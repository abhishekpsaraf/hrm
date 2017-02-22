<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

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
		$this->load->database();
		$this->load->library('form_validation');
		//load the login model
		$this->load->model('login_model');
		$this->load->model('users_model');
		$this->load->helper('menu_helper');
		$this->load->helper('login_helper');
		$this->load->helper('common_helper');
     }

	 
	public function index()
	{
		$this->load->view('login/login_form');
		$this->load->view('common/footer');
	}
	
	public function loginCheck()
	{
		$username = $this->input->post("txt_username");
		$password = $this->input->post("txt_password");
		//set validations
		$this->form_validation->set_rules("txt_username", "Username", "trim|required");
		$this->form_validation->set_rules("txt_password", "Password", "trim|required");
		//echo $this->form_validation->run().'-'.$username.'-'.$password;exit;
		if ($this->form_validation->run() == Null)
		{
		   //validation fails
		   $this->load->view('login/login_form');
		}
		else
		{
			
			 if ($this->input->post('btn_login') == "Login")
               {
                    //check if username and password is correct
                    $usr_result = $this->login_model->get_user($username,$password);
                    $usr_detail_result = $this->login_model->get_user_information($username,$password)[0];
                    $usr_active_result = $this->users_model->get_active_user();
                    $usr_inactive_result = $this->users_model->get_inactive_user();
                    $all_users_result = $this->users_model->get_all_user_information();
                    
                    $sessiondata = getUserInformation($username,$password);
                 
					
                    if ($usr_result > 0) //active user record is present
                    {	
                        
						//echo $sessiondata['company_id'].'-'.$sessiondata['company_branch_id'];
						//Check company ,branch assigned or not
						$this->session->set_userdata($sessiondata);
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
                    else
                    {
                         $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Invalid username and password!</div>');
                         redirect('LoginController');
                    }
               }
               else
               {
                    redirect('LoginController');
               }
		}
		
		
	}
	
	public function admin_dashboard()
	{
		$username = $this->session->userdata['username'];
		$password = $this->session->userdata['password'];
		$sessiondata = getUserInformation($username,$password);
		$sessiondata['heading']='Dashboard';
		//echo '<pre>===>';print_r($sessiondata);
		$this->load->view('common/header',$sessiondata);
		$this->load->view('dashboard/admin_dashboard',$sessiondata);
		$this->load->view('common/footer');
	}
	
	public function company_admin_dashboard()
	{
		$username = $this->session->userdata['username'];
		$password = $this->session->userdata['password'];
		$sessiondata = getUserInformation($username,$password);
		$sessiondata['heading']='Company Admin Dashboard';
		//echo '<pre>===>';print_r($sessiondata);
		$this->load->view('common/header',$sessiondata);
		$this->load->view('dashboard/admin_dashboard',$sessiondata);
		$this->load->view('common/footer');
	}
	
	public function company_user_dashboard()
	{
		$username = $this->session->userdata['username'];
		$password = $this->session->userdata['password'];
		$sessiondata = getUserInformation($username,$password);
		$sessiondata['heading']='Company User Dashboard';
		//echo '<pre>===>';print_r($sessiondata);
		$this->load->view('common/header',$sessiondata);
		$this->load->view('dashboard/admin_dashboard',$sessiondata);
		$this->load->view('common/footer');
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
		redirect('');
	}
}
