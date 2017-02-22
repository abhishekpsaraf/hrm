<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//echo $company_id.'-'.$company_branch_id;
class users_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
          $this->load->library('session');
     }

     function add_user($table,$data){ 
		// Inserting in Table(students) of Database(college)
		$this->db->insert($table, $data);
	 }
	 
	  //get the username & password from tbl_usrs
     function get_active_user()
     {
          $sql = "select * from tbl_usrs where status = '1'";
          $query = $this->db->query($sql);
          return $query->num_rows();
     }
     
      //get the username & password from tbl_usrs
     function get_inactive_user()
     {
          $sql = "select * from tbl_usrs where status = '0'";
          $query = $this->db->query($sql);
          return $query->num_rows();
     }
     
      //get the username & password from tbl_usrs
     function get_all_user_information($company_id='')
     {
          /*$sql = "select * from tbl_usrs";
          $query = $this->db->query($sql);*/
		//$company_id = $this->session->userdata['company_id'];
		$this->db->select("u.*,IF(u.role_id='0','Not Assigned',r.role) as user_role,IF(u.status='0','Inactive','Active') as user_status,CASE WHEN u.reporting_person_id = '0' THEN 'No Reporting Person Assigned' ELSE (select CONCAT(fname,' ',lname) from tbl_usrs where id=u.reporting_person_id) END AS assigned_username,r.*");
		$this->db->from('tbl_usrs u');
		$this->db->join('tbl_roles r', 'u.role_id = r.role_id', 'left');
		$this->db->where('u.company_id',$company_id);
		$this->db->order_by('u.fname','asc');
         $query = $this->db->get(); 
         return $query->result_array();
     }
     
     function get_user_info_by_id($id)
     {
          $sql = "select * from tbl_usrs where id = '".$id."'";
          $query = $this->db->query($sql);
          return $query->result_array();
     }
     // Update Query For Selected Student
	function update_user($id,$data,$tbl)
	{
		$this->db->where('id', $id);
		$this->db->update($tbl, $data);
	}
	
	function get_assigned_user_info_by_id($id)
     {
          $sql = "select * from tbl_usrs where id != '".$id."'";
          $query = $this->db->query($sql);
          return $query->result_array();
     }
}
?>
