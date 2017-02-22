<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class company_model extends CI_Model
{
	 function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }

     function add_data($table,$data){ 
		// Inserting in Table(students) of Database(college)
		$this->db->insert($table, $data);
		 return $this->db->insert_id(); 
	 }
	
}
