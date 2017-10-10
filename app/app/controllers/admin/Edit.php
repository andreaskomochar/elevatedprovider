<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('User_model');
		if(!$this->session->userdata('logged_in')){
			redirect('user/login');
		}
		if(!$this->User_model->isadmin($this->session->userdata('user_id'))) {
			redirect('user/login');
		}
		$this->load->model('Creative_model');
	}

	public function index() {
		// $data['username'] = ucfirst($this->session->userdata('name'));
		redirect('admin');
	}

	public function creative($id = FALSE) {
		if(!$id){
			redirect('admin/creatives');
		}
		$this->form_validation->set_rules('creative','Creative','required');
		$this->form_validation->set_rules('code','Code of Creative','required');
		$this->form_validation->set_rules('offer_id','Offer','required');

		if ($this->form_validation->run() == FALSE){
				//Load View
				$data['offers'] = $this->Creative_model->list_offers();
				$data['tags'] = $this->Creative_model->list_tags();
				$creative = $this->Creative_model->single_creative($id);
				if($creative) {
					$data['creative'] = $creative;
				} else {
					$this->session->set_flashdata('error', 'There is no creative with this ID. Please try another creative.');
					// Redirect
					redirect('admin/creatives');
				}
				$this->load->view('admin/creative_edit',$data);
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
			if($this->Creative_model->update('creative_id', $id, 'creatives', $data)){
				// Create Message
				$this->session->set_flashdata('success', 'The creative has been edited successfully.');

				// Redirect
				redirect('admin/creatives');
			} else {
					// Create Error
					$this->session->set_flashdata('error', 'There is an error while updating the creative. Please try again.');

					// Redirect
					redirect('admin/creatives');
			}
		}
	}

	public function vertical($id = FALSE) {
		if(!$id){
			redirect('admin/creatives/verticals');
		}
		$this->form_validation->set_rules('vertical','Vertical','required');

		if ($this->form_validation->run() == FALSE){
				//Load View
				$vertical = $this->Creative_model->single_vertical($id);
				if($vertical) {
					$data['vertical'] = $vertical;
				} else {
					$this->session->set_flashdata('error', 'There is no vertical with this ID. Please try another one.');
					// Redirect
					redirect('admin/creatives/verticals');
				}
				$this->load->view('admin/vertical_edit',$data);
		} else {
			$data = array(
	            'vertical' => $this->input->post('vertical')
	        );

			if($this->Creative_model->update('vertical_id', $id, 'verticals', $data)){
				// Create Message
				$this->session->set_flashdata('success', 'The vertical has been edited successfully.');

				// Redirect
				redirect('admin/creatives/verticals');
			} else {
					// Create Error
					$this->session->set_flashdata('error', 'There is an error while updating the vertical. Please try again.');

					// Redirect to pages
					redirect('admin/creatives/verticals');
			}
		}
	}

	public function tag($id = FALSE) {
		if(!$id){
			redirect('admin/creatives/tags');
		}
		$this->form_validation->set_rules('tag','Tag','required');
		$this->form_validation->set_rules('color','Tag Color','required');

		if ($this->form_validation->run() == FALSE){
				//Load View
				$tag = $this->Creative_model->single_tag($id);
				if($tag) {
					$data['tag'] = $tag;
				} else {
					$this->session->set_flashdata('error', 'There is no tag with this ID. Please try another one.');
					// Redirect
					redirect('admin/creatives/tags');
				}
				$this->load->view('admin/tag_edit',$data);
		} else {
			$data = array(
	            'tag' => $this->input->post('tag'),
							'tag_color_class' => $this->input->post('color')
	        );

			if($this->Creative_model->update('tag_id', $id, 'tags', $data)){
				// Create Message
				$this->session->set_flashdata('success', 'The tag has been edited successfully.');

				// Redirect
				redirect('admin/creatives/tags');
			} else {
					// Create Error
					$this->session->set_flashdata('error', 'There is an error while updating the tag. Please try again.');

					// Redirect to pages
					redirect('admin/creatives/tags');
			}
		}
	}

	public function subject($id = FALSE) {
		if(!$id){
			redirect('admin/creatives/subjects');
		}
		$this->form_validation->set_rules('subject','Subject','required');
		$this->form_validation->set_rules('offer_id','Offer','required');

		if ($this->form_validation->run() == FALSE){
				$data['verticals'] = $this->Creative_model->list_verticals();
				$data['offers'] = $this->Creative_model->get_offers();
				$subject = $this->Creative_model->single_subject_line($id);
				if($subject) {
					$data['subject'] = $subject;
				} else {
					$this->session->set_flashdata('error', 'There is no Subject Line with this ID. Please try another one.');
					// Redirect
					redirect('admin/creatives/subjects');
				}
				//Load View
				$this->load->view('admin/subject_edit',$data);
		} else {
					$data = array(
			            'subject' => $this->input->post('subject'),
									'offer_id' => $this->input->post('offer_id')
			        );
					$query = $this->Creative_model->update('subject_id', $id, 'subject_lines', $data);

				if($query){
					// Create Message
					$this->session->set_flashdata('success', 'The subject line has been edited successfully.');
				} else {
					// Create Error
					$this->session->set_flashdata('error', 'There is an error while updating the subject line. Please try again.');
				}
			// Redirect
			redirect('admin/creatives/subjects');
		}
	}

	public function offer($id = FALSE) {
		if(!$id){
			redirect('admin/creatives/offers');
		}
		$this->form_validation->set_rules('offer','Offer Name or Description','required');
		$this->form_validation->set_rules('code','Code of The Offer','required');

		if ($this->form_validation->run() == FALSE){
				//Load View
				$data['verticals'] = $this->Creative_model->list_verticals();
				$data['tags'] = $this->Creative_model->list_tags();
				$offer = $this->Creative_model->single_offer($id);
				if($offer) {
					$data['offer'] = $offer;
					$data['selected_tags'] = explode(',',$offer->offer_tags);
				} else {
					$this->session->set_flashdata('error', 'There is no Offer with this ID. Please try another one.');
					// Redirect
					redirect('admin/creatives/offers');
				}
				$this->load->view('admin/offer_edit',$data);
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

			if($this->Creative_model->update('offer_id', $id, 'offers', $data)){
				// Create Message
				$this->session->set_flashdata('success', 'The offer has been edited successfully.');

				// Redirect
				redirect('admin/creatives/offers');
			} else {
					// Create Error
					$this->session->set_flashdata('error', 'There is an error while updating the offer. Please try again.');

					// Redirect to pages
					redirect('admin/creatives/offers');
			}
		}
	}
}
