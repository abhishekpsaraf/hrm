<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


    function test_method($var = '')
    {
        return $var;
    }
    
    /*function getMenus()
    {
		$ci=& get_instance();
        $ci->load->database(); 

        $sql = "select * from tbl_menus where status=1 and is_delete=0 and parent_menu_id=0"; 
        $query = $ci->db->query($sql);
        $row = $query->result_array();
        return $row;
	}*/
	
	function getUserInformation($username,$password)
    {
		$ci=& get_instance();
		$usr_detail_result = $ci->login_model->get_user_information($username,$password)[0];
		$usr_active_result = $ci->users_model->get_active_user();
		$usr_inactive_result = $ci->users_model->get_inactive_user();
		$all_users_result = $ci->users_model->get_all_user_information();
		
		 $userdata = array(
			  'username' => $username,
			  'activeusers'=>$usr_active_result,
			  'inactiveusers'=>$usr_inactive_result,
			  'id'=>$usr_detail_result['id'],
			  'fname'=>$usr_detail_result['fname'],
			  'lname'=>$usr_detail_result['lname'],
			  'email'=>$usr_detail_result['email'],
			  'password'=>$usr_detail_result['password'],
			  'profilepic'=>$usr_detail_result['profile_pic'],
			  'user_menu_access'=>$usr_detail_result['user_menu_access'],
			  'user_leaves_access'=>$usr_detail_result['user_leaves_access'],
			  'allusersinfo'=>$all_users_result,
			  'company_id'=>$usr_detail_result['company_id'],
			  'company_branch_id'=>$usr_detail_result['company_branch_id'],
			  'loginuser' => TRUE
		 );
		 
		 return $userdata;
	}
	
	function getReportingUser($id)
    {
		$ci=& get_instance();
        $ci->load->database(); 

        $sql = "select * from tbl_usrs where status=1 and is_delete=0"; 
        $query = $ci->db->query($sql);
        $row = $query->result_array();
        return $row;
	}
	
	function getLeaveType($user_leaves_access='')
    {
		$ci=& get_instance();
        $ci->load->database(); 
        $where = '';
		if($user_leaves_access!='')
		{
			$where = "and leave_id IN($user_leaves_access)";
		}
        $sql = "select * from tbl_leaves where leave_type='Other' $where and status=1 and is_delete=0"; 
        $query = $ci->db->query($sql);
        $row = $query->result_array();
        return $row;
		
	}

?>

