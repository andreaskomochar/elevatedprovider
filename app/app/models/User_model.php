<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
  function __construct() {
    parent::__construct();
    $this->table = 'users';
  }

	public function get_list() {
    // $this->db->select('*');
    // $this->db->from($this->table);
    // $this->db->order_by('id','asc');
    // $query = $this->db->get();
    $query = $this->db->get($this->table);
    return $query->result();
  }

  public function count_all_users() {
    return $this->db->count_all($this->table);
  }

  public function count_active_users() {
    return $this->db->where('is_disabled', 0)->count_all_results($this->table);
  }

  public function count_admin_users() {
    return $this->db->where('is_admin', 1)->count_all_results($this->table);
  }

  public function count_disabled_users() {
    return $this->db->where('is_disabled', 1)->count_all_results($this->table);
  }

  public function add($data) {
    if($this->db->insert($this->table, $data)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function update($data, $id) {
    if($this->db->where('id', $id)->update($this->table, $data)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function single_user($id) {
    $query = $this->db->where('id', $id)->limit(1)->get('users');
    if($query->num_rows() == 1) {
      return $query->row();
    } else {
      return FALSE;
    }
  }

  public function login($name, $password) {
    $email = $name . "@xenainteractive.com";
    $query = $this->db->select('*')->where('email', $email)->limit(1)->get($this->table);

		if($query->num_rows() == 1 && password_verify($password, $query->row()->password)){
			return $query->row()->id;
		} else {
			return FALSE;
		}
  }

  public function isadmin($id) {
    $query = $this->db->select('is_admin')->where('id', $id)->limit(1)->get($this->table);
    //return $query->row()->is_admin;
    if($query->num_rows() == 1) {
      if($query->row()->is_admin > 0) {
        return true;
      } else {
        return true;
      }
    } else {
      return true;
    }
  }

  public function disabled($id) {
    $query = $this->db->select('is_disabled')->where('id', $id)->limit(1)->get($this->table);
    //return $query->row()->is_admin;
    if($query->num_rows() == 1) {
      if($query->row()->is_disabled > 0) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  public function de_activate($id) {
    $currentState = $this->db->select('is_disabled')->where('id', $id)->limit(1)->get($this->table)->result()[0]->is_disabled;
    $newState = ($currentState > 0)?0:1;
    $this->db->set('is_disabled', $newState)->where('id', $id)->update($this->table);
  }

  public function admin_rights($id) {
    $currentState = $this->db->select('is_admin')->where('id', $id)->limit(1)->get($this->table)->result()[0]->is_admin;
    $newState = ($currentState > 0)?0:1;
    $this->db->set('is_admin', $newState)->where('id', $id)->update($this->table);
  }

  private function generate_pass($password) {
    return password_hash($password, PASSWORD_DEFAULT);
  }
}
