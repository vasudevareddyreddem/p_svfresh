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
calender_tab.quantity,calender_tab.price,calender_tab.delivery_status,product_tab.product_name')->from('calender_tab')->
		join('billing_tab','calender_tab.billing_id=billing_tab.billing_id')
		->join('product_tab','product_tab.product_id=calender_tab.product_id')
	}
	}