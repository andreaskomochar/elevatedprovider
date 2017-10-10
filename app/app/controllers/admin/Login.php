<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in')){
			redirect('user/dashboard');
		}
		$this->load->model('User_model');
	}

	public function index() {
		// die("<h1>Xenapedia is under the active maintenance! Please come back after about a week.</h1>");
		// $this->form_validation->set_rules('email','Email','trim|required|min_length[21]|regex_match["\w+@xenainteractive.com"]');
		$this->form_validation->set_rules('name','Name','trim|required|strtolower');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[5]');
		//$this->form_validation->set_rules('g-recaptcha-response','Captcha Challenge','required');

		if ($this->form_validation->run() == FALSE){
				//Load Login View
				$this->load->view('user/login');
		} else {
			 // Get Post Data
				// $email = $this->input->post('email');
				$name = $this->input->post('name');
				$password = $this->input->post('password');
				// $user_ip = $this->input->ip_address();

				 $recaptcha_headers = array('Content-Type' => 'application/json');
				$recaptcha_fields = array(
						'secret'   => "6LcDwRgUAAAAABphPKLToR9YY8WXFgYby2kR0B-K",
						'response' => $this->input->post('g-recaptcha-response'),
						'remoteip' => $_SERVER['REMOTE_ADDR']
				);

				$this->load->library('PHPRequests');
				$response = Requests::post("https://www.google.com/recaptcha/api/siteverify", array(), $recaptcha_fields);
				$recaptcha_post_body = json_decode($response->body, true);
				if(ENVIRONMENT == 'production' && isset($response) && $response->success && $recaptcha_post_body['success'] && $recaptcha_post_body['hostname'] == 'xenapedia.com') {
					$user_id = $this->User_model->login($name, $password);
				} else if(ENVIRONMENT == 'development' && isset($response) && $response->success && $recaptcha_post_body['success'] && $recaptcha_post_body['hostname'] == 'localhost') {
					$user_id = $this->User_model->login($name, $password);
				} else {
					$user_id = FALSE;
				}

				if($user_id && !$this->User_model->disabled($user_id)){
			//	if(!$this->User_model->disabled($user_id)){
						$user_data = array(
								'user_id' => $user_id,
								'name'  => $name,
								'logged_in' => true
						);

						// Set Session Data
						$this->session->set_userdata($user_data);

						// Create Message
						$this->session->set_flashdata('success', 'You are logged in');

						// Redirect to pages
						redirect('user/dashboard');
				} else {
						// Create Error
						$this->session->set_flashdata('error', 'Invalid Login');

						// Redirect to pages
						redirect('user/login');
				}
		}
	}
}
