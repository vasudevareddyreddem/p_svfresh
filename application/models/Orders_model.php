<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders_model extends CI_Model

{
	function __construct()
	{
		parent::__construct();
		$this->load->database("default");
	}
	public function total_order_list(){
		$this->db->select('order_tab.order_id  order_id,order_items_tab.product_name,order_items_tab.order_number,order_items_tab.quantity,
		order_items_tab.net_price,order_tab.payment_type,order_items_tab.status,order_items_tab.created_date,
		order_items_tab.delivered_time,order_items_tab.cancelled_time,users_tab.phone_number,
		billing_tab.*')->from('order_tab')->
		join('order_items_tab','order_items_tab.order_id=order_tab.order_id')->
		join('billing_tab','order_tab.billing_id=billing_tab.id')->join('users_tab','users_tab.id=billing_tab.user_id')
		->order_by('order_tab.updated_date','desc');
		
	
		return $this->db->get()->result();;
	}
	public function pending_order_list(){
		$this->db->select('order_tab.id order_id,order_tab.product_name,order_tab.order_number,order_tab.quantity,
		order_tab.net_price,order_tab.payment_type,order_tab.order_status,order_tab.created_date,
		order_tab.delivered_time,order_tab.cancelled_time,users_tab.phone_number,
		billing_tab.*')->from('order_tab')->
		join('billing_tab','order_tab.billing_id=billing_tab.id')->join('users_tab','users_tab.id=billing_tab.user_id')
		->where('order_tab.order_status',2)->order_by('order_tab.updated_date','desc');
		
	
		return $this->db->get()->result();;
		
	}
	public function delivered_order_list(){
		$this->db->select('order_tab.id order_id,order_tab.product_name,order_tab.order_number,order_tab.quantity,
		order_tab.net_price,order_tab.payment_type,order_tab.order_status,order_tab.created_date,
		order_tab.delivered_time,order_tab.cancelled_time,users_tab.phone_number,
		billing_tab.*')->from('order_tab')->
		join('billing_tab','order_tab.billing_id=billing_tab.id')->join('users_tab','users_tab.id=billing_tab.user_id')
		->where('order_tab.order_status',1)->order_by('order_tab.updated_date','desc');
		
	
		return $this->db->get()->result();;
		
	}
	public function cancel_order_list(){
		$this->db->select('order_tab.id order_id,order_tab.product_name,order_tab.order_number,order_tab.quantity,
		order_tab.net_price,order_tab.payment_type,order_tab.order_status,order_tab.created_date,
		order_tab.delivered_time,order_tab.cancelled_time,users_tab.phone_number,
		billing_tab.*')->from('order_tab')->
		join('billing_tab','order_tab.billing_id=billing_tab.id')->join('users_tab','users_tab.id=billing_tab.user_id')
		->where('order_tab.order_status',0)->order_by('order_tab.updated_date','desc');
		
	
		return $this->db->get()->result();;
		
	}
	public function change_to_delivery_status($id,$svadmin){
		$this->db->set('order_status',1);
		$this->db->set('updated_by',$svadmin);
		$this->db->set('delivered_time','now()',FALSE);
		$this->db->where('id',$id);
		$this->db->update('order_tab');
		
		return $this->db->affected_rows()?1:0;
	}
	public function change_to_cancel_status($id,$svadmin){	
		$this->db->set('order_status',0);
		$this->db->set('updated_by',$svadmin);
		$this->db->set('cancelled_time','now()',FALSE);
		$this->db->where('id',$id);
		$this->db->update('order_tab');
		
		return $this->db->affected_rows()?1:0;
	}
	public function change_to_pending_status($id,$svadmin){	
		$this->db->set('order_status',2);
		$this->db->set('updated_by',$svadmin);
		
		$this->db->where('id',$id);
		$this->db->update('order_tab');
		
		return $this->db->affected_rows()?1:0;
	}
	
	}