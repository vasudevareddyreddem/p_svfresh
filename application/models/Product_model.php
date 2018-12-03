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
	public function save_product($data){
		
		$this->db->insert('product_tab',$data);
		   $insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function save_features($data){
		$this->db->insert_batch('features_tab',$data);
		return $this->db->affected_rows()?1:0;
		
	}
	public function get_product_list(){
			$this->db->select('product_tab.product_id,product_tab.product_name,product_tab.product_img,
			product_tab.actual_price,product_tab.discount_price,product_tab.status,product_tab.net_price,
			product_tab.created_at,product_tab.quantity,
			category_tab.cat_name,subcat_tab.subcat_name');
	  $this->db->from('product_tab');
	  $this->db->join('category_tab','category_tab.cat_id=product_tab.cat_id');
	  $this->db->join('subcat_tab','subcat_tab.subcat_id=product_tab.subcat_id');
	  $this->db->where('product_tab.status',1);
	  $this->db->or_where('product_tab.status',2);
	  $this->db->order_by('product_tab.updated_at');
	 return $this->db->get()->result();
		
		
		
	}
	public function edit_product($pid){
			$this->db->select('product_tab.product_id,product_tab.product_name,product_tab.product_img,
			product_tab.actual_price,product_tab.discount_price,product_tab.status,product_tab.net_price,
			product_tab.created_at,product_tab.quantity,product_tab.cat_id,product_tab.subcat_id
			');
	  $this->db->from('product_tab');
	  $this->db->where('product_tab.product_id',$pid);
	 $this->db->group_start();
	  $this->db->where('product_tab.status',1);
	  $this->db->or_where('product_tab.status',2);
	   $this->db->group_end();
	  
	 return $this->db->get()->row();
		
		
}
public function get_features($pid){
	$this->db->select('feature_id,feature_name,feature_value');
	  $this->db->from('features_tab');
	  $this->db->where('features_tab.product_id',$pid);
	 return $this->db->get()->result();
}

	}