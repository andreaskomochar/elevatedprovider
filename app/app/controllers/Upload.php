<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('Upload_model');
	}

	public function index()
	{
		$this->load->view('upload/upload',array('error' => ' ' ));
	}

	public function do_upload_ac()
        {
                header('Cache-Control: must-revalidate');
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'csv';
                $config['max_size']             = 0;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;                

                $this->load->library('Upload', $config);

                if ( ! $this->upload->do_upload('actives'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        $this->session->set_flashdata('error', 'Csv Data Import failed!! Please check the file size or file type!');
                        //$this->load->view('admin/muc', $error);
                        redirect(base_url() . 'index.php/admin/muc');
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                        
                        $filename_ac = $this->upload->data('full_path');

                        $this->Upload_model->insert_csv_ac($filename_ac);
                        $this->Upload_model->clean_temp_ac();
                        $this->Upload_model->truncate_temp_ac();             

                        $this->session->set_flashdata('success', 'Csv Data Imported Succesfully!');
                        //$this->load->view('success', $data);
                        unlink($filename_ac);			
                        redirect(base_url() . 'index.php/admin/muc');
                }

               
        }

        public function do_upload_un()
        {
				
                header('Cache-Control: must-revalidate');
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'csv';
                $config['max_size']             = 0;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;               


                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('unactives'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        $this->session->set_flashdata('error', 'Csv Data Import failed!! Please check the file size or file type!');
                        //$this->load->view('admin/muc', $error);
                        redirect(base_url() . 'index.php/admin/muc');
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                        
                        $filename_un = $this->upload->data('full_path');

                        $this->Upload_model->insert_csv_un($filename_un);
                        $this->Upload_model->clean_temp_un();
                        $this->Upload_model->truncate_temp_un();             

                        $this->session->set_flashdata('success', 'Csv Data Imported Succesfully!');
                        //$this->load->view('success', $data);
                        unlink($filename_un);			                       						
                        redirect(base_url() . 'index.php/admin/muc');

                }

               
        }

        

        

}

/* End of file Upload.php */
/* Location: ./application/controllers/Upload.php */
