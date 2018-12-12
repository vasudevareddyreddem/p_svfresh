<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobile_model extends CI_Model

{
	function __construct()
	{
		parent::__construct();
		$this->load->database("default");
	}
	public function category_list(){
		$this->db->select('*');
	  $this->db->from('category_tab');
	   $this->db->where('status',1);
	   
	   $this->db->order_by('updated_at','desc');
	   return $this->db->get()->result_array();


	}
	public function user_checking($userid){
		
		$this->db->select('*')->from('users_tab')->where('id',$userid);
		return $this->db->get()->result()?1:0;
		
	}
	public function subcategory_list($cat){
			$this->db->select('*');
	  $this->db->from('subcat_tab');
	   $this->db->where('status',1);
	    $this->db->where('cat_id',$cat);
	   $this->db->order_by('updated_at','desc');
	   return $this->db->get()->result_array();
		
		
	}
	public function product_list($cat,$subcat){
			$this->db->select('*');
	  $this->db->from('product_tab');
	   $this->db->where('status',1);
	    $this->db->where('cat_id',$cat);
		$this->db->where('subcat_id',$subcat);
	   $this->db->order_by('updated_at','desc');
	   return $this->db->get()->result_array();
		
		
	}
	public function home_slider_two_images(){
		$this->db->select('*')->from('slider_tab')->where('status',1);
	return	$this->db->get()->row_array();
		
		
	}
	public function home_sliders($id){
			$this->db->select('*')->from('slider_pic_tab')->where('status',1)->where('slider_id',$id);
	return	$this->db->get()->result_array();
		
		
	}
	public function get_all_products(){
		$this->db->select('product_tab.product_id,product_tab.product_name,product_img,category_tab.*')->from('product_tab')->
		join('category_tab','category_tab.cat_id=product_tab.cat_id')->order_by('updated_at,cat_id','desc');
		return $this->db->get()->result_array();
	}
	
	
	}
	