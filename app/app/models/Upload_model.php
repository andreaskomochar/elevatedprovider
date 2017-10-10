<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insert_csv_ac($file)
	{		

		return $this->db->query("LOAD DATA LOCAL INFILE '".$file."' INTO TABLE temp_muc_active");		
		
	}	

	
	

	public function clean_temp_ac()
	{
		return $this->db->query("INSERT IGNORE INTO muc_active SELECT * FROM temp_muc_active");

	}

	

	public function truncate_temp_ac()
	{
		return $this->db->query("TRUNCATE TABLE temp_muc_active");
	}

	////////////////////////////Unsubscribers//////////////////////

	public function insert_csv_un($file)
	{		

		return $this->db->query("LOAD DATA LOCAL INFILE '".$file."' INTO TABLE temp_muc_unsub");		
		
	}	
	

	public function clean_temp_un()
	{
		return $this->db->query("INSERT IGNORE INTO muc_unsubscribers SELECT * FROM temp_muc_unsub");

	}
	

	public function truncate_temp_un()
	{
		return $this->db->query("TRUNCATE TABLE temp_muc_unsub");
	}
	

    public function trunc_ac()
    {
        return $this->db->query("TRUNCATE TABLE muc_active");
    }

    public function truncate_duplicates()
    {
        return $this->db->query("TRUNCATE TABLE muc_duplicates");
    }

    public function copy_duplicates()
    {
        return $this->db->query("INSERT IGNORE INTO muc_duplicates_all SELECT * from muc_duplicates");
    }


    public function insert_csv_cake($file)
	{		

return $this->db->query("LOAD DATA LOCAL INFILE '".$file."' IGNORE INTO TABLE cake_campaigns FIELDS TERMINATED BY ',' ENCLOSED BY '\"' IGNORE 1 LINES");				
	}	
}

/* End of file Upload_model.php */
/* Location: ./application/models/Upload_model.php */