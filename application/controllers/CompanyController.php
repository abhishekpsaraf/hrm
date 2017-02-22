<?php

//defined('BASEPATH') OR exit('No direct script access allowed');

class CompanyController extends CI_Controller {

	
	 public function __construct()
     {
        parent::__construct();
		
		$this->load->helper('common_helper');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('menu/menu_helper');
		$this->load->database();
		$this->load->library('form_validation');
		//load the login model
		$this->load->model('company_model');
		$this->load->model('users_model');
     }

	public function index()
	{
		$this->load->view('company/new_company_form');
		$this->load->view('common/footer');
	}
	
	public function addCompany()
	{
		$txt_cname = $this->input->post("txt_cname");
		$txt_creg = $this->input->post("txt_creg");
		$txt_ctype = $this->input->post("txt_ctype");
		$txt_coutry_id = $this->input->post("txt_coutry_id");
		$txt_state_id = $this->input->post("txt_state_id");
		$txt_city_id = $this->input->post("txt_city_id");
		$txt_company_email = $this->input->post("txt_company_email");
		$dos = $this->input->post("txt_dos");
		$txt_mobile = $this->input->post("txt_mobile");
		$txt_username = $this->input->post("txt_username");
		$txt_password = $this->input->post("txt_password");
		$dos = changeDateFormat($dos);
		$status = '1';
		$is_delete = '0';
		//$picture = $this->input->post("picture");
		
		//set validations
		$this->form_validation->set_rules("txt_cname", "Company Name", "trim|required");
		$this->form_validation->set_rules("txt_creg", "Registration No.", "trim|required");
		$this->form_validation->set_rules("txt_ctype", "Company Type", "trim|required");
		$this->form_validation->set_rules("txt_coutry_id", "Country", "trim|required");
		$this->form_validation->set_rules("txt_state_id", "State", "trim|required");
		$this->form_validation->set_rules("txt_city_id", "City", "trim|required");
		$this->form_validation->set_rules("txt_company_email", "Email", "trim|required");
		$this->form_validation->set_rules("txt_dos", "Date of Start", "trim|required");
		$this->form_validation->set_rules("txt_mobile", "Mobile", "trim|required");
		$this->form_validation->set_rules("txt_username", "Username", "trim|required");
		$this->form_validation->set_rules("txt_password", "Password", "trim|required");
		//$this->form_validation->set_rules("picture", "Picture", "trim|required");
		//echo $this->form_validation->run();exit;
		if ($this->form_validation->run() == Null)
		{
		   //validation fails
		   //echo "Validations Fail"; exit;
		  $this->load->view('company/new_company_form');
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
			
				$data = array(
					'company_name' => $txt_cname,
					'company_type_id' => $txt_ctype,
					'date_of_start' => $dos,
					'company_email' => $txt_company_email,
					'company_country_id' => $txt_coutry_id,
					'company_state_id' => $txt_state_id,
					'company_city_id'=>$txt_city_id,
					'company_logo' => $picture,
					'company_reg_no' => $txt_creg,
					'status' => $status,
					'is_delete'=> $is_delete
					);
				//Transfering data to Model
				$last_insert_company_id = $this->company_model->add_data('tbl_company',$data);
				//Create Main branch of company
				if($last_insert_company_id!='')
				{
					$createdDate = date("Y-m-d");
					$branchData = array(
					'company_id' => $last_insert_company_id,
					'company_country_id' => $txt_coutry_id,
					'company_state_id' => $txt_state_id,
					'company_city_id'=>$txt_city_id,
					'created_date' => $createdDate,
					'created_by_id' => '0',
					'status' => $status,
					'is_delete'=> $is_delete
					);
					 $last_insert_branch_id = $this->company_model->add_data('tbl_company_branch',$branchData);
					 if($last_insert_branch_id!='')
					 {
						$userData = array(
						'fname' => $txt_cname,
						'lname' => $txt_cname,
						'mobile' => $txt_mobile,
						'username' => $txt_username,
						'password' => $txt_password,
						'email' => $txt_company_email,
						'profile_pic'=>'',
						'company_id'=>$last_insert_company_id,
						'company_branch_id'=>$last_insert_branch_id,
						'status' => $status,
						'is_delete'=> $is_delete
						);
						//Transfering data to Model
						$last_insert_user_id = $this->users_model->add_user('tbl_usrs',$userData);
						if($last_insert_user_id!='')
						{
							$sessiondata = array('message' => 'Company Details added Successfully');
							// $this->sendemail();
							$this->load->view('login/login_form',$sessiondata);
						}
						/*else
						{
							$sessiondata = array('message' => 'Error while adding data');
							$this->load->view('company/new_company_form',$sessiondata);
						}*/
					 }
					 /*else
					 {
						 $sessiondata = array('message' => 'Error while adding data');
							$this->load->view('company/new_company_form',$sessiondata);
					 }	*/
					
				}
			 }
		}
	}
	
	public function getLocationList()
	{
		$companyLoc = getCountry();
		echo json_encode($companyLoc);
	}
	
	public function getStateList($countryID)
	{
		$companyState = getState($countryID);
		echo json_encode($companyState);
	}
	
	public function getCityList($stateID)
	{
		$companyCity = getCity($stateID);
		echo json_encode($companyCity);
	}
}

?>
