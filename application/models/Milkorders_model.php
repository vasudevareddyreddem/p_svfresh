<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Milkorders_model extends CI_Model

{
	function __construct()
	{
		parent::__construct();
		$this->load->database("default");
        $this->db->query("SET time_zone='+5:30'");
	}
	public function total_order_list($apartment='',$block='',$date='')
	{
		$this->db->select('calender_tab.calender_id,calender_tab.year,calender_tab.date,calender_tab.month,
		calender_tab.quantity,(calender_tab.price)*(calender_tab.quantity) as price ,calender_tab.delivery_status,calender_tab.created_date,
		calender_tab.payment_type,
		product_tab.product_name,users_tab.email_id,users_tab.first_name,
		users_tab.last_name,users_tab.email_id,apartment_tab.apartment_name,block_tab.block_name,users_tab.flat_door_no,
	users_tab.phone_number,
		calender_tab.delivered_time,calender_tab.cancelled_time');
		$this->db->from('calender_tab');
		//$this->db->join('billing_tab','calender_tab.billing_id=billing_tab.id');
		$this->db->join('product_tab','product_tab.product_id=calender_tab.product_id');
		$this->db->join('users_tab','users_tab.id=calender_tab.user_id');
		$this->db->join('apartment_tab','apartment_tab.apartment_id=users_tab.appartment','left');
		$this->db->join('block_tab','block_tab.block_id=users_tab.block','left');
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
		$this->db->order_by('calender_tab.created_date,users_tab.id','desc');
		return $this->db->get()->result();
	}
	public function pending_order_list(){
		$this->db->select('calender_tab.calender_id,calender_tab.year,calender_tab.date,calender_tab.month,
		calender_tab.quantity,(calender_tab.price)*(calender_tab.quantity) as price,calender_tab.delivery_status,calender_tab.created_date,
		calender_tab.payment_type,
		product_tab.product_name,users_tab.email_id,users_tab.first_name,
		users_tab.last_name,users_tab.email_id,apartment_tab.apartment_name,block_tab.block_name,users_tab.flat_door_no,
		
		users_tab.phone_number')->from('calender_tab')->
		//join('billing_tab','calender_tab.billing_id=billing_tab.id')
		join('product_tab','product_tab.product_id=calender_tab.product_id')
		->join('users_tab','users_tab.id=calender_tab.user_id')
		->join('apartment_tab','apartment_tab.apartment_id=users_tab.appartment','left')
		->join('block_tab','block_tab.block_id=users_tab.block','left')
		->where('calender_tab.delivery_status',2)
		
		->order_by('calender_tab.created_date,users_tab.id','desc');
		return $this->db->get()->result();
	}
	public function delivered_order_list(){
		$this->db->select('calender_tab.calender_id,calender_tab.year,calender_tab.date,calender_tab.month,
		calender_tab.quantity,(calender_tab.price)*(calender_tab.quantity) as price,calender_tab.delivery_status,calender_tab.created_date,
		calender_tab.payment_type,
		product_tab.product_name,users_tab.email_id,users_tab.first_name,apartment_tab.apartment_name,block_tab.block_name,users_tab.flat_door_no,
		users_tab.last_name,
		users_tab.phone_number,calender_tab.delivered_time')->from('calender_tab')->
		//join('billing_tab','calender_tab.billing_id=billing_tab.id')
		join('product_tab','product_tab.product_id=calender_tab.product_id')
		->join('users_tab','users_tab.id=calender_tab.user_id')->where('calender_tab.delivery_status',1)
		->join('apartment_tab','apartment_tab.apartment_id=users_tab.appartment','left')
		->join('block_tab','block_tab.block_id=users_tab.block','left')
		->order_by('calender_tab.created_date,users_tab.id','desc');
		return $this->db->get()->result();
	}
	public function cancel_order_list(){
		$this->db->select('calender_tab.calender_id,calender_tab.year,calender_tab.date,calender_tab.month,
		calender_tab.quantity,(calender_tab.price)*(calender_tab.quantity) as price,calender_tab.delivery_status,calender_tab.created_date,
		calender_tab.payment_type,
		product_tab.product_name,users_tab.email_id,users_tab.first_name,
		users_tab.last_name,apartment_tab.apartment_name,block_tab.block_name,users_tab.flat_door_no,
		users_tab.phone_number,calender_tab.cancelled_time')->from('calender_tab')
		//join('billing_tab','calender_tab.billing_id=billing_tab.id')
		->join('product_tab','product_tab.product_id=calender_tab.product_id')
		->join('users_tab','users_tab.id=calender_tab.user_id')->where('calender_tab.delivery_status',0)
		->join('apartment_tab','apartment_tab.apartment_id=users_tab.appartment','left')
		->join('block_tab','block_tab.block_id=users_tab.block','left')
		->order_by('calender_tab.created_date,users_tab.id');;
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

}
