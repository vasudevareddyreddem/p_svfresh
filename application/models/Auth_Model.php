<?php
/**
 *
 */
class Auth_Model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
      $this->db->query("SET time_zone='+5:30'");
  }
  public $table = 'users_tab';

  public function insert($post_data)
  {
    $this->db->insert($this->table,$post_data);
	return $this->db->insert_id();
  }
  //checking email unique
  public function check_email_exists($email='',$id='')
  {
    $this->db->where(array('email_id'=>$email,'id!='=>$id));
    return $this->db->get($this->table)->row();
  }
  //checking user name unique
  public function check_username_exists($user_name='',$id='')
  {
    $this->db->where(array('user_name'=>$user_name,'id!='=>$id));
    return $this->db->get($this->table)->row();
  }
  //checking phone number unique
  public function check_phone_number_exists($phone_number='',$id='')
  {
    $this->db->where(array('phone_number'=>$phone_number,'id!='=>$id));
    return $this->db->get($this->table)->row();
  }

  public function login($post_data)
  {
    return $this->db->get_where($this->table,$post_data)->row();
  }

  public function update($post_data='',$id='')
  {
    $this->db->where('id',$id);
    $this->db->set($post_data);
    return $this->db->update($this->table);
  }

  public function get_user_details($user_id='')
  {
    $this->db->where('id',$user_id);
    return $this->db->get($this->table)->row();
  }
  //change password
  public function change_password($user_id='',$password='')
  {
    $this->db->where('id',$user_id);
    $this->db->set($password);
    return $this->db->update($this->table);
  }


  /* return by vasu*/
  public function save_newsletters_emails($data){
	  $this->db->insert('newsletters_list',$data);
	  return $this->db->insert_id();

  }
  public  function check_email_ornot($email){
	  $this->db->select('*')->from('newsletters_list');
	  $this->db->where('email',$email);
	  return $this->db->get()->row_array();

  }

  public function get_cart_item_qty($user_id){
	  $this->db->select('count(cart_tab.id) as cnt')->from('cart_tab');
	  $this->db->where('user_id',$user_id);
	  return $this->db->get()->row_array();

  }
  public  function get_all_products_lists(){
	  $this->db->select('product_tab.product_name,product_tab.product_id')->from('product_tab');
	  $this->db->where('status',1);
	  return $this->db->get()->result_array();
  }

  public  function delete_cart_item($id){
	   $this->db->where('id',$id);
	   return $this->db->delete('cart_tab');
  }

  public  function save_contactus($data){
	   $this->db->insert('contactus_list',$data);
	  return $this->db->insert_id();
  }

  public function get_user_details_for_billing($user_id='')
  {
    $this->db->select('u.*,a.apartment_name as appartment,bl.block_name as block');
    $this->db->from($this->table.' u');
    $this->db->join('apartment_tab  a','u.appartment = a.apartment_id','left');
    $this->db->join('block_tab  bl','u.block = bl.block_id','left');
    $this->db->where('id',$user_id);
    return $this->db->get()->row();
  }
  //get user details by phone number
  public function get_user_details_by_phone_number($phone_number='')
  {
    return $this->db->get_where($this->table,array('phone_number' => $phone_number))->row();
  }
  //get user details by otp and mobile number
  public function get_user_details_by_otp_phone_number($phone_number = '',$otp = '')
  {
    $this->db->select('id,otp,otp_created_on');
    return $this->db->get_where($this->table,array('phone_number' => $phone_number, 'otp' => $otp))->row();
  }
  public function old_address($post_id){
    $this->db->select('*')->from('users_tab')->where('id',$post_id);
    $data=$this->db->get()->row_array();
    $this->db->insert('user_old_address_tab',$data);
    return $this->db->affected_rows()?1:0;
  }
  
  public  function user_details($id){
	  $this->db->select('id,phone_number,otp,verified,email_id,phone_number,role')->from('users_tab');
	  $this->db->where ('id',$id);
	  return $this->db->get()->row_array();
 }
 public  function update_user_data($id,$data){
	 $this->db->where ('id',$id);
	 return $this->db->update('users_tab',$data);
 }

}


 ?>
