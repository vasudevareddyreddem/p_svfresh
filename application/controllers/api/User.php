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
		$this->load->model('Mobile_model');
		
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
public function categories_post(){
	
	$userid=$this->post('user_id');
	
	$flag=$this->Mobile_model->user_checking($userid);
	if($flag==0){
		 $message = array('status'=>0,'message'=>' unauthorized user');
		    $this->response($message, REST_Controller::HTTP_OK);
	}
	
	$cat=$this->Mobile_model->category_list();
	if(count($cat)>0){
	       $message = array('status'=>1,'message'=>$cat);
		    $this->response($message, REST_Controller::HTTP_OK);
	}
	    $message = array('status'=>0,'message'=>'No records in category');
		    $this->response($message, REST_Controller::HTTP_OK);
}
public function subcatgories_post(){
	
	$userid=$this->post('user_id');
	$cat=$this->post('cat_id');
	$flag=$this->Mobile_model->user_checking($userid);
	if($flag==0){
		 $message = array('status'=>0,'message'=>' unauthorized user');
		    $this->response($message, REST_Controller::HTTP_OK);
	}
	$subcat=$this->Mobile_model->subcategory_list($cat);
	
	if(count($subcat)>0){
	 $message = array('status'=>1,'message'=>$subcat);
		    $this->response($message, REST_Controller::HTTP_OK);
	}
	 $message = array('status'=>0,'message'=>'NO Subcategories for this Category');
		    $this->response($message, REST_Controller::HTTP_OK);
}
public function products_post(){
	
	$userid=$this->post('user_id');
	$cat=$this->post('cat_id');
	$subcat=$this->post('subcat_id');
	$flag=$this->Mobile_model->user_checking($userid);
	if($flag==0){
		 $message = array('status'=>0,'message'=>' unauthorized user');
		    $this->response($message, REST_Controller::HTTP_OK);
	}
	$products=$this->Mobile_model->product_list($cat,$subcat);
	if(count($products)>0){
	 $message = array('status'=>1,'message'=>$products);
		    $this->response($message, REST_Controller::HTTP_OK);
	}
	 $message = array('status'=>0,'message'=>'NO Products for this subcategory');
		    $this->response($message, REST_Controller::HTTP_OK);
	
}
public function home_post(){
	$userid=$this->post('user_id');
	$flag=$this->Mobile_model->user_checking($userid);
	if($flag==0){
		 $message = array('status'=>0,'message'=>' unauthorized user');
		    $this->response($message, REST_Controller::HTTP_OK);
	}
	$products=$this->Mobile_model->get_all_products();
	$message=array();
	if(count($products)>0){
		$message['prodcut_status']=1;
		$message['prodcuts']=$products;
		   
		
	}
	else{
		$message['prodcut_status']=0;
	}
	$images=$this->Mobile_model->home_slider_two_images();
		if(count($images)>0){
			$id=$images['slider_id'];
			$slider=$this->Mobile_model->home_sliders($id);
			if(count($slider)>0){
				$message['slider_staus']=1;
			 $message['siider']=$slider;
			}
			else{
					$message['slider_staus']=0;
			}
			 $message['simg_staus']=1;
			 $message['simages']=$images;
		   
			
		}
		else{
			 $message['simg_staus']=0;
			 
		}
		$cat=$this->Mobile_model->category_list();
		if(count($cat)>0){
			$message['cat_status']=1;
			$message['cat_list']=$cat;
			
		}
		else{
			$message['cat_status']=0;
		}
		 $this->response($message, REST_Controller::HTTP_OK)  ;
		
	}


}
