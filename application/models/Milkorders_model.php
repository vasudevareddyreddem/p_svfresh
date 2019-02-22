<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Milkorders_model extends CI_Model

{
	function __construct()
	{
		parent::__construct();
		$this->load->database("default");
        $this->db->query("SET time_zone='+5:30'");
	}
	public function total_order_list($apartment='',$block='',$date='',$mobile='')
	{
		$this->db->select('calender_tab.calender_id,calender_tab.year,calender_tab.date,calender_tab.month,
		calender_tab.quantity,(calender_tab.price)*(calender_tab.quantity) as price ,calender_tab.delivery_status,calender_tab.created_date,
		calender_tab.payment_type,
		product_tab.product_name,users_tab.email_id,users_tab.first_name,
		users_tab.last_name,users_tab.user_name,users_tab.email_id,apartment_tab.apartment_name,block_tab.block_name,users_tab.flat_door_no,
	users_tab.phone_number,
		calender_tab.delivered_time,calender_tab.cancelled_time,calender_tab.payment_status,calender_tab.payment_img');
		$this->db->from('calender_tab');
		//$this->db->join('billing_tab','calender_tab.billing_id=billing_tab.id');
		$this->db->join('product_tab','product_tab.product_id=calender_tab.product_id');
		$this->db->join('users_tab','users_tab.id=calender_tab.user_id');
		$this->db->join('apartment_tab','apartment_tab.apartment_id=users_tab.appartment','left');
		$this->db->join('block_tab','block_tab.block_id=users_tab.block','left');
		if (isset($apartment) && !empty($apartment)) {
			$this->db->where('users_tab.appartment',$apartment);
		}
		if (isset($mobile) && !empty($mobile)) {
			$this->db->where('users_tab.phone_number',$mobile);
		}
		if (isset($block) && !empty($block)) {
			$this->db->where('users_tab.block',$block);
		}
		if (isset($date) && !empty($date)) {
			$date_fragment = explode('/',$date);
			if(is_array($date_fragment)){
				$day = $date_fragment[0];
				if(isset($day) && !empty($day)){
					$this->db->where('calender_tab.date',$day);
				}
				$month = $date_fragment[1];
				if(isset($month) && !empty($month)){
					$this->db->where('calender_tab.month',$month);
				}
				$year = $date_fragment[2];
				if(isset($year) && !empty($year)){
					$this->db->where('calender_tab.year',$year);
				}
			}
		}
		$this->db->order_by('calender_tab.year','desc');
		$this->db->order_by('calender_tab.month','desc');
		$this->db->order_by('calender_tab.date','desc');
		$this->db->order_by('users_tab.id','desc');

		return $this->db->get()->result();
	}
	public function pending_order_list($apartment='',$block='',$date='',$mobile=''){
		$this->db->select('calender_tab.calender_id,calender_tab.year,calender_tab.date,calender_tab.month,
		calender_tab.quantity,(calender_tab.price)*(calender_tab.quantity) as price,calender_tab.delivery_status,calender_tab.created_date,
		calender_tab.payment_type,
		product_tab.product_name,users_tab.email_id,users_tab.first_name,
		users_tab.last_name,users_tab.email_id,apartment_tab.apartment_name,block_tab.block_name,users_tab.flat_door_no,

		users_tab.phone_number');
		$this->db->from('calender_tab');
		//join('billing_tab','calender_tab.billing_id=billing_tab.id')
		$this->db->join('product_tab','product_tab.product_id=calender_tab.product_id');
		$this->db->join('users_tab','users_tab.id=calender_tab.user_id');
		$this->db->join('apartment_tab','apartment_tab.apartment_id=users_tab.appartment','left');
		$this->db->join('block_tab','block_tab.block_id=users_tab.block','left');
		$this->db->where('calender_tab.delivery_status',2);
		if (isset($apartment) && !empty($apartment)) {
			$this->db->where('users_tab.appartment',$apartment);
		}
		if (isset($mobile) && !empty($mobile)) {
			$this->db->where('users_tab.phone_number',$mobile);
		}
		if (isset($block) && !empty($block)) {
			$this->db->where('users_tab.block',$block);
		}
		if (isset($date) && !empty($date)) {
			$date_fragment = explode('/',$date);
			if(is_array($date_fragment)){
				$day = $date_fragment[0];
				if(isset($day) && !empty($day)){
					$this->db->where('calender_tab.date',$day);
				}
				$month = $date_fragment[1];
				if(isset($month) && !empty($month)){
					$this->db->where('calender_tab.month',$month);
				}
				$year = $date_fragment[2];
				if(isset($year) && !empty($year)){
					$this->db->where('calender_tab.year',$year);
				}
			}
		}

		$this->db->order_by('calender_tab.year','desc');
		$this->db->order_by('calender_tab.month','desc');
		$this->db->order_by('calender_tab.date','desc');
		$this->db->order_by('users_tab.id','desc');

		return $this->db->get()->result();
	}
	public function delivered_order_list($apartment='',$block='',$date='',$mobile=''){
		$this->db->select('calender_tab.calender_id,calender_tab.year,calender_tab.date,calender_tab.month,
		calender_tab.quantity,(calender_tab.price)*(calender_tab.quantity) as price,calender_tab.delivery_status,calender_tab.created_date,
		calender_tab.payment_type,
		product_tab.product_name,users_tab.email_id,users_tab.first_name,apartment_tab.apartment_name,block_tab.block_name,users_tab.flat_door_no,
		users_tab.last_name,
		users_tab.phone_number,calender_tab.delivered_time');
		$this->db->from('calender_tab');
		//join('billing_tab','calender_tab.billing_id=billing_tab.id')
		$this->db->join('product_tab','product_tab.product_id=calender_tab.product_id');
		$this->db->join('users_tab','users_tab.id=calender_tab.user_id');
		$this->db->join('apartment_tab','apartment_tab.apartment_id=users_tab.appartment','left');
		$this->db->join('block_tab','block_tab.block_id=users_tab.block','left');
		$this->db->where('calender_tab.delivery_status',1);
		if (isset($apartment) && !empty($apartment)) {
			$this->db->where('users_tab.appartment',$apartment);
		}
		if (isset($mobile) && !empty($mobile)) {
			$this->db->where('users_tab.phone_number',$mobile);
		}
		if (isset($block) && !empty($block)) {
			$this->db->where('users_tab.block',$block);
		}
		if (isset($date) && !empty($date)) {
			$date_fragment = explode('/',$date);
			if(is_array($date_fragment)){
				$day = $date_fragment[0];
				if(isset($day) && !empty($day)){
					$this->db->where('calender_tab.date',$day);
				}
				$month = $date_fragment[1];
				if(isset($month) && !empty($month)){
					$this->db->where('calender_tab.month',$month);
				}
				$year = $date_fragment[2];
				if(isset($year) && !empty($year)){
					$this->db->where('calender_tab.year',$year);
				}
			}
		}
		$this->db->order_by('calender_tab.year','desc');
		$this->db->order_by('calender_tab.month','desc');
		$this->db->order_by('calender_tab.date','desc');
		$this->db->order_by('users_tab.id','desc');

		return $this->db->get()->result();
	}
	public function cancel_order_list($apartment='',$block='',$date='',$mobile=''){
		$this->db->select('calender_tab.calender_id,calender_tab.year,calender_tab.date,calender_tab.month,
		calender_tab.quantity,(calender_tab.price)*(calender_tab.quantity) as price,calender_tab.delivery_status,calender_tab.created_date,
		calender_tab.payment_type,
		product_tab.product_name,users_tab.email_id,users_tab.first_name,
		users_tab.last_name,apartment_tab.apartment_name,block_tab.block_name,users_tab.flat_door_no,
		users_tab.phone_number,calender_tab.cancelled_time');
		$this->db->from('calender_tab');
		//join('billing_tab','calender_tab.billing_id=billing_tab.id')
		$this->db->join('product_tab','product_tab.product_id=calender_tab.product_id');
		$this->db->join('users_tab','users_tab.id=calender_tab.user_id');
		$this->db->join('apartment_tab','apartment_tab.apartment_id=users_tab.appartment','left');
		$this->db->join('block_tab','block_tab.block_id=users_tab.block','left');
		if (isset($apartment) && !empty($apartment)) {
			$this->db->where('users_tab.appartment',$apartment);
		}
		if (isset($mobile) && !empty($mobile)) {
			$this->db->where('users_tab.phone_number',$mobile);
		}
		if (isset($block) && !empty($block)) {
			$this->db->where('users_tab.block',$block);
		}
		if (isset($date) && !empty($date)) {
			$date_fragment = explode('/',$date);
			if(is_array($date_fragment)){
				$day = $date_fragment[0];
				if(isset($day) && !empty($day)){
					$this->db->where('calender_tab.date',$day);
				}
				$month = $date_fragment[1];
				if(isset($month) && !empty($month)){
					$this->db->where('calender_tab.month',$month);
				}
				$year = $date_fragment[2];
				if(isset($year) && !empty($year)){
					$this->db->where('calender_tab.year',$year);
				}
			}
		}

		$this->db->where('calender_tab.delivery_status',0);

		$this->db->order_by('calender_tab.year','desc');
		$this->db->order_by('calender_tab.month','desc');
		$this->db->order_by('calender_tab.date','desc');
		$this->db->order_by('users_tab.id','desc');
		return $this->db->get()->result();
	}
	public function change_to_delivery_status($id,$svadmin){
		$this->db->set('delivery_status',1);
		$this->db->set('updated_by',$svadmin);
		$this->db->set('delivered_time','now()',FALSE);
		$this->db->where('calender_id',$id);
		$this->db->update('calender_tab');

		return $this->db->affected_rows()?1:0;
	}
	public function change_to_cancel_status($id,$svadmin){
		$this->db->set('delivery_status',0);
		$this->db->set('updated_by',$svadmin);
		$this->db->set('cancelled_time','now()',FALSE);
		$this->db->where('calender_id',$id);
		$this->db->update('calender_tab');

		return $this->db->affected_rows()?1:0;
	}
	public function change_to_pending_status($id,$svadmin){
		$this->db->set('delivery_status',2);
		$this->db->set('updated_by',$svadmin);

		$this->db->where('calender_id',$id);
		$this->db->update('calender_tab');

		return $this->db->affected_rows()?1:0;
	}
	public function auto_update_sataus(){
		$date=date('Y-m-d H:i:s');
		//echo $date;exit;

$month=date('m' ,strtotime($date));//current month in number
$year=date('Y' ,strtotime($date));// current year in number
$days=date('d' ,strtotime($date));//present date in month


		$this->db->where('delivery_status',2);
		$this->db->where('year',$year);
		$this->db->where('month',$month);
		$this->db->where('date',$days);
		$this->db->set('delivery_status',1);
		$this->db->set('delivered_time',$date);
		$this->db->update('calender_tab');
		return 1;

	}
	public function boys_order_list($apartment,$block,$date){

		$this->db->select('calender_tab.year,calender_tab.date,calender_tab.month,
		calender_tab.quantity,

		product_tab.product_name,apartment_tab.apartment_name,block_tab.block_name,users_tab.flat_door_no

	');
		$this->db->from('calender_tab');


		$this->db->join('product_tab','product_tab.product_id=calender_tab.product_id');
		$this->db->join('users_tab','users_tab.id=calender_tab.user_id');
		$this->db->join('apartment_tab','apartment_tab.apartment_id=users_tab.appartment','left');
		$this->db->join('block_tab','block_tab.block_id=users_tab.block','left');
		$this->db->where('calender_tab.delivery_status',2);

		if (isset($apartment) && !empty($apartment)) {
			$this->db->where('users_tab.appartment',$apartment);
		}

		if (isset($block) && !empty($block)) {
			$this->db->where('users_tab.block',$block);
		}

		if (isset($date) && !empty($date)) {
			$date_fragment = explode('/',$date);
			if(is_array($date_fragment)){
				$day = $date_fragment[0];
				if(isset($day) && !empty($day)){
					$this->db->where('calender_tab.date',$day);
				}
				$month = $date_fragment[1];
				if(isset($month) && !empty($month)){
					$this->db->where('calender_tab.month',$month);
				}
				$year = $date_fragment[2];
				if(isset($year) && !empty($year)){
					$this->db->where('calender_tab.year',$year);
				}
			}
		}

		$this->db->order_by('calender_tab.year','desc');
		$this->db->order_by('calender_tab.month','desc');
		$this->db->order_by('calender_tab.date','desc');
		$this->db->order_by('apartment_tab.apartment_name','desc');
		$this->db->order_by('block_tab.block_name','desc');
		$this->db->order_by('users_tab.flat_door_no','desc');


		return $this->db->get()->result();
	}
	public function block_products($apartment,$block,$date){
		$this->db->select('

		product_tab.product_name,apartment_tab.apartment_name,block_tab.block_name,sum(calender_tab.quantity) packets

	');
		$this->db->from('calender_tab');
		//join('billing_tab','calender_tab.billing_id=billing_tab.id')
		$this->db->join('product_tab','product_tab.product_id=calender_tab.product_id');
		$this->db->join('users_tab','users_tab.id=calender_tab.user_id');
		$this->db->join('apartment_tab','apartment_tab.apartment_id=users_tab.appartment','left');
		$this->db->join('block_tab','block_tab.block_id=users_tab.block','left');
		$this->db->where('calender_tab.delivery_status',2);
		if (isset($apartment) && !empty($apartment)) {
			$this->db->where('users_tab.appartment',$apartment);
		}

		if (isset($block) && !empty($block)) {
			$this->db->where('users_tab.block',$block);
		}

						if (isset($date) && !empty($date)) {
							$date_fragment = explode('/',$date);
							if(is_array($date_fragment)){
								$day = $date_fragment[0];
								if(isset($day) && !empty($day)){
									$this->db->where('calender_tab.date',$day);
								}
								$month = $date_fragment[1];
								if(isset($month) && !empty($month)){
									$this->db->where('calender_tab.month',$month);
								}
								$year = $date_fragment[2];
								if(isset($year) && !empty($year)){
									$this->db->where('calender_tab.year',$year);
								}
							}
						}
     $this->db->group_by('product_tab.product_name,apartment_tab.apartment_name,block_tab.block_name');
	    return $this->db->get()->result_array();
	}

}
