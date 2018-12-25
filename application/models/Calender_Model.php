<?php
/**
 *
 */
class Calender_Model extends CI_Model
{

  public $table = 'calender_tab';

  function __construct()
  {
    parent::__construct();
  }

  public function get_all_calender_items_by_user_id($user_id='')
  {
    $this->db->select('p.product_name AS product_name,c.date AS date,c.month AS month,c.year AS year,c.quantity AS quantity,(c.price * c.quantity) AS price');
    $this->db->from('calender_tab AS c');
    $this->db->join('product_tab AS p','c.product_id = p.product_id','left');
    $this->db->where('p.status','1');
    $this->db->where('c.user_id',$user_id);
    $this->db->order_by('c.created_date','desc');
    return $this->db->get()->result();
  }

  public function insert($post_data='')
  {
    return $this->db->insert($this->table,$post_data);
  }

  public function update($post_data='',$calender_id='')
  {
    $this->db->where('calender_id',$calender_id);
    return $this->db->update($this->table,$post_data);
  }

  public function get_all_calender_items_by_user_id_and_month($user_id='',$month='')
  {
    $this->db->select('p.product_name AS product_name,c.date AS date,c.month AS month,c.year AS year,c.quantity AS quantity,(c.price * c.quantity) AS price');
    $this->db->from('calender_tab AS c');
    $this->db->join('product_tab AS p','c.product_id = p.product_id','left');
    $this->db->where('p.status','1');
    $this->db->where('c.user_id',$user_id);
    $this->db->where('c.month',$month);
    $this->db->order_by('c.created_date','desc');
    return $this->db->get()->result();
  }

  public function check_unique_order($product_id='',$user_id='',$date='',$month='',$year='')
  {
    $this->db->select('calender_id');
    $this->db->from($this->table);
    $this->db->where('product_id',$product_id);
    $this->db->where('user_id',$user_id);
    $this->db->where('year',$year);
    $this->db->where('month',$month);
    $this->db->where('date',$date);
    return $this->db->get()->row();
  }

}


?>
