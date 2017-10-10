<?php
class Wiki extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Wiki_model');
        $this->load->helper('url_helper');
        $this->load->helper(array('form', 'url'));
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
        $data['wiki'] = $this->Wiki_model->get_wiki();
      //  $data['id'] = $id;
       // $data['title'] = $title;
     //   $data['text'] = $text;
     //   $this->load->view('search_page2', $data);
    //    $data['title'] = 'Wiki archive';
        $this->load->helper('url');
       
        $this->load->view('admin/wiki_index', $data);


        
        
    }
 
    public function view($id = NULL)
    {
        $data['wiki_item'] = $this->Wiki_model->get_wiki($id);
        
        if (empty($data['wiki_item']))
        {
            show_404();
        }
 
        $data['title'] = $data['wiki_item']['title'];
 
        $this->load->view('admin/wiki_view', $data);
    }

       

     
    public function create()
    {
        $this->load->helper('form');
        $this->load->helper('url');
        // To use base_url() you need to load URL Helper.
        $this->load->library('form_validation');
        $data['title'] = 'Create a wiki item';
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');
 	
        if ($this->form_validation->run() === FALSE)
        {
         $this->load->view('admin/wiki_create');
         }
        else
        {
            $this->Wiki_model->set_wiki();
            $this->session->set_flashdata('success', 'Wiki Post Created Succesfully!');
            redirect(base_url() . 'index.php/admin/wiki');
        }
    }
    

    public function edit()
    {      

        $id = $this->uri->segment(4);
        
        if (empty($id))
        {
            show_404();
        }
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
      //  $data['title'] = 'Edit a news item';   
        //$data['wiki_item'] = $this->Wiki_model->get_wiki_by_title();     
        $data['wiki_item'] = $this->Wiki_model->get_wiki_by_id($id);        
        
		$this->load->view('admin/wiki_edit', $data);
    }


    

    public function edit_old($data)
    {
        $id = $this->uri->segment(4);
        
        if (empty($id))
        {
            show_404();
        }
        
        $this->load->helper('form');
        $this->load->library('form_validation');

        

      //  $query = $this->db->where('id',$id)->get('wiki');
       // die(print_r($query->result()));
     //   $data['wiki'] = $this->Wiki_model->single_wiki($id);
       // die(print_r( $this->Wiki_model->single_wiki($id)));

     //  $data ['id'] = $this->Wiki_model->single_wiki($id);
    //    $data['title'] = $this->Wiki_model->get_title($id);        
    //   $data['wiki_item'] = $this->Wiki_model->get_wiki_by_id($id);
   //     
         $this->form_validation->set_rules('title', 'Title');
         $this->form_validation->set_rules('text', 'Text');
         $this->form_validation->set_rules('id', 'ID');
         if ($this->form_validation->run() === FALSE)


       $wiki = $this->Wiki_model->single_wiki($id);
     //  $data['title'] = $data['wiki_item']['title'];
     //  $data['title'] = $this->Wiki_model->get_title($id);
        
        if($wiki) {
            $data['wiki'] = $wiki;
            $data['title'] = $this->Wiki_model->get_wiki($title->title);
            $data['id'] = $this->Wiki_model->get_id($data['id']->id);
            $data['text'] = $this->Wiki_model->get_text($data['text']->text);
            
        }
        else
        {
            $this->Wiki_model->update($text, $title);
            $this->load->view('admin/wiki_success');

          //  $this->session->set_flashdata('error', 'There is no creative with this ID. Please try another creative.');
            // Redirect
          //  redirect('admin/creatives');
        }
        $this->load->view('admin/wiki_edit', $data);
        
        }

    
  public function add() {
		$this->form_validation->set_rules('title','Title','required');
		$this->form_validation->set_rules('text','Text of Post','required');
		$this->form_validation->set('file');

		if ($this->form_validation->run() == FALSE){
				//Load View
				$data['tite'] = $this->Wiki_model->list_title();
				$data['text'] = $this->Wiki_model->list_text();
				$data['file'] = $this->Wiki_model->list_files();
				$this->load->view('admin/wiki_create',$data);
		} else {
			// print_r($this->input->post('tags'));
			if(null !== $this->input->post('tags')) {
				$tags = implode(',',$this->input->post('tags'));
			} else {
				$tags = $this->input->post('tags');
			}
			$data = array(
	            'title' => $this->input->post('title'),
	            'text' => $this->input->post('text'),
	            'file' => $this->input->post('file'),
							
	        );
			if($this->Wiki_model->add('wiki', $data)){
				// Create Message
				$this->session->set_flashdata('success', 'The creative has been added successfully.');

				// Redirect
				redirect('admin/wiki_success');
			} else {
					// Create Error
					$this->session->set_flashdata('error', 'There is an error while adding the creative to the database. Please try again.');

					// Redirect to pages
					redirect('admin/wiki_create');
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

 
    public function delete_row($id) {   
    $this->load->model("Wiki_model");
    $this->Wiki_model->did_delete_row($id);
    $this->session->set_flashdata('success', 'Wiki Post was deleted!');
    redirect(base_url() . 'index.php/admin/wiki');

    }
	
	public function update()

	{
		$mdata['title']=$_POST['title'];

		$mdata['text']=$_POST['text'];
		

		$res=$this->Wiki_model->update($mdata, $_POST['id']);
		
		$this->session->set_flashdata('success', 'Wiki Post updated Succesfully!');
		redirect(base_url() . 'index.php/admin/wiki');

}

	
	
               
}
