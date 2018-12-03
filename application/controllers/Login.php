<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

public function __construct() 
	{
	parent::__construct();	
		$this->load->helper(array('form', 'url','cookie'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('email');
		$this->load->library('user_agent');
		$this->load->helper('directory');
		$this->load->helper('security');
		$this->load->model('Login_model');

	}
public function index(){
	
	if(!$this->session->userdata('svadmin_det')){
		//echo $this->input->cookie('username'); exit;
			
	
	$this->load->view('admin/login');
	
		
	}else{

	redirect('admin');
	}
	
	
}
	public function checking(){
		
			
	 $this->form_validation->set_rules('email_id', 'user name', 'required');
	  $this->form_validation->set_rules('password', 'password', 'required');
	 
	   if ($this->form_validation->run() == FALSE)
                 {
          $this->session->set_flashdata('error',validation_errors());
                     redirect('login');

                }
			   //echo 'kdkd'; exit;
			   
	$userid=$this->input->post('email_id');
	$password=$this->input->post('password');
	
	

	$password=md5($password);
	
	
$row=$this->Login_model->logincheck($userid,$password);
//echo $this->db->last_query();exit;


//echo '<pre>'; print_r($row);exit;
if(!(count($row)>0)){
	      $this->session->set_flashdata('error','email or password is incorrect');
                    redirect('login');
	
}
$this->session->set_userdata('svadmin_det',$row);
if($this->input->post('remember_me')){
$this->input->set_cookie('remember','yes',30*24*60*60); 
$this->input->set_cookie('username',$this->input->post('email_id'),30*24*60*60); 
$this->input->set_cookie('password',$this->input->post('password'),30*24*60*60); 
	}
	
	
	redirect('admin');
	
		
	
	
}

public function logout(){
	if($this->session->userdata('svadmin_det'))
		{
				
			$this->session->unset_userdata('svadmin_det');
			$this->session->sess_destroy('svadmin_det');
			redirect('login');
		}else{
		 $this->session->set_flashdata('loginerror','Please login to continue');
		 redirect('login');
		} 
	
	
}
/*
public function forgot_password(){
	if(!$this->session->userdata('admindetails')){
		$this->load->view('admin/header');
		$this->load->view('admin/forgot_password');
		$this->load->view('admin/footer');
	}else{
		redirect('admin/dashboard');
	}
	
	
} */


	
	
	
	
	
}

 ?>