<?php
/**
 *
 */
class Cart_Model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
    $this->db->query("SET time_zone='+5:30'");
  }

  public $table = 'cart_tab';

  public function insert($post_data='')
  {
    return $this->db->insert($this->table,$post_data);
  }
  public function get_all_items_from_cart($user_id)
  {
    return $this->db->order_by('created_date','asc')->get_where($this->table,array('user_id'=>$user_id ))->result();
  }
  public function update($quantity='',$id='')
  {
    $this->db->where('id',$id);
    return $this->db->update($this->table,array('quantity'=>$quantity));
  }
  public function get_cart_total_for_user($user_id='')
  {
    $this->db->select('SUM(quantity * net_price) AS total_cart');
    $this->db->from($this->table);
    $this->db->where('user_id',$user_id);
    return $this->db->get()->row();
  }
  public function delete($id='')
  {
    $this->db->where('id',$id);
    return $this->db->delete($this->table);
  }

  public  function get_billing_details($billing_id){
	  $this->db->select('*')->from('billing_tab');
	  $this->db->where('id',$billing_id);
	  return $this->db->get()->row_array();

  }

  public function get_product_ids_in_cart($user_id=''){
    $this->db->select('product_id');
    $this->db->from($this->table);
    $this->db->where('user_id',$user_id);
    $result = $this->db->get()->result();
    $return = array();
    foreach($result as $r){
      $return[] = $r->product_id;
    }
    return $return;
  }

  public function get_cart_quantity_for_product($user_id='',$product_id='')
  {
    $this->db->select('quantity');
    $this->db->from($this->table);
    $this->db->where('user_id',$user_id);
    $this->db->where('product_id',$product_id);
    return $this->db->get()->row();
  }
  
  /* cart amountpurpose */
  public  function normal_cart_amount($user_id){
	  $this->db->select('SUM(cart_tab.net_price) as c_amt')->from('cart_tab');
      $this->db->where('user_id',$user_id);
      return $this->db->get()->row_array(); 
  }
 
  public  function special_cart_amount($user_id,$date){
	  //echo $date;
	  $this->db->select('SUM((calender_tab.quantity)*(price)) as m_amt')->from('calender_tab');
      $this->db->where('user_id',$user_id);
      $this->db->where('date >=',date('d'));
      $this->db->where('month >=',date('m'));
      $this->db->where('year >=',date('Y'));
      return $this->db->get()->row_array(); 
  }
  public  function check_product_ava_qty($user_id){
		$this->db->select('cart_tab.product_id,cart_tab.quantity,p.quantity as av_qty,p.product_name')->from('cart_tab');
		$this->db->join('product_tab AS p','p.product_id = cart_tab.product_id','left');
		$this->db->where('cart_tab.user_id',$user_id);
		return $this->db->get()->result_array();
  }
  /* cart amountpurpose */
}

?>
