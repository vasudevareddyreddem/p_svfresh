<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Milkorders_model extends CI_Model

{
	function __construct()
	{
		parent::__construct();
		$this->load->database("default");
        $this->db->query("SET time_zone='+5:30'");
	}
	public function total_order_list($apartment='',$block='',$floor_number='',$mobile='')
	{
		$this->db->select('calender_tab.calender_id,calender_tab.year,calender_tab.date,calender_tab.month,
		calender_tab.quantity,(calender_tab.price)*(calender_tab.quantity) as price ,calender_tab.delivery_status,calender_tab.created_date,
		calender_tab.payment_type,
		product_tab.product_name,product_tab.product_nick_name,users_tab.email_id,users_tab.first_name,product_tab.o_quantity,
		users_tab.last_name,users_tab.user_name,users_tab.email_id,apartment_tab.apartment_name,block_tab.block_name,users_tab.flat_door_no,
	users_tab.phone_number,
		calender_tab.delivered_time,calender_tab.cancelled_time,calender_tab.payment_status,calender_tab.payment_img,calender_tab.payment_date,calender_tab.order_id');
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
		}if (isset($floor_number) && !empty($floor_number)) {
			$this->db->where('users_tab.flat_door_no',$floor_number);
		}
		
		$this->db->order_by('apartment_tab.apartment_name');
		$this->db->order_by('block_tab.block_name');
		$this->db->order_by('calender_tab.year','desc');
		$this->db->order_by('calender_tab.month','desc');
		$this->db->order_by('calender_tab.date','desc');
		$this->db->order_by('users_tab.id','desc');

		return $this->db->get()->result();
	}
	public function total_payment_order_list($apartment='',$block='',$floor_number='',$mobile='')
	{
		$this->db->select('calender_tab.calender_id,calender_tab.order_id,calender_tab.admin_accept_status,calender_tab.year,calender_tab.date,calender_tab.month,
		calender_tab.quantity,(calender_tab.price)*(calender_tab.quantity) as price ,calender_tab.delivery_status,calender_tab.created_date,
		calender_tab.payment_type,product_tab.o_quantity,
		product_tab.product_name,product_tab.product_nick_name,users_tab.email_id,users_tab.first_name,
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
		if (isset($floor_number) && !empty($floor_number)) {
			$this->db->where('users_tab.flat_door_no',$floor_number);
		}
		
		$this->db->where('calender_tab.payment_status',1);
		$this->db->order_by('apartment_tab.apartment_name');
		$this->db->order_by('block_tab.block_name');
		$this->db->order_by('calender_tab.year','desc');
		$this->db->order_by('calender_tab.month','desc');
		$this->db->order_by('calender_tab.date','desc');
		$this->db->order_by('users_tab.id','desc');

		return $this->db->get()->result();
	}
	public function pending_order_list($apartment='',$block='',$floor_number='',$mobile=''){
		$this->db->select('calender_tab.calender_id,calender_tab.year,calender_tab.date,calender_tab.month,
		calender_tab.quantity,(calender_tab.price)*(calender_tab.quantity) as price,calender_tab.delivery_status,calender_tab.created_date,
		calender_tab.payment_type,
		product_tab.product_name,product_tab.product_nick_name,users_tab.email_id,users_tab.first_name,product_tab.o_quantity,
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
		if (isset($floor_number) && !empty($floor_number)){
			$this->db->where('users_tab.flat_door_no',$floor_number);
		}
		
		$this->db->order_by('apartment_tab.apartment_name');
	 $this->db->order_by('block_tab.block_name');
		$this->db->order_by('calender_tab.year','desc');
		$this->db->order_by('calender_tab.month','desc');
		$this->db->order_by('calender_tab.date','desc');
		$this->db->order_by('users_tab.id','desc');

		return $this->db->get()->result();
	}
	public function delivered_order_list($apartment='',$block='',$floor_number='',$mobile=''){
		$this->db->select('calender_tab.calender_id,calender_tab.year,calender_tab.date,calender_tab.month,
		calender_tab.quantity,(calender_tab.price)*(calender_tab.quantity) as price,calender_tab.delivery_status,calender_tab.created_date,product_tab.o_quantity,
		calender_tab.payment_type,
		product_tab.product_name,product_tab.product_nick_name,users_tab.email_id,users_tab.first_name,apartment_tab.apartment_name,block_tab.block_name,users_tab.flat_door_no,
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
		if (isset($floor_number) && !empty($floor_number)) {
			$this->db->where('users_tab.flat_door_no',$floor_number);
		}
		
		$this->db->order_by('apartment_tab.apartment_name');
		$this->db->order_by('block_tab.block_name');
		$this->db->order_by('calender_tab.year','desc');
		$this->db->order_by('calender_tab.month','desc');
		$this->db->order_by('calender_tab.date','desc');
		$this->db->order_by('users_tab.id','desc');

		return $this->db->get()->result();
	}
	public function cancel_order_list($apartment='',$block='',$floor_number='',$mobile=''){
		$this->db->select('calender_tab.calender_id,calender_tab.year,calender_tab.date,calender_tab.month,
		calender_tab.quantity,(calender_tab.price)*(calender_tab.quantity) as price,calender_tab.delivery_status,calender_tab.created_date,
		calender_tab.payment_type,
		product_tab.product_name,product_tab.product_nick_name,users_tab.email_id,users_tab.first_name,product_tab.o_quantity,
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
		}if (isset($floor_number) && !empty($floor_number)) {
			$this->db->where('users_tab.flat_door_no',$floor_number);
		}
		

		$this->db->where('calender_tab.delivery_status',0);
		$this->db->order_by('apartment_tab.apartment_name');
		$this->db->order_by('block_tab.block_name');

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
		calender_tab.quantity,product_tab.o_quantity,

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
	public  function get_milk_orders_list($order_ids){
		$this->db->select('calender_id,order_id,payment_img')->from('calender_tab');
		$this->db->where('order_id',$order_ids);
		return $this->db->get()->result_array();
	}
	public  function update_payment_details($c_id,$data){
		$this->db->where('calender_tab.calender_id',$c_id);
		return $this->db->update('calender_tab',$data);
	}
	public  function delete_irder_id($order_id){
		$this->db->where('order_tab.order_id',$order_id);
		return $this->db->delete('order_tab');
	}
	public function get_month_milk_list($yr,$mon,$num){

		$this->db->select('product_tab.product_id,product_tab.net_price,product_tab.product_nick_name,calender_tab.calender_id,calender_tab.year,calender_tab.date,calender_tab.month,
		calender_tab.quantity,(calender_tab.price)*(calender_tab.quantity) as price ,calender_tab.delivery_status,calender_tab.created_date,
		calender_tab.payment_type,
		product_tab.product_name,users_tab.email_id,users_tab.first_name,product_tab.o_quantity,
		users_tab.last_name,users_tab.user_name,users_tab.email_id,apartment_tab.apartment_name,block_tab.block_name,users_tab.flat_door_no,
	users_tab.phone_number,
		calender_tab.delivered_time,calender_tab.cancelled_time,calender_tab.payment_status,calender_tab.payment_img,calender_tab.payment_date,calender_tab.order_id');
		$this->db->from('calender_tab');
		//$this->db->join('billing_tab','calender_tab.billing_id=billing_tab.id');
		$this->db->join('product_tab','product_tab.product_id=calender_tab.product_id');
		$this->db->join('users_tab','users_tab.id=calender_tab.user_id');
		$this->db->join('apartment_tab','apartment_tab.apartment_id=users_tab.appartment','left');
		$this->db->join('block_tab','block_tab.block_id=users_tab.block','left');



					$this->db->where('calender_tab.month',$mon);
			$this->db->where('users_tab.phone_number',$num);
			$this->db->where('calender_tab.year',$yr);


		$this->db->order_by('apartment_tab.apartment_name');
		$this->db->order_by('block_tab.block_name');
		$this->db->order_by('calender_tab.year','desc');
		$this->db->order_by('calender_tab.month','desc');
		$this->db->order_by('calender_tab.date','desc');
		$this->db->order_by('users_tab.id','desc');

		return $this->db->get()->result();
	}
	public function get_month_amount($yr,$mon,$num){
		$this->db->select('sum(c.price*c.quantity) total')->from('calender_tab c')->join('users_tab u' ,'c.user_id=u.id')->where('year',$yr)->where('month',$mon)->where('phone_number',$num)->where('delivery_status !=',3);
		return $this->db->get()->row_array();


	}
	public function get_month_paid_amount($yr,$mon,$num){
		$this->db->select('sum(c.price*c.quantity) total')->from('calender_tab c')->join('users_tab u' ,'c.user_id=u.id')->where('year',$yr)->where('month',$mon)->where('phone_number',$num)->where('delivery_status !=',3)->where('payment_status',1)->where('admin_accept_status',1);
		return $this->db->get()->row_array();


	}
	public function get_month_unpaid_amount($yr,$mon,$num){
		$this->db->select('sum(c.price*c.quantity) total')->from('calender_tab c')->join('users_tab u' ,'c.user_id=u.id')->where('year',$yr)->where('month',$mon)->where('phone_number',$num)->where('delivery_status !=',3)->where('payment_status',0);
		return $this->db->get()->row_array();
	}
	public function get_month_wise_brand($yr,$mon,$num){
		$this->db->select('p.product_id,p.product_nick_name')->from('calender_tab c');
		$this->db->join('users_tab u' ,'c.user_id=u.id');
		$this->db->join('product_tab p' ,'p.product_id=c.product_id');
		$this->db->where('year',$yr);
		$this->db->where('month',$mon);
		$this->db->where('phone_number',$num);
		$this->db->where('delivery_status !=',3);
		$this->db->where('payment_status',0);
		$this->db->group_by('c.product_id');
		$return=$this->db->get()->result_array();
		foreach($return as $lis){
			$p_q_list=$this->get_brand_wise_qty($yr,$mon,$num,$lis['product_id']);
			$b_total=$this->get_brand_wise_total($yr,$mon,$num,$lis['product_id']);
			$data[$lis['product_id']]=$lis;
			$data[$lis['product_id']]['qty']=$p_q_list['total'];
			$data[$lis['product_id']]['b_total']=$b_total['total'];
			
		}
		if(!empty($data)){
			return $data;
		}
	}
	
	public  function get_brand_wise_qty($yr,$mon,$num,$pid){
		$this->db->select('sum(c.quantity) total')->from('calender_tab c')->join('users_tab u' ,'c.user_id=u.id')->where('year',$yr)->where('month',$mon)->where('phone_number',$num)->where('product_id',$pid)->where('delivery_status !=',3)->where('payment_status',0);
		return $this->db->get()->row_array();
	}
	public function get_brand_wise_total($yr,$mon,$num,$pid){
		$this->db->select('sum(c.price*c.quantity) total')->from('calender_tab c')->join('users_tab u' ,'c.user_id=u.id')->where('year',$yr)->where('month',$mon)->where('phone_number',$num)->where('product_id',$pid)->where('delivery_status !=',3)->where('payment_status',0);
		return $this->db->get()->row_array();
	}

}
