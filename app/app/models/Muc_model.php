<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Muc_model extends CI_Model {
  function __construct() {
    parent::__construct();
    $this->table = 'muc_active';
    $this->table = 'muc_unsubscribers';

}


function get_contents() {
        $this->db->select('email_un');
        $this->db->from('muc_unsubscribers');
        $query = $this->db->get();
        return $result = $query->result();
    }

public function add($data) {
    if($this->db->insert($data)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

    
  function get_muc() {
     $query = $this->db->order_by('muc_unsubscribers.email_un','asc')->join('muc_active', 'muc_active.email_ac = muc_active.email_ac')->group_by('muc_active.email_ac')->get('muc_active');
    return $query->result();
  }


//uporabljeno count all duplicates
  public function count_all_results() {

   $query = $this->db->query('SELECT * FROM muc_unsubscribers, muc_active WHERE email_un = email_ac');
    return $query->num_rows();
  }

//uporabljeno prešteje aktivne 
 public function count_muc_active() {
    return $this->db->count_all('muc_active');
  }

//uporabljeno prešteje neaktivne
  public function count_muc_unsubscribers() {
    return $this->db->count_all('muc_unsubscribers');
  }


//uporabljeno prešteje bazo z duplikati
    public function count_muc_duplicates() {
     return $this->db->count_all('muc_duplicates');
    }


    public function get_actives() {
      $query = $this->db->query('SELECT email_ac FROM muc_active');
      foreach ($query->result() as $row)
        {
       // echo $row['email_ac'];
       echo $row->email_ac . '<br/>';
        }

    }

    public function list_actives() {
      $query = $this->db->order_by('email_ac','asc')->get('muc_active');
      return $query->result();
    }


    
    //najde duplikate emailov
    public function get_duplicates() {
      $query = $this->db->query('SELECT email_un, email_ac FROM muc_unsubscribers, muc_active WHERE email_un = email_ac');
      foreach ($query->result() as $row)
        {
       // echo $row['email_ac'];
           echo $row->email_ac . '<br/>';
           
        }           
    }

    public function get_unsubscribers() {
      $query = $this->db->query('SELECT email_un FROM muc_unsubscribers');
      foreach ($query->result() as $row)
        {
            // echo $row['email_ac'];
             echo $row->email_un . '<br/>';
        }
    }

//import csv unsubscribers
    function get_un() {     
        $query = $this->db->get('muc_unsubscribers');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
 
    function insert_csv_un($data) {
        $this->db->insert('muc_unsubscribers', $data);
      
    }

    // import csv active
      function get_ac() {     
        $query = $this->db->get('muc_active');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
      function insert_csv_ac($data) {
        $this->db->insert('muc_active', $data);
      
    }

    function insert_duplicates()
    {
        $query = $this->db->query('SELECT email_un, email_ac FROM muc_unsubscribers, muc_active WHERE email_un = email_ac');
        foreach ($query->result() as $row)
          {
           //$query = $this->db->query('SELECT email_un FROM muc_unsubscribers');
           $query = "INSERT IGNORE INTO muc_duplicates (email_dup) VALUES ('$row->email_un') ";
           //   if ($query == $query) {echo ""; }
               $this->db->$query;        
          }


    }
  }