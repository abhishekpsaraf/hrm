<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LeavesController extends CI_Controller {
	
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
	$this->load->model('leave_model');
	$this->load->helper('menu_helper');
	$this->load->helper('login_helper');
	$this->load->helper('common_helper');
}	
	
public function index()
{
	//echo "INDEX";exit;
	$username = $this->session->userdata['username'];
	$password = $this->session->userdata['password'];
	$sessiondata = getUserInformation($username,$password);
	$sessiondata['heading']='Leave Management';
	$this->load->view('common/header',$sessiondata);
	$this->load->view('leaves/leave_view',$sessiondata);
	$this->load->view('common/footer');
	//echo '<pre>===';print_r($this->session->userdata);
}	

public function list_applied_leaves()
{
	//echo "INDEX";exit;
	$username = $this->session->userdata['username'];
	$password = $this->session->userdata['password'];
	$sessiondata = getUserInformation($username,$password);
	$sessiondata['heading']='Leave Management';
	$this->load->view('common/header',$sessiondata);
	$this->load->view('leaves/list_applied_leaves',$sessiondata);
	$this->load->view('common/footer');
	//echo '<pre>===';print_r($this->session->userdata);
}

public function add_leave_form()
{
	$username = $this->session->userdata['username'];
	$password = $this->session->userdata['password'];
	$sessiondata = getUserInformation($username,$password);
	$sessiondata['heading']='Add Leave';
	$this->load->view('common/header',$sessiondata);
	$this->load->view('leaves/add_leave',$sessiondata);
	$this->load->view('common/footer');
	//echo '<pre>===';print_r($this->session->userdata);
}

public function apply_leave_form()
{
	$username = $this->session->userdata['username'];
	$password = $this->session->userdata['password'];
	$sessiondata = getUserInformation($username,$password);
	$sessiondata['heading']='Apply For Leave';
	$this->load->view('common/header',$sessiondata);
	$this->load->view('leaves/apply_leave_form',$sessiondata);
	$this->load->view('common/footer');
	//echo '<pre>===';print_r($this->session->userdata);
}	


public function addLeave()
{
	//echo "ADD";exit;
	//echo '<pre>';print_r($this->input);exit;
	$id = $this->input->post("leave_id");
	$txt_leave = $this->input->post("txt_leave");
	$txt_leave_type = $this->input->post("txt_leave_type");
	$txt_leave_count = $this->input->post("txt_leave_count");
	$leave_date = $this->input->post("leave_date");
	$chk_status = $this->input->post("chk_status");
	$leave_date = changeDateFormat($leave_date);
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
	$this->form_validation->set_rules("txt_leave", "Leave Title", "trim|required");
	$this->form_validation->set_rules("txt_leave_type", "Leave Type", "trim|required");
	$this->form_validation->set_rules("txt_leave_count", "Leave Count", "trim|required");

	if ($this->form_validation->run() == Null)
	{
	   //validation fails
	  // echo "Validations Fail";
		$this->load->view('common/header',$this->session->userdata);
		$this->load->view('leaves/add_leave',$this->session->userdata);
		$this->load->view('common/footer');
	}
	else
	{
		 if ($this->input->post('btn_login') == "Submit")
		   {
				//Setting values for tabel columns                   
				$data = array(
				'leave_title' => $txt_leave,
				'leave_type' => $txt_leave_type,
				'leave_count' => $txt_leave_count,
				'leave_date'=> $leave_date,
				'status' => $chk_status,
				'is_delete' => $chk_delete
				);
				//echo '<pre>';print_r($data);exit;
				
				//Transfering data to Model
				$this->leave_model->add_leave('tbl_leaves',$data);
				
			   //Loading View
				$sessiondata = array('message' => 'Data Added Successfully');
				//$this->load->view('common/header',$this->session->userdata);
				//$this->load->view('role/role_view',$sessiondata);
				//$this->load->view('common/footer');
				echo 'Data Added Successfully';

		   }
	}
		
}


