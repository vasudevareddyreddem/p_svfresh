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
}

?>
