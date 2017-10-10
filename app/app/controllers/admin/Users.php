<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('User_model');
		if(!$this->session->userdata('logged_in')){
			redirect('user/login');
		}
		if(!$this->User_model->isadmin($this->session->userdata('user_id'))) {
			redirect('user/login');
		}
	}

	public function index()
	{
		$data['users'] = $this->User_model->get_list();
		$this->load->view('admin/users', $data);
	}

	// Activates or deactivates the user (toggles active flag ON or OFF)
	public function active($id = FALSE) {
		if ($id === FALSE) {
			$this->session->set_flashdata('error', 'You have not provided the user ID. Please try again.');
			redirect(admin/users);
		} else {
			$this->User_model->de_activate($id);
			$this->session->set_flashdata('success', 'User has been activated (or deactivated) successfully.');
			redirect('admin/users');
		}
	}

	// Toggles the administrator rights on user - ON / OFF
	public function admin($id = FALSE) {
		if ($id === FALSE) {
			$this->session->set_flashdata('error', 'You have not provided the user ID. Please try again.');
			redirect(admin/users);
		} else {
			$this->User_model->admin_rights($id);
			$this->session->set_flashdata('success', 'The admin rights for this user have been changed successfully.');
			redirect('admin/users');
		}
	}

	// Editing the user
	public function edit($id = FALSE) {
		if ($id === FALSE) {
			$this->session->set_flashdata('error', 'You have not provided the user ID. Please try again.');
			redirect('admin/users');
		}

		$this->form_validation->set_rules('first','First Name','required|trim|strtolower|ucwords');
		$this->form_validation->set_rules('last','Last Name','required|trim|strtolower|ucwords');
		$this->form_validation->set_rules('admin_rights','Admin Rights','required|in_list[0,1]');
		$this->form_validation->set_rules('active','User Enabled','required|in_list[0,1]');
		if(strlen($this->input->post('password')) > 0) {
			$this->form_validation->set_rules('password','Password','required|min_length[8]|matches[confirm_password]');
			$this->form_validation->set_rules('confirm_password','Password Confirmation','required|min_length[8]|matches[password]');
		}

		if ($this->form_validation->run() == FALSE){
				//Load View
				$data['user'] = $this->User_model->single_user($id);
				$this->load->view('admin/user_edit', $data);
		} else {
			$email = strtok(strtolower($this->input->post('first')),' ').'@xenainteractive.com';
			if(strlen($this->input->post('password')) > 0) {
			$data = array(
	            'is_admin' => $this->input->post('admin_rights'),
	            'is_disabled' => $this->input->post('active'),
	            'email' => $email,
							'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
							'first_name' => $this->input->post('first'),
							'last_name' => $this->input->post('last')
	        );
			} else {
				$data = array(
		            'is_admin' => $this->input->post('admin_rights'),
		            'is_disabled' => $this->input->post('active'),
		            'email' => $email,
								'first_name' => $this->input->post('first'),
								'last_name' => $this->input->post('last')
		        );
			}
			if($this->User_model->update($data, $id)){
				// Create Message
				$this->session->set_flashdata('success', 'The user has been edited successfully.');

				// Redirect
				redirect('admin/users');
			} else {
				// Create Error
				$this->session->set_flashdata('error', 'There is an error while updating the user. Please try again.');

				// Redirect to pages
				redirect('admin/users/edit/'.$id);
			}
		}
	}

	// Adding the user
	public function add() {
		$this->form_validation->set_rules('first','First Name','required|trim|strtolower|ucwords|is_unique[users.first_name]');
		$this->form_validation->set_rules('last','Last Name','required|trim|strtolower|ucwords');
		$this->form_validation->set_rules('password','Password','required|min_length[8]|matches[confirm_password]');
		$this->form_validation->set_rules('confirm_password','Password Confirmation','required|min_length[8]|matches[password]');
		$this->form_validation->set_rules('admin_rights','Admin Rights','required|in_list[0,1]');
		$this->form_validation->set_rules('active','User Enabled','required|in_list[0,1]');

		if ($this->form_validation->run() == FALSE){
				//Load View
				$this->load->view('admin/user_add');
		} else {
			$email = strtok(strtolower($this->input->post('first')),' ').'@xenainteractive.com';
			$data = array(
	            'is_admin' => $this->input->post('admin_rights'),
	            'is_disabled' => $this->input->post('active'),
	            'email' => $email,
							'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
							'first_name' => $this->input->post('first'),
							'last_name' => $this->input->post('last')
	        );
			if($this->User_model->add($data)){
				// Create Message
				$this->session->set_flashdata('success', 'The user has been added successfully.');

				// Redirect
				redirect('admin/users');
			} else {
				// Create Error
				$this->session->set_flashdata('error', 'There is an error while adding the user to the database. Please try again.');

				// Redirect to pages
				redirect('admin/users/add');
			}
		}
	}
}
