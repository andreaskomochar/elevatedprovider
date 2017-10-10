<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Creatives extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Creative_model');
		$this->load->model('User_model');
		if(!$this->session->userdata('logged_in')){
			redirect('user/login');
		}
	}

	public function index() {
		$data['username'] = ucfirst($this->session->userdata('name'));
		$data['creatives'] = $this->Creative_model->get_creatives();
		$data['tags'] = $this->Creative_model->list_tags();
		$this->load->view('user/creatives', $data);
	}

	public function view($id = FALSE, $html = FALSE) {
		if(!$id){
			redirect('user/creatives');
		}
		$creative = $this->Creative_model->single_creative($id);
		$data['tags'] = $this->Creative_model->list_tags();
		$data['html'] = $html;
		if($creative) {
			$data['creative'] = $creative;
			$data['offer'] = $this->Creative_model->single_offer($creative->offer_id);
			$data['vertical'] = $this->Creative_model->single_vertical($data['offer']->vertical_id);
      $data['subject_lines'] = $this->Creative_model->search_subject_lines($data['offer']->offer);
			$data['search'] = $data['offer']->offer;
		} else {
			$this->session->set_flashdata('error', 'There is no creative with this ID. Please try another creative.');
			// Redirect
			redirect('user/creatives');
		}
		$this->load->view('user/creative_view',$data);
	}

	public function verticals() {
		$data['verticals'] = $this->Creative_model->list_verticals();
		$this->load->view('user/verticals',$data);
	}

	public function tags() {
		$data['tags'] = $this->Creative_model->list_tags();
		$this->load->view('user/tags',$data);
	}

	public function subjects() {
		$data['subject_lines'] = $this->Creative_model->get_subject_lines();
		$data['verticals'] = $this->Creative_model->list_verticals();
		$data['offers'] = $this->Creative_model->get_offers();
		//Load View
		$this->load->view('user/subjects',$data);
	}

	public function offers() {
		$data['verticals'] = $this->Creative_model->list_verticals();
		$data['offers'] = $this->Creative_model->get_offers();
		$this->load->view('user/offers',$data);
	}

	public function search() {
		$data['username'] = ucfirst($this->session->userdata('name'));
		$data['search'] = $this->input->get_post('q');
		if(!$data['search']) {
			$this->session->set_flashdata('error', 'You have not submitted the search query. Please try again.');
			// Redirect
			redirect('user/creatives');
		}
		$data['tags'] = $this->Creative_model->list_tags();
		$data['creatives'] = $this->Creative_model->search_creatives($data['search']);
		$data['offers'] = $this->Creative_model->search_offers($data['search']);
		$data['subject_lines'] = $this->Creative_model->search_subject_lines($data['search']);
		$this->load->view('user/search', $data);
	}
}
