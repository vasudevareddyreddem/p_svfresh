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
	   $this->db->where('cat_name',$name);
	   $this->db->where('status',1);

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
	 
	}