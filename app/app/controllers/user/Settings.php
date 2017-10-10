<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('User_model');
		if(!$this->session->userdata('logged_in')){
			redirect('user/login');
		}
	}

	public function index() {
		$this->form_validation->set_rules('current_password','Current Password','required|min_length[8]|differs[password]');
		$this->form_validation->set_rules('password','New Password','required|min_length[8]|matches[confirm_password]');
		$this->form_validation->set_rules('confirm_password','Password Confirmation','required|min_length[8]|matches[password]');

		if ($this->form_validation->run() == FALSE){
				//Load View
				$this->load->view('user/settings');
		} else {
			$data = array(
							'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
					);
			if(password_verify($this->input->post('current_password'), $this->User_model->single_user($this->session->userdata('user_id'))->password)) {
				if($this->User_model->update($data, $this->session->userdata('user_id'))){
					// Create Message
					$this->session->set_flashdata('success', 'The user settings has been edited successfully.');

					// Redirect
					redirect('user/settings');
				} else {
					// Create Error
					$this->session->set_flashdata('error', 'There is an error while updating the user settings. Please try again.');

					// Redirect
					redirect('user/settings');
				}
			} else {
				// Create Error
				$this->session->set_flashdata('error', 'Current password entered is wrong. Please try again.');
				// Redirect
				redirect('user/settings');
			}
		}
	}
}
