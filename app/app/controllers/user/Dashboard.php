<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('User_model');
		if(!$this->session->userdata('logged_in')){
			redirect('user/login');
		}
	}

	public function index()
	{
		$data['username'] = ucfirst($this->session->userdata('name'));
		$this->load->view('user/dashboard', $data);
	}
}
