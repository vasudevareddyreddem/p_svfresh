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
class User extends REST_Controller
{
    
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit']    = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit']   = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('security');
        $this->load->model('Mobile_model');
        
        
    }
    public function user_reg_post()
    {
        $uname = $this->post('uname');
        $fname = $this->post('fname');
        $lname = $this->post('lname');
        
        $username     = $uname;
        $email        = $this->post('email');
        $mobile       = $this->post('mobile');
        $org_password = $this->post('password');
        $apt          = $this->post('apt');
        $block        = $this->post('block');
        $flat         = $this->post('flat');
        $password     = password_hash($this->post('password'), PASSWORD_DEFAULT);
        $flag         = $this->Mobile_model->user_email_checking($email);
        //echo $this->db->last_query();exit;
        if ($flag == 1) {
            $message = array(
                'status' => 0,
                'message' => 'email already  existed'
            );
            $this->response($message, REST_Controller::HTTP_OK);
            
            
        }
        $flag = $this->Mobile_model->user_mobile_checking($mobile);
        if ($flag == 1) {
            $message = array(
                'status' => 0,
                'message' => 'phone number already  existed'
            );
            $this->response($message, REST_Controller::HTTP_OK);
            
            
        }
        
        $data = array(
            'email_id' => $email,
            'phone_number' => $mobile,
            'first_name' => $fname,
            'last_name' => $lname,
            'user_name' => $username,
            'org_password' => $org_password,
            'password' => $password,
            'status' => 'Active',
            'appartment' => $apt,
            'block' => $block,
            'flat_door_no' => $flat
            
        );
        
        $status = $this->Mobile_model->insert_user_reg($data);
        if ($status == 0) {
            
            $message = array(
                'status' => 0,
                'message' => 'user not registered'
            );
            $this->response($message, REST_Controller::HTTP_OK);
            
            
        }
        $message = array(
            'status' => 1,
            'id' => $status,
            'message' => 'user registered'
        );
        $this->response($message, REST_Controller::HTTP_OK);
        
        
    }
    
    public function login_post()
    {
        $email = $this->post('email');
        
        $password = $this->post('password');
        
        
        if ($email == '') {
            $message = array(
                'status' => 0,
                'message' => 'Email Id is required'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
        if ($password == '') {
            $message = array(
                'status' => 0,
                'message' => 'Password is required'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
        
        
        $user = $this->Mobile_model->check_loging($email);
        //echo $this->db->last_query();exit;
        
        
        if (count($user) > 0) {
            if (password_verify($this->post('password'), $user['password'])) {
                unset($user['password']);
                $message = array(
                    'status' => 1,
                    'message' => 'login successful',
                    'user' => $user
                );
                $this->response($message, REST_Controller::HTTP_OK);
                
            } else {
                $u       = new stdClass();
                $message = array(
                    'status' => 0,
                    'message' => 'password is wrong',
                    'user' => $u
                );
                $this->response($message, REST_Controller::HTTP_OK);
                
            }
            
            
        } else {
            $u       = new stdClass();
            $message = array(
                'status' => 0,
                'message' => 'email is wrong',
                'user' => $u
            );
            $this->response($message, REST_Controller::HTTP_OK);
            
            
        }
        
        
        
        
    }
    //categories
    public function categories_post()
    {
        
        // $userid=$this->post('user_id');
        
        // $flag=$this->Mobile_model->user_checking($userid);
        // if($flag==0){
        // $message = array('status'=>0,'message'=>' unauthorized user');
        // $this->response($message, REST_Controller::HTTP_OK);
        // }
        
        $cat = $this->Mobile_model->category_list();
        if (count($cat) > 0) {
            $message               = array(
                'status' => 1,
                'message' => $cat
            );
            $message['image_path'] = base_url() . 'assets/uploads/category_pics/';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $message = array(
            'status' => 0,
            'message' => 'No records in category'
        );
        $this->response($message, REST_Controller::HTTP_OK);
    }
    public function home_slider_post()
    {
        $images = $this->Mobile_model->home_slider_two_images();
        if (count($images) > 0) {
            $id     = $images['slider_id'];
            $slider = $this->Mobile_model->home_sliders($id);
            if (count($slider) > 0) {
                $message['status']     = 1;
                $message['siider']     = $slider;
                $message['image_path'] = base_url() . 'assets/uploads/slider_pics/';
            } else {
                $message['status'] = 0;
                
            }
            
        } else {
            $message['status']  = 0;
            $message['message'] = 'no slider Images';
            
        }
        $this->response($message, REST_Controller::HTTP_OK);
        
    }
    public function subcatgories_post()
    {
        
        
        $cat = $this->post('cat_id');
        
        $subcat = $this->Mobile_model->subcategory_list($cat);
        
        if (count($subcat) > 0) {
            $message                    = array(
                'status' => 1,
                'message' => $subcat
            );
            $message['subcat_img_path'] = base_url() . 'assets/uploads/sub_category_pics/';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $message = array(
            'status' => 0,
            'message' => 'NO Subcategories for this Category'
        );
        $this->response($message, REST_Controller::HTTP_OK);
    }
    //not needed
    public function products_post()
    {
        
        $userid = $this->post('user_id');
        $cat    = $this->post('cat_id');
        $subcat = $this->post('subcat_id');
        $flag   = $this->Mobile_model->user_checking($userid);
        if ($flag == 0) {
            $message = array(
                'status' => 0,
                'message' => ' unauthorized user'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $products = $this->Mobile_model->product_list($cat, $subcat);
        if (count($products) > 0) {
            $message = array(
                'status' => 1,
                'message' => $products
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $message = array(
            'status' => 0,
            'message' => 'NO Products for this subcategory'
        );
        $this->response($message, REST_Controller::HTTP_OK);
        
    }
    //not needed
    //home page
    public function home_post()
    {
        $userid = $this->post('user_id');
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
        $images = $this->Mobile_model->home_slider_two_images();
        if (count($images) > 0) {
            $id     = $images['slider_id'];
            $slider = $this->Mobile_model->home_sliders($id);
            if (count($slider) > 0) {
                $message['slider_staus'] = 1;
                $message['siider']       = $slider;
            } else {
                $message['slider_staus'] = 0;
            }
            
            //$message['simg_staus']=1;
            //$message['simages']=$images;
            
            
        } else {
            // $message['simg_staus']=0;
            
        }
        
        $cat = $this->Mobile_model->category_list();
        if (count($cat) > 0) {
            $message['cat_status'] = 1;
            $message['cat_list']   = $cat;
            
        } else {
            $message['cat_status'] = 0;
        }
        $this->response($message, REST_Controller::HTTP_OK);
        
    }
    //get product for single category
    public function subcatproducts_post()
    {
        
        
        //$cat=$this->post('cat_id');
        $subcat = $this->post('subcat_id');
        
        if ($this->post('user_id')) {
            $user_id = $this->post('user_id');
        } else {
            $user_id = 'dummydata';
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
        
        $products = $this->Mobile_model->product_list($subcat, $user_id);
        
        
        if (count($products) > 0) {
            $message['status']             = 1;
            $message['products']           = $products;
            $message['product_image_path'] = base_url() . 'assets/uploads/product_pics/';
            $message['message']            = 'products available';
            
        } else {
            $message['status']  = 0;
            $message['message'] = 'No products available';
        }
        
        $this->response($message, REST_Controller::HTTP_OK);
        
    }
    //not needed
    //get products for single category
    public function catproducts_post()
    {
        
        $userid = $this->post('user_id');
        $cat    = $this->post('cat_id');
        
        
        
        $products = $this->Mobile_model->product_list_by_cat($cat);
        if (count($products) > 0) {
            $message['status']     = 1;
            $message['products']   = $products;
            $message['image_path'] = base_url() . 'assets/uploads/product_pics/';
            
        } else {
            $message['status'] = 0;
            $message[]         = 'No products available';
        }
        
        $this->response($message, REST_Controller::HTTP_OK);
        
    }
    //get single product
    public function singleproduct_post()
    {
        $pid      = $this->post('product_id');
        $message  = array();
        $prod_det = $this->Mobile_model->single_product_details($pid);
        //$prod_imgs=$this->Mobile_model->single_product_images($pid);
        $prod_fet = $this->Mobile_model->single_product_features($pid);
        $prod_rel = $this->Mobile_model->single_product_rel_products($pid);
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
        if (count($prod_det) > 0) {
            
            $message['prod_det_status'] = 1;
            $message['prod_det']        = $prod_det;
        } else {
            $message['prod_det_status'] = 0;
        }
        // if(count($prod_imgs)>0)
        // {
        
        // $message['prod_imgs_status']=1;
        // $message['prod_imgs']=$prod_imgs;
        // }
        // else{
        // $message['prod_imgs_status']=0;
        // }
        if (count($prod_fet) > 0) {
            
            
            $message['prod_fet'] = $prod_fet;
        } else {
            $message['prod_fet'] = 'No Product Features';
        }
        if (count($prod_rel) > 0) {
            
            $message['prod_rel'] = $prod_rel;
            
        } else {
            $message['prod_rel'] = 'No related Products';
        }
        
        $this->response($message, REST_Controller::HTTP_OK);
        
        
    }
    //get user orders
    public function orders_post()
    {
        $user_id = $this->post('user_id');
        $message = array();
        $flag    = $this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message['check_staus'] = 0;
            $message['message']     = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $orders = $this->Mobile_model->get_user_orders($user_id);
        if (count($orders) > 0) {
            $message['orders_status']      = 1;
            $message['orders']             = $orders;
            $message['product_image_path'] = base_url() . 'assets/uploads/product_pics/';
            
        } else {
            $message['orders_status'] = 0;
            $message['message']       = "NO orders";
        }
        
        $this->response($message, REST_Controller::HTTP_OK);
        
        
        
    }
    //insert wishlist
    public function insert_wishlist_product_post()
    {
        $user_id = $this->post('user_id');
        $message = array();
        $flag    = $this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message['check_staus'] = 0;
            $message['message']     = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        
        $pid      = $this->post('product_id');
        $quan     = $this->post('quantity');
        $prod_det = $this->Mobile_model->single_product_details($pid);
        
        
        if (!count($prod_det) > 0) {
            $message = array(
                'status' => 0,
                'message' => 'Product Not available'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $data = array(
            'user_id' => $user_id,
            'product_id' => $pid,
            'product_img' => $prod_det['product_img'],
            'product_name' => $prod_det['product_name'],
            'quantity' => $quan,
            'net_price' => $prod_det['net_price'],
            'discount_price' => $prod_det['discount_price']
            
        );
        
        
        $flag = $this->Mobile_model->insert_wishlist_product($data);
        if ($flag == 1) {
            $message['status']  = 1;
            $message['message'] = 'product placed in whishlist';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $message = array(
            'status' => 0,
            'message' => 'product not added  to whishlist'
        );
        $this->response($message, REST_Controller::HTTP_OK);
        
        
    }
    //get wishlist
    public function wishlist_post()
    {
        $user_id = $this->post('user_id');
        $message = array();
        $flag    = $this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message['check_staus'] = 0;
            $message['message']     = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $wishlist = $this->Mobile_model->get_user_wishlist($user_id);
        if (count($wishlist) > 0) {
            $message['wishlist_status'] = 1;
            $message['wishlist']        = $wishlist;
            $message['image_path']      = base_url() . 'assets/uploads/product_pics/';
            
        } else {
            $message['wishlist_status'] = 0;
        }
        
        $this->response($message, REST_Controller::HTTP_OK);
        
        
        
    }
    //getting user profile
    public function profile_post()
    {
        $user_id = $this->post('user_id');
        $message = array();
        $flag    = $this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message['check_staus'] = 0;
            $message['message']     = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $profile = $this->Mobile_model->get_user_profile($user_id);
        if (count($profile) > 0) {
            $message['profile_status'] = 1;
            $message['profile']        = $profile;
            
        } else {
            $message['profile_status'] = 0;
        }
        
        $this->response($message, REST_Controller::HTTP_OK);
        
        
        
    }
    public function edit_profile_post()
    {
        $user_id = $this->post('user_id');
        $flag    = $this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message['check_staus'] = 0;
            $message['message']     = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $fname        = $this->post('first_name');
        $lname        = $this->post('last_name');
        $username     = $this->post('username');
        $email        = $this->post('email');
        $mobile       = $this->post('mobile');
        $appartment   = $this->post('appartment');
        $block        = $this->post('block');
        $flat_door_no = $this->post('flat_door_no');
        $status       = $this->Mobile_model->check_edit_email($email, $user_id);
        
        
        if ($status == 1) {
            $message = array(
                'status' => 0,
                'message' => 'email already existed'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $status = $this->Mobile_model->check_edit_mobile($mobile, $user_id);
        
        if ($status == 1) {
            $message = array(
                'status' => 0,
                'message' => 'mobile number already existed'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $data   = array(
            'first_name' => $fname,
            'last_name' => $lname,
            'email_id' => $email,
            'phone_number' => $mobile,
            'user_name' => $username,
            'block' => $block,
            'flat_door_no' => $flat_door_no,
            'appartment' => $appartment
        );
        $status = $this->Mobile_model->update_profile($data, $user_id);
        if ($status == 1) {
            $message = array(
                'status' => 1,
                'message' => 'Profile Updated Successfully'
            );
            $this->response($message, REST_Controller::HTTP_OK);
            
        }
        $message = array(
            'status' => 1,
            'message' => 'Profile Updated Successfully'
        );
        $this->response($message, REST_Controller::HTTP_OK);
        
    }
    //add to cart
    public function add_to_cart_post()
    {
        $product_id = $this->post('product_id');
        $user_id    = $this->post('user_id');
        $quan       = $this->post('quantity');
        $net_price  = $this->post('net_price');
        $flag       = $this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message = array(
                'status' => 0,
                'message' => ' unauthorized user'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $prod_det = $this->Mobile_model->single_product_details($product_id);
        
        
        if (!count($prod_det) > 0) {
            $message = array(
                'status' => 0,
                'message' => 'Product Not available'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $data = array(
            'user_id' => $user_id,
            'product_id' => $product_id,
            'product_img' => $prod_det['product_img'],
            'product_name' => $prod_det['product_name'],
            'net_price' => $net_price,
            'quantity' => $quan
            
        );
        $flag = $this->Mobile_model->insert_cart_product($data);
        if ($flag == 1) {
            $message = array(
                'status' => 1,
                'message' => 'Added to cart'
            );
            $this->response($message, REST_Controller::HTTP_OK);
            
        }
        $message = array(
            'status' => 1,
            'message' => 'Product not added to cart'
        );
        $this->response($message, REST_Controller::HTTP_OK);
    }
    
    
    //get the cart products
    public function get_cart_post()
    {
        $user_id = $this->post('user_id');
        $message = array();
        $flag    = $this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message['status']  = 0;
            $message['message'] = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $cart = $this->Mobile_model->get_user_cart($user_id);
        if (count($cart) > 0) {
            $message['status']     = 1;
            $message['cart_list']  = $cart;
            $message['image_path'] = base_url() . 'assets/uploads/product_pics/';
            
        } else {
            $message['status']  = 0;
            $message['message'] = 'No cart products Available';
        }
        
        $this->response($message, REST_Controller::HTTP_OK);
        
        
        
    }
    // delete the cart product
    public function delete_cart_product_post()
    {
        
        $user_id = $this->post('user_id');
        $cart_id = $this->post('cart_id');
        $message = array();
        
        
        $flag = $this->Mobile_model->user_checking($user_id);
        
        if ($flag == 0) {
            $message['status']  = 0;
            $message['message'] = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        
        $cart = $this->Mobile_model->delete_cart_product($cart_id);
        if ($cart == 1) {
            $message['status']  = 1;
            $message['message'] = 'product deleted from cart';
            
        } else {
            $message['status']  = 0;
            $message['message'] = 'product not deleted from cart';
        }
        
        $this->response($message, REST_Controller::HTTP_OK);
        
        
        
    }
    //get the checkout products
    public function checkout_post()
    {
        $user_id = $this->post('user_id');
        $message = array();
        $flag    = $this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message['check_staus'] = 0;
            $message['message']     = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $checkout = $this->Mobile_model->get_user_checkout($user_id);
        if (count($checkout) > 0) {
            $message['checkout_status'] = 1;
            $message['checkout']        = $checkout;
            
        } else {
            $message['checkout_status'] = 0;
        }
        
        $this->response($message, REST_Controller::HTTP_OK);
        
        
        
    }
    public function billing_address_post()
    {
        $user_id = $this->post('user_id');
        $message = array();
        $flag    = $this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message['status']  = 0;
            $message['message'] = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $address = $this->Mobile_model->get_user_billing_address($user_id);
        if (count($address) > 0) {
            $message['status']  = 1;
            $message['address'] = $address;
            
        } else {
            $message['status'] = 0;
        }
        
        $this->response($message, REST_Controller::HTTP_OK);
        
        
        
    }
    public function insert_billing_address_post()
    {
        
        $user_id = $this->post('user_id');
        $flag    = $this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message['status']  = 0;
            $message['message'] = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $fname     = $this->post('fname');
        $lname     = $this->post('lname');
        $comp_name = $this->post('comp_name');
        $email     = $this->post('email');
        $address   = $this->post('address');
        $city      = $this->post('city');
        $state     = $this->post('state');
        $pin       = $this->post('pin');
        $mobile    = $this->post('mobile');
        $fax       = $this->post('fax');
        
        $data      = array(
            'user_id' => $user_id,
            'first_name' => $fname,
            'last_name' => $lname,
            'company_name' => $comp_name,
            'email_address' => $email,
            'address' => $address,
            'state' => $state,
            'city' => $city,
            'zip' => $pin,
            'telephone' => $mobile,
            'fax' => $fax,
            'created_by' => $user_id,
            'status' => 'Active'
        );
        $insert_id = $this->Mobile_model->insert_billing_address($data);
        if ($insert_id == 0) {
            $message = array(
                'status' => 0,
                'message' => 'Billing address not added '
            );
            $this->response($message, REST_Controller::HTTP_OK);
            
        }
        
        $message = array(
            'status' => 1,
            'billing_id' => $insert_id
        );
        $this->response($message, REST_Controller::HTTP_OK);
        
        
    }
    public function insert_order_post()
    {
        //$billing_id=$this->post('billing_id');
        $user_id = $this->post('user_id');
        $flag    = $this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message['status']  = 0;
            $message['message'] = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        
        
        if ($this->post('razor_payment_id')) {
            $razor_payment_id = $this->post('razor_payment_id');
            
        } else {
            $razor_payment_id = '';
            
        }
        
        if ($this->post('razor_order_id')) {
            $razor_order_id = $this->post('razor_order_id');
        }
        
        else {
            $razor_order_id = '';
        }
        if ($this->post('razor_signature')) {
            $razor_sig = $this->post('razor_signature');
        } else {
            $razor_sig = '';
        }
        $ite   = $this->post('product_ids');
        $ite   = str_replace(array(
            '[',
            ']'
        ), '', $ite);
        $items = explode(',', $ite);
        
        
        $payment_type = $this->post('payment_type');
        $pnames       = $this->post('product_names');
        
        $pnames        = str_replace(array(
            '[',
            ']'
        ), '', $pnames);
        $product_names = explode(',', $pnames);
        
        $imgs         = $this->post('product_imgs');
        $imgs         = str_replace(array(
            '[',
            ']'
        ), '', $imgs);
        $product_imgs = explode(',', $imgs);
        $quans        = $this->post('quantitys');
        $quans        = str_replace(array(
            '[',
            ']'
        ), '', $quans);
        $quantitys    = explode(',', $quans);
        
        
        
        
        $ps     = $this->post('prices');
        $ps     = str_replace(array(
            '[',
            ']'
        ), '', $ps);
        $prices = explode(',', $ps);
        
        
        $data         = array(
            'user_id' => $user_id,
            //'billing_id'=>$billing_id,
            'payment_type' => $payment_type,
            'created_by' => $user_id,
            'razorpay_payment_id' => $razor_payment_id,
            'razorpay_order_id' => $razor_order_id,
            'razorpay_signature' => $razor_sig
            
        );
        $insert_id    = $this->Mobile_model->insert_order($data);
        //echo '<pre>';print_r($insert_id);exit;
        $str          = date('Ymd') . $insert_id;
        $order_number = 'SV' . str_pad($str, 10, '0', STR_PAD_LEFT);
        $count        = count($items);
        for ($i = 0; $i < $count; $i++) {
            //$cart_det=$this->Mobile_model->single_cart_item($item);
            
            
            //$product=$this->Mobile_model->single_product_details($cart_det['product_id']);
            //$net_price=$cart_det['quantity']*$product['net_price'];
            
            $itemdata[] = array(
                'order_id' => $insert_id,
                'order_number' => $order_number,
                'user_id' => $user_id,
                'product_id' => $items[$i],
                'product_name' => $product_names[$i],
                'product_img' => $product_imgs[$i],
                'quantity' => $quantitys[$i],
                'net_price' => $prices[$i]
            );
            $p_qty      = $this->Mobile_model->get_product_qty($items[$i]);
            $p_udata    = array(
                'quantity' => ($p_qty['quantity'] - $quantitys[$i])
            );
            $this->Mobile_model->update_product_qty($items[$i], $p_udata);
        }
        
        $status = $this->Mobile_model->insert_order_items($itemdata);
        if ($status == 1) {
            $this->Mobile_model->delete_cart_items($user_id);
            $message = array(
                'status' => 1,
                'order_id' => $insert_id
            );
            $this->response($message, REST_Controller::HTTP_OK);
            
        }
        $message = array(
            'status' => 0,
            'message' => 'order_items not added'
        );
        $this->response($message, REST_Controller::HTTP_OK);
        
    }
    public function delete_wishlist_item_post()
    {
        $user_id = $this->post('user_id');
        $flag    = $this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message['status']  = 0;
            $message['message'] = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $wishlist_id = $this->post('wishlist_id');
        $status      = $this->Mobile_model->delete_wishlist_item($wishlist_id);
        if ($status == 1) {
            $message = array(
                'status' => 1,
                'message' => 'wishlist item deleted'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $message = array(
            'status' => 0,
            'message' => 'wishlist item not deleted'
        );
        $this->response($message, REST_Controller::HTTP_OK);
        
        
    }
    public function delete_wishlist_post()
    {
        $user_id = $this->post('user_id');
        $flag    = $this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message['status']  = 0;
            $message['message'] = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $status = $this->Mobile_model->delete_wishlist($user_id);
        if ($status == 1) {
            $message = array(
                'status' => 1,
                'message' => 'wishlist  deleted'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $message = array(
            'status' => 0,
            'message' => 'wishlist not deleted'
        );
        $this->response($message, REST_Controller::HTTP_OK);
        
    }
    public function change_password_post()
    {
        $user_id = $this->post('user_id');
        $flag    = $this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message['status']  = 0;
            $message['message'] = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $password    = $this->post('old_password');
        $newpassword = $this->post('new_password');
        
        $user = $this->Mobile_model->get_user_details($user_id);
        if (password_verify($this->post('old_password'), $user['password'])) {
            
            $hashpassword = password_hash($this->post('new_password'), PASSWORD_DEFAULT);
            $this->Mobile_model->change_password($hashpassword, $newpassword, $user_id);
            
            $message = array(
                'status' => 1,
                'message' => 'Password Changed Successfully'
            );
            $this->response($message, REST_Controller::HTTP_OK);
            
        }
        $message = array(
            'status' => 0,
            'message' => 'Old Password is Wrong'
        );
        $this->response($message, REST_Controller::HTTP_OK);
        
        
        
    }
    public function get_months_post()
    {
        
        
        $hours = date('H');
        
        
        
        if ($hours < 2) {
            $cdate = date('Y-m-d');
        } else {
            $cdate = date('Y-m-d', strtotime(' + 1 days'));
        }
        
        
        
        $month = date('m', strtotime($cdate)); //current month in number
        $year  = date('Y', strtotime($cdate)); // current year in number
        
        $days                      = cal_days_in_month(CAL_GREGORIAN, $month, $year); //days in  a month
        $curmonth['month_in_text'] = date('F', strtotime($cdate)); //month in text
        $curmonth['month']         = $month;
        $curmonth['year']          = $year;
        $curmonth['days']          = $days;
        $curmonth['present_day']   = date('d', strtotime($cdate)); // present day in number
        $months[]                  = $curmonth;
        
        
        for ($i = 1; $i < 3; $i++) {
            $curmonth = array();
            
            
            //$date=date('Y-m-d', strtotime('+'.$i.' month',strtotime(date('Y-m-d'))));
            $date = date('Y-m-d', strtotime($cdate . 'first day of +' . $i . ' month'));
            
            
            $curmonth['month_in_text'] = date('F', strtotime($date));
            $curmonth['month']         = date('m', strtotime($date));
            $curmonth['year']          = date('Y', strtotime($date));
            $curmonth['days']          = cal_days_in_month(CAL_GREGORIAN, $curmonth['month'], $curmonth['year']);
            $curmonth['present_day']   = 1;
            $months[]                  = $curmonth;
            
            
            
        }
        $data['months'] = $months;
        //print_r($months);exit;
        $this->response($data, REST_Controller::HTTP_OK);
        
    }
    public function insert_milk_order_post()
    {
        $product_id = $this->post('product_id');
        //$billing_id=$this->post('billing_id');
        $user_id    = $this->post('user_id');
        $flag       = $this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message['status']  = 0;
            $message['message'] = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        
        $month = $this->post('month');
        $year  = $this->post('year');
        $d     = $this->post('days');
        //print_r( $d); exit;
        $d     = str_replace(array(
            '[',
            ']'
        ), '', $d);
        
        $days = explode(',', $d);
        
        $quans     = $this->post('quantitys');
        $quans     = str_replace(array(
            '[',
            ']'
        ), '', $quans);
        $quantitys = explode(',', $quans);
        
        
        $price = $this->post('price');
        
        foreach ($quantitys as $key => $value) {
            if ($value < 0) {
                
            } else {
                $data[] = "('$product_id',

	         '$user_id',
	         '$month',
              '$year',
	          '$days[$key]',
	'$price',
	'$value'
	)";
            }
            
        }
        //echo '<pre>';print_r($data);exit;
        $status = $this->Mobile_model->milk_orders($data);
        
        if ($status == 1) {
            
            
            $message = array(
                'status' => 1,
                'message' => 'Milk order added'
            );
            $this->response($message, REST_Controller::HTTP_OK);
            
        } else {
            $message = array(
                'status' => 0,
                'message' => 'Milk order  not added'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
    }
    //this is calender display
    public function get_milk_order_post()
    {
        $product_id = $this->post('product_id');
        $user_id    = $this->post('user_id');
        $month      = $this->post('month');
        $year       = $this->post('year');
        $frq        = $this->post('frq');
        $qu         = $this->post('quantity');
        $flag       = $this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message['status']  = 0;
            $message['message'] = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $days_inmonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $curmonth     = date('m');
        if ($curmonth == $month) {
            $hours = date('H');
            if ($hours < 2) {
                $cdate = date('Y-m-d');
            } else {
                $cdate = date('Y-m-d', strtotime(' + 1 days'));
            }
            $day        = date('d', strtotime($cdate)); // present day in number
            //$day=date('d');
            $start_date = $day;
        } else {
            $day        = 0;
            $start_date = 1;
        }
        $result = $this->Mobile_model->get_milk_orders_by_user($user_id, $product_id, $month, $year, $day);
        // $object = new stdClass();
        //  $object->date = 6;
        //  $object->quantity = 8;
        //  $result[]=$object;
        //  $message['status'] =0;
        //  $message['message']=$result;
        //
        //    $this->response($message, REST_Controller::HTTP_OK);
        
        //echo $start_date;exit;
        // if previous records are exit or not
        if (count($result) > 0) {
            $cnt        = 2;
            $order_days = array_column($result, 'date');
            
            $quantity = array_column($result, 'quantity');
            
            
            for ($i = $start_date; $i <= $days_inmonth; $i++) {
                //if date is alreay in database, previously ordered
                if (in_array($i, $order_days)) {
                    //fiiter the records that are already in database
                    //start of if, if it is daily
                    if ($frq == 1) {
                        foreach ($result as $key => $val) {
                            $val = json_decode(json_encode($val));
                            
                            
                            if ($val->quantity != $qu and $val->date == $i) {
                                unset($result[$key]);
                                $object           = new stdClass();
                                $object->date     = "$i";
                                $object->quantity = "$qu";
                                //$result[]=$object;
                                array_push($result, $object);
                                //  $result[]=(object)array('date'=>"$i",'quantity'=>"$qu");
                                
                                
                            }
                        }
                    }
                    //end of daily
                    //start of  alternative
                    if ($frq == 2) {
                        if ($cnt % 2 == 0) {
                            
                            foreach ($result as $key => $val) {
                                $val = json_decode(json_encode($val));
                                if ($val->quantity != $qu and $val->date == $i) {
                                    //$val['quantity']=$qu;
                                    
                                    unset($result[$key]);
                                    $object           = new stdClass();
                                    $object->date     = "$i";
                                    $object->quantity = "$qu";
                                    //$result[]=$object;
                                    array_push($result, $object);
                                    //  $result[]=(object)array('date'=>"$i",'quantity'=>"$qu");
                                    
                                    
                                }
                                
                                //echo $start_date;  echo $val['date'];exit;
                                
                            }
                            
                            
                        }
                        
                        
                    }
                    //end of alternative
                    //start of  weekends
                    if ($frq == 3) {
                        $wdate   = $year . '-' . $month . '-' . $i;
                        $wday    = strtotime($wdate);
                        $weekday = date('l', $wday);
                        if ($weekday == 'Saturday' or $weekday == 'Sunday') {
                            foreach ($result as $key => $val) {
                                $val = json_decode(json_encode($val));
                                if ($val->quantity != $qu and $val->date == $i) {
                                    unset($result[$key]);
                                    $object           = new stdClass();
                                    $object->date     = "$i";
                                    $object->quantity = "$qu";
                                    //$result[]=$object;
                                    array_push($result, $object);
                                    
                                    
                                    //$result[]=(object)array('date'=>"$i",'quantity'=>"$qu");
                                }
                            }
                            
                        }
                    }
                    //end of weekends
                    
                }
                //end of previously ordered
                //start of the date that was not in databse,no order for this date
                else {
                    //daily
                    if ($frq == 1) {
                        $object           = new stdClass();
                        $object->date     = "$i";
                        $object->quantity = "$qu";
                        //$result[]=$object;
                        array_push($result, $object);
                        
                        //  $result[]=(object)array('date'=>"$i",'quantity'=>"$qu");
                    }
                    
                    //alternative days
                    if ($frq == 2) {
                        if ($cnt % 2 == 0) {
                            $object           = new stdClass();
                            $object->date     = "$i";
                            $object->quantity = "$qu";
                            //$result[]=$object;
                            array_push($result, $object);
                            
                            // $result[]=(object)array('date'=>"$i",'quantity'=>"$qu");
                        } else {
                            $object           = new stdClass();
                            $object->date     = "$i";
                            $object->quantity = "0";
                            //$result[]=$object;
                            array_push($result, $object);
                            // $result[]=(object)array('date'=>"$i",'quantity'=>"0");
                        }
                        
                    }
                    
                    //weekends
                    if ($frq == 3) {
                        $wdate   = $year . '-' . $month . '-' . $start_date;
                        $wday    = strtotime($wdate);
                        $weekday = date('l', $wday);
                        if ($weekday == 'Saturday' or $weekday == 'Sunday') {
                            $object           = new stdClass();
                            $object->date     = "$i";
                            $object->quantity = "$qu";
                            //$result[]=$object;
                            array_push($result, $object);
                            //$result[]=(object)array('date'=>"$i",'quantity'=>"$qu");
                            
                        } else {
                            $object           = new stdClass();
                            $object->date     = "$i";
                            $object->quantity = "0";
                            //$result[]=$object;
                            array_push($result, $object);
                            //$result[]=(object)array('date'=>"$i",'quantity'=>"0");
                        }
                        
                        
                    }
                    
                    
                    
                }
                //end of the no order date
                
                $cnt++;
            }
            //end of for loop
            //$result=(array)$result;
            //$res = (array) $result;
            //$data=array(1);
            foreach ($result as $key => $val) {
                //echo $key;exit;
                $data[] = $val;
                //var_dump($dat);exit;
                
            }
            
            $message = array(
                'status' => 1,
                'orders' => $data,
                'curdate' => $day,
                'days_inmonth' => $days_inmonth
            );
            $this->response($message, REST_Controller::HTTP_OK);
            
        }
        //end of if
        //NO records are there for that month
        $cnt = 2;
        for ($i = $start_date; $i <= $days_inmonth; $i++) {
            if ($frq == 1) {
                
                $empty_result[] = array(
                    'date' => "$i",
                    'quantity' => "$qu"
                );
            }
            
            if ($frq == 2) {
                if ($cnt % 2 == 0) {
                    
                    $empty_result[] = array(
                        'date' => "$i",
                        'quantity' => "$qu"
                    );
                } else {
                    $empty_result[] = array(
                        'date' => "$i",
                        'quantity' => "0"
                    );
                }
                
            }
            if ($frq == 3) {
                $wdate   = $year . '-' . $month . '-' . $i;
                $wday    = strtotime($wdate);
                $weekday = date('l', $wday);
                //echo $weekday;exit;
                if ($weekday == 'Saturday' or $weekday == 'Sunday') {
                    $empty_result[] = array(
                        'date' => "$i",
                        'quantity' => "$qu"
                    );
                    
                } else {
                    $empty_result[] = array(
                        'date' => "$i",
                        'quantity' => "0"
                    );
                }
                
                
            }
            $cnt++;
        }
        //end of for loop
        
        
        $message = array(
            'status' => 0,
            'orders' => $empty_result,
            'curdate' => $day,
            'days_inmonth' => $days_inmonth
        );
        $this->response($message, REST_Controller::HTTP_OK);
        
        
    }
    public function milk_orders_post()
    {
        
        $user_id = $this->post('user_id');
        $flag    = $this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message['status']  = 0;
            $message['message'] = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $result = $this->Mobile_model->get_milk_orders($user_id);
        if (count($result) > 0) {
            
            $message                       = array(
                'status' => 1,
                'orders' => $result
            );
            $message['product_image_path'] = base_url() . 'assets/uploads/product_pics/';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $message = array(
            'status' => 0,
            'orders' => array()
        );
        $this->response($message, REST_Controller::HTTP_OK);
    }
    
    public function cancel_milk_order_post()
    {
        $user_id = $this->post('user_id');
        $flag    = $this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message['status']  = 0;
            $message['message'] = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $cal_id = $this->post('milk_id');
        $status = $this->Mobile_model->cancel_milk_order($cal_id, $user_id);
        
        if ($status == 1) {
            $message = array(
                'status' => 1,
                'message' => 'Milk order Cancelled'
            );
            $this->response($message, REST_Controller::HTTP_OK);
            
        }
        $message = array(
            'status' => 0,
            'message' => 'Milk order not  Cancelled'
        );
        $this->response($message, REST_Controller::HTTP_OK);
        
    }
    public function cancel_order_post()
    {
        $user_id = $this->post('user_id');
        $flag    = $this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message['status']  = 0;
            $message['message'] = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $item_id = $this->post('item_id');
        $status  = $this->Mobile_model->cancel_order($item_id, $user_id);
        // echo $this->db->last_query();exit;
        if ($status == 1) {
            /* seller purpose*/
            $dat = $this->Mobile_model->user_det($user_id);
            
            
            $mobile   = $dat['phone_number'];
            $username = $this->config->item('smsusername');
            $pass     = $this->config->item('smspassword');
            $sender   = $this->config->item('sender');
            $msg      = "Dear Customer Your Order is Cancelled  ";
            
            $ch2 = curl_init();
            curl_setopt($ch2, CURLOPT_URL, "http://trans.smsfresh.co/api/sendmsg.php");
            curl_setopt($ch2, CURLOPT_POST, 1);
            curl_setopt($ch2, CURLOPT_POSTFIELDS, 'user=' . $username . '&pass=' . $pass . '&sender=' . $sender . '&phone=' . $mobile . '&text=' . $msg . '&priority=ndnd&stype=normal');
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
            
            $server_output = curl_exec($ch2);
            //echo '<pre>' ;print_r($server_output);exit;
            curl_close($ch2);
            /* accept message */
            /* seller purpose*/
            $ch2 = curl_init();
            curl_setopt($ch2, CURLOPT_URL, "http://trans.smsfresh.co/api/sendmsg.php");
            curl_setopt($ch2, CURLOPT_POST, 1);
            curl_setopt($ch2, CURLOPT_POSTFIELDS, 'user=' . $username . '&pass=' . $pass . '&sender=' . $sender . '&phone=' . $mobile . '&text=' . $msg . '&priority=ndnd&stype=normal');
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
            
            $server_output = curl_exec($ch2);
            //echo '<pre>' ;print_r($server_output);exit;
            curl_close($ch2);
            /* accept message */
            $message = array(
                'status' => 1,
                'message' => 'Order Item  Cancelled'
            );
            $this->response($message, REST_Controller::HTTP_OK);
            
        }
        $message = array(
            'status' => 0,
            'message' => 'Order Item not  Cancelled'
        );
        $this->response($message, REST_Controller::HTTP_OK);
        
    }
    public function get_apartments_post()
    {
        $res = $this->Mobile_model->get_apartments();
        
        if (count($res) > 0) {
            $message = array(
                'status' => 1,
                'apartment_list' => $res
            );
            $this->response($message, REST_Controller::HTTP_OK);
            
        }
        $message = array(
            'status' => 0,
            'message' => 'No Apartments Available'
        );
        $this->response($message, REST_Controller::HTTP_OK);
        
        
        
        
    }
    public function get_blocks_by_apt_post()
    {
        $apt_id = $this->post('apt_id');
        $res    = $this->Mobile_model->get_blocks($apt_id);
        if (count($res) > 0) {
            $message = array(
                'status' => 1,
                'block_list' => $res
            );
            $this->response($message, REST_Controller::HTTP_OK);
            
        }
        $message = array(
            'status' => 0,
            'message' => 'No Blocks Available'
        );
        $this->response($message, REST_Controller::HTTP_OK);
        
        
        
        
        
    }
    public function get_user_address_post()
    {
        $user_id = $this->post('user_id');
        $flag    = $this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message['status']  = 0;
            $message['message'] = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $res     = $this->Mobile_model->get_user_address($user_id);
        $message = array(
            'status' => 1,
            'user_address' => $res
        );
        $this->response($message, REST_Controller::HTTP_OK);
        
    }
    public function edit_user_address_post()
    {
        $user_id = $this->post('user_id');
        $flag    = $this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message['check_staus'] = 0;
            $message['message']     = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $username = $this->post('username');
        $fname    = $this->post('fname');
        $lname    = $this->post('lname');
        $apt      = $this->post('apt');
        $block    = $this->post('block');
        $flat     = $this->post('flat');
        $email    = $this->post('email');
        $mobile   = $this->post('mobile');
        $status   = $this->Mobile_model->check_edit_email($email, $user_id);
        
        
        if ($status == 1) {
            $message = array(
                'status' => 0,
                'message' => 'email already existed'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $status = $this->Mobile_model->check_edit_mobile($mobile, $user_id);
        
        if ($status == 1) {
            $message = array(
                'status' => 0,
                'message' => 'mobile number already existed'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $data   = array(
            'email_id' => $email,
            'phone_number' => $mobile,
            'user_name' => $username,
            'first_name' => $fname,
            'last_name' => $lname,
            'appartment' => $apt,
            'block' => $block,
            'flat_door_no' => $flat
        );
        $status = $this->Mobile_model->update_address($data, $user_id);
        if ($status == 1) {
            $message = array(
                'status' => 1,
                'message' => 'Address Updated Successfully'
            );
            $this->response($message, REST_Controller::HTTP_OK);
            
        }
        $message = array(
            'status' => 1,
            'message' => 'Address Updated Successfully'
        );
        $this->response($message, REST_Controller::HTTP_OK);
        
        
        
    }
    public function send_email_post()
    {
        $email = $this->post('email');
        $res   = $this->Mobile_model->check_user_mail($email);
        //echo $this->db->last_query();exit;
        if (count($res) > 0) {
            
            
        } else {
            $message = array(
                'status' => 0,
                'message' => 'Phone Number Not Existed'
            );
            $this->response($message, REST_Controller::HTTP_OK);
            
        }
        
        $s = 0;
        while ($s == 0) {
            $num = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
            
            $flag = $this->Mobile_model->check_space($email, $num);
            if ($flag == 0) {
                $s = 1;
            }
            
            
        }
        $data = array(
            'otp' => $num,
            'user_id' => $email,
            'created_date' => date('Y-m-d H:i:s'),
            'expiry_status' => 1
        );
        $this->Mobile_model->change_otp_status($email);
        $r = $this->Mobile_model->save_otp($data);
        if ($r == 1) {
            
            /* accept message */
            
            
            $mobile   = $email;
            $username = $this->config->item('smsusername');
            $pass     = $this->config->item('smspassword');
            $sender   = $this->config->item('sender');
            $msg      = "Dear Customer Your otp  is " . $num;
            /* seller purpose*/
            $ch2      = curl_init();
            curl_setopt($ch2, CURLOPT_URL, "http://trans.smsfresh.co/api/sendmsg.php");
            curl_setopt($ch2, CURLOPT_POST, 1);
            curl_setopt($ch2, CURLOPT_POSTFIELDS, 'user=' . $username . '&pass=' . $pass . '&sender=' . $sender . '&phone=' . $mobile . '&text=' . $msg . '&priority=ndnd&stype=normal');
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
            
            $server_output = curl_exec($ch2);
            //echo '<pre>' ;print_r($server_output);exit;
            curl_close($ch2);
            /* accept message */
            $message = array(
                'status' => 1,
                'otp' => strval($num),
                'message' => 'otp sent to your registered mobile number,it will expire after 5 minutes '
            );
            $this->response($message, REST_Controller::HTTP_OK);
            
        }
        $message = array(
            'status' => 1,
            'otp' => '',
            'message' => 'otp not sent , try again '
        );
        $this->response($message, REST_Controller::HTTP_OK);
        
        
        
    }
    public function otp_checking_post()
    {
        $otp     = $this->post('otp');
        $user_id = $this->post('email');
        $res     = $this->Mobile_model->otp_data($otp, $user_id);
        //echo $this->db->last_query();exit;
        if (count($res) > 0) {
            $start_date  = new DateTime(date('Y-m-d  H:i:s'));
            $since_start = $start_date->diff(new DateTime($res->created_date));
            
            $secs = $since_start->s;
            if ($secs > 300) {
                $this->Mobile_model->update_otp_data($res->id);
                
                $message = array(
                    'status' => 0,
                    'message' => 'otp is expired '
                );
                $this->response($message, REST_Controller::HTTP_OK);
                
                
            } else {
                $this->Mobile_model->update_otp_data($res->id);
                
                $message = array(
                    'status' => 1,
                    'res' => $res
                );
                $this->response($message, REST_Controller::HTTP_OK);
            }
            
            
            
            
            
            
        }
        
        $message = array(
            'status' => 0,
            'message' => 'otp is wrong '
        );
        $this->response($message, REST_Controller::HTTP_OK);
    }
    public function password_reset_post()
    {
        
        $user_id  = $this->post('user_id');
        $check_id = $this->post('id');
        
        $flag = $this->Mobile_model->chcek_otp_id($check_id, $user_id);
        if ($flag == 1) {
            
            
        } else {
            $message = array(
                'status' => 0,
                'message' => 'Wrong User'
            );
            $this->response($message, REST_Controller::HTTP_OK);
            
        }
        
        $password = password_hash($this->post('password'), PASSWORD_DEFAULT);
        
        $data = array(
            'password' => $password,
            'org_password' => $this->post('password'),
            'updated_date' => date('Y-m-d H:i:s')
        );
        
        $flag = $this->Mobile_model->update_password($data, $user_id);
        
        if ($flag == 1) {
            $message = array(
                'status' => 1,
                'message' => 'Password Reset Successfully '
            );
            $this->response($message, REST_Controller::HTTP_OK);
            
        }
        $message = array(
            'status' => 0,
            'message' => 'Password not reset ,try again'
        );
        $this->response($message, REST_Controller::HTTP_OK);
        
        
    }
    public function get_date_wise_milk_orders_post()
    {
        $user_id = $this->post('user_id');
        $flag    = $this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message['check_staus'] = 0;
            $message['message']     = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $date  = $this->post('sdate');
        $month = date('m', strtotime($date));
        $year  = date('Y', strtotime($date));
        $day   = date('d', strtotime($date));
        
        $res = $this->Mobile_model->get_day_milk_orders($year, $month, $day, $user_id);
        //echo $this->db->last_query();exit;
        if (count($res) > 0) {
            $message                       = array(
                'status' => 1,
                'message' => $res
            );
            $message['product_image_path'] = base_url() . 'assets/uploads/product_pics/';
            $this->response($message, REST_Controller::HTTP_OK);
            
            
        }
        $message = array(
            'status' => 0,
            'message' => $res
        );
        $this->response($message, REST_Controller::HTTP_OK);
        
        
    }
    public function testapi_post()
    {
        $timestamp = strtotime("2019-2-17");
        $weekDay   = date('l', $timestamp);
        echo $weekDay;
        
        
        
    }
    // public function objectToArray( $object )
    //     {
    //         if( !is_object( $object ) && !is_array( $object ) )
    //         {
    //             return $object;
    //         }
    //         if( is_object( $object ) )
    //         {
    //             $object = get_object_vars( $object );
    //         }
    //         return array_map( 'objectToArray', $object );
    //     }
    public function objToArray($obj, &$arr)
    {
        
        if (!is_object($obj) && !is_array($obj)) {
            $arr = $obj;
            return $arr;
        }
        
        foreach ($obj as $key => $value) {
            if (!empty($value)) {
                $arr[$key] = array();
                objToArray($value, $arr[$key]);
            } else {
                $arr[$key] = $value;
            }
        }
        return $arr;
    }
    public function user_milk_amount_post()
    {
        $user_id = $this->post('user_id');
        $flag    = $this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message['check_staus'] = 0;
            $message['message']     = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $row = $this->Mobile_model->user_milk_amount($user_id);
        //echo $this->db->last_query();exit;
        
        if ($row['total'] == '' or $row['total'] == null) {
            
            $message = array(
                'status' => 0,
                'amount' => 0
            );
            
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $message = array(
            'status' => 1,
            'amount' => $row['total']
        );
        
        $this->response($message, REST_Controller::HTTP_OK);
        
        
    }
    
    public function milk_month_amt_post()
    {
        $user_id = $this->post('user_id');
        $flag    = $this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message['check_staus'] = 0;
            $message['message']     = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $mon      = $this->post('mon');
        $yr       = $this->post('year');
        $row      = $this->Mobile_model->milk_mon_amt($user_id, $mon, $yr);
        $qty_list = $this->Mobile_model->milk_mon_amt_list($user_id, $mon, $yr,date('d'));
        //echo $this->db->last_query();exit;
        //echo '<pre>';print_r($qty_list);exit;
        
        if ($row['total'] == '' or $row['total'] == null) {
            
            $message = array(
                'status' => 0,
                'amount' => 0,
                'details' => array()
            );
            
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $message = array(
            'status' => 1,
            'amount' => $row['total']+30,
            'details' => $qty_list
        );
        
        $this->response($message, REST_Controller::HTTP_OK);
        
    }
    
    public function update_milk_payments_post()
    {
        $user_id = $this->post('user_id');
        $flag    = $this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message['check_staus'] = 0;
            $message['message']     = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $mon                     = $this->post('mon');
        $yr                      = $this->post('year');
        $config['upload_path']   = './assets/uploads/screenshot';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|Jpeg|Png';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('img', time())) {
            $error = array(
                'error' => $this->upload->display_errors()
            );
            
            $message = array(
                'status' => 0,
                'message' => 'Image not uploaded try again'
            );
            
            $this->response($message, REST_Controller::HTTP_OK);
            
        } else {
            $upload_data = $this->upload->data();
            $img         = $upload_data['file_name'];
            
            
        }
        $time = time();
        $data = array(
            'payment_img' => $img,
            'payment_status' => 1,
            'payment_date' => date('Y-m-d H:i:s'),
            'payment_type' => 4,
            'order_id' => $time
        );
        $res  = $this->Mobile_model->update_milk_payment($user_id, $mon, $yr, $data);
        if ($res == 1) {
            $message = array(
                'status' => 1,
                'message' => 'Your Payment successful'
            );
            $this->response($message, REST_Controller::HTTP_OK);
            
        }
        $message = array(
            'status' => 0,
            'message' => 'Your Payment Not Successful'
        );
        $this->response($message, REST_Controller::HTTP_OK);
        
        
    }
    
    public function payment_method_post()
    {
        $user_id = $this->post('user_id');
        $flag    = $this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message['check_staus'] = 0;
            $message['message']     = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $apt = $this->post('apt_id');
        
        $res = $this->Mobile_model->get_payment_method($apt);
        if ($res['account_status'] == 1) {
            $message = array(
                'status' => 1,
                'acc_status' => $res
            );
            $this->response($message, REST_Controller::HTTP_OK);
        } else {
            $u       = (object) array();
            $message = array(
                'status' => 0,
                'acc_status' => $u
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
        
    }
    public function milk_online_payment_post()
    {
        $user_id = $this->post('user_id');
        $flag    = $this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message['check_staus'] = 0;
            $message['message']     = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $mon   = $this->post('mon');
        $yr    = $this->post('year');
        $razor = $this->post('razor_id');
        //   $odata=array('user_id'=>$user_id,
        //   'created_date'=>date('Y-m-d H:i:s'),
        //   'created_by'=>$user_id,
        //   'razorpay_payment_id'=>$razor
        // );
        //   //$id=$this->Mobile_model->pay_milk_online($odata);
        
        $id   = time();
        $data = array(
            'payment_status' => 1,
            'payment_date' => date('Y-m-d H:i:s'),
            'payment_type' => 1,
            'order_id' => $id,
            'razor_id' => $razor
        );
        $res  = $this->Mobile_model->update_milk_payment($user_id, $mon, $yr, $data);
        if ($res == 1) {
            $message = array(
                'status' => 1,
                'message' => 'Your Payment successful'
            );
            $this->response($message, REST_Controller::HTTP_OK);
            
        }
        $message = array(
            'status' => 0,
            'message' => 'Your Payment Not Successful'
        );
        $this->response($message, REST_Controller::HTTP_OK);
        
        
        
    }
    public function update_qty_post()
    {
        $calender_id = $this->post('calender_id');
        $qty         = $this->post('quantity');
        if ($calender_id == '') {
            $message = array(
                'status' => 0,
                'message' => 'Calender id is required'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
        if ($qty == '') {
            $message = array(
                'status' => 0,
                'message' => 'Quantity is required'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $u_data = array(
            'quantity' => $qty,
            'updated_date' => date('Y-m-d H:i:s')
        );
        $update = $this->Mobile_model->update_milk_order_qty($calender_id, $u_data);
        if (count($update) > 0) {
            $message = array(
                'status' => 1,
                'calender_id' => $calender_id,
                'message' => 'Quantity details successfully updated'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        } else {
            $message = array(
                'status' => 0,
                's_id' => $s_id,
                'message' => 'Technical problem will occurred .Please try again'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
    }
    public function contact_post()
    {
        $name     = $this->post('name');
        $email    = $this->post('email');
        $mobile   = $this->post('mobile');
        $messages = $this->post('message');
        if ($name == '') {
            $message = array(
                'status' => 0,
                'message' => 'Name id is required'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
        if ($email == '') {
            $message = array(
                'status' => 0,
                'message' => 'Email is required'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
        if ($mobile == '') {
            $message = array(
                'status' => 0,
                'message' => 'Mobile is required'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
        if ($messages == '') {
            $message = array(
                'status' => 0,
                'message' => 'Message is required'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $addcontact = array(
            'name' => isset($name) ? $name : '',
            'email' => isset($email) ? $email : '',
            'mobile' => isset($mobile) ? $mobile : '',
            'message' => isset($messages) ? $messages : '',
            'create_at' => date('Y-m-d H:i:s')
        );
        $save       = $this->Mobile_model->save_contactus($addcontact);
        if (count($save) > 0) {
            $this->load->library('email');
            $this->email->set_newline("\r\n");
            $this->email->set_mailtype("html");
            $this->email->from($email);
            $this->email->to('support@svfresh.com');
            $this->email->subject('Contact us - Request');
            //$body = $this->load->view('email/contactus.php',$data,true);
            //$html = $this->load->view('email/orderconfirmation.php', $data, true);
            
            $msg = 'Name:' . $name . ' Email :' . $email . '<br> Phone  number :' . $mobile . '<br> Message :' . $messages;
            $this->email->message($msg);
            //echo $body;exit;
            $this->email->send();
            $message = array(
                'status' => 1,
                'message' => 'Your message was successfully sent'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        } else {
            $message = array(
                'status' => 0,
                'message' => 'Technical problem will occurred .Please try again'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
    }
    public function notifications_post()
    {
        
        $minutes_to_add = 1;
        $d              = date('Y-m-d H:i:s');
        $time           = new DateTime($d);
        $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
        $stamp = $time->format('Y-m-d H:i:s');
		$users_lists=$this->Mobile_model->get_token_users_list();
		if(count($users_lists)>0){
			
			foreach($users_lists as $li){
				
				 $save=$this->Mobile_model->get_new_product_names_inbetween($stamp,$d);
				if(count($save)>0){
						foreach($save as $list){
							$lis[]=$list['product_name'].' having '.$list['discount_percentage'].' % discount ';
						}
						$n_msg=implode(', ',$lis);
						$serverKey = $this->config->item('server_key_push');
						$url          = "https://fcm.googleapis.com/fcm/send";
						$token        = $li['token'];
						$title        = "SVfresh";
						//$body = "Hello ".$details['name']." you have an appointment booked";
						$notification = array(
							'title' => $title,
							'text' => $n_msg,
							'sound' => 'default',
							'badge' => '1'
						);
						$arrayToSend  = array(
							'to' => $token,
							'notification' => $notification,
							'priority' => 'high'
						);
						$json         = json_encode($arrayToSend);
						$headers      = array();
						$headers[]    = 'Content-Type: application/json';
						$headers[]    = 'Authorization: key=' . $serverKey;
						$ch           = curl_init();
						curl_setopt($ch, CURLOPT_URL, $url);
						
						curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
						curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
						curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
						//Send the request
						$response = curl_exec($ch);
						
						echo '<pre>';print_r($response);
						//Close request
						if ($response === FALSE) {
							die('FCM Send Error: ' . curl_error($ch));
						}
						curl_close($ch);
						
				}
				
			}
			
		}
        
    }
    public function content_post()
    {
        $data = $this->Mobile_model->get_app_content_data();
        //echo $this->db->last_query();exit;
        if (count($data) > 0) {
            $message = array(
                'status' => 1,
                'details' => $data,
                'message' => 'Details are found'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        } else {
            $message = array(
                'status' => 0,
                'message' => 'Details are not found'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
    }
    public function cart_count_post()
    {
        $user_id = $this->post('user_id');
        if ($user_id == '') {
            $message = array(
                'status' => 0,
                'message' => 'User id is required'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $cart_count = $this->Mobile_model->get_cart_count($user_id);
        //echo $this->db->last_query();exit;
        if (count($cart_count) > 0) {
            $message = array(
                'status' => 1,
                'count' => strval($cart_count['cnt']),
                'message' => 'count available'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        } else {
            $message = array(
                'status' => 0,
                'count' => '',
                'message' => 'count not available'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
    }
    public function checkversion_post()
    {
        $mac_id = $this->post('mac_id');
        if ($mac_id == '') {
            $message = array(
                'status' => 0,
                'message' => 'Mac id is required'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $mac_ver = $this->Mobile_model->get_mobile_mac_version($mac_id);
        if (count($mac_ver) > 0) {
            $message = array(
                'status' => 1,
                'version' => $mac_ver['version'],
                'message' => 'App version available'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        } else {
            $message = array(
                'status' => 0,
                'version' => '',
                'message' => 'App version not available'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
    }
    public function saveversion_post()
    {
        $mac_id  = $this->post('mac_id');
        $version = $this->post('version');
        if ($mac_id == '') {
            $message = array(
                'status' => 0,
                'message' => 'Mac id is required'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
        if ($version == '') {
            $message = array(
                'status' => 0,
                'message' => 'Version is required'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $mac_ver = $this->Mobile_model->get_mobile_mac_version($mac_id);
        if (count($mac_ver) > 0) {
            $u_data = array(
                'version' => $version,
                'updated_at' => date('Y-m-d H:i:s')
            );
            $update = $this->Mobile_model->update_mac_addtress($mac_id, $u_data);
            if (count($update) > 0) {
                $message = array(
                    'status' => 1,
                    'mac_id' => $mac_id,
                    'message' => 'Version updated successfully'
                );
                $this->response($message, REST_Controller::HTTP_OK);
            } else {
                $message = array(
                    'status' => 0,
                    'mac_id' => $mac_id,
                    'message' => 'Technical problem will occurred .Please try again'
                );
                $this->response($message, REST_Controller::HTTP_OK);
            }
            
        } else {
            $a_data = array(
                'mac_add' => $mac_id,
                'version' => $version,
                'creadted_at' => date('Y-m-d H:i:s')
            );
            $save   = $this->Mobile_model->insert_mac_addtress($a_data);
            if (count($save) > 0) {
                $message = array(
                    'status' => 1,
                    'mac_id' => $mac_id,
                    'message' => 'Version added successfully'
                );
                $this->response($message, REST_Controller::HTTP_OK);
            } else {
                $message = array(
                    'status' => 0,
                    'mac_id' => $mac_id,
                    'message' => 'Technical problem will occurred .Please try again'
                );
                $this->response($message, REST_Controller::HTTP_OK);
            }
        }
    }
    // no use this api 
    public function check_regotp_post()
    {
        $mobile_num = $this->post('mobile');
        if ($mobile_num == '') {
            $message = array(
                'status' => 0,
                'message' => 'Mobile is required'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $num = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        
        $mobile   = $mobile_num;
        $username = $this->config->item('smsusername');
        $pass     = $this->config->item('smspassword');
        $sender   = $this->config->item('sender');
        $msg      = "Dear Customer Your otp  is " . $num;
        /* seller purpose*/
        $ch2      = curl_init();
        curl_setopt($ch2, CURLOPT_URL, "http://trans.smsfresh.co/api/sendmsg.php");
        curl_setopt($ch2, CURLOPT_POST, 1);
        curl_setopt($ch2, CURLOPT_POSTFIELDS, 'user=' . $username . '&pass=' . $pass . '&sender=' . $sender . '&phone=' . $mobile . '&text=' . $msg . '&priority=ndnd&stype=normal');
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        
        $server_output = curl_exec($ch2);
        //echo '<pre>' ;print_r($server_output);exit;
        curl_close($ch2);
        /* accept message */
        $message = array(
            'status' => 1,
            'otp' => strval($num),
            'message' => 'otp sent to your registered mobile number,it will expire after 5 minutes '
        );
        $this->response($message, REST_Controller::HTTP_OK);
    }
    
    public function token_post()
    {
        $id    = $this->post('id');
        $token = $this->post('token');
        if ($id == '') {
            $message = array(
                'status' => 0,
                'message' => 'Id is required'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
        if ($token == '') {
            $message = array(
                'status' => 0,
                'message' => 'Token is required'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
        $u_data = array(
            'token' => isset($token) ? $token : ''
        );
        $update = $this->Mobile_model->update_user_tocken($id, $u_data);
        if (count($update) > 0) {
            $message = array(
                'status' => 1,
                'id' => $id,
                'message' => 'Token updated successfully'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        } else {
            $message = array(
                'status' => 0,
                'id' => $id,
                'message' => 'Technical problem will occurred .Please try again'
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
    }
	public  function edit_get_milk_order_post(){
		$product_id    = $this->post('product_id');
        $user_id = $this->post('user_id');
        $month = $this->post('month');
        $year = $this->post('year');
        if ($product_id == '') {
            $message = array('status' => 0,'message' => 'Product Id is required');
            $this->response($message, REST_Controller::HTTP_OK);
        }
        if ($user_id == '') {
            $message = array('status' => 0,'message' => 'Token is required');
            $this->response($message, REST_Controller::HTTP_OK);
        } if ($month == '') {
            $message = array('status' => 0,'message' => 'Month is required');
            $this->response($message, REST_Controller::HTTP_OK);
        } if($year == '') {
            $message = array('status' => 0,'message' => 'Year is required');
            $this->response($message, REST_Controller::HTTP_OK);
        }
		$flag=$this->Mobile_model->user_checking($user_id);
        if ($flag == 0) {
            $message['status']  = 0;
            $message['message'] = 'unauthorized user';
            $this->response($message, REST_Controller::HTTP_OK);
        }
		$days_inmonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		$c_details=$this->Mobile_model->get_milk_product_qty_details($product_id,$user_id,$month,$year,date('d'));
		if(count($c_details)>0){
			for($i=1;$i<=$days_inmonth;$i++){
				$lids=array();foreach($c_details as $li){
					if ($li['date']==$i)
					{
						$lids[]=$li['date'];
						$a[]=array('date'=>$li['date'],'quantity'=>$li['quantity']);
					}
					if(($li['date']!=$i)){
						//$a1[]=array('date'=>$i,'quantity'=>0);
					}
				 
					}
					if (!in_array($i, $lids))
					  {
					  $a1[]=array('date'=>strval($i),'quantity'=>'0');
					  }
				}
			$arr_com=array_merge($a,$a1);
			if(count($arr_com)>0){
				$s_arr_list=array();foreach($arr_com as $li){
					if(date('d')<=$li['date']){
						$s_arr_list[]=$li;
					}
					
				}
				foreach ($s_arr_list as $key => $row)
				{
					$vc_array_name[$key] = $row['date'];	
				}
				array_multisort($vc_array_name, SORT_ASC, $s_arr_list);
			}else{
				$arr_com=array();
			}
			$message = array('status' =>1,'curdate' =>date('d'),'days_inmonth' =>$days_inmonth,'orders'=>$s_arr_list);
            $this->response($message, REST_Controller::HTTP_OK);
		}else{
			$message = array('status' =>0,'curdate'=>'','days_inmonth'=>'','orders'=>'');
            $this->response($message, REST_Controller::HTTP_OK);
		}
	}
	
}
