<?php
/**
 *
 */
class Billing_Model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
    $this->db->query("SET time_zone='+5:30'");
  }

  public $table = 'billing_tab';

  public function insert($post_data='')
  {
    return $this->db->insert($this->table,$post_data);
  }
  public function get_user_billing_details_by_userid($user_id='')
  {
    $this->db->select('b.first_name,b.last_name,b.email_address,b.mobile_number,a.apartment_name,bl.block_name,b.flat_door_no,b.id');
    $this->db->from('billing_tab as b');
    $this->db->join('apartment_tab as a','b.appartment = a.apartment_id','left');
    $this->db->join('block_tab as bl','b.block = bl.block_id','left');
    $this->db->where('b.user_id',$user_id);
    $this->db->where('b.status','Active');
    return $this->db->get()->result();
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
