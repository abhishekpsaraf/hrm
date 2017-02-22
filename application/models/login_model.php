<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }

     //get the username & password from tbl_usrs
     function get_user($usr, $pwd)
     {
          $sql = "select * from tbl_usrs where username = '" . $usr . 
          "' and password = '" . $pwd . "' and status = '1'";
          $query = $this->db->query($sql);
          return $query->num_rows();
     }
     
      //get the username & password from tbl_usrs
     function get_user_information($usr, $pwd)
     {
          $sql = "select * from tbl_usrs where username = '" . $usr . 
          "' and password = '" . $pwd . "' and status = '1'";
          $query = $this->db->query($sql);
          return $query->result_array();
     }
}?>