public function updateLeave()
{
		
	$id = $this->input->post("leave_id");
	$txt_leave = $this->input->post("txt_leave");
	$txt_leave_type = $this->input->post("txt_leave_type");
	$txt_leave_count = $this->input->post("txt_leave_count");
	$leave_date = $this->input->post("leave_date");
	$chk_status = $this->input->post("chk_status");
	$leave_date = changeDateFormat($leave_date);
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
	$this->form_validation->set_rules("txt_leave", "Leave Title", "trim|required");
	//$this->form_validation->set_rules("txt_leave_type", "Leave Type", "trim|required");
	$this->form_validation->set_rules("txt_leave_count", "Leave Count", "trim|required");

	if ($this->form_validation->run() == Null)
	{
	   //validation fails
	  // echo "Validations Fail";
		$this->load->view('common/header',$this->session->userdata);
		$this->load->view('leaves/add_leave',$this->session->userdata);
		$this->load->view('common/footer');
	}
	else
	{
		 if ($this->input->post('btn_login') == "Submit")
		   {
				if($txt_leave_type=='')
				{
					$txt_leave_type='Other';
				}
				$data = array(
				'leave_title' => $txt_leave,
				'leave_type' => $txt_leave_type,
				'leave_count' => $txt_leave_count,
				'leave_date'=>$leave_date,
				'status' => $chk_status,
				'is_delete' => $chk_delete
				);
				//echo '<pre>';print_r($data);exit;
				
				//Transfering data to Model
				$this->leave_model->update_leave($id,$data,'tbl_leaves');
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

public function getLeaveList($type)
{
	 $all_leave_result = $this->leave_model->get_all_leave_information($type);
	 //echo '<pre>';print_r($all_role_result);exit;
		echo json_encode($all_leave_result);
}


public function getAppliedLeaveList($id)
{
	 
	$all_leave_result = $this->leave_model->get_user_leaves_information_by_id($id);
	 //echo '<pre>';print_r($all_leave_result);exit;
	 
	echo json_encode($all_leave_result); 
	/*if(count($all_leave_result) > 0)
	{
		echo json_encode($all_leave_result);
	}
	else
	{
		echo count($all_leave_result);
	}*/
}

public function getLeavePopUpValues($id)
{
	$role_result = $this->leave_model->get_leave_info_by_id($id)[0];
		echo json_encode($role_result);
}

public function submit_leave()
{
	
	$user_id = $this->input->post("user_id");
	$leave_id = $this->input->post("leave_id");
	$leave_from = $this->input->post("leave_from");
	$leave_to = $this->input->post("leave_to");
	$leave_days = $this->input->post("leave_days");
	$leave_reason = $this->input->post("leave_reason");
	$status = $this->input->post("status");
	$leave_from = changeDateFormat($leave_from);
	$leave_to = changeDateFormat($leave_to);
	$this->form_validation->set_rules("leave_from", "Leave From Date", "trim|required");
	//$this->form_validation->set_rules("txt_leave_type", "Leave Type", "trim|required");
	//$this->form_validation->set_rules("txt_leave_count", "Leave Count", "trim|required");
	
	if ($this->form_validation->run() == Null)
	{
	   
	   //validation fails
	  // echo "Validations Fail";
		$this->load->view('common/header',$this->session->userdata);
		$this->load->view('leaves/apply_leave_form',$this->session->userdata);
		$this->load->view('common/footer');
	}
	else
	{	
		if ($this->input->post('btn_login') == "Submit")
		{
			
			$data = array(
				'user_id' => $user_id,
				'leave_id' => $leave_id,
				'leave_from' => $leave_from,
				'leave_to'=> $leave_to,
				'leave_days' => $leave_days,
				'leave_reason' => $leave_reason,
				'status'=> $status
				);
				//echo '<pre>';print_r($data);exit;
				
				//Transfering data to Model
				$this->leave_model->add_leave('tbl_user_leaves',$data);
				
			   //Loading View
				$sessiondata = array('message' => 'Leave Application Submitted Successfully');
				//$this->load->view('common/header',$this->session->userdata);
				//$this->load->view('role/role_view',$sessiondata);
				//$this->load->view('common/footer');
				echo 'Leave Application Submitted Successfully';
		}
	}
}

}

?>

