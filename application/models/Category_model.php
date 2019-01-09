<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model

{
	function __construct()
	{
		parent::__construct();
		$this->load->database("default");
        $this->db->query("SET time_zone='+5:30'");
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
	   $this->db->order_by('updated_at','desc');
	   return $this->db->get()->result();


	}
	public function inactive_category($id,$svadmin){
		$this->db->set('status',2);
		$this->db->set('updated_by',$svadmin);
		$this->db->where('cat_id',$id);
		$this->db->update('category_tab');
		return $this->db->affected_rows()?1:0;
	}
	public function active_category($id,$svadmin){
		$this->db->set('status',1);
		$this->db->set('updated_by',$svadmin);
		$this->db->where('cat_id',$id);
		$this->db->update('category_tab');
		return $this->db->affected_rows()?1:0;
	}
	public function delete_category($id,$svadmin){
		$this->db->set('status',0);
		$this->db->set('updated_by',$svadmin);
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
		//return $this->db->query("SELECT * FROM category_tab WHERE status = '1' AND cat_id IN (SELECT cat_id FROM product_tab WHERE `status` = '1')")->result();
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
	   $this->db->order_by('subcat_tab.updated_at','desc');
	   return $this->db->get()->result();

	}
	public function inactive_subcategory($id,$svadmin){
		$this->db->set('status',2);
				$this->db->set('updated_by',$svadmin);
		$this->db->where('subcat_id',$id);
		$this->db->update('subcat_tab');
		return $this->db->affected_rows()?1:0;
	}
	public function active_subcategory($id,$svadmin){
		$this->db->set('status',1);
				$this->db->set('updated_by',$svadmin);
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
	//getting sub categories for database based on category id -- Rana
	public function get_sub_category($id='')
	{
		$this->db->select('subcat_id,subcat_name,subcat_img');
		$this->db->from('subcat_tab');
		$this->db->where('cat_id',$id);
		$this->db->where('status','1');
		return $this->db->get()->result();
	}
	//getting categories name for database based on category id -- Rana
	public function get_category_name_by_id($id='')
	{
		$this->db->select('cat_name');
		$this->db->from('category_tab');
		$this->db->where('cat_id',$id);
		$this->db->where('status','1');
		return $this->db->get()->row();
	}
	//getting sub categories name for database based on sub category id -- Rana
	public function get_sub_category_name_by_id($id='')
	{
		$this->db->select('subcat_name');
		$this->db->from('subcat_tab');
		$this->db->where('subcat_id',$id);
		$this->db->where('status','1');
		return $this->db->get()->row();
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
	public function delete_subcategory($id,$svadmin){
		$this->db->set('status',0);
				$this->db->set('updated_by',$svadmin);
		$this->db->where('subcat_id',$id);
		$this->db->update('subcat_tab');
		return $this->db->affected_rows()?1:0;
	}
	public function update_discount_category($data,$cat_id){
		$this->db->where('cat_id',$cat_id);
		$this->db->update('category_tab',$data);
		return $this->db->affected_rows()?1:0;
	}
	public function save_subcat_slider($data){

		$this->db->insert('subcat_slider',$data);
		return $this->db->affected_rows()?1:0;
	}
	public function subcat_slider_list(){

	$this->db->select('subcat_tab.*,subcat_slider.*')->from('subcat_slider')->join('subcat_tab','subcat_tab.subcat_id=subcat_slider.subcat_id')->where('subcat_slider.status',1)
	->order_by('subcat_slider.updated_at,subcat_slider.subcat_id','desc');
	return $this->db->get()->result();
	}
	public function get_slider_image($id){
		$this->db->select('*')->from('subcat_slider')->join('subcat_tab','subcat_tab.subcat_id=subcat_slider.subcat_id')->join('category_tab','category_tab.cat_id=subcat_tab.cat_id')
		->where('id',$id)
		;
		return $this->db->get()->row();
	}
	public function update_subcat_slider($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('subcat_slider',$data);
		return $this->db->affected_rows()?1:0;

	}
	public function delete_slider_image($id){
		$this->db->where('id',$id);
		$this->db->set('status',0);
		$this->db->update('subcat_slider');
		return $this->db->affected_rows()?1:0;
	}
	public function get_category_name_by_subcat_id($id='')
	{
		return $this->db->query("SELECT cat_name FROM category_tab WHERE status = '1' AND cat_id IN (SELECT cat_id FROM subcat_tab WHERE subcat_id = $id)")->row();
	}

	public function get_cat_id_from_sub_cat_id($id='')
	{
		return $this->db->select('cat_id')->get_where('subcat_tab',array('subcat_id' => $id))->row()->cat_id;
	}
	}
