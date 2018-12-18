<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Milkorders_model extends CI_Model

{
	function __construct()
	{
		parent::__construct();
		$this->load->database("default");
	}
	public function total_order_list()
	{
		$this->db->select('calender_tab.calender_id,calender_tab.year,calender_tab.date,calender_tab.month,
calender_tab.quantity,calender_tab.price,calender_tab.delivery_status,calender_tab.created_date,
calender_tab.payment_type,
product_tab.product_name,users_tab.email_id,billing_tab.first_name,
billing_tab.last_name,billing_tab.company_name,billing_tab.email_address,billing_tab.address,
billing_tab.city,billing_tab.state,billing_tab.zip,billing_tab.country,billing_tab.telephone,
users_tab.phone_number')->from('calender_tab')->
		join('billing_tab','calender_tab.billing_id=billing_tab.id')
		->join('product_tab','product_tab.product_id=calender_tab.product_id')
		->join('users_tab','product_tab.product_id=calender_tab.product_id')
		->order_by('calender_tab.created_date,users_tab.id');
		
		return $this->db->get()->result();
	}
	public function pending_order_list(){
		$this->db->select('calender_tab.calender_id,calender_tab.year,calender_tab.date,calender_tab.month,
calender_tab.quantity,calender_tab.price,calender_tab.delivery_status,calender_tab.created_date,
calender_tab.payment_type,
product_tab.product_name,users_tab.email_id,billing_tab.first_name,
billing_tab.last_name,billing_tab.company_name,billing_tab.email_address,billing_tab.address,
billing_tab.city,billing_tab.state,billing_tab.zip,billing_tab.country,billing_tab.telephone,
users_tab.phone_number')->from('calender_tab')->
		join('billing_tab','calender_tab.billing_id=billing_tab.id')
		->join('product_tab','product_tab.product_id=calender_tab.product_id')
		->join('users_tab','product_tab.product_id=calender_tab.product_id')->where('delivery_status',2)
		->order_by('calender_tab.created_date,users_tab.id');;
		return $this->db->get()->result();
	}
	public function delivered_order_list(){
		$this->db->select('calender_tab.calender_id,calender_tab.year,calender_tab.date,calender_tab.month,
calender_tab.quantity,calender_tab.price,calender_tab.delivery_status,calender_tab.created_date,
calender_tab.payment_type,
product_tab.product_name,users_tab.email_id,billing_tab.first_name,
billing_tab.last_name,billing_tab.company_name,billing_tab.email_address,billing_tab.address,
billing_tab.city,billing_tab.state,billing_tab.zip,billing_tab.country,billing_tab.telephone,
users_tab.phone_number')->from('calender_tab')->
		join('billing_tab','calender_tab.billing_id=billing_tab.id')
		->join('product_tab','product_tab.product_id=calender_tab.product_id')
		->join('users_tab','product_tab.product_id=calender_tab.product_id')->where('delivery_status',1)
		->order_by('calender_tab.created_date,users_tab.id');;
		return $this->db->get()->result();
	}
	}
	