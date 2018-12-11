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
			product_tab.actual_price,product_tab.discount_price,product_tab.status,product_tab.net_price,product_tab.description,
			product_tab.created_at,product_tab.quantity,product_tab.cat_id,product_tab.subcat_id,product_tab.discount_percentage
			');
	  $this->db->from('product_tab');

	  $this->db->where('product_tab.product_id',$pid);
	 $this->db->group_start();
	  $this->db->where('product_tab.status',1);
	  $this->db->or_where('product_tab.status',2);
	   $this->db->group_end();

	 return $this->db->get()->row();


}
public function save_edit_product($data,$pid){
	$this->db->where('product_id',$pid);
	$this->db->update('product_tab',$data);

	return $this->db->affected_rows()?1:0;

}
public function get_features($pid){
	$this->db->select('feature_id,feature_name,feature_value');
	  $this->db->from('features_tab');
	  $this->db->where('features_tab.product_id',$pid);
	   $this->db->where('status',1);
	 return $this->db->get()->result();
}
public function save_edit_features($up_features,$fid){
	 $this->db->where('feature_id',$fid);
	$this->db->update('features_tab',$up_features);

}
public function delete_features($value){
	$this->db->set('status',0);
	$this->db->where('feature_id',$value);
	$this->db->update('features_tab');

}
public function get_features_array($pid){
	$this->db->select('feature_id,feature_name,feature_value');
	  $this->db->from('features_tab');
	  $this->db->where('features_tab.product_id',$pid);
	 return $this->db->get()->result_array();
}
public function check_unique_product($pname,$cat_id,$subcat_id)
{
    $this->db->select('1');
	  $this->db->from('product_tab');
	  $this->db->group_start();
	  $this->db->where('product_name',$pname);
	  $this->db->where('subcat_id',$subcat_id);
	  $this->db->where('cat_id',$cat_id);
	   $this->db->group_end();
	    $this->db->group_start();
	  $this->db->where('status',1);
	  $this->db->or_where('status',2);
	   $this->db->group_end();


	  return $this->db->get()->result()?1:0;
}
public function check_unique_edit_product($pid,$pname,$cat_id,$subcat_id){
	$this->db->select('*');
	    $this->db->from('product_tab');
		$this->db->group_start();
		$this->db->where('product_id !=',$pid);
		$this->db->where('cat_id ',$cat_id);
		$this->db->where('subcat_id ',$subcat_id);
		$this->db->group_end();
		$this->db->group_start();
	   $this->db->where('status',1);
	   $this->db->or_where('status',2);
	   $this->db->group_end();

}
//getting all product with active status--Rana
public function get_all_product()
{
	return $this->db->get_where('product_tab',array('status' => '1'))->result();
}
//getting products with sub category id--Rana
public function get_products_by_sub_category($id='')
{
	$this->db->select('*');
	$this->db->from('product_tab');
	$this->db->where('subcat_id',$id);
	$this->db->where('status','1');
	return $this->db->get()->result();
}
//getting products with product id--Rana
public function get_product_by_id($id='')
{
	return $this->db->get_where('product_tab',array('product_id' => $id,'status' => '1'))->row();
}
public function delete_product($id){
	$this->db->set('status',0);
		$this->db->where('product_id',$id);
		$this->db->update('product_tab');
		return $this->db->affected_rows()?1:0;

}
public function save_product_images($pdata){
	$this->db->insert_batch('product_images_tab',$pdata);
	return $this->db->affected_rows()?1:0;
}
public function get_product_images($pid){

	$this->db->select('*');
	$this->db->from('product_images_tab');
	$this->db->where('product_id',$pid);
	$this->db->where('status',1);
	return $this->db->get()->result();
}
public function get_rel_products($cat_id,$subcat_id){

	$this->db->select('*');
	$this->db->from('product_tab');
	$this->db->join('subcat_tab','product_tab.subcat_id=subcat_tab.subcat_id');
	$this->db->join('category_tab','product_tab.cat_id=category_tab.cat_id');
	$this->db->group_start();
	$this->db->where('category_tab.cat_id',$cat_id);
	$this->db->where('subcat_tab.subcat_id',$subcat_id);
	$this->db->group_end();
	$this->db->group_start();

    $this->db->where('product_tab.status',1);
	$this->db->or_where('product_tab.status',2);
	$this->db->group_end();
return $this->db->get()->result();
}
public function save_rel_products($rdata){
	$this->db->insert_batch('rel_products_tab',$rdata);
	return $this->db->affected_rows()?1:0;

}
public function get_rel_proudcts_by_id($pid){

	$this->db->select('*');
	$this->db->from('rel_products_tab');
	$this->db->where('product_id',$pid);

	$this->db->where('status',1);


 $rel_pro= $this->db->get()->result_array();
 $rel_proids = array_column($rel_pro, 'rel_product_id');
 return $rel_proids;

}
public function get_images_array($pid){
	$this->db->select('image_id,image_name');
	  $this->db->from('product_images_tab');
	  $this->db->where('product_id',$pid);
	  $this->db->where('status',1);
	 return $this->db->get()->result_array();
}
public function save_edit_product_images($pdata,$value){
	$this->db->where('image_id',$value);
	$this->db->update('product_images_tab',$pdata);
	return $this->db->affected_rows()?1:0;
}
public function save_delete_product_images($value){
	$this->db->set('status',0);
	$this->db->where('image_id',$value);
	$this->db->update('product_images_tab');
	return $this->db->affected_rows()?1:0;
}

public function delete_rel_products($pid){
	$this->db->set('status',2);
	$this->db->where('product_id',$pid);
	$this->db->update('rel_products_tab');
	return $this->db->affected_rows()?1:0;
}
public function get_related_products_by_prdouct($product_id=''){
	$this->db->select('p.product_id,p.product_img,p.product_name,p.net_price,p.discount_price');
	$this->db->from('product_tab AS p');
	$this->db->join('rel_products_tab AS rp','p.product_id = rp.product_id','left');
	$this->db->where('p.product_id',$product_id);
	return $this->db->where('rp.status','1')->get()->result();
	//SELECT p.product_img,p.product_name,p.actual_price,p.discount_price FROM product_tab AS p LEFT JOIN rel_products_tab AS rp ON p.product_id = rp.product_id WHERE p.product_id = '29'

}
public function get_product_feature_by_product($product_id='')
{
	$this->db->select('f.feature_id,f.feature_name,f.feature_value');
	$this->db->from('features_tab AS f');
	$this->db->join('product_tab AS p','f.product_id = p.product_id','left');
	$this->db->where('p.product_id',$product_id);
	return $this->db->where('f.status','1')->get()->result();
	//SELECT f.feature_id,f.feature_name,f.feature_value FROM features_tab AS f LEFT JOIN product_tab AS p ON f.product_id = p.product_id WHERE p.product_id = '29'
}

	}
