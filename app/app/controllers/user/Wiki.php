<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wiki extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Wiki_model');
        $this->load->helper('url_helper');
        $this->load->helper(array('form', 'url'));
        $this->load->model('User_model');

		if(!$this->session->userdata('logged_in')){
			redirect('user/login');
		}
	}

	public function index() {
		
        $data['wiki'] = $this->Wiki_model->get_wiki();
      //  $data['id'] = $id;
       // $data['title'] = $title;
     //   $data['text'] = $text;
     //   $this->load->view('search_page2', $data);
    //    $data['title'] = 'Wiki archive';
        $this->load->helper('url');
       
        $this->load->view('user/wiki_index', $data);
        
        
    }
	

	public function view($id = NULL)
    {
        $data['wiki_item'] = $this->Wiki_model->get_wiki($id);
        
        if (empty($data['wiki_item']))
        {
            show_404();
        }
 
        $data['title'] = $data['wiki_item']['title'];
 
        $this->load->view('user/wiki_view', $data);
    }

	public function search() {
		$data['username'] = ucfirst($this->session->userdata('name'));
		$data['search'] = $this->input->get_post('q');
		if(!$data['search']) {
			$this->session->set_flashdata('error', 'You have not submitted the search query. Please try again.');
			// Redirect
			redirect('user/wikis');
		}
		$data['wikis'] = $this->Wiki_model->search_creatives($data['search']);
		$this->load->view('user/search', $data);
	}
}
