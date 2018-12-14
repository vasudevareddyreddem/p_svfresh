<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobile_model extends CI_Model

{
	function __construct()
	{
		parent::__construct();
		$this->load->database("default");
	}
	public function category_list(){
       $this->db->select('category_tab.cat_id,category_tab.cat_name,category_tab.cat_img');
	   $this->db->from('category_tab');
	   $this->db->join('subcat_tab','subcat_tab.cat_id=category_tab.cat_id');
	   $this->db->join('product_tab','subcat_tab.subcat_id=product_tab.subcat_id');
	   $this->db->where('category_tab.status',1);
	   $this->db->where('subcat_tab.status',1);
	   $this->db->where('product_tab.status',1);
	   $this->db->group_by('category_tab.cat_id,category_tab.cat_name,category_tab.cat_img');
	   $this->db->order_by('product_tab.updated_at','desc');
	   return $this->db->get()->result_array();


	}
	public function user_checking($userid){
		
		$this->db->select('*')->from('users_tab')->where('id',$userid);
		return $this->db->get()->result()?1:0;
		
	}
	public function subcategory_list($cat){
			$this->db->select('category_tab.cat_id,category_tab.cat_name,subcat_tab.subcat_id,subcat_tab.subcat_name');
	  $this->db->from('subcat_tab');
	  $this->db->join('category_tab','subcat_tab.cat_id=category_tab.cat_id');
	   $this->db->where('subcat_tab.status',1);
	    $this->db->where('category_tab.cat_id',$cat);
	   $this->db->order_by('subcat_tab.updated_at','desc');
	   return $this->db->get()->result_array();
		
		
	}
	//gettting from category and subcategory
	public function product_list($subcat){
			$this->db->select('product_tab.product_id,product_tab.product_name,product_tab.product_img,
			product_tab.actual_price,product_tab.net_price,product_tab.discount_price,
			product_tab.guarantee_policy,product_tab.description,subcat_tab.subcat_name');
	  $this->db->from('product_tab');
	  $this->db->join('subcat_tab','subcat_tab.subcat_id=product_tab.subcat_id');
	   $this->db->where('product_tab.status',1);

		$this->db->where('subcat_tab.subcat_id',$subcat);
	   $this->db->order_by('product_tab.updated_at','desc');
	   return $this->db->get()->result_array();
		
		
	}
	public function home_slider_two_images(){
		$this->db->select('*')->from('slider_tab')->where('status',1);
	return	$this->db->get()->row_array();
		
		
	}
	public function home_sliders($id){
			$this->db->select('pic_name')->from('slider_pic_tab')->where('status',1)->where('slider_id',$id);
	return	$this->db->get()->result_array();
		
		
	}
	public function get_all_products(){
		$this->db->select('product_tab.*,category_tab.cat_id catid,category_tab.cat_name ,category_tab.cat_scr_content,category_tab.cat_id catid,category_tab.cat_id catidcatid,category_tab.cat_id catid,category_tab.cat_id catid')->from('product_tab')->
		join('subcat_tab','subcat_tab.subcat_id=product_tab.subcat_id')->
		join('category_tab','category_tab.cat_id=product_tab.cat_id')->order_by('updated_at,cat_id','desc')->where('category_tab.status',1)->where('product_tab.status',1)->where('subcat_tab.status',1);
		return $this->db->get()->result_array();
	}
	public function subcat_img_slider($subcat){
		
		$this->db->select('image_path')->from('subcat_slider')->where('subcat_id',$subcat)
		->where('status',1);
		return $this->db->get()->result_array();
	}
	//getting single product details
	public function single_product_details($id){
		$this->db->select('product_tab.product_id,product_tab.product_name,product_tab.product_img,
			product_tab.actual_price,product_tab.net_price,product_tab.discount_price,
			product_tab.guarantee_policy,product_tab.description')->from('product_tab')->where('product_id',$id)
		->where('status',1);
	  return $this->db->get()->row_array();
	}
	public function single_product_images($id){
		$this->db->select('product_images_tab.*')->from('product_images_tab')->where('product_id',$id)
		->where('status',1);
	  return $this->db->get()->result_array();
	}
	public function single_product_features($id){
		$this->db->select('feature_name,feature_value')->from('features_tab')->where('product_id',$id)
		->where('status',1);
	  return $this->db->get()->result_array();
	}
	public function single_product_rel_products($id){
		$this->db->select('product_tab.product_id,product_tab.product_name,product_tab.product_img,
			product_tab.actual_price,product_tab.net_price,product_tab.discount_price,
			product_tab.guarantee_policy,product_tab.description')->from('rel_products_tab')->
		join('product_tab','rel_products_tab.rel_product_id=product_tab.product_id')->where('rel_products_tab.product_id',$id)
		->where('product_tab.status',1)->where('rel_products_tab.status',1);
	  return $this->db->get()->result_array();
	}
	public function get_user_orders($id){
		$this->db->select('order_items_tab.order_number,order_items_tab.product_name,order_items_tab.product_id,
		order_items_tab.product_img,order_items_tab.quantity,order_items_tab.net_price,
		order_items_tab.delivery_status')->from('order_tab')->
		join('order_items_tab','order_tab.order_id=order_items_tab.order_id')
		->where('order_tab.user_id',$id)->order_by('order_items_tab.created_date','desc');
	
	  return $this->db->get()->result_array();
	}
	public function get_user_wishlist($id){
		$this->db->select('wishlist_tab.product_name,wishlist_tab.product_id,
		wishlist_tab.product_img,wishlist_tab.quantity,wishlist_tab.net_price,wishlist_tab.discount_price
		')->from('wishlist_tab')->
		where('wishlist_tab.user_id',$id);
	
	  return $this->db->get()->result_array();
	}
		public function get_user_profile($id){
		$this->db->select('email_id,phone_number,user_name')->from('users_tab')->
		where('users_tab.id',$id);
	
	  return $this->db->get()->row_array();
	}
		public function get_user_cart($id){
		$this->db->select('product_id,product_name,product_img,quantity,net_price')->from('cart_tab')->
		where('cart_tab.user_id',$id)->order_by('created_date','desc');
	
	  return $this->db->get()->result_array();
	}
		
		public function delete_cart_product($id){
			$this->db->where('id',$id);
			$this->db->delete('cart_tab');
			return $this->db->affected_rows()?1:0;
			
		}
		public function get_user_checkout($id){
		$this->db->select('product_tab.product_id,product_tab.product_name,product_tab.product_img,
		product_tab.description,product_tab.net_price')->from('cart_tab')->
		join('product_tab','product_tab.product_id=cart_tab.product_id')->
		where('cart_tab.user_id',$id)->where('product_tab.status',1)->
		order_by('created_date','desc');

	  return $this->db->get()->result_array();
	}
	public function get_user_billing_address($user_id){
		
		$this->db->select('*')->from('billing_tab')->where('user_id',$user_id)
		->where('status','Active');
		  return $this->db->get()->result_array();
	}
	public function product_list_by_cat($cat){
		$this->db->select('product_tab.product_id,product_tab.product_name,product_tab.product_img,
			product_tab.actual_price,product_tab.net_price,product_tab.discount_price,
			product_tab.guarantee_policy,product_tab.description')->from('product_tab')->
			join('category_tab','category_tab.cat_id=product_tab.cat_id')->where('product_tab.cat_id',$cat)->where('product_tab.status',1)->
			order_by('product_tab.updated_at','desc');
			
			return $this->db->get()->result_array();
		
	}
	public function insert_cart_product($data)
    {
		$this->db->insert('cart_tab',$data);
		return $this->db->affected_rows()?1:0;
	}
}