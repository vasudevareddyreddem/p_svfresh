<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class User extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
		$this->load->library('email');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('security');
		$this->load->model('User_model');
		
    }

	public function login_post(){
		$email=$this->post('email');
		$password=$this->post('password');
		echo $email;
		echo $password;exit;
		
		if($email==''){
			$message = array('status'=>0,'message'=>'Email Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		if($password==''){
			$message = array('status'=>0,'message'=>'Password is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
	
		
		$user=$this->User_model->check_loging($email);
		
		
		if(count($user)>0){
			if(password_verify($this->input->post('password'),$user['password']))
			{
				$message = array('status'=>1,'message'=>$user);
			$this->response($message, REST_Controller::HTTP_OK);
				
			}
			else{
				echo $this->input->post('password');exit;
					$message = array('status'=>0,'message'=>'email is wrong');
			 //$this->response($message, REST_Controller::HTTP_OK);
				
			}
		
		
	               }
				   else{
					   $message = array('status'=>0,'message'=>'email or password is wrong');
			     $this->response($message, REST_Controller::HTTP_OK);
					   
					   
				   }
	
	
	

}
}
