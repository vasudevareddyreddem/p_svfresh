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
    $this->db->where('user_id',$user_id);
    $this->db->where('status','Active');
    return $this->db->get($this->table)->result();
  }
  public function get_billing_details_by_id($id='')
  {
    return $this->db->get_where($this->table,array('id' => $id))->row();
  }
  public function update($post_data='',$post_id='')
  {
    $this->db->where('id',$post_id);
    $this->db->set($post_data);
    return $this->db->update($this->table);
  }
}

?>
