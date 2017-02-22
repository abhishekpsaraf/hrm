<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class menu_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }

      //get the username & password from tbl_usrs
     function get_all_menu_information()
     {
          $sql = "select * from tbl_menus";
          $query = $this->db->query($sql);
          return $query->result_array();
     }
     function get_menu_info_by_id($id)
     {
          $sql = "select * from tbl_menus where menu_id = '".$id."'";
          $query = $this->db->query($sql);
          return $query->result_array();
     }
     public function add_menu($table,$data){ 
		// Inserting in Table(students) of Database(college)
		$this->db->insert($table, $data);
	 }
     // Update Query For Selected Menu
	public function update_menu($id,$data,$tbl)
	{
		
		$this->db->where('menu_id', $id);
		$this->db->update($tbl, $data);
	}    
	
	 
}
?>

