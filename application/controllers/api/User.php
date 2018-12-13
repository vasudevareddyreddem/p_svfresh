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
		echo $password;
		
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
//home page
public function home_post(){
	$userid=$this->post('user_id');
	// $flag=$this->Mobile_model->user_checking($userid);
	// if($flag==0){
		 // $message = array('status'=>0,'message'=>' unauthorized user');
		    // $this->response($message, REST_Controller::HTTP_OK);
	// }
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
	//get product for single category
	public function subcatproducts_post(){
	
	$userid=$this->post('user_id');
	$cat=$this->post('cat_id');
	$subcat=$this->post('subcat_id');
	$flag=$this->Mobile_model->user_checking($userid);
	if($flag==0){
		 $message = array('status'=>0,'message'=>' unauthorized user');
		    $this->response($message, REST_Controller::HTTP_OK);
	}
	$slider=$this->Mobile_model->subcat_img_slider($subcat);
	
	$message=array();

	if(count($slider)>0){
		$message['slider_status']=1;
		$message['subcat_slider']=$slider;
		
	}
	else{
		$message['slider_status']=0;
	}
	
	$products=$this->Mobile_model->product_list($subcat);
	if(count($products)>0){
		$message['product_status']=1;
		$message['products']=$products;
	
		 }
		 else{
			 $message['product_status']=0;
		 }

		    $this->response($message, REST_Controller::HTTP_OK);
	
}
//get single product
public function singleproduct_post(){
$pid=$this->post('product_id');
$message=array();
 $prod_det=$this->Mobile_model->single_product_details($pid);
 $prod_imgs=$this->Mobile_model->single_product_images($pid);
 $prod_fet=$this->Mobile_model->single_product_features($pid);
 $prod_rel=$this->Mobile_model->single_product_rel_products($pid);
 $dis_imgs=$this->Mobile_model->cat_dis_imgs();
    $cat_list=$this->Mobile_model->category_list();
if(count($cat_list)>0)
 { 
	
	 $message['cat_list_status']=1;
	  $message['cat_list']=$cat_list;
 }
 else{
	  $message['cat_list_status']=0;
 }
 if(count($prod_det)>0)
 { 
	
	 $message['prod_det_status']=1;
	  $message['prod_det']=$prod_det;
 }
 else{
	  $message['prod_det_status']=0;
 }
 if(count($prod_imgs)>0)
 { 
	
	 $message['prod_imgs_status']=1;
	  $message['prod_imgs']=$prod_imgs;
 }
 else{
	  $message['prod_imgs_status']=0;
 }
 if(count($prod_fet)>0)
 { 
	 
	 $message['prod_fet_status']=1;
	 $message['prod_fet']=$prod_fet;
 }
 else{
	  $message['prod_fet_status']=0;
 }
 if(count($prod_rel)>0)
 { 
 $message['prod_rel_status']=1;
	 $message['prod_rel']=$prod_rel;
	
 }
 else{
	  $message['prod_rel_status']=0;
 }
 
   $this->response($message, REST_Controller::HTTP_OK);
	
	
}
//get user orders
public function orders_post(){
	$user_id=$this->post('user_id');
	$message=array();
	$orders=$this->Mobile_model->get_user_orders($user_id);
	if(count($orders)>0)
 { 
 $message['orders_status']=1;
	 $message['orders']=$orders;
	
 }
 else{
	  $message['orders_status']=0;
 }
 
   $this->response($message, REST_Controller::HTTP_OK);
	
	
	
}
//get wishlist
public function wishlist_post(){
	$user_id=$this->post('user_id');
	$message=array();
	$wishlist=$this->Mobile_model->get_user_wishlist($user_id);
	if(count($wishlist)>0)
 { 
 $message['wishlist_status']=1;
	 $message['wishlist']=$wishlist;
	
 }
 else{
	  $message['wishlist_status']=0;
 }
 
   $this->response($message, REST_Controller::HTTP_OK);
	
	
	
}
//getting user profile
public function profile_post(){
	$user_id=$this->post('user_id');
	$message=array();
	$profile=$this->Mobile_model->get_user_profile($user_id);
	if(count($profile)>0)
 { 
 $message['profile_status']=1;
	 $message['profile']=$profile;
	
 }
 else{
	  $message['profile_status']=0;
 }
 
   $this->response($message, REST_Controller::HTTP_OK);
	
	
	
}
//get the cart products
public function cart_post(){
	$user_id=$this->post('user_id');
	$message=array();
	$cart=$this->Mobile_model->get_user_cart($user_id);
	if(count($cart)>0)
 { 
 $message['cart_status']=1;
	 $message['cart']=$cart;
	
 }
 else{
	  $message['cart_status']=0;
 }
 
   $this->response($message, REST_Controller::HTTP_OK);
	
	
	
}


}
