<?php
/**
 *
 */
class Order_Model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }
  public $table = 'order_tab';
  public $table_order_items = 'order_items_tab';
  public function insert_order_items($post_data='')
  {
    return $this->db->insert($this->table_order_items,$post_data);
  }
  public function insert_order($post_data='')
  {
    return $this->db->insert($this->table,$post_data);
  }
  public function delete_cart_after_order($user_id='')
  {
    $this->db->where('user_id',$user_id);
    return $this->db->delete('cart_tab');
  }
  public function get_order_by_user($user_id='')
  {
    $this->db->select('*');
    $this->db->from('order_tab AS o');
    $this->db->join('order_items_tab AS oi','o.order_id = oi.order_id');
    return $this->db->where('o.user_id',$user_id)->get()->result();
    //return $this->db->get_where($this->table,array('user_id' => $user_id))->result();
  }

}

?>
