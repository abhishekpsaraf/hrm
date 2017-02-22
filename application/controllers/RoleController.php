<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class RoleController extends CI_Controller {
	
public function __construct()
{
	parent::__construct();
	$this->load->library('session');

	$this->load->helper('form');
	$this->load->helper('url');
	$this->load->helper('html');
	$this->load->database();
	$this->load->library('form_validation');
	//load the login model
	$this->load->model('role_model');
	$this->load->model('users_model');
	$this->load->model('login_model');
	$this->load->helper('menu_helper');
	$this->load->helper('login_helper');
	$this->load->helper('common_helper');
}	
	
public function index()
{
	$username = $this->session->userdata['username'];
	$password = $this->session->userdata['password'];
	$sessiondata = getUserInformation($username,$password);
	$sessiondata['heading']='Role Management';
	$this->load->view('common/header',$sessiondata);
	$this->load->view('role/role_view',$sessiondata);
	$this->load->view('common/footer');
	//echo '<pre>===';print_r($this->session->userdata);
}	


public function add_role_form()
{
	$username = $this->session->userdata['username'];
	$password = $this->session->userdata['password'];
	$sessiondata = getUserInformation($username,$password);
	$sessiondata['heading']='Add Role';
	$this->load->view('common/header',$sessiondata);
	$this->load->view('role/add_role',$sessiondata);
	$this->load->view('common/footer');
	//echo '<pre>===';print_r($this->session->userdata);
}	


public function addRole()
{
	//echo "ADD";exit;
	//echo '<pre>';print_r($this->input->post);exit;
	$id = $this->input->post("role_id");
	$txt_role = $this->input->post("txt_role");
	$role_access_type = $this->input->post("role_access_type");
	$chk_status = $this->input->post("chk_status");
	if($chk_status=='')
	{
		$chk_status = 0;
	}
	
	$chk_delete = $this->input->post("chk_delete");
	if($chk_delete=='')
	{
		$chk_delete = 0;
	}
	//set validations
	$this->form_validation->set_rules("txt_role", "Role", "trim|required");

	if ($this->form_validation->run() == Null)
	{
	   //validation fails
	  // echo "Validations Fail";
		$this->load->view('common/header',$this->session->userdata);
		$this->load->view('role/add_role',$this->session->userdata);
		$this->load->view('common/footer');
	}
	else
	{
		 if ($this->input->post('btn_login') == "Submit")
		   {
				//Setting values for tabel columns                   
				$data = array(
				'role' => $txt_role,
				'role_access_id' => $role_access_type,
				'status' => $chk_status,
				'is_delete' => $chk_delete
				);
				//echo '<pre>';print_r($data);exit;
				
				//Transfering data to Model
				$this->role_model->add_role('tbl_roles',$data);
				
			   //Loading View
				$sessiondata = array('message' => 'Data Added Successfully');
				//$this->load->view('common/header',$this->session->userdata);
				//$this->load->view('role/role_view',$sessiondata);
				//$this->load->view('common/footer');
				echo 'Data Added Successfully';

		   }
	}
		
}


public function updateRole()
	{
		
		$role_id = $this->input->post("role_id");
		$txt_role = $this->input->post("txt_role");
		$role_access_type = $this->input->post("role_access_type");
		$chk_status = $this->input->post("chk_status");
		if($chk_status=='')
		{
			$chk_status = 0;
		}
		//set validations
		$this->form_validation->set_rules("txt_role", "Role", "trim|required");
		$this->form_validation->set_rules("role_access_type", "Access Type", "trim|required");
		//$this->form_validation->set_rules("picture", "Picture", "trim|required");
		//echo $this->form_validation->run();exit;
		if ($this->form_validation->run() == Null)
		{
		   //validation fails
		   //echo "Validations Fail"; exit;
		  //$this->load->view('users/new_user_form');
		}
		else
		{
			 if ($this->input->post('btn_login') == "Submit")
               {
                    //Setting values for tabel columns                   
					$data = array(
					'role' => $txt_role,
					'role_access_id' => $role_access_type,
					'status' => $chk_status
					);
					//echo '<pre>'.$id;print_r($data);exit;
					
					//Transfering data to Model
					$this->role_model->update_role($role_id,$data,'tbl_roles');
					/*if($chk_status==1)
					{
						$subject ='User Account Activation';
						$lognLink = '<a href='.base_url().'>Click Here</a>';
						$template ='Dear'.' '.$fname.' '.$lname.',<br><br>Thank you for registration.Your acount is activated.<br><br>Please find below login details<br><br>User Name:'.$username.'<br>Password :'.$password.'<br><br>Please '.$lognLink.' to login.<br><br><br>Regards,<br>Website Admin';
						//Email Send
						$this->emailSend($email,$subject,$template);
					}*/
                   //Loading View
                    $sessiondata = array('message' => 'Data Updated Successfully');
                    echo 'Data Updated Successfully';
                    
                   // $this->sendemail();
					//$this->load->view('dashboard/admin_dashboard',$sessiondata);
               }
		}
			
	}

public function getRoleList()
{
	 $all_role_result = $this->role_model->get_all_role_information();
	 //echo '<pre>';print_r($all_role_result);exit;
		echo json_encode($all_role_result);
}

public function getRolePopUpValues($id)
{
	$role_result = $this->role_model->get_role_info_by_id($id)[0];
		echo json_encode($role_result);
}

}

?>
