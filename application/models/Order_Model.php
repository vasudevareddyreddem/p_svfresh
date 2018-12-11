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
  public function insert($post_data='')
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
    return $this->db->get_where($this->table,array('user_id' => $user_id))->result();
  }

}

?>
