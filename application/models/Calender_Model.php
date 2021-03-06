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
    $this->db->query("SET time_zone='+5:30'");
  }

  public function get_all_calender_items_by_user_id($user_id='',$date='',$to_date='')
  {
  //   $to_date1=strtotime("1 day", strtotime($todate));
	// $plusone= date("d-m-Y", $to_date1);
	$this->db->select('p.product_name AS product_name,p.o_quantity, c.date AS date,c.month AS month,c.year AS year,c.quantity AS quantity,(c.price * c.quantity) AS price,c.delivery_status,c.calender_id,c.payment_status');
    $this->db->from('calender_tab AS c');
    $this->db->join('product_tab AS p','c.product_id = p.product_id','left');
    if (isset($date) && !empty($date)) {
			$date_fragment = explode('-',$date);
			if(is_array($date_fragment)){
				$day = $date_fragment[0];
				if(isset($day) && !empty($day)){
					$this->db->where('c.date >=',$day);
				}
				$month = $date_fragment[1];
				if(isset($month) && !empty($month)){
					$this->db->where('c.month >=',$month);
				}
				$year = $date_fragment[2];
				if(isset($year) && !empty($year)){
					$this->db->where('c.year >=',$year);
				}
			}
		}
    if (isset($to_date) && !empty($to_date)) {
			$to_date_fragment = explode('-',$to_date);
			if(is_array($to_date_fragment)){
				$to_day = $to_date_fragment[0];
				if(isset($to_day) && !empty($to_day)){
					$this->db->where('c.date <=',$to_day);
				}
				$to_month = $to_date_fragment[1];
				if(isset($to_month) && !empty($to_month)){
					$this->db->where('c.month <=',$to_month);
				}
				$to_year = $to_date_fragment[2];
				if(isset($to_year) && !empty($to_year)){
					$this->db->where('c.year <=',$to_year);
				}
			}
		}
	  $this->db->where('p.status','1');
    $this->db->where('c.user_id',$user_id);
    $this->db->order_by('c.date','desc');
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

  public function get_all_calender_items_by_user_id_and_month($user_id='',$month='',$year='',$product_id='')
  {
    $this->db->select('c.calender_id,p.product_name AS product_name,c.date AS date,c.month AS month,c.year AS year,c.quantity AS quantity,(c.price * c.quantity) AS price');
    $this->db->from('calender_tab AS c');
    $this->db->join('product_tab AS p','c.product_id = p.product_id','left');
    $this->db->where('p.status','1');
    $this->db->where('c.user_id',$user_id);
    $this->db->where('c.month',$month);
    $this->db->where('c.year',$year);
    $this->db->where('c.product_id',$product_id);
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

  public function cancel_order($calender_id='')
  {
    $this->db->set('delivery_status','3');
    $this->db->where('calender_id',$calender_id);
    return $this->db->update($this->table);
  }
  public  function update_qty_amount($c_id,$data){
	   $this->db->where('calender_id',$c_id);
		return $this->db->update('calender_tab',$data);
  }
  public  function get_payment_img_details($c_id){
		$this->db->select('calender_tab.payment_img')->from('calender_tab');
		$this->db->where('calender_tab.calender_id',$c_id);
		return $this->db->get()->row_array();
	}
	public  function update_payment_details($c_id,$data){
		$this->db->where('calender_tab.calender_id',$c_id);
		return $this->db->update('calender_tab',$data);
	}
	public  function  get_payments_inbetween_dates($user_id='',$date='',$to_date='')
	{
		$this->db->select('p.product_name AS product_name,c.date AS date,c.month AS month,c.year AS year,c.quantity AS quantity,(c.price * c.quantity) AS price,c.delivery_status,c.calender_id,c.payment_status');
		$this->db->from('calender_tab AS c');
		$this->db->join('product_tab AS p','c.product_id = p.product_id','left');
		if (isset($date) && !empty($date)) {
			$date_fragment = explode('-',$date);
			if(is_array($date_fragment)){
				$day = $date_fragment[0];
				if(isset($day) && !empty($day)){
					$this->db->where('c.date >=',$day);
				}
				$month = $date_fragment[1];
				if(isset($month) && !empty($month)){
					$this->db->where('c.month >=',$month);
				}
				$year = $date_fragment[2];
				if(isset($year) && !empty($year)){
					$this->db->where('c.year >=',$year);
				}
			}
		}
    if (isset($to_date) && !empty($to_date)) {
			$to_date_fragment = explode('-',$to_date);
			if(is_array($to_date_fragment)){
				$to_day = $to_date_fragment[0];
				if(isset($to_day) && !empty($to_day)){
					$this->db->where('c.date <=',$to_day);
				}
				$to_month = $to_date_fragment[1];
				if(isset($to_month) && !empty($to_month)){
					$this->db->where('c.month <=',$to_month);
				}
				$to_year = $to_date_fragment[2];
				if(isset($to_year) && !empty($to_year)){
					$this->db->where('c.year <=',$to_year);
				}
			}
		}
		$this->db->where('p.status','1');
		$this->db->where('c.payment_status',0);
		$this->db->where('c.delivery_status!=',3);
		$this->db->order_by('c.created_date','desc');
		$this->db->where('c.user_id',$user_id);
		return $this->db->get()->result_array();

	}
	public function insert_order_id($data){
		$this->db->insert('order_tab',$data);
		return $this->db->insert_id();

	}
	public  function get_bank_details($user_id){
		 $this->db->select('account_number,account_name,ifsc,upi_code')->from('users_tab');
		 $this->db->join('apartment_tab AS a','a.apartment_id = users_tab.appartment','left');
		 $this->db->where('users_tab.id',$user_id);
		 return $this->db->get()->row_array();
	}

}


?>
