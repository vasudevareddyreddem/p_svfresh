<?php
/**
 *
 */
class Wishlist_Model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }
  public $table = 'wishlist_tab';

  public function insert($post_data='')
  {
    return $this->db->insert($this->table,$post_data);
  }
  public function delete($id='')
  {
    $this->db->where('id',$id);
    return $this->db->delete($this->table);
  }

  public function get_all_wishlist_by_user_id($user_id='')
  {
    return $this->db->get_where($this->table,array('user_id'=>$user_id))->result();
  }
}

?>
