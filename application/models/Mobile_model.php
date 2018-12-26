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
			$this->db->select('category_tab.cat_id,category_tab.cat_name,subcat_tab.subcat_id,subcat_tab.subcat_name
			,subcat_tab.subcat_img');
	  $this->db->from('subcat_tab');
	  $this->db->join('category_tab','subcat_tab.cat_id=category_tab.cat_id');
	   $this->db->where('subcat_tab.status',1);
	    $this->db->where('category_tab.cat_id',$cat);
	   $this->db->order_by('subcat_tab.updated_at','desc');
	   return $this->db->get()->result_array();
		
		
	}
	//gettting from category and subcategory
	public function product_list($subcat,$user_id){
			$this->db->select("product_tab.product_id,product_tab.product_name,product_tab.product_img,
			product_tab.actual_price,product_tab.net_price,product_tab.discount_price,
			product_tab.guarantee_policy,product_tab.description,
			product_tab.quantity,
			subcat_tab.subcat_name, IF(wishlist_tab.user_id='$user_id',wishlist_tab.id,null) wishlist_id,
			IF(cart_tab.user_id='$user_id',cart_tab.id,null) cart_id,
			(select sum(rate)/count(product_id)   from rating_list where rating_list.product_id=product_tab.product_id group by product_id) AS rating ");
	  $this->db->from('product_tab');
	  $this->db->join('subcat_tab','subcat_tab.subcat_id=product_tab.subcat_id');
	   $this->db->join('wishlist_tab',"(wishlist_tab.product_id=product_tab.product_id)
	   and (wishlist_tab.user_id='$user_id' )",'left');
	     $this->db->join('cart_tab',"(cart_tab.product_id=product_tab.product_id)
		and (cart_tab.user_id='$user_id' )
	    ",'left');
	   $this->db->where('product_tab.status',1);
	    $this->db->where('subcat_tab.status',1);
		

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
		$this->db->select('order_items_tab.order_items_id,order_tab.order_id,order_items_tab.order_number,order_items_tab.product_name,order_items_tab.product_id,
		order_items_tab.product_img,order_items_tab.quantity,order_items_tab.net_price,
		order_items_tab.delivery_status')->from('order_tab')->
		join('order_items_tab','order_tab.order_id=order_items_tab.order_id')
		->where('order_tab.user_id',$id)->order_by('order_items_tab.created_date,order_tab.order_id','desc');
	
	  return $this->db->get()->result_array();
	}
	public function get_user_wishlist($id){
		$this->db->select('wishlist_tab.id wishlistid,product_tab.product_name,product_tab.product_id,
		product_tab.product_img,wishlist_tab.quantity,product_tab.actual_price,product_tab.net_price,product_tab.discount_price,(wishlist_tab.quantity)*(product_tab.net_price) whole_price
		')->from('wishlist_tab')->join('product_tab','product_tab.product_id=wishlist_tab.product_id')->
		where('wishlist_tab.user_id',$id);
	
	  return $this->db->get()->result_array();
	}
		public function get_user_profile($id){
		$this->db->select('email_id,phone_number,user_name')->from('users_tab')->
		where('users_tab.id',$id)->where('status','Active');
	
	  return $this->db->get()->row_array();
	}
		public function get_user_cart($id){
		$this->db->select('cart_tab.id,product_tab.product_id,product_tab.product_name,product_tab.product_img,
		cart_tab.quantity,product_tab.net_price,
		product_tab.discount_price,
			product_tab.guarantee_policy,product_tab.description')->from('cart_tab')->
		join('product_tab','product_tab.product_id=cart_tab.product_id')->
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
	public function insert_billing_address($data){
		$this->db->insert('billing_tab',$data);
		$insert_id=$this->db->insert_id();
		return $insert_id?$insert_id:0;
		
	}
	public function insert_order($data){
		$this->db->insert('order_tab',$data);
		$insert_id=$this->db->insert_id();
		return $insert_id;
	
	}
	public function insert_wishlist_product($data){
		$this->db->insert('wishlist_tab',$data);
		return $this->db->affected_rows()?1:0;
		
	}
	public function single_cart_item($item){
		$this->db->select('*')->from('cart_tab')->where('id',$item);
		return $this->db->get()->row_array();
	}
	public function insert_order_items($itemdata){
		$this->db->insert_batch('order_items_tab',$itemdata);
		return $this->db->affected_rows()?1:0;
	}
	public function delete_cart_items($user_id){
		$this->db->where('user_id',$user_id);
		$this->db->delete('cart_tab');
	return $this->db->affected_rows()?1:0;
	}
	public function check_loging($username){
		$this->db->select('id,email_id,phone_number,user_name,password')->from('users_tab')->
		where('phone_number',$username)->or_where('email_id',$username);

		return $this->db->get()->row_array();
		
	}
	public function insert_user_reg($data){
		$this->db->insert('users_tab',$data);
		$insert_id=$this->db->insert_id();
	 return $insert_id?$insert_id:0;
		
	}
	public function user_email_checking($email){
		
		$this->db->select('*')->from('users_tab')->where('status','active')->
		where('email_id',$email);
		$res=$this->db->get()->result();
		if(count($res)>0)
		{
			return 1;
			
		}
		else{
			return 0;
		}
		
		
	}
	public function user_mobile_checking($mobile){
	$this->db->select('*')->from('users_tab')->where('status','active')->
		where('phone_number',$mobile);
		$res=$this->db->get()->result();
		if(count($res)>0)
		{
			return 1;
			
		}
		else{
			return 0;
		}
		
		
	}
	public function delete_wishlist_item($wishlist_id){
		
		$this->db->where('id',$wishlist_id);
			$this->db->delete('wishlist_tab');
			return $this->db->affected_rows()?1:0;
	}
	public function check_edit_email($email,$user_id){
		$this->db->select('*');
	    $this->db->from('users_tab');
		
		$this->db->where('id!=',$user_id);
		$this->db->where('status ','Active');
		
	   $res= $this->db->get()->result_array(); 

			$email_list = array_column($res, 'email_id');
			
			//echo $catname;exit;
			//echo in_array($catname,$cat_names);exit;
			if(in_array($email,$email_list)){

			return 1;
			}
			else{
				return 0;
			}
	}
	public function check_edit_mobile($mobile,$user_id){
		$this->db->select('*');
	    $this->db->from('users_tab');
		
		$this->db->where('id!=',$user_id);
		$this->db->where('status ','Active');
		
	   $res= $this->db->get()->result_array(); 

			$number_list = array_column($res, 'phone_number');
			//echo $catname;exit;
			//echo in_array($catname,$cat_names);exit;
			if(in_array($mobile,$number_list)){

			return 1;
			}
			else{
				return 0;
			}
	}
	public function update_profile($data,$user_id){
		$this->db->where('id',$user_id);
		$this->db->update('users_tab',$data);
		return $this->db->affected_rows()?1:0;
		
	}
	public function delete_wishlist($user_id){
		$this->db->where('user_id',$user_id);
			$this->db->delete('wishlist_tab');
			return $this->db->affected_rows()?1:0;
		
		
	}
	public function get_user_details($user_id){
		
		$this->db->select('password')->from('users_tab')->where('id',$user_id);
		return $this->db->get()->row_array();
	}
	public function change_password($hashpassword,$newpassword,$user_id){
			$this->db->where('id',$user_id);
			$this->db->set('password',$hashpassword);
			$this->db->set('org_password',$newpassword);
			$this->db->update('users_tab');
			return $this->db->affected_rows()?1:0;
		
	}
	// public function insert_milk_order($data){
		// $pid=$data['product_id'];
		// $uid=$data['user_id'];
		// $month=$data['month'];
		// $year=$data['year'];
		// $day=$data['day'];
		// $this->db->select('*')->from(calender_tab)->where('product_id',$pid)->
		// where('user_id',$uid)->where('month',$month)->where('year',$year)->
		// where('date',$day);
		// $res=$this->db->get()->row();
		// if(count($res)>0){
			// $this->db->where('calender_id',$res->calender_id);
			// $this->db->update('calender_tab',)
		// }
		
	// }
	public function milk_order($data){
$sql="insert into  calender_tab(product_id,billing_id,user_id,month,date,year,quantity,price)
  values('".$data['product_id']."','".$data['billing_id']."',
		'".$data['user_id']."','".$data['month']."','".$data['year']."',
		'".$data['day']."','".$data['quantity']."','".$data['price']."') 
		
		on duplicate key update 
		quantity='".$data['quantity']."',
		price='".$data['price']."' ";
		
	
	
	
$result = $this->db->query($sql);
return $this->db->affected_rows()?1:0;

	}
	public function milk_orders($data){
		
		$query = "INSERT INTO calender_tab(product_id,billing_id,user_id,month,year,date,price,quantity) VALUES " . implode(', ', $data) . " ON DUPLICATE KEY UPDATE quantity = VALUES(quantity),
		price=VALUES(price)";
		$this->db->query($query);
   //$this->db->insert_on_duplicate_update_batch('calender_tab',$data);
return $this->db->affected_rows()?1:0;
	}
	// public function get_milk_orders_by_user($user_id,$product_id,$month,$year){
		
		// $this->db->select(*)->from('calender_tab')->join('')
		
	// }
	public function get_milk_orders_by_user($user_id,$product_id,$month,$year){
		$this->db->select('date,quantity')->from('calender_tab')->where('product_id',$product_id)->where('user_id',$user_id)->
		where('month',$month)->where('year',$year);
	return	$this->db->get()->result_array();
		
	}
	public  function  get_milk_orders($user_id){

	    $this->db->select('calender_tab.calender_id,calender_tab.year,calender_tab.month,calender_tab.date,calender_tab.quantity,
	    calender_tab.price,calender_tab.delivery_status,product_tab.product_name,product_tab.product_img,
	    billing_tab.first_name,billing_tab.last_name,billing_tab.email_address,billing_tab.address,billing_tab.city,
	    billing_tab.state,billing_tab.zip,billing_tab.country,billing_tab.telephone')
            ->from('calender_tab')->join('product_tab','product_tab.product_id=calender_tab.product_id')->
        join('users_tab','calender_tab.user_id=users_tab.id')->
            join('billing_tab','billing_tab.user_id=users_tab.id')->
        where('calender_tab.user_id',$user_id);
        ;
	 return   $this->db->get()->result_array();
    }
public function cancel_milk_order($cal_id,$user_id)
{
    $this->db->where('calender_id',$cal_id);
    $this->db->where('user_id',$user_id);
    $this->db->set('cancelled_time','now()',FALSE);

    $this->db->set('delivery_status',0);
    $this->db->set('updated_by_user',$user_id);
    $this->db->update('calender_tab');
    return $this->db->affected_rows()?1:0;



}
public function cancel_order($item_id,$user_id){
    $this->db->where('order_items_id',$item_id);
    $this->db->where('user_id',$user_id);
    $this->db->set('delivery_status',0);
    $this->db->set('cancelled_time','now()',FALSE);
    $this->db->set('updated_by_user',$user_id);
    $this->db->update('order_items_tab');
    return $this->db->affected_rows()?1:0;


}
}