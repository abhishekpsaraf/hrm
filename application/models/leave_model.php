<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class leave_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }

      //get the username & password from tbl_usrs
     function get_all_leave_information($leaveType='')
     {	
		 $where ='';
		 if($leaveType!='')
		 {
			 $where = "and leave_type='$leaveType'";
		 }
         $sql = "select *,DATE_FORMAT(leave_date,'%d-%m-%Y') AS leave_date from tbl_leaves where is_delete=0 $where ";
          $query = $this->db->query($sql);
          return $query->result_array();
     }
     function get_leave_info_by_id($id)
     {
          $sql = "select *,DATE_FORMAT(leave_date,'%d-%m-%Y') AS leave_date from tbl_leaves where leave_id = '".$id."'";
          $query = $this->db->query($sql);
          return $query->result_array();
     }
     public function add_leave($table,$data){ 
		// Inserting in Table(students) of Database(college)
		$this->db->insert($table, $data);
	 }
     // Update Query For Selected Menu
	public function update_leave($id,$data,$tbl)
	{
		
		$this->db->where('leave_id', $id);
		$this->db->update($tbl, $data);
	}
	
	 function get_user_leaves_information_by_id($id)
     {
          
		$this->db->select("ul.*,DATE_FORMAT(ul.leave_from,'%d-%m-%Y') AS leave_from,DATE_FORMAT(ul.leave_to,'%d-%m-%Y') AS leave_to,l.*");
		$this->db->from('tbl_user_leaves ul');
		$this->db->join('tbl_leaves l', 'ul.leave_id = l.leave_id', 'left');
		$this->db->where('ul.user_id', $id);
		$this->db->order_by('ul.leave_from','asc');
         $query = $this->db->get(); 
         return $query->result_array();
     }    
	
	 
}
?>


