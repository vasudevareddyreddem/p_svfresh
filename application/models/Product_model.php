<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	public function get_sub_category_names($id){
		$this->db->select('subcat_id,subcat_name');
	  $this->db->from('subcat_tab');
	  $this->db->where('cat_id',$id);
	   $this->db->group_start();
	 $this->db->where('status',1);
	   $this->db->or_where('status',2);
	    $this->db->group_end();
	   $this->db->order_by('updated_at');
	   return $this->db->get()->result_array();
		
	}
	}