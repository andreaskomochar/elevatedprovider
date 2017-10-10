<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Creative_model extends CI_Model {
  function __construct() {
    parent::__construct();
    $this->table = 'creatives';
  }

  public function count_creatives() {
    return $this->db->count_all('creatives');
  }

  public function count_verticals() {
    return $this->db->count_all('verticals');
  }

  public function add($table, $data) {
    if($this->db->insert($table, $data)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function update($where_field_id, $id, $table, $data) {
    if($this->db->update($table, $data, array($where_field_id => $id))) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function single_vertical($id) {
    $query = $this->db->where('vertical_id', $id)->limit(1)->get('verticals');
    if($query->num_rows() == 1) {
      return $query->row();
    } else {
      return FALSE;
    }
  }

  public function single_tag($id) {
    $query = $this->db->where('tag_id', $id)->limit(1)->get('tags');
    if($query->num_rows() == 1) {
      return $query->row();
    } else {
      return FALSE;
    }
  }

  public function single_creative($id) {
    $query = $this->db->where('creative_id', $id)->limit(1)->get('creatives');
    if($query->num_rows() == 1) {
      return $query->row();
    } else {
      return FALSE;
    }
  }

  public function single_offer($id) {
    $query = $this->db->where('offer_id', $id)->limit(1)->get('offers');
    if($query->num_rows() == 1) {
      return $query->row();
    } else {
      return FALSE;
    }
  }

  public function single_subject_line($id) {
    $query = $this->db->where('subject_id', $id)->limit(1)->get('subject_lines');
    if($query->num_rows() == 1) {
      return $query->row();
    } else {
      return FALSE;
    }
  }

  public function list_verticals() {
    $query = $this->db->order_by('vertical_id','asc')->get('verticals');
    return $query->result();
  }

  public function list_tags() {
    $query = $this->db->order_by('tag_id','asc')->get('tags');
    return $query->result();
  }

  public function list_offers() {
    $query = $this->db->order_by('offer_id','asc')->get('offers');
    return $query->result();
  }

  public function get_subject_lines() {
    $query = $this->db->order_by('subject_lines.subject_id','asc')->join('offers', 'subject_lines.offer_id = offers.offer_id')->join('verticals', 'offers.vertical_id = verticals.vertical_id')->get('subject_lines');
    return $query->result();
  }

  public function get_creatives() {
    $query = $this->db->order_by('creatives.creative_id','asc')->join('offers', 'creatives.offer_id = offers.offer_id')->join('verticals', 'offers.vertical_id = verticals.vertical_id')->group_by('creatives.creative_id')->get('creatives');
    return $query->result();
  }

  public function get_offers() {
    $query = $this->db->order_by('offers.offer_id','asc')->join('verticals', 'offers.vertical_id = verticals.vertical_id')->group_by('offers.offer_id')->get('offers');
    return $query->result();
  }

  public function search_creatives($search) {
    $query = $this->db->order_by('creatives.creative_id','asc')->join('offers', 'creatives.offer_id = offers.offer_id')->join('verticals', 'offers.vertical_id = verticals.vertical_id')->like('creative_code', $search)->or_like('offer_code', $search)->or_like('creative', $search)->or_like('offer', $search)->or_like('vertical', $search)->get('creatives');
    return $query->result();
  }

  public function search_offers($search) {
    $query = $this->db->order_by('offers.offer_id','asc')->join('verticals', 'offers.vertical_id = verticals.vertical_id')->like('offer_code', $search)->or_like('offer', $search)->or_like('vertical', $search)->get('offers');
    return $query->result();
  }

  public function search_subject_lines($search) {
    $query = $this->db->order_by('subject_lines.subject_id','asc')->join('offers', 'subject_lines.offer_id = offers.offer_id')->join('verticals', 'offers.vertical_id = verticals.vertical_id')->like('subject', $search)->or_like('offer_code', $search)->or_like('offer', $search)->or_like('vertical', $search)->get('subject_lines');
    return $query->result();
  }
}
