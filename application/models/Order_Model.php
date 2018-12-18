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
    $this->db->join('order_items_tab AS oi','o.order_id = oi.order_id','left');
    $this->db->where('o.user_id',$user_id);
    $this->db->order_by('o.updated_date','desc');
    return $this->db->order_by('o.created_date','desc')->get()->result();
  }
  public function cancel_order($order_items_id='')
  {
    $this->db->where('order_items_id',$order_items_id);
    $this->db->set(array('order_status'=>'0'));
    return $this->db->update($this->table_order_items);
  }

  public  function get_order_item_details($order_item_id){

    $this->db->select('*')->from('order_items_tab');
    $this->db->where('order_items_id',$order_item_id);
	 return $this->db->get()->row_array();
  }

	public  function save_item_review($data){
	  $this->db->insert('rating_list',$data);
	  return $this->db->insert_id();
	}

	public  function check_rating_exits($user_id,$o_i_id){
		$this->db->select('*')->from('rating_list');
		$this->db->where('order_item_id',$o_i_id);
		$this->db->where('user_id',$user_id);
		return $this->db->get()->row_array();
	}

}

?>
