<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class menuController extends CI_Controller {


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
	$this->load->model('users_model');
	$this->load->model('login_model');
	$this->load->model('menu_model');
	$this->load->helper('menu_helper');
	$this->load->helper('login_helper');
	
	
	
}	
	
public function index()
{
	
	$username = $this->session->userdata['username'];
	$password = $this->session->userdata['password'];
	$sessiondata = getUserInformation($username,$password);
	$sessiondata['heading']='Menu Management';
	$this->load->view('common/header',$sessiondata);
	$this->load->view('menu/menu_view',$sessiondata);
	$this->load->view('common/footer');
	
}	

public function getMenuList()
{
	 $all_menu_result = $this->menu_model->get_all_menu_information();
		 //echo '<pre>';print_r($all_users_result);exit;
		 echo json_encode($all_menu_result);
}

public function getMenuPopUpValues($id)
{
	$menu_result = $this->menu_model->get_menu_info_by_id($id)[0];
	echo json_encode($menu_result);
}



public function updateMenu()
{
	
	//echo '<pre>';print_r($this->input->post);exit;
	$id = $this->input->post("menu_id");
	$txt_menu_title = $this->input->post("txt_menu_title");
	$txt_menu = $this->input->post("txt_menu");
	$parent_menu_title = $this->input->post("parent_menu_title");
	$txt_menu_url = $this->input->post("txt_menu_url");
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
	$this->form_validation->set_rules("txt_menu", "Menu", "trim|required");
	$this->form_validation->set_rules("txt_menu_title", "Menutitle", "trim|required");

	if ($this->form_validation->run() == Null)
	{
	   //validation fails
	   //echo "Validations Fail";
	  //$this->load->view('users/new_user_form');
	}
	else
	{
		 if ($this->input->post('btn_login') == "Submit")
		   {
				//Setting values for tabel columns                   
				$data = array(
				'menu' => $txt_menu,
				'menu_title' => $txt_menu_title,
				'menu_url' => $txt_menu_url,
				'parent_menu_id'=>$parent_menu_title,
				'status' => $chk_status,
				'is_delete' => $chk_delete
				);
				//echo '<pre>';print_r($data);exit;
				
				//Transfering data to Model
				$this->menu_model->update_menu($id,$data,'tbl_menus');
				
			   //Loading View
				$sessiondata = array('message' => 'Data Updated Successfully');
				echo 'Data Updated Successfully';

		   }
	}
		
}

public function addMenu()
{
	//echo "ADD";exit;
	//echo '<pre>';print_r($this->input->post);exit;
	$id = $this->input->post("menu_id");
	$txt_menu = $this->input->post("txt_menu");
	$txt_menu_title = $this->input->post("txt_menu_title");
	$parent_menu_title = $this->input->post("parent_menu_title");
	$txt_menu_url = $this->input->post("txt_menu_url");
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
	$this->form_validation->set_rules("txt_menu", "Menu", "trim|required");
	$this->form_validation->set_rules("txt_menu_title", "Menutitle", "trim|required");
	//$this->form_validation->set_rules("txt_menu_url", "MenuUrl", "trim|required");
//	echo $id.'-'.$txt_menu.'-'.$txt_menu_title.'-'.$txt_menu_url.'-'.$chk_status.'-'.$chk_delete;exit;
	if ($this->form_validation->run() == Null)
	{
	   //validation fails
	   echo "Validations Fail";
	  //$this->load->view('users/new_user_form');
	}
	else
	{
		 if ($this->input->post('btn_login') == "Submit")
		   {
				//Setting values for tabel columns                   
				$data = array(
				'menu' => $txt_menu,
				'menu_title' => $txt_menu_title,
				'menu_url' => $txt_menu_url,
				'parent_menu_id'=>$parent_menu_title,
				'status' => $chk_status,
				'is_delete' => $chk_delete
				);
				//echo '<pre>';print_r($data);exit;
				
				//Transfering data to Model
				$this->menu_model->add_menu('tbl_menus',$data);
				
			   //Loading View
				$sessiondata = array('message' => 'Data Added Successfully');
				echo 'Data Added Successfully';

		   }
	}
		
}

public function setSideMenu()
{
	$menus = getMenus();
	$menuLi = '';
	$finalMenuLi='';
	for($i=0;$i<count($menus);$i++)
	{
		$menuLi = '<li class=""><a href="#">'.$menus[$i]['menu'].'<span class="fa arrow"></span></a><ul class="nav nav-second-level">';
		$parentMenu = getParentMenus($menus[$i]['menu_id']);
		for($j=0;$j<count($parentMenu);$j++)
		{
			$menuLi .='<li>'.$parentMenu[$j]['menu_url'].'</li>';
		}
		$menuLi .= '</ul></li>';
		$finalMenuLi .= $menuLi;
	}
	echo $finalMenuLi;
}

}
?>
