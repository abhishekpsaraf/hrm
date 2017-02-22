<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	  public function __construct()
     {
          parent::__construct();
		$this->load->library('session');

		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('login_helper');
		$this->load->helper('menu_helper');
		$this->load->helper('common_helper');
		$this->load->database();
		$this->load->library('form_validation');
		//load the login model
		$this->load->model('users_model');
		$this->load->model('login_model');
		
     }

	 
	public function index()
	{
		
		$username = $this->session->userdata['username'];
		$password = $this->session->userdata['password'];
		$sessiondata = getUserInformation($username,$password);
		$sessiondata['heading']='User Management';
		//echo '<pre>===>';print_r($sessiondata); exit;
		$this->load->view('common/header',$sessiondata);
		$this->load->view('users/new_user_form');
		$this->load->view('common/footer');
	}
	
	public function addUser()
	{
		
		$fname = $this->input->post("txt_fname");
		$lname = $this->input->post("txt_lname");
		$email = $this->input->post("txt_email");
		$mobile = $this->input->post("txt_mobile");
		$username = $this->input->post("txt_username");
		$password = $this->input->post("txt_password");
		$company_id = $this->input->post("company_id");
		$company_branch_id = $this->input->post("company_branch_id");
		//$picture = $this->input->post("picture");
		
		//set validations
		$this->form_validation->set_rules("txt_fname", "Firstname", "trim|required");
		$this->form_validation->set_rules("txt_lname", "Lastname", "trim|required");
		$this->form_validation->set_rules("txt_email", "Email", "trim|required");
		$this->form_validation->set_rules("txt_mobile", "Mobile", "trim|required");
		$this->form_validation->set_rules("txt_username", "Username", "trim|required");
		$this->form_validation->set_rules("txt_password", "Password", "trim|required");
		//$this->form_validation->set_rules("picture", "Picture", "trim|required");
		//echo $this->form_validation->run();exit;
		if ($this->form_validation->run() == Null)
		{
		   //validation fails
		   //echo "Validations Fail"; exit;
		  $this->load->view('users/new_user_form');
		}
		else
		{
			
			 if ($this->input->post('btn_login') == "Submit")
               {
                   
					if(!empty($_FILES['picture']['name']))
					{
						$config['upload_path'] = 'uploads/images/';
						$config['allowed_types'] = 'jpg|jpeg|png|gif';
						$config['file_name'] = time()."_".$_FILES['picture']['name'];

						//Load upload library and initialize configuration
						$this->load->library('upload',$config);
						$this->upload->initialize($config);

						if($this->upload->do_upload('picture'))
						{
							$uploadData = $this->upload->data();
							$picture = $uploadData['file_name'];
						}
						else
						{
							$picture = '';
						}
					}
					else
					{
						$picture = '';
					}
                    //echo $picture;exit;
                    //Setting values for tabel columns
                   
					$data = array(
					'fname' => $fname,
					'lname' => $lname,
					'mobile' => $mobile,
					'username' => $username,
					'password' => $password,
					'email' => $email,
					'profile_pic'=>$picture,
					'company_id'=>$company_id,
					'company_branch_id'=>$company_branch_id,
					'status' => '0'
					);
					//Transfering data to Model
					$this->users_model->add_user('tbl_usrs',$data);
					//Email of add
					$subject ='New User';
					$template ='Dear'.' '.$fname.' '.$lname.',<br><br>Thank you for registration.Your account is under screening.<br><br> You will get login details once account activated by admin.<br><br><br>Regards,<br>Website Admin';
					//Email Send
					$this->emailSend($email,$subject,$template);
                   //Loading View
                    $sessiondata = array('message' => 'Data Inserted Successfully');
                   // $this->sendemail();
					//$this->load->view('login/login_form',$sessiondata);
					$this->loadUserList();
               }
               else
               {
                    redirect('LoginController');
               }
		}
		
		
	}
	
	public function loadUserList()
	{
		
		$username = $this->session->userdata['username'];
		$password = $this->session->userdata['password'];
		$sessiondata = getUserInformation($username,$password);
		$sessiondata['heading']='User Management';
		if($sessiondata['company_id']=='0')
		{
			$sessiondata['heading']='Admin Dashboard';
			$this->load->view('common/header',$sessiondata);
			$this->load->view('dashboard/admin_dashboard',$sessiondata);
		}
		else if($sessiondata['company_id']!='0' && $sessiondata['company_branch_id']=='0')
		{
			$sessiondata['heading']='Company Admin Dashboard';
			$this->load->view('common/header',$sessiondata);
			$this->load->view('dashboard/company_admin_dashboard',$sessiondata);
		}
		else if($sessiondata['company_id']!='0' && $sessiondata['company_branch_id']!='0')
		{
			$sessiondata['heading']='Company User Dashboard';
			$this->load->view('common/header',$sessiondata);
			$this->load->view('dashboard/company_user_dashboard',$sessiondata);
		}
		//ends
		 $this->load->view('common/footer');
	}
	
	public function admin_dashboard()
	{
		$this->load->view('dashboard/admin_dashboard');
	}
	
	function logout()
	{
		$user_data = $this->session->all_userdata();
			foreach ($user_data as $key => $value) {
				if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
					$this->session->unset_userdata($key);
				}
			}
		$this->session->sess_destroy();
		redirect('LoginController');
	}
	
	public function popup()
	{
		$this->load->view('test/test_popup');
	}
	
	public function sendemail()
	{
		$this->load->library('email');
		$this->email->to('abhishekpsaraf@gmail.com');
		$this->email->from('apsaraf26@gmail.com','CodexWorld');
		$this->email->subject('Test Email (TEXT)');
		$this->email->message('Text email testing by CodeIgniter Email library.');
		$this->email->send();
	}
	public function getPopUpValues($id)
	{
		
		$usr_result = $this->users_model->get_user_info_by_id($id)[0];
		echo json_encode($usr_result);
	}
	public function updateUser()
	{
		
		$id = $this->input->post("txt_id");
		$fname = $this->input->post("txt_fname");
		$lname = $this->input->post("txt_lname");
		$email = $this->input->post("txt_email");
		$mobile = $this->input->post("txt_mobile");
		$username = $this->input->post("txt_username");
		$user_designation = $this->input->post("user_designation");
		$reporting_person = $this->input->post("reporting_person");
		$password = $this->input->post("txt_password");
		$chk_status = $this->input->post("chk_status");
		$company_id = $this->input->post("company_id");
		$company_branch_id = $this->input->post("company_branch_id");
		
		if($chk_status=='')
		{
			$chk_status = 0;
		}
		//set validations
		$this->form_validation->set_rules("txt_fname", "Firstname", "trim|required");
		$this->form_validation->set_rules("txt_lname", "Lastname", "trim|required");
		$this->form_validation->set_rules("txt_email", "Email", "trim|required");
		$this->form_validation->set_rules("txt_mobile", "Mobile", "trim|required");
		$this->form_validation->set_rules("txt_username", "Username", "trim|required");
		$this->form_validation->set_rules("txt_password", "Password", "trim|required");
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
					'fname' => $fname,
					'lname' => $lname,
					'mobile' => $mobile,
					'username' => $username,
					'password' => $password,
					'email' => $email,
					'reporting_person_id'=> $reporting_person,
					'role_id'=> $user_designation,
					//'profile_pic'=>$picture,
					'company_id'=>$company_id,
					'company_branch_id'=>$company_branch_id,
					'status' => $chk_status
					);
					//echo '<pre>'.$id;print_r($data);exit;
					
					//Transfering data to Model
					$this->users_model->update_user($id,$data,'tbl_usrs');
					if($chk_status==1)
					{
						$subject ='User Account Activation';
						$lognLink = '<a href='.base_url().'>Click Here</a>';
						$template ='Dear'.' '.$fname.' '.$lname.',<br><br>Thank you for registration.Your acount is activated.<br><br>Please find below login details<br><br>User Name:'.$username.'<br>Password :'.$password.'<br><br>Please '.$lognLink.' to login.<br><br><br>Regards,<br>Website Admin';
						//Email Send
						$this->emailSend($email,$subject,$template);
					}
                   //Loading View
                    $sessiondata = array('message' => 'Data Updated Successfully');
                    echo 'Data Updated Successfully';
                    
                   // $this->sendemail();
					//$this->load->view('dashboard/admin_dashboard',$sessiondata);
               }
		}
			
	}
	
	public function getUserInformation()
	{
		 $company_id = $this->session->userdata['company_id'];
		 if($company_id==0)
		 {
			 $company_id = '11';
		 }
		 $all_users_result = $this->users_model->get_all_user_information($company_id);
		 //echo '<pre>';print_r($all_users_result);exit;
		 echo json_encode($all_users_result);
	}
	public function emailSend($email,$subject,$template)
	{
		
		
		$ci = get_instance();
		$ci->load->library('email');

		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.googlemail.com';
		$config['smtp_port'] = '465';
		$config['smtp_user'] = 'apsaraf26@gmail.com';
		$config['smtp_from_name'] = 'Admin';
		$config['smtp_pass'] = 'mangeshkar@9';
		$config['wordwrap'] = TRUE;
		$config['newline'] = "\r\n";
		$config['mailtype'] = 'html';    

		$ci->email->initialize($config);
		
		$ci->email->from($config['smtp_user'], $config['smtp_from_name']);
		$ci->email->to($email);
		//$ci->email->cc('apsaraf@hotmail.com');
		//$ci->email->bcc('abhishek.saraf26@ymail.com');
		$ci->email->subject($subject);

		$ci->email->message($template);

		if($ci->email->send()) {
			return true;        
		} else {
			//return false;
		}       
	}
	
	public function getAssignUserInformation($id)
	{
		 $all_users_result = $this->users_model->get_assigned_user_info_by_id($id);
		 //echo '<pre>';print_r($all_users_result);exit;
		 echo json_encode($all_users_result);
	}
	public function assignMenu($id)
	{
		$assignMenusId = $this->input->post("menuVal");
		//Setting values for tabel columns                   
		$data = array(
		'user_menu_access' => $assignMenusId
		);
		//echo '<pre>'.$id;print_r($data);exit;
		//Transfering data to Model
		$this->users_model->update_user($id,$data,'tbl_usrs');
		$sessiondata = array('message' => 'Menu assigned Successfully');
		echo 'Menu assigned Successfully';
	}
	
	public function assignLeaves($id)
	{
		$assignLeavesId = $this->input->post("leavesVal");
		//Setting values for tabel columns                   
		$data = array(
		'user_leaves_access' => $assignLeavesId
		);
		//echo '<pre>'.$id;print_r($data);exit;
		//Transfering data to Model
		$this->users_model->update_user($id,$data,'tbl_usrs');
		$sessiondata = array('message' => 'Leaves assigned Successfully');
		echo 'Leaves assigned Successfully';
	}
}
