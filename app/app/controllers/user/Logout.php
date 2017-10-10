<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
	function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->session->unset_userdata('logged_in');
    $this->session->unset_userdata('user_id');
    $this->session->unset_userdata('username');
    $this->session->sess_destroy();

    // Message
    $this->session->set_flashdata('success', 'You are logged out');
    redirect('user/login');
	}
}
