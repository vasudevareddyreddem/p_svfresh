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

public function forgot_password(){
	if(!$this->session->userdata('admindetails')){

		$this->load->view('admin/forgot');
		$this->load->view('admin/footer');
	}else{
		redirect('admin/dashboard');
	}


}
public  function forgotpass(){
	$post=$this->input->post();
		$check_login=$this->Login_model->get_email_details_check($post['email']);
		//echo $this->db->last_query();exit;
		if(count($check_login)>0){
			//echo '<pre>';print_r($check_login);exit;
					$config['mailtype'] = 'html';
				$this->load->library('email',$config);
				$this->email->set_newline("\r\n");
				$this->email->set_mailtype("html");
				$this->email->to($check_login['login_email']);
				$this->email->from('admin@prachatech.com');
				$this->email->subject('Forgot Password');
				$body = "<b> Your Account login Password is </b> : ".$check_login['org_password'];
				$this->email->message($body);
				if ($this->email->send())
				{
					$this->session->set_flashdata('success',"Password sent to your registered email address. Please Check your registered email address");
					redirect('login');
				}else{
					$this->session->set_flashdata('error'," In Localhost mail  didn't sent");
					redirect('login');
				}
			}else{
				$this->session->set_flashdata('error',"Invalid email id. Please try again once");
				redirect($_SERVER['HTTP_REFERER']);
			}
}







}

 ?>
