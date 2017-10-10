<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campaigns extends CI_Controller {
	function __construct() {
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

	public function index() {
	//	$data['username'] = ucfirst($this->session->userdata('name'));
	//	$data['creatives'] = $this->Campaign_model->get_campaigns();
	//  $data['tags'] = $this->Campaign_model->list_tags();
		$this->load->view('user/campaigns', $data);
		echo "Elastic Email";
	}

	public function request() {
		Requests::get('https://api.elasticemail.com/v2/campaign/list?apikey=a4266009-1c30-4ac7-b17e-04827319bd0f', array('Accept' => 'application/json'));
		$data['name'] = ucfirst($this->session->userdata('name'));
		$data['email'] = $this->Campaign_model->get_campaigns();
		$this->load->view('user/campaigns', $data);
	}
	

	public function add() {
		$this->form_validation->set_rules('campaign','Campaign','required');
		$this->form_validation->set_rules('code','Code of Campaign','required|is_unique[creatives.campaign_code]');
		$this->form_validation->set_rules('offer_id','Offer','required');

		if ($this->form_validation->run() == FALSE){
				//Load View
				$data['offers'] = $this->Campaign_model->list_offers();
				$data['tags'] = $this->Campaign_model->list_tags();
				$this->load->view('user/campaign_add',$data);
		} else {
			// print_r($this->input->post('tags'));
			if(null !== $this->input->post('tags')) {
				$tags = implode(',',$this->input->post('tags'));
			} else {
				$tags = $this->input->post('tags');
			}
			$data = array(
	            'offer_id' => $this->input->post('offer_id'),
	            'campaign_code' => $this->input->post('code'),
	            'campaign' => $this->input->post('campaign'),
							'creative_tags' => $tags
	        );
			if($this->Campaign_model->add('campaigns', $data)){
				// Create Message
				$this->session->set_flashdata('success', 'The campaign has been added successfully.');

				// Redirect
				redirect('user/campaigns');
			} else {
					// Create Error
					$this->session->set_flashdata('error', 'There is an error while adding the Campaign to the database. Please try again.');

					// Redirect to pages
					redirect('user/campaigns/add');
			}
		}
	}

	public function view($id = FALSE, $html = FALSE) {
		if(!$id){
			redirect('user/campaigns');
		}
		$campaign = $this->Campaign_model->single_creative($id);
		$data['tags'] = $this->Campaign_model->list_tags();
		$data['html'] = $html;
		if($campaign) {
			$data['campaign'] = $campaign;
			$data['offer'] = $this->Campaign_model->single_offer($campaign->offer_id);
			$data['vertical'] = $this->Campaign_model->single_vertical($data['offer']->vertical_id);
			$data['subject_lines'] = $this->Campaign_model->search_subject_lines($data['offer']->offer);
			$data['search'] = $data['offer']->offer;
		} else {
			$this->session->set_flashdata('error', 'There is no campaign with this ID. Please try another campaign.');
			// Redirect
			redirect('user/campaigns');
		}
		$this->load->view('user/campaign_view',$data);
	}

	public function verticals() {
		$this->form_validation->set_rules('vertical','Vertical','required|is_unique[verticals.vertical]');

		if ($this->form_validation->run() == FALSE){
				//Load View
				$data['verticals'] = $this->Campaign_model->list_verticals();
				$this->load->view('user/verticals',$data);
		} else {
			$data = array(
	            'vertical' => $this->input->post('vertical')
	        );

			if($this->Campaign_model->add('verticals', $data)){
				// Create Message
				$this->session->set_flashdata('success', 'The vertical has been added successfully.');

				// Redirect
				redirect('user/campaigns/verticals');
			} else {
					// Create Error
					$this->session->set_flashdata('error', 'There is an error while adding the vertical to the database. Please try again.');

					// Redirect to pages
					redirect('user/campaigns/verticals');
			}
		}
	}

	public function tags() {
		$this->form_validation->set_rules('tag','Tag','required|is_unique[tags.tag]');
		$this->form_validation->set_rules('color','Tag Color','required');

		if ($this->form_validation->run() == FALSE){
				//Load View
				$data['tags'] = $this->Campaign_model->list_tags();
				$this->load->view('user/tags',$data);
		} else {
			$data = array(
	            'tag' => $this->input->post('tag'),
							'tag_color_class' => $this->input->post('color')
	        );

			if($this->Campaign_model->add('tags', $data)){
				// Create Message
				$this->session->set_flashdata('success', 'The tag has been added successfully.');

				// Redirect
				redirect('user/campaigns/tags');
			} else {
					// Create Error
					$this->session->set_flashdata('error', 'There is an error while adding the tag into the database. Please try again.');

					// Redirect to pages
					redirect('user/campaigns/tags');
			}
		}
	}

	public function subjects() {
		$this->form_validation->set_rules('subject','Subject','required');
		$this->form_validation->set_rules('offer_id','Offer','required');

		if ($this->form_validation->run() == FALSE){
				$data['subject_lines'] = $this->Campaign_model->get_subject_lines();
				$data['verticals'] = $this->Campaign_model->list_verticals();
				$data['offers'] = $this->Campaign_model->get_offers();
				//Load View
				$this->load->view('user/subjects',$data);
		} else {
				$data = array(
		            'subject' => $this->input->post('subject'),
								'offer_id' => $this->input->post('offer_id')
		        );
				if($this->Campaign_model->add('subject_lines', $data)){
					// Create Message
					$this->session->set_flashdata('success', 'The subject line has been added successfully.');
				} else {
					// Create Error
					$this->session->set_flashdata('error', 'There is an error while adding the subject line to the database. Please try again.');
				}
			// Redirect
			redirect('user/campaigns/subjects');
		}
	}

	public function offers() {
		$this->form_validation->set_rules('offer','Offer Name or Description','required');
		$this->form_validation->set_rules('code','Code of The Offer','required|is_unique[offers.offer_code]');

		if ($this->form_validation->run() == FALSE){
				//Load View
				$data['verticals'] = $this->Campaign_model->list_verticals();
				$data['offers'] = $this->Campaign_model->get_offers();
				$data['tags'] = $this->Campaign_model->list_tags();
				$this->load->view('user/offers',$data);
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

			if($this->Campaign_model->add('offers', $data)){
				// Create Message
				$this->session->set_flashdata('success', 'The offer has been added successfully.');

				// Redirect
				redirect('user/campaigns/offers');
			} else {
					// Create Error
					$this->session->set_flashdata('error', 'There is an error while adding the vertical to the database. Please try again.');

					// Redirect to pages
					redirect('user/campaigns/offers');
			}
		}
	}

	public function search() {
		$data['username'] = ucfirst($this->session->userdata('name'));
		$data['search'] = $this->input->get_post('q');
		if(!$data['search']) {
			$this->session->set_flashdata('error', 'You have not submitted the search query. Please try again.');
			// Redirect
			redirect('user/campaigns');
		}
		$data['tags'] = $this->Campaign_model->list_tags();
		$data['campaigns'] = $this->Campaign_model->search_campaigns($data['search']);
		$data['offers'] = $this->Campaign_model->search_offers($data['search']);
		$data['subject_lines'] = $this->Campaign_model->search_subject_lines($data['search']);
		$this->load->view('user/search', $data);
	}
}


  