<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class role_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }

      //get the username & password from tbl_usrs
     function get_all_role_information()
     {
          
          
		$this->db->select("tr.*,tr.status as role_status,IF(tr.role_access_id='0','No Access',tra.role_access) as role_access_alias,tra.*");
		$this->db->from('tbl_roles tr');
		$this->db->join('tbl_role_access tra', 'tr.role_access_id = tra.role_access_id', 'left');
		$this->db->order_by('tr.role_id','asc');
		//$this->db->where('ue.user_id', $userid);
		$query = $this->db->get(); //exit;
		return $query->result_array();
         /* $sql = "select * from tbl_roles";
          $query = $this->db->query($sql);
          return $query->result_array();*/
     }
     function get_role_info_by_id($id)
     {
          $sql = "select * from tbl_roles where role_id = '".$id."'";
          $query = $this->db->query($sql);
          return $query->result_array();
     }
     public function add_role($table,$data){ 
		// Inserting in Table(students) of Database(college)
		$this->db->insert($table, $data);
	 }
     // Update Query For Selected Menu
	public function update_role($id,$data,$tbl)
	{
		
		$this->db->where('role_id', $id);
		$this->db->update($tbl, $data);
	}    
	
	 
}
?>

