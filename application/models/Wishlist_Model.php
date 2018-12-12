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

  public function get_product_ids_in_wishlist($user_id=''){
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
  public  function remove_wishlist_item($id){
	 $this->db->where('id',$id); 
	 return $this->db->delete('wishlist_tab');
  }
}

?>
