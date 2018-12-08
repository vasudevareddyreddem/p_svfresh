<?php
/**
 *
 */
class Billing_Model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public $table = 'billing_tab';

  public function insert($post_data='')
  {
    return $this->db->insert($this->table,$post_data);
  }
  public function get_user_billing_details_by_userid($user_id='')
  {
    return $this->db->get_where($this->table,array('user_id',$user_id))->row();
  }
}

?>
