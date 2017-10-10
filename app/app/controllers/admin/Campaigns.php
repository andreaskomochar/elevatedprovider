<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campaigns extends CI_Controller {
	
	function __construct() 
		{
		parent::__construct();
		$this->load->model('Campaign_model');	
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
		$data['campaigns'] = $this->Campaign_model->get_data();
		$data['cake'] = $this->Campaign_model->get_cake();
        $this->load->view('admin/campaigns', $data);
		}
	
}


