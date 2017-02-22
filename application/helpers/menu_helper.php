<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//if ( ! function_exists('test_method'))
//{
   
    function getMenus()
    {
		$ci=& get_instance();
        $ci->load->database(); 

        $sql = "select * from tbl_menus where status=1 and is_delete=0 and parent_menu_id=0"; 
        $query = $ci->db->query($sql);
        $row = $query->result_array();
        return $row;
	}
	
	function getMenusAccess($parentMenuIdByAccess)
    {
		$ci=& get_instance();
        $ci->load->database(); 
		$where = '';
		if($parentMenuIdByAccess!='')
		{
			$where ="and menu_id IN ($parentMenuIdByAccess)";
		}
        $sql = "select * from tbl_menus where status=1 and is_delete=0 $where and parent_menu_id=0"; 
        $query = $ci->db->query($sql);
        $row = $query->result_array();
        return $row;
	}
	
	function getParentMenusAccess($parent_menu_id,$user_menu_access)
    {
		$ci=& get_instance();
        $ci->load->database(); 
        $where = '';
		if($user_menu_access!='')
		{
			$where ="and menu_id IN ($user_menu_access)";
		}
        $sql = "select * from tbl_menus where parent_menu_id='$parent_menu_id' $where and status=1 and is_delete=0"; 
        $query = $ci->db->query($sql);
        $row = $query->result_array();
        return $row;
	}
	
	function getParentMenus($parent_menu_id)
    {
		$ci=& get_instance();
        $ci->load->database(); 

        $sql = "select * from tbl_menus where parent_menu_id='$parent_menu_id' and status=1 and is_delete=0"; 
        $query = $ci->db->query($sql);
        $row = $query->result_array();
        return $row;
	}
	function getAllMenus()
    {
		$ci=& get_instance();
        $ci->load->database(); 

        $sql = "select * from tbl_menus where status=1 and is_delete=0"; 
        $query = $ci->db->query($sql);
        $row = $query->result_array();
        return $row;
	}
	function getParentMenusById($parent_menu_id)
    {
		$ci=& get_instance();
        $ci->load->database(); 
		$where = '';
		if($parent_menu_id!='')
		{
			$where ="and menu_id IN ($parent_menu_id)";
		}
        $sql = "select * from tbl_menus where status=1 $where and is_delete=0 group by parent_menu_id"; 
        $query = $ci->db->query($sql);
        $row = $query->result_array();
        return $row;
	}
//}
?>
