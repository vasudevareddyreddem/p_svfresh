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
}

?>
