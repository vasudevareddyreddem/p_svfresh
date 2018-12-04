<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model

{
	function __construct()
	{
		parent::__construct();
		$this->load->database("default");
	}
	public function category_name_check($name){
     $this->db->select('1');
	  $this->db->from('category_tab');
	  $this->db->where('cat_name',$name);
	  $this->db->group_start();
	  $this->db->where('status',1);
	  $this->db->or_where('status',2);
	  $this->db->group_end();


	  return $this->db->get()->result()?1:0;

	}
	public function insert_category($data){

	return 	$this->db->insert('category_tab',$data)?1:0;
	}
	public function category_list(){
		$this->db->select('*');
	  $this->db->from('category_tab');
	   $this->db->where('status',1);
	   $this->db->or_where('status',2);
	   $this->db->order_by('updated_at');
	   return $this->db->get()->result();


	}
	public function inactive_category($id){
		$this->db->set('status',2);
		$this->db->where('cat_id',$id);
		$this->db->update('category_tab');
		return $this->db->affected_rows()?1:0;
	}
	public function active_category($id){
		$this->db->set('status',1);
		$this->db->where('cat_id',$id);
		$this->db->update('category_tab');
		return $this->db->affected_rows()?1:0;
	}
	public function delete_category($id){
		$this->db->set('status',0);
		$this->db->where('cat_id',$id);
		$this->db->update('category_tab');
		return $this->db->affected_rows()?1:0;
	}
	public function get_category($id){
		$this->db->select('*');
	    $this->db->from('category_tab');
		$this->db->group_start();
		$this->db->where('cat_id',$id);
		$this->db->group_start();
	   $this->db->where('status',1);
	   $this->db->or_where('status',2);
	   $this->db->group_end();
	   $this->db->group_end();
	   $result=$this->db->get()->row();
	   return  $result;

	}
	public function category_edit_name_check($cid,$catname){
		$this->db->select('*');
	    $this->db->from('category_tab');
		$this->db->group_start();
		$this->db->where('cat_id !=',$cid);
		$this->db->group_start();
	   $this->db->where('status',1);
	   $this->db->or_where('status',2);
	   $this->db->group_end();
	   $this->db->group_end();

	   $cnames= $this->db->get()->result_array();

			$cat_names = array_column($cnames, 'cat_name');
			//echo $catname;exit;
			//echo in_array($catname,$cat_names);exit;
			if(in_array($catname,$cat_names)){

			return 1;
			}
			else{
				return 0;
			}
	 }
	 public function subcategory_name_check($name,$id){
		 $this->db->select('1');
	  $this->db->from('subcat_tab');
	  $this->db->group_start();
	  $this->db->where('subcat_name',$name);
	  $this->db->where('cat_id',$id);
	   $this->db->group_end();
	    $this->db->group_start();
	  $this->db->where('status',1);
	  $this->db->or_where('status',2);
	   $this->db->group_end();


	  return $this->db->get()->result()?1:0;
		 
	 }
	 public function edit_category($cid,$data){
		 $this->db->where('cat_id',$cid);
		 $this->db->update('category_tab',$data);
		 return $this->db->affected_rows()?1:0;

	 }
	 public function get_category_names(){
		$this->db->select('cat_id,cat_name');
	  $this->db->from('category_tab');
	   $this->db->where('status',1);
	   $this->db->or_where('status',2);
	   $this->db->order_by('updated_at');
	   return $this->db->get()->result();


	}
	public function save_sub_category($data){
		$this->db->insert('subcat_tab',$data);
		return $this->db->affected_rows()?1:0;
	}
	//getting all category with active status--Rana
	public function get_all_category()
	{
		return $this->db->get_where('category_tab',array('status' => '1'))->result();
	}
	public function get_subcategory_list(){
			$this->db->select('subcat_tab.subcat_id,subcat_tab.subcat_name,subcat_tab.subcat_img,
			subcat_tab.status,subcat_tab.created_at,category_tab.cat_name,
			count(product_tab.product_name) countproduct');
	  $this->db->from('subcat_tab');
	  $this->db->join('category_tab','category_tab.cat_id=subcat_tab.cat_id');
	  $this->db->join('product_tab','product_tab.subcat_id=subcat_tab.subcat_id','left');
	   $this->db->where('subcat_tab.status',1);
	   $this->db->or_where('subcat_tab.status',2);
	   $this->db->group_by('subcat_tab.subcat_id,subcat_tab.subcat_name,subcat_tab.subcat_img,
			subcat_tab.status,subcat_tab.updated_at,category_tab.cat_name');
	   $this->db->order_by('subcat_tab.updated_at');
	   return $this->db->get()->result();
		
	}
	public function inactive_subcategory($id){
		$this->db->set('status',2);
		$this->db->where('subcat_id',$id);
		$this->db->update('subcat_tab');
		return $this->db->affected_rows()?1:0;
	}
	public function active_subcategory($id){
		$this->db->set('status',1);
		$this->db->where('subcat_id',$id);
		$this->db->update('subcat_tab');
		return $this->db->affected_rows()?1:0;
	}
	public function get_subcategory($scid){
		$this->db->select('*');
	    $this->db->from('subcat_tab');
		$this->db->group_start();
		$this->db->where('subcat_id',$scid);
		$this->db->group_end();
		$this->db->group_start();
	   $this->db->where('status',1);
	   $this->db->or_where('status',2);
	   $this->db->group_end();
	   
	   $result=$this->db->get()->row();
	   return  $result;
		
		
	}
	public function subcategory_editname_check($scname,$cid,$scid){
		$this->db->select('*');
	    $this->db->from('subcat_tab');
		$this->db->group_start();
		$this->db->where('subcat_id !=',$scid);
		$this->db->where('cat_id ',$cid);
		$this->db->group_start();
	   $this->db->where('status',1);
	   $this->db->or_where('status',2);
	   $this->db->group_end();
	   $this->db->group_end();

	   $subnames= $this->db->get()->result_array();

			$scat_names = array_column($subnames, 'subcat_name');
			//echo $catname;exit;
			//echo in_array($catname,$cat_names);exit;
			if(in_array($scname,$scat_names)){

			return 1;
			}
			else{
				return 0;
			}
	}
	public function save_editsub_category($data,$scid){
		$this->db->where('subcat_id',$scid);
		$this->db->update('subcat_tab',$data);
		return $this->db->affected_rows()?1:0;
		
	}
	public function delete_subcategory($id){
		$this->db->set('status',0);
		$this->db->where('subcat_id',$id);
		$this->db->update('subcat_tab');
		return $this->db->affected_rows()?1:0;
	}

	}
