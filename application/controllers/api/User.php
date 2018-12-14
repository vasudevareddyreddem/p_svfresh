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
//categories
public function categories_post(){
	
	// $userid=$this->post('user_id');
	
	// $flag=$this->Mobile_model->user_checking($userid);
	// if($flag==0){
		 // $message = array('status'=>0,'message'=>' unauthorized user');
		    // $this->response($message, REST_Controller::HTTP_OK);
	// }
	
	$cat=$this->Mobile_model->category_list();
	if(count($cat)>0){
	       $message = array('status'=>1,'message'=>$cat);
		   $message['image_path']=base_url().'assets/uploads/category_pics/';
		    $this->response($message, REST_Controller::HTTP_OK);
	}
	    $message = array('status'=>0,'message'=>'No records in category');
		    $this->response($message, REST_Controller::HTTP_OK);
}
public function home_slider_post(){
		 $images=$this->Mobile_model->home_slider_two_images();
		 if(count($images)>0){
			 $id=$images['slider_id'];
			 $slider=$this->Mobile_model->home_sliders($id);
			if(count($slider)>0){
				$message['status']=1;
			 $message['siider']=$slider;
			 $message['image_path']=base_url().'assets/uploads/slider_pics/';
			}
			else{
					$message['status']=0;
					
			}
			
			 }
		 else{
			 $message['status']=0;
			 $message['message']='no slider Images';
			 
		 }
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
	// $products=$this->Mobile_model->get_all_products();
	// $message=array();
	// if(count($products)>0){
		// $message['prodcut_status']=1;
		// $message['prodcuts']=$products;
		   
		
	// }
	// else{
		// $message['prodcut_status']=0;
	// }
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
			
			  //$message['simg_staus']=1;
			  //$message['simages']=$images;
		   
			
		 }
		 else{
			 // $message['simg_staus']=0;
			 
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
	// $flag=$this->Mobile_model->user_checking($userid);
	// if($flag==0){
		 // $message = array('status'=>0,'message'=>' unauthorized user');
		    // $this->response($message, REST_Controller::HTTP_OK);
	// }
	// $slider=$this->Mobile_model->subcat_img_slider($subcat);
	
	// $message=array();

	// if(count($slider)>0){
		// $message['status']=1;
		// $message['subcat_slider']=$slider;
		
	// }
	// else{
		// $message['slider_status']=0;
	// }
	
	$products=$this->Mobile_model->product_list($subcat);
	if(count($products)>0){
		$message['status']=1;
		$message['products']=$products;
	
		 }
		 else{
			 $message['status']=0;
			 $message[]='No products available';
		 }

		    $this->response($message, REST_Controller::HTTP_OK);
	
}
//get products for single category
	public function catproducts_post(){
	
	$userid=$this->post('user_id');
	$cat=$this->post('cat_id');
	
	
	
	$products=$this->Mobile_model->product_list_by_cat($cat);
	if(count($products)>0){
		$message['status']=1;
		$message['products']=$products;
		 $message['image_path']=base_url().'assets/uploads/product_pics/';
	
		 }
		 else{
			 $message['status']=0;
			 $message[]='No products available';
		 }

		    $this->response($message, REST_Controller::HTTP_OK);
	
}
//get single product
public function singleproduct_post(){
$pid=$this->post('product_id');
$message=array();
 $prod_det=$this->Mobile_model->single_product_details($pid);
 //$prod_imgs=$this->Mobile_model->single_product_images($pid);
 $prod_fet=$this->Mobile_model->single_product_features($pid);
 $prod_rel=$this->Mobile_model->single_product_rel_products($pid);
 //$dis_imgs=$this->Mobile_model->cat_dis_imgs();
    // $cat_list=$this->Mobile_model->category_list();
// if(count($cat_list)>0)
 // { 
	
	 // $message['cat_list_status']=1;
	  // $message['cat_list']=$cat_list;
 // }
 // else{
	  // $message['cat_list_status']=0;
 // }
 if(count($prod_det)>0)
 { 
	
	 $message['prod_det_status']=1;
	  $message['prod_det']=$prod_det;
 }
 else{
	  $message['prod_det_status']=0;
 }
 // if(count($prod_imgs)>0)
 // { 
	
	 // $message['prod_imgs_status']=1;
	  // $message['prod_imgs']=$prod_imgs;
 // }
 // else{
	  // $message['prod_imgs_status']=0;
 // }
 if(count($prod_fet)>0)
 { 
	 
	
	 $message['prod_fet']=$prod_fet;
 }
 else{
	  $message['prod_fet']='No Product Features';
 }
 if(count($prod_rel)>0)
 { 
 
	 $message['prod_rel']=$prod_rel;
	
 }
 else{
	  $message['prod_rel']='No related Products';
 }
 
   $this->response($message, REST_Controller::HTTP_OK);
	
	
}
//get user orders
public function orders_post(){
	$user_id=$this->post('user_id');
	$message=array();
	$flag=$this->Mobile_model->user_checking($user_id);
	if($flag==0){
		 $message['check_staus'] =0;
		 $message['message']='unauthorized user';
		    $this->response($message, REST_Controller::HTTP_OK);
	}
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
	$flag=$this->Mobile_model->user_checking($user_id);
	if($flag==0){
		 $message['check_staus'] =0;
		 $message['message']='unauthorized user';
		    $this->response($message, REST_Controller::HTTP_OK);
	}
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
	$flag=$this->Mobile_model->user_checking($user_id);
	if($flag==0){
		 $message['check_staus'] =0;
		 $message['message']='unauthorized user';
		    $this->response($message, REST_Controller::HTTP_OK);
	}
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
//add to cart
public function add_to_cart_post(){
	 $product_id=$this->post('product_id');
	 $user_id=$this->post('user_id');
	 $quan=$this->post('quantity');
	 $net_price=$this->post('net_price');
	 $flag=$this->Mobile_model->user_checking($user_id);
	if($flag==0){
		 $message = array('status'=>0,'message'=>' unauthorized user');
		    $this->response($message, REST_Controller::HTTP_OK);
	 }
	$prod_det=$this->Mobile_model->single_product_details($product_id);
	
	
	if(!count($prod_det)>0){
		 $message = array('status'=>0,'message'=>'Product Not available');
		    $this->response($message, REST_Controller::HTTP_OK);
	}
	$data=array('user_id'=>$user_id,
	 'product_id'=>$product_id,
	 'product_img'=>$prod_det['product_img'],
	 'product_name'=>$prod_det['product_name'],
	  'net_price'=>$net_price,
	 'quantity'=>$quan,
	 
	 );
	$flag= $this->Mobile_model->insert_cart_product($data);
	if($flag==1){
	 $message = array('status'=>1,'message'=>'Add to cart Successfully');
		    $this->response($message, REST_Controller::HTTP_OK);
		
	}
	 $message = array('status'=>1,'message'=>'Product not added to cart');
		    $this->response($message, REST_Controller::HTTP_OK);
}


//get the cart products
public function get_cart_post(){
	$user_id=$this->post('user_id');
	$message=array();
	$flag=$this->Mobile_model->user_checking($user_id);
	if($flag==0){
		 $message['status'] =0;
		 $message['message']='unauthorized user';
		    $this->response($message, REST_Controller::HTTP_OK);
	}
	$cart=$this->Mobile_model->get_user_cart($user_id);
	if(count($cart)>0)
 { 
 $message['status']=1;
	 $message['cart_list']=$cart;
	
 }
 else{
	  $message['status']=0;
	   $message['message']='No cart products Available';
 }
 
   $this->response($message, REST_Controller::HTTP_OK);
	
	
	
}
// delete the cart product
public function delete_cart_product_post(){
	$user_id=$this->post('user_id');
	$cart_id=$this->post('cart_id');
	$message=array();
	$flag=$this->Mobile_model->user_checking($user_id);
	if($flag==0){
		 $message['check_staus'] =0;
		 $message['message']='unauthorized user';
		    $this->response($message, REST_Controller::HTTP_OK);
	}
	$cart=$this->Mobile_model->delete_cart_product($cart_id);
	if($cart==1)
 { 
 $message['cart_status']=1;
	 $message['message']='product deleted from cart';
	
 }
 else{
	  $message['cart_status']=0;
	   $message['message']='product not deleted from cart';
 }
 
   $this->response($message, REST_Controller::HTTP_OK);
	
	
	
}
//get the checkout products
public function checkout_post(){
	$user_id=$this->post('user_id');
	$message=array();
	$flag=$this->Mobile_model->user_checking($user_id);
	if($flag==0){
		 $message['check_staus'] =0;
		 $message['message']='unauthorized user';
		    $this->response($message, REST_Controller::HTTP_OK);
	}
	$checkout=$this->Mobile_model->get_user_checkout($user_id);
	if(count($checkout)>0)
 { 
 $message['checkout_status']=1;
	 $message['checkout']=$checkout;
	
 }
 else{
	  $message['checkout_status']=0;
 }
 
   $this->response($message, REST_Controller::HTTP_OK);
	
	
	
}
public function billing_address_post(){
	$user_id=$this->post('user_id');
	$message=array();
	$flag=$this->Mobile_model->user_checking($user_id);
	if($flag==0){
		 $message['check_staus'] =0;
		 $message['message']='unauthorized user';
		    $this->response($message, REST_Controller::HTTP_OK);
	}
	$address=$this->Mobile_model->get_user_billing_address($user_id);
	if(count($address)>0)
 { 
 $message['address_status']=1;
	 $message['address']=$address;
	
 }
 else{
	  $message['address_status']=0;
 }
 
   $this->response($message, REST_Controller::HTTP_OK);
	
	
	
}



}
