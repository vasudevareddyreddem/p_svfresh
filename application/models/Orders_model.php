<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders_model extends CI_Model

{
	function __construct()
	{
		parent::__construct();
		$this->load->database("default");
	}
	public function total_order_list(){
		
		$this->db->select('order_tab.product_name,order_tab.order_number,order_tab.quantity,
		order_tab.net_price,order_tab.payment_type,order_tab.order_status,order_tab.created_date,
		order_tab.delivered_time,order_tab.cancelled_time,users_tab.phone_number,
		billing_tab.*')->from('order_tab')
		->join('users_tab','users_tab.id=order_tab.user_id')->
		join('billing_tab','users_tab.id=billing_tab.user_id')->order_by('order_tab.updated_date');
		return $this->db->get()->result();
	}
	public function pending_order_list(){
		$this->db->select('order_tab.product_name,order_tab.order_number,order_tab.quantity,
		order_tab.net_price,order_tab.payment_type,order_tab.order_status,order_tab.created_date,
		order_tab.delivered_time,order_tab.cancelled_time,users_tab.phone_number,
		billing_tab.*')->from('order_tab')
		->join('users_tab','users_tab.id=order_tab.user_id')->
		join('billing_tab','users_tab.id=billing_tab.user_id')->order_by('order_tab.updated_date')
		->where('order_tab.order_status',2);
		return $this->db->get()->result();
		
	}
	public function delivered_order_list(){
		$this->db->select('order_tab.product_name,order_tab.order_number,order_tab.quantity,
		order_tab.net_price,order_tab.payment_type,order_tab.order_status,order_tab.created_date,
		order_tab.delivered_time,order_tab.cancelled_time,users_tab.phone_number,
		billing_tab.*')->from('order_tab')
		->join('users_tab','users_tab.id=order_tab.user_id')->
		join('billing_tab','users_tab.id=billing_tab.user_id')->order_by('order_tab.updated_date')
		->where('order_tab.order_status',1);
		return $this->db->get()->result();
		
	}
	}