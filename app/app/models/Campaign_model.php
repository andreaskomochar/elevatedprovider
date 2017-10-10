<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campaign_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        //  $this->load->library('PHPRequests');
        $this->table = 'campaigns';
        // $this->load->model('upload_services');
        $this->load->helper('file');
        $this->load->library('upload');

    }

    public function count_campaigns() {
        return $this->db->count_all('ee_campaigns');
    }


    public function add($data)
    {
        if ($this->db->insert('ee_campaigns', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_ee_api()
    {
        $response = Requests::get("https://api.elasticemail.com/v2/campaign/list?apikey=a4266009-1c30-4ac7-b17e-04827319bd0f", array());
        $this->get_ee_api();
        return json_decode($response->body, true);

    }


    public function get_data() {
		$this->db->order_by('ee_dateadded','DESC');
		$this->db->limit(5);
		$query = $this->db->get('ee_campaigns');		
        return $query->result_array(); 
    }

    public function get_cake() {        
        $this->db->limit(5);
        $query = $this->db->get('cake_campaigns');        
        return $query->result_array(); 
    }

    public function count_cake_campaigns() {
        return $this->db->count_all('cake_campaigns');
    }


}