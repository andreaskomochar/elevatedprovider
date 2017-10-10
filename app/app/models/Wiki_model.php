<?php
class Wiki_model extends CI_Model {
 
    public function __construct()
    {
        $this->table = 'wiki';
        $this->load->database();
    }
    
    public function get_wiki($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('wiki');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('wiki', array('id' => $id));
        return $query->row_array();
    }



       public function get_title($id) {
    // $query = $this->db->query('SELECT title FROM wiki WHERE id = ' . $id);
    // return $query->result_array();

       $query = $this->db->where('id', $id)->limit(1)->get('wiki');
        return $query;

        }

          public function get_text() {
     $query = $this->db->query('SELECT title FROM wiki');
     return $query;

     //  $query = $this->db->where('text', $text)->get('wiki');
     //   return $query;

        }

   

  public function single_wiki($id) {
    $query = $this->db->where('id', $id)->limit(1)->get('wiki');
    if($query->num_rows() == 1) {
      return $query;
    } else {
      return FALSE;
    }
  }

   public function get_id() {
     $query = $this->db->query('SELECT id FROM wiki');
     return $query->result_array();
    }

    
    public function get_wiki_by_id($id)
    {
        if ($id === 0)
        {
            $query = $this->db->get('wiki');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('wiki', array('id' => $id));
        return $query->row_array();
    }

        public function get_wiki_by_title()
    {
        if ($id === 0)
        {
            $query = $this->db->get('wiki');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('wiki', array('title' => $title));
        return $query->row_array();
    }



    public function get_wiki_by_id_old($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('wiki');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('wiki', array('id' => $id));
        return $query->row_array();
    }
    
    public function set_wiki($id = 0)
    {
        $this->load->helper('url');
 
        $slug = url_title($this->input->post('title'), 'dash', TRUE);
 
        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'text' => $this->input->post('text')

        );
        
        if ($id == 0) {
            return $this->db->insert('wiki', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('wiki', $data);
        }
    }
    
  

public function edit_title($id) {
    $data['id'] = $id;
    $data['title'] = $title;
    $data['text'] = $text;
   

$this->db->select('title')
->from('wiki')
->where('id', $id);
//->where_not_in('deleted', '1');

$query = $this->db->get();
if ($query->num_rows() > 0)    {
   return $query->row(); 
}

return NULL;
} 
    


public function edit_text($id) {
    $data['id'] = $id;
    $data['title'] = $title;
    $data['text'] = $text;
    

$this->db->select()
->from('wiki')
->where('id', $id);
//->where_not_in('deleted', '1');

$query = $this->db->get();
if ($query->num_rows() > 0)    {
   return $query->row(); 
}

return NULL;
} 
    
 public function update($data,$id) {
	 
    $this->db->where('wiki.id',$id);
	return $this->db->update('wiki', $data);
  }




public function did_delete_row($id){
  $this -> db -> where('id', $id);
  $this -> db -> delete('wiki');
}


}
