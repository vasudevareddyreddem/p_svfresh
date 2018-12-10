<?php
/**
 *
 */
class Cart_Model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public $table = 'cart_tab';

  public function insert($post_data='')
  {
    return $this->db->insert($this->table,$post_data);
  }
  public function get_all_items_from_cart($user_id)
  {
    return $this->db->get_where($this->table,array('user_id'=>$user_id ))->result();
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
}

?>
