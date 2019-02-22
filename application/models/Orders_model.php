<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders_model extends CI_Model

{
	function __construct()
	{
		parent::__construct();
		$this->load->database("default");
        $this->db->query("SET time_zone='+5:30'");
	}
	public function total_order_list(){
		$this->db->select('order_items_tab.order_items_id   order_id,order_items_tab.product_name,order_items_tab.order_number,order_items_tab.quantity,
		order_items_tab.net_price,order_tab.payment_type,order_items_tab.delivery_status,order_items_tab.created_date,
		order_items_tab.delivered_time,order_items_tab.cancelled_time,users_tab.phone_number,users_tab.user_name,
		apartment_tab.apartment_name,block_tab.block_name,users_tab.flat_door_no,
		users_tab.email_id')->from('order_tab')->
		join('order_items_tab','order_items_tab.order_id=order_tab.order_id')->
		join('users_tab','order_tab.user_id=users_tab.id')
		->join('apartment_tab','apartment_tab.apartment_id=users_tab.appartment','left')
		->join('block_tab','block_tab.block_id=users_tab.block','left')
		//join('users_tab','users_tab.id=billing_tab.user_id')
		->order_by('order_tab.updated_date','desc');


		return $this->db->get()->result();
	}
	public function pending_order_list(){
	$this->db->select('order_items_tab.order_items_id  order_id,order_items_tab.product_name,order_items_tab.order_number,order_items_tab.quantity,
		order_items_tab.net_price,order_tab.payment_type,order_items_tab.delivery_status,order_items_tab.created_date,
		order_items_tab.delivered_time,order_items_tab.cancelled_time,users_tab.user_name,
		apartment_tab.apartment_name,block_tab.block_name,users_tab.flat_door_no,
		users_tab.email_id,users_tab.phone_number')->from('order_tab')->
		join('order_items_tab','order_items_tab.order_id=order_tab.order_id')->
		join('users_tab','order_tab.user_id=users_tab.id')->
		join('apartment_tab','apartment_tab.apartment_id=users_tab.appartment','left')
		->join('block_tab','block_tab.block_id=users_tab.block','left')->

		where('order_items_tab.delivery_status',2)
		->order_by('order_tab.created_date','desc');


		return $this->db->get()->result();

	}
	public function delivered_order_list(){
		$this->db->select('order_items_tab.order_items_id  order_id,order_items_tab.product_name,order_items_tab.order_number,order_items_tab.quantity,
		order_items_tab.net_price,order_tab.payment_type,order_items_tab.delivery_status,order_items_tab.created_date,
		order_items_tab.delivered_time,order_items_tab.cancelled_time,users_tab.user_name,
		apartment_tab.apartment_name,block_tab.block_name,users_tab.flat_door_no,
		users_tab.email_id,users_tab.phone_number')->from('order_tab')->
		join('order_items_tab','order_items_tab.order_id=order_tab.order_id')->
		join('users_tab','order_tab.user_id=users_tab.id')->
		join('apartment_tab','apartment_tab.apartment_id=users_tab.appartment','left')
		->join('block_tab','block_tab.block_id=users_tab.block','left')->where('order_items_tab.delivery_status',1)
		->order_by('order_tab.updated_date','desc');


		return $this->db->get()->result();

	}
	public function cancel_order_list(){
		$this->db->select('order_items_tab.order_items_id  order_id,order_items_tab.product_name,order_items_tab.order_number,order_items_tab.quantity,
		order_items_tab.net_price,order_tab.payment_type,order_items_tab.delivery_status,order_items_tab.created_date,
		order_items_tab.delivered_time,order_items_tab.cancelled_time,users_tab.user_name,
		apartment_tab.apartment_name,block_tab.block_name,users_tab.flat_door_no,
		users_tab.email_id,users_tab.phone_number')->from('order_tab')->
		join('order_items_tab','order_items_tab.order_id=order_tab.order_id')->
		join('users_tab','order_tab.user_id=users_tab.id')->
		join('apartment_tab','apartment_tab.apartment_id=users_tab.appartment','left')
		->join('block_tab','block_tab.block_id=users_tab.block','left')
		->where('order_items_tab.delivery_status',0)
		->order_by('order_tab.updated_date','desc');


		return $this->db->get()->result();

	}
	public function change_to_delivery_status($id,$svadmin){
		$this->db->set('delivery_status',1);
		$this->db->set('updated_by',$svadmin);
		$this->db->set('delivered_time','now()',FALSE);
		$this->db->where('order_items_id',$id);
		$this->db->update('order_items_tab');

		return $this->db->affected_rows()?1:0;
	}
	public function change_to_cancel_status($id,$svadmin){
		$this->db->set('delivery_status',0);
		$this->db->set('updated_by',$svadmin);
		$this->db->set('cancelled_time','now()',FALSE);
		$this->db->where('order_items_id',$id);
		$this->db->update('order_items_tab');

		return $this->db->affected_rows()?1:0;
	}
	public function change_to_pending_status($id,$svadmin){
		$this->db->set('delivery_status',2);
		$this->db->set('updated_by',$svadmin);


		$this->db->where('order_items_id',$id);
		$this->db->update('order_items_tab');

		return $this->db->affected_rows()?1:0;
	}

	}

	
	
	
	
