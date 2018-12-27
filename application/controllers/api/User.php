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
	public function user_reg_post(){
		$uname=$this->post('uname');
		
		$username=$uname;
		$email=$this->post('email');
		$mobile=$this->post('mobile');
		$org_password=$this->post('password');
	    $password=password_hash($this->post('password'),PASSWORD_DEFAULT);
		$flag=$this->Mobile_model->user_email_checking($email);
		//echo $this->db->last_query();exit;
		if($flag==1){
			$message = array('status'=>0,'message'=>'email already  existed');
			$this->response($message, REST_Controller::HTTP_OK);
		
			
		}
		$flag=$this->Mobile_model->user_mobile_checking($mobile);
		if($flag==1){
			$message = array('status'=>0,'message'=>'phone number already  existed');
			$this->response($message, REST_Controller::HTTP_OK);
		
			
		}
		
		$data=array('email_id'=>$email,
		'phone_number'=>$mobile,
		'user_name'=>$username,
		'org_password'=>$org_password,
		'password'=>$password,
		'status'=>'active'
		);
		
		$status=$this->Mobile_model->insert_user_reg($data);
		if($status==0){
			
				$message = array('status'=>0,'message'=>'user not registered');
			$this->response($message, REST_Controller::HTTP_OK);
		
			
		}
		$message = array('status'=>1, 'id'=>$status,'message'=>'user registered');
			$this->response($message, REST_Controller::HTTP_OK);
	
		
	}

	public function login_post(){
		$email=$this->post('email');
	
		$password=$this->post('password');
		
		
		if($email==''){
			$message = array('status'=>0,'message'=>'Email Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		if($password==''){
			$message = array('status'=>0,'message'=>'Password is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
	
		
		$user=$this->Mobile_model->check_loging($email);
		//echo $this->db->last_query();exit;
		
		
		if(count($user)>0){
			if(password_verify($this->post('password'),$user['password']))
				{
					unset($user['password']);
				$message = array('status'=>1,'message'=>'login successful','user'=>$user);
			$this->response($message, REST_Controller::HTTP_OK);
				
			}
			else{
				
					$message = array('status'=>0,'message'=>'password is wrong');
			 $this->response($message, REST_Controller::HTTP_OK);
				
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
	
	
	$cat=$this->post('cat_id');
	
	$subcat=$this->Mobile_model->subcategory_list($cat);
	
	if(count($subcat)>0){
	 $message = array('status'=>1,'message'=>$subcat);
	 $message['subcat_img_path']=base_url().'assets/uploads/sub_category_pics/';
		    $this->response($message, REST_Controller::HTTP_OK);
	}
	 $message = array('status'=>0,'message'=>'NO Subcategories for this Category');
		    $this->response($message, REST_Controller::HTTP_OK);
}
//not needed
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
//not needed
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
	
	
	//$cat=$this->post('cat_id');
	$subcat=$this->post('subcat_id');
	
	if($this->post('user_id')){
	$user_id=$this->post('user_id');
	} else{
		$user_id='dummydata';
	}
	
	
	
	// $slider=$this->Mobile_model->subcat_img_slider($subcat);
	
	// $message=array();

	// if(count($slider)>0){
		// $message['status']=1;
		// $message['subcat_slider']=$slider;
		
	// }
	// else{
		// $message['slider_status']=0;
	// }
	
	$products=$this->Mobile_model->product_list($subcat,$user_id);

	
	if(count($products)>0){
		$message['status']=1;
		$message['products']=$products;
		$message['product_image_path']=base_url().'assets/uploads/product_pics/';
		$message['message']='products available';
	
		 }
		 else{
			 $message['status']=0;
			 $message['message']='No products available';
		 }

		    $this->response($message, REST_Controller::HTTP_OK);
	
}
//not needed
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
     $message['product_image_path']=base_url().'assets/uploads/product_pics/';
	
 }
 else{
	  $message['orders_status']=0;
	  $message['message']="NO orders";
 }
 
   $this->response($message, REST_Controller::HTTP_OK);
	
	
	
}
//insert wishlist
public function insert_wishlist_product_post(){
	$user_id=$this->post('user_id');
	$message=array();
	$flag=$this->Mobile_model->user_checking($user_id);
	if($flag==0){
		 $message['check_staus'] =0;
		 $message['message']='unauthorized user';
		    $this->response($message, REST_Controller::HTTP_OK);
	}
	
	$pid=$this->post('product_id');
	$quan=$this->post('quantity');
	$prod_det=$this->Mobile_model->single_product_details($pid);
	
	
	if(!count($prod_det)>0){
		 $message = array('status'=>0,'message'=>'Product Not available');
		    $this->response($message, REST_Controller::HTTP_OK);
	}
	$data=array('user_id'=>$user_id,
	            'product_id'=>$pid,
				'product_img'=>$prod_det['product_img'],
				'product_name'=>$prod_det['product_name'],
				'quantity'=>$quan,
				'net_price'=>$prod_det['net_price'],
				'discount_price'=>$prod_det['discount_price'],
			
				);
	

	$flag=$this->Mobile_model->insert_wishlist_product($data);
	if($flag==1) {
		$message['status']=1;
	    $message['message']='product placed in whishlist';
		 $this->response($message, REST_Controller::HTTP_OK);
	}
	$message = array('status'=>0,'message'=>'product not added  to whishlist');
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
	 $message['image_path']=base_url().'assets/uploads/product_pics/';
	
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
public function edit_profile_post(){
	$user_id=$this->post('user_id');
	$flag=$this->Mobile_model->user_checking($user_id);
	if($flag==0){
		 $message['check_staus'] =0;
		 $message['message']='unauthorized user';
		    $this->response($message, REST_Controller::HTTP_OK);
	}
	$username=$this->post('username');
	$email=$this->post('email');
	$mobile=$this->post('mobile');
	$status=$this->Mobile_model->check_edit_email($email,$user_id);
	
	
	if($status==1){
		 $message = array('status'=>0,'message'=>'email already existed');
		  $this->response($message, REST_Controller::HTTP_OK);
	}
	$status=$this->Mobile_model->check_edit_mobile($mobile,$user_id);
	
	if($status==1){
		 $message = array('status'=>0,'message'=>'mobile number already existed');
		  $this->response($message, REST_Controller::HTTP_OK);
	}
	$data=array(
	'email_id'=>$email,
	'phone_number'=>$mobile,
	'user_name'=>$username);
	$status=$this->Mobile_model->update_profile($data,$user_id);
	if($status==1){
		 $message = array('status'=>1,'message'=>'Profile Updated Successfully');
		 $this->response($message, REST_Controller::HTTP_OK);
		
	}
	 $message = array('status'=>1,'message'=>'Profile Updated Successfully');
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
	  $message['image_path']=base_url().'assets/uploads/product_pics/';
	
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
		 $message['status'] =0;
		 $message['message']='unauthorized user';
		    $this->response($message, REST_Controller::HTTP_OK);
	}
	
	$cart=$this->Mobile_model->delete_cart_product($cart_id);
	if($cart==1)
 { 
 $message['status']=1;
	 $message['message']='product deleted from cart';
	
 }
 else{
	  $message['status']=0;
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
		 $message['status'] =0;
		 $message['message']='unauthorized user';
		    $this->response($message, REST_Controller::HTTP_OK);
	}
	$address=$this->Mobile_model->get_user_billing_address($user_id);
	if(count($address)>0)
 { 
 $message['status']=1;
	 $message['address']=$address;
	
 }
 else{
	  $message['status']=0;
 }
 
   $this->response($message, REST_Controller::HTTP_OK);
	
	
	
}
public function insert_billing_address_post(){
	
	$user_id=$this->post('user_id');
	$flag=$this->Mobile_model->user_checking($user_id);
	if($flag==0){
		 $message['status'] =0;
		 $message['message']='unauthorized user';
		    $this->response($message, REST_Controller::HTTP_OK);
	}
	$fname=$this->post('fname');
	$lname=$this->post('lname');
	$comp_name=$this->post('comp_name');
	$email=$this->post('email');
	$address=$this->post('address');
	$city=$this->post('city');
	$state=$this->post('state');
	$pin=$this->post('pin');
	$mobile=$this->post('mobile');
	$fax=$this->post('fax');
	
	$data=array('user_id'=>$user_id,
	'first_name'=>$fname,
	'last_name'=>$lname,
	'company_name'=>$comp_name,
	'email_address'=>$email,
	'address'=>$address,
	'state'=>$state,
	'city'=>$city,
	'zip'=>$pin,
	'telephone'=>$mobile,
	'fax'=>$fax,
	'created_by'=>$user_id,
	'status'=>'active'
	);
    $insert_id=$this->Mobile_model->insert_billing_address($data);
	if($insert_id==0){
		$message=array('status'=>0,'message'=>'Billing address not added ');
	 $this->response($message, REST_Controller::HTTP_OK);
		
	}
	
		$message=array('status'=>1,'billing_id'=>$insert_id);
		 $this->response($message, REST_Controller::HTTP_OK);
	
	
}
public function insert_order_post(){
	$billing_id=$this->post('billing_id');
	$user_id=$this->post('user_id');
	$flag=$this->Mobile_model->user_checking($user_id);
	if($flag==0){
		 $message['status'] =0;
		 $message['message']='unauthorized user';
		    $this->response($message, REST_Controller::HTTP_OK);
	}
	
	
	if($this->post('razor_payment_id')){
		 $razor_payment_id=$this->post('razor_payment_id');
	
	} 
	else{
		$razor_payment_id='';
		
	}
	
	if($this->post('razor_order_id')){
		$razor_order_id=$this->post('razor_order_id');
	}
   
	else{
   $razor_order_id='';
	}
	if($this->post('razor_signature')){
   $razor_sig=$this->post('razor_signature');
	} 
	else{
		$razor_sig='';
	}
	$ite=$this->post('product_ids');
    $ite = str_replace(array('[',']') ,'' , $ite);
    $items = explode(',' , $ite);


	$payment_type=$this->post('payment_type');
	$pnames=$this->post('product_names');

    $pnames = str_replace(array('[',']') ,'' , $pnames);
    $product_names = explode(',' , $pnames);

    $imgs=$this->post('product_imgs');
    $imgs = str_replace(array('[',']') ,'' , $imgs);
    $product_imgs = explode(',' ,$imgs);
    $quans=$this->post('quantitys');
    $quans = str_replace(array('[',']') ,'' , $quans);
    $quantitys = explode(',' , $quans);




	$ps=$this->post('prices');
    $ps = str_replace(array('[',']') ,'' , $ps);
    $prices = explode(',' , $ps);


   $data=array('user_id'=>$user_id,
               'billing_id'=>$billing_id,
			   'payment_type'=>$payment_type,
			    'created_by'=>$user_id,
				'razorpay_payment_id'=>$razor_payment_id,
				'razorpay_order_id'=>$razor_order_id,
				'razorpay_signature'=>$razor_sig
				
				);
	$insert_id=$this->Mobile_model->insert_order($data);
	    $str = date('Ymd').$insert_id;
        $order_number =  'SV'.str_pad($str,10,'0',STR_PAD_LEFT);
		$count=count($items);
     for($i=0;$i<$count;$i++)
	 {
		 //$cart_det=$this->Mobile_model->single_cart_item($item);
		 
		 
		//$product=$this->Mobile_model->single_product_details($cart_det['product_id']);
		//$net_price=$cart_det['quantity']*$product['net_price'];
		
		 $itemdata[]=array('order_id'=>$insert_id,
		                  'order_number'=>$order_number,
						  'user_id'=>$user_id,
						  'product_id'=>$items[$i],
						  'product_name'=>$product_names[$i],
						  'product_img'=>$product_imgs[$i],
						  'quantity'=>$quantitys[$i],
						  'net_price'=>$prices[$i],
						  );
	 }
	
	$status=$this->Mobile_model->insert_order_items($itemdata);
	if($status==1){
		$this->Mobile_model->delete_cart_items($user_id);
	$message=array('status'=>1,'order_id'=>$insert_id);
		 $this->response($message, REST_Controller::HTTP_OK);
		 
	}
		$message=array('status'=>0,'message'=>'order_items not added');
		 $this->response($message, REST_Controller::HTTP_OK);
	
}
public function delete_wishlist_item_post(){
	$user_id=$this->post('user_id');
	$flag=$this->Mobile_model->user_checking($user_id);
	if($flag==0){
		 $message['status'] =0;
		 $message['message']='unauthorized user';
		    $this->response($message, REST_Controller::HTTP_OK);
	}
	$wishlist_id=$this->post('wishlist_id');
	$status=$this->Mobile_model->delete_wishlist_item($wishlist_id);
	if($status==1){
		$message=array('status'=>1,'message'=>'wishlist item deleted');
		 $this->response($message, REST_Controller::HTTP_OK);
	}
	$message=array('status'=>0,'message'=>'wishlist item not deleted');
		 $this->response($message, REST_Controller::HTTP_OK);
	
	
          }
		  public function delete_wishlist_post(){
			  	$user_id=$this->post('user_id');
	      $flag=$this->Mobile_model->user_checking($user_id);
	if($flag==0){
		 $message['status'] =0;
		 $message['message']='unauthorized user';
		    $this->response($message, REST_Controller::HTTP_OK);
	}
	$status=$this->Mobile_model->delete_wishlist($user_id);
	if($status==1){
		$message=array('status'=>1,'message'=>'wishlist  deleted');
		 $this->response($message, REST_Controller::HTTP_OK);
	}
	$message=array('status'=>0,'message'=>'wishlist not deleted');
		 $this->response($message, REST_Controller::HTTP_OK);
			  
		  }
public function change_password_post(){
	$user_id=$this->post('user_id');
	$flag=$this->Mobile_model->user_checking($user_id);
	if($flag==0){
		 $message['status'] =0;
		 $message['message']='unauthorized user';
		    $this->response($message, REST_Controller::HTTP_OK);
	}
	$password=$this->post('old_password');
	$newpassword=$this->post('new_password');
	
	$user=$this->Mobile_model->get_user_details($user_id);
	if(password_verify($this->post('old_password'),$user['password']))
				{
					
					$hashpassword=password_hash($this->post('new_password'),PASSWORD_DEFAULT);
					$this->Mobile_model->change_password($hashpassword,$newpassword,$user_id);
				
				$message = array('status'=>1,'message'=>'Password Changed Successfully');
			$this->response($message, REST_Controller::HTTP_OK);
				
			}
				$message = array('status'=>0,'message'=>'Old Password is Wrong');
			$this->response($message, REST_Controller::HTTP_OK);
				
	
	
} 
public function get_months_post(){
 $date = date('Y-m-d');


$month=date('m' ,strtotime($date));//current month in number
$year=date('Y' ,strtotime($date));// current year in number

 $days=cal_days_in_month(CAL_GREGORIAN,$month,$year);//days in  a month
 $curmonth['month_in_text']=date('F' ,strtotime($date));//month in text
 $curmonth['month']=$month;
  $curmonth['year']=$year;
  $curmonth['days']=$days;
   $curmonth['present_day']=date('d' ,strtotime($date)); // present day in number
$months[]=$curmonth;  

 for($i=1;$i<3;$i++)
 {
	$curmonth=array();

	$date=date('Y-m-d', strtotime('+'.$i.' month'));
	$curmonth['month_in_text']=date('F' ,strtotime($date));
	$curmonth['month']=date('m' ,strtotime($date));
    $curmonth['year']=date('Y' ,strtotime($date));
    $curmonth['days']=cal_days_in_month(CAL_GREGORIAN,$curmonth['month'],$curmonth['year']);
    $curmonth['present_day']=1; 
	$months[]=$curmonth; 
	
	
	 
 }
 $data['months']=$months;
   $this->response($data, REST_Controller::HTTP_OK);

}
 public function insert_milk_order_post(){
	$product_id=$this->post('product_id');
	$billing_id=$this->post('billing_id');
	$user_id=$this->post('user_id');
	$flag=$this->Mobile_model->user_checking($user_id);
	if($flag==0){
		 $message['status'] =0;
		 $message['message']='unauthorized user';
		    $this->response($message, REST_Controller::HTTP_OK);
	}
	
	$month=$this->post('month');
	$year=$this->post('year');
	$d=$this->post('days');
     $d = str_replace(array('[',']') ,'' , $d);
     $days = explode(',' , $d);

	$quans=$this->post('quantitys');
     $quans= str_replace(array('[',']') ,'' , $quans);
     $quantitys = explode(',' , $quans);


	$price=$this->post('price');
	
	foreach($quantitys as $key=>$value ){
	$data[]="('$product_id',
	         '$billing_id',
	         '$user_id',
	         '$month',
              '$year',
	          '$days[$key]',
	'$price',
	'$value'
	)";
	
	
	}

	$status=$this->Mobile_model->milk_orders($data);

	if($status==1){
	$message=array('status'=>1,'message'=>'Milk order added');
		 $this->response($message, REST_Controller::HTTP_OK);
	
	}
	else{
		 $message=array('status'=>0,'message'=>'Milk order  not added');
		 $this->response($message, REST_Controller::HTTP_OK);
	}
}
//this is calender display
public function get_milk_order_post(){
	$product_id=$this->post('product_id');
	$user_id=$this->post('user_id');
	$month=$this->post('month');
	$year=$this->post('year');
	$flag=$this->Mobile_model->user_checking($user_id);
	if($flag==0){
		 $message['status'] =0;
		 $message['message']='unauthorized user';
		    $this->response($message, REST_Controller::HTTP_OK);
	}
    $days_inmonth=cal_days_in_month(CAL_GREGORIAN,$month,$year);
	$curmonth=date('m');
	if($curmonth==$month){
		
		$day=date('d');
	}
	else{
		$day=0;
		
	}
	$result=$this->Mobile_model->get_milk_orders_by_user($user_id,$product_id,$month,$year);

	if(count($result)>0){
      $order_days=array_column($result,'date');
	 
	  $quantity=array_column($result,'quantity');

	    for($i=1;$i<=$days_inmonth;$i++){
			if(in_array($i,$order_days)){
				
			
			}
			else{
				$result[]=array('date'=>$i,'quantity'=>0);
				
				
				
			}
			
	        
        }

		$message=array('status'=>1,'orders'=>$result,'curdate'=>$day,'days_inmonth'=>$days_inmonth);
		 $this->response($message, REST_Controller::HTTP_OK);
		
	}
    for($i=1;$i<=$days_inmonth;$i++){

            $empty_result[]=array('date'=>$i,'quantity'=>0);




    }

	
	$message=array('status'=>0,'orders'=>$empty_result,'curdate'=>$day,'days_inmonth'=>$days_inmonth);
		 $this->response($message, REST_Controller::HTTP_OK);
	
	
}
public  function  milk_orders_post(){

        $user_id=$this->post('user_id');
    $flag=$this->Mobile_model->user_checking($user_id);
    if($flag==0){
        $message['status'] =0;
        $message['message']='unauthorized user';
        $this->response($message, REST_Controller::HTTP_OK);
    }
       $result=$this->Mobile_model->get_milk_orders($user_id);
    if(count($result)>0) {

        $message = array('status' => 1, 'orders' => $result );
        $message['product_image_path']=base_url().'assets/uploads/product_pics/';
        $this->response($message, REST_Controller::HTTP_OK);
    }
    $message = array('status' => 0, 'orders' => array() );
    $this->response($message, REST_Controller::HTTP_OK);
}

    public function  cancel_milk_order_post(){
        $user_id=$this->post('user_id');
        $flag=$this->Mobile_model->user_checking($user_id);
        if($flag==0){
            $message['status'] =0;
            $message['message']='unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
            $cal_id=$this->post('milk_id');
        $status=$this->Mobile_model->cancel_milk_order($cal_id,$user_id);

        if($status==1){
            $message = array('status' => 1, 'message' => 'Milk order Cancelled' );
            $this->response($message, REST_Controller::HTTP_OK);

        }
        $message = array('status' => 0, 'message' => 'Milk order not  Cancelled' );
        $this->response($message, REST_Controller::HTTP_OK);

    }
    public function  cancel_order_post(){
        $user_id=$this->post('user_id');
        $flag=$this->Mobile_model->user_checking($user_id);
        if($flag==0){
            $message['status'] =0;
            $message['message']='unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $item_id=$this->post('item_id');
        $status=$this->Mobile_model->cancel_order($item_id,$user_id);
       // echo $this->db->last_query();exit;
        if($status==1){
            $message = array('status' => 1, 'message' => 'Order Item  Cancelled' );
            $this->response($message, REST_Controller::HTTP_OK);

        }
        $message = array('status' => 0, 'message' => 'Order Item not  Cancelled' );
        $this->response($message, REST_Controller::HTTP_OK);

    }

}
