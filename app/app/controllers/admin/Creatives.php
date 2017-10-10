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
		if(!$this->User_model->isadmin($this->session->userdata('user_id'))) {
			redirect('user/login');
		}
	}

	public function index() {
		$data['username'] = ucfirst($this->session->userdata('name'));
		$data['creatives'] = $this->Creative_model->get_creatives();
		$data['tags'] = $this->Creative_model->list_tags();
		$this->load->view('admin/creatives', $data);
	}

	public function add() {
		$this->form_validation->set_rules('creative','Creative','required');
		$this->form_validation->set_rules('code','Code of Creative','required|is_unique[creatives.creative_code]');
		$this->form_validation->set_rules('offer_id','Offer','required');

		if ($this->form_validation->run() == FALSE){
				//Load View
				$data['offers'] = $this->Creative_model->list_offers();
				$data['tags'] = $this->Creative_model->list_tags();
				$this->load->view('admin/creative_add',$data);
		} else {
			// print_r($this->input->post('tags'));
			if(null !== $this->input->post('tags')) {
				$tags = implode(',',$this->input->post('tags'));
			} else {
				$tags = $this->input->post('tags');
			}
			$data = array(
	            'offer_id' => $this->input->post('offer_id'),
	            'creative_code' => $this->input->post('code'),
	            'creative' => $this->input->post('creative'),
							'creative_tags' => $tags
	        );
			if($this->Creative_model->add('creatives', $data)){
				// Create Message
				$this->session->set_flashdata('success', 'The creative has been added successfully.');

				// Redirect
				redirect('admin/creatives');
			} else {
					// Create Error
					$this->session->set_flashdata('error', 'There is an error while adding the creative to the database. Please try again.');

					// Redirect to pages
					redirect('admin/creatives/add');
			}
		}
	}

	public function view($id = FALSE, $html = FALSE) {
		if(!$id){
			redirect('admin/creatives');
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
			redirect('admin/creatives');
		}
		$this->load->view('admin/creative_view',$data);
	}

	public function verticals() {
		$this->form_validation->set_rules('vertical','Vertical','required|is_unique[verticals.vertical]');

		if ($this->form_validation->run() == FALSE){
				//Load View
				$data['verticals'] = $this->Creative_model->list_verticals();
				$this->load->view('admin/verticals',$data);
		} else {
			$data = array(
	            'vertical' => $this->input->post('vertical')
	        );

			if($this->Creative_model->add('verticals', $data)){
				// Create Message
				$this->session->set_flashdata('success', 'The vertical has been added successfully.');

				// Redirect
				redirect('admin/creatives/verticals');
			} else {
					// Create Error
					$this->session->set_flashdata('error', 'There is an error while adding the vertical to the database. Please try again.');

					// Redirect to pages
					redirect('admin/creatives/verticals');
			}
		}
	}

	public function tags() {
		$this->form_validation->set_rules('tag','Tag','required|is_unique[tags.tag]');
		$this->form_validation->set_rules('color','Tag Color','required');

		if ($this->form_validation->run() == FALSE){
				//Load View
				$data['tags'] = $this->Creative_model->list_tags();
				$this->load->view('admin/tags',$data);
		} else {
			$data = array(
	            'tag' => $this->input->post('tag'),
							'tag_color_class' => $this->input->post('color')
	        );

			if($this->Creative_model->add('tags', $data)){
				// Create Message
				$this->session->set_flashdata('success', 'The tag has been added successfully.');

				// Redirect
				redirect('admin/creatives/tags');
			} else {
					// Create Error
					$this->session->set_flashdata('error', 'There is an error while adding the tag into the database. Please try again.');

					// Redirect to pages
					redirect('admin/creatives/tags');
			}
		}
	}

	public function subjects() {
		$this->form_validation->set_rules('subject','Subject','required');
		$this->form_validation->set_rules('offer_id','Offer','required');

		if ($this->form_validation->run() == FALSE){
				$data['subject_lines'] = $this->Creative_model->get_subject_lines();
				$data['verticals'] = $this->Creative_model->list_verticals();
				$data['offers'] = $this->Creative_model->get_offers();
				//Load View
				$this->load->view('admin/subjects',$data);
		} else {
				$data = array(
		            'subject' => $this->input->post('subject'),
								'offer_id' => $this->input->post('offer_id')
		        );
				if($this->Creative_model->add('subject_lines', $data)){
					// Create Message
					$this->session->set_flashdata('success', 'The subject line has been added successfully.');
				} else {
					// Create Error
					$this->session->set_flashdata('error', 'There is an error while adding the subject line to the database. Please try again.');
				}
			// Redirect
			redirect('admin/creatives/subjects');
		}
	}

	public function offers() {
		$this->form_validation->set_rules('offer','Offer Name or Description','required');
		$this->form_validation->set_rules('code','Code of The Offer','required|is_unique[offers.offer_code]');

		if ($this->form_validation->run() == FALSE){
				//Load View
				$data['verticals'] = $this->Creative_model->list_verticals();
				$data['offers'] = $this->Creative_model->get_offers();
				$data['tags'] = $this->Creative_model->list_tags();
				$this->load->view('admin/offers',$data);
		} else {
			if(null !== $this->input->post('tags')) {
				$tags = implode(',',$this->input->post('tags'));
			} else {
				$tags = $this->input->post('tags');
			}
			$data = array(
	            'vertical_id' => $this->input->post('vertical'),
							'offer_code' => $this->input->post('code'),
							'offer' => $this->input->post('offer'),
							'offer_tags' => $tags
	        );

			if($this->Creative_model->add('offers', $data)){
				// Create Message
				$this->session->set_flashdata('success', 'The offer has been added successfully.');

				// Redirect
				redirect('admin/creatives/offers');
			} else {
					// Create Error
					$this->session->set_flashdata('error', 'There is an error while adding the vertical to the database. Please try again.');

					// Redirect to pages
					redirect('admin/creatives/offers');
			}
		}
	}

	public function search() {
		$data['username'] = ucfirst($this->session->userdata('name'));
		$data['search'] = $this->input->get_post('q');
		if(!$data['search']) {
			$this->session->set_flashdata('error', 'You have not submitted the search query. Please try again.');
			// Redirect
			redirect('admin/creatives');
		}
		$data['tags'] = $this->Creative_model->list_tags();
		$data['creatives'] = $this->Creative_model->search_creatives($data['search']);
		$data['offers'] = $this->Creative_model->search_offers($data['search']);
		$data['subject_lines'] = $this->Creative_model->search_subject_lines($data['search']);
		$this->load->view('admin/search', $data);
	}
}