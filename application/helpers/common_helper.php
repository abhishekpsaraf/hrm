<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function getRoleAccess()
    {
		$ci=& get_instance();
        $ci->load->database(); 

        $sql = "select * from tbl_role_access where status=1 and is_delete=0"; 
        $query = $ci->db->query($sql);
        $row = $query->result_array();
        return $row;
	}
	
	function getUserDesignation()
    {
		$ci=& get_instance();
        $ci->load->database(); 

        $sql = "select * from tbl_roles where status=1 and is_delete=0"; 
        $query = $ci->db->query($sql);
        $row = $query->result_array();
        return $row;
	}
	
	function changeDateFormat($date)
    {
		$originalDate = $date;
		$newDate = date("Y-m-d", strtotime($originalDate));
        return $newDate;
	}
	
	function displayDateFormat($date)
    {
		$originalDate = $date;
		$newDate = date("d-m-Y", strtotime($originalDate));
        return $newDate;
	}
	
	function getCountry()
    {
		$ci=& get_instance();
        $ci->load->database(); 

        $sql = "select * from tbl_country where status=1 and is_delete=0"; 
        $query = $ci->db->query($sql);
        $row = $query->result_array();
        return $row;
	}
	
	function getState($countryID)
    {
		$ci=& get_instance();
        $ci->load->database(); 

		$sql = "select * from tbl_state where country_id='$countryID' and status=1 and is_delete=0";
        $query = $ci->db->query($sql);
        $row = $query->result_array();
        return $row;
	}
	function getCity($stateID)
    {
		$ci=& get_instance();
        $ci->load->database(); 

        $sql = "select * from tbl_city where state_id='$stateID' and status=1 and is_delete=0"; 
        $query = $ci->db->query($sql);
        $row = $query->result_array();
        return $row;
	}
	function getCompanyType()
    {
		$ci=& get_instance();
        $ci->load->database(); 

        $sql = "select * from tbl_company_type where status=1 and is_delete=0"; 
        $query = $ci->db->query($sql);
        $row = $query->result_array();
        return $row;
	}

?>
