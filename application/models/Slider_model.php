<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slider_model extends CI_Model

{
	function __construct()
	{
		parent::__construct();
		$this->load->database("default");
        $this->db->query("SET time_zone='+5:30'");

	}
	public function save_slider($data){
		$this->db->insert('slider_tab',$data);
		 $insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function save_slider_pics($sdata){
		$this->db->insert_batch('slider_pic_tab',$sdata);
		return 1;
	}
	public function slider_unique_check($sname){
		$this->db->select('1');
		$this->db->from('slider_tab');
		$this->db->where('slider_name',$sname);
		$this->db->group_start();
		$this->db->where('status',1);
		$this->db->or_where('status',2);
		$this->db->group_end();
		return $this->db->get()->result()?1:0;

	}
	// for getting slides in home page, code written by rana
	public function get_all_slides()
	{
		return $this->db->query('SELECT * FROM slider_pic_tab WHERE slider_id IN (SELECT slider_id FROM slider_tab WHERE status = "1" )')->result();
		//SELECT * FROM slider_tab AS s LEFT JOIN slider_pic_tab AS sp ON s.slider_id = sp.slider_id WHERE s.status = '1'
	}

	public function get_slides_side_images()
	{
		$this->db->select('slider_id,l_pic,r_pic');
		$this->db->from('slider_tab');
		return $this->db->where('status','1')->get()->row();
	}

	public function get_sliders(){
		$this->db->select('*');
		$this->db->from('slider_tab');
		$this->db->where('status',1);
		$this->db->or_where('status',2);
		$this->db->order_by('updated_at','desc');
		return $this->db->get()->result();
	}
	public function inactive_slider($id,$admin){
		$this->db->set('status',2);
		$this->db->set('updated_by',$admin);
		$this->db->where('slider_id',$id);
		$this->db->update('slider_tab');
		return $this->db->affected_rows()?1:0;
	}
	public function active_slider($id,$admin){
		$this->db->set('status',1);
		$this->db->set('updated_by',$admin);
		$this->db->where('slider_id',$id);
		$this->db->update('slider_tab');
		return $this->db->affected_rows()?1:0;
	}
	public function delete_slider($id,$admin){
		$this->db->set('status',0);
		$this->db->set('updated_by',$admin);
		$this->db->where('slider_id',$id);
		$this->db->update('slider_tab');
		return $this->db->affected_rows()?1:0;
	}
	public function all_inactive($admin){
		$this->db->set('status',2);
		$this->db->set('updated_by',$admin);
		$this->db->where('status',1);
		$this->db->update('slider_tab');

		return $this->db->affected_rows()?1:0;
	}
	public function get_single_slider($id){
		$this->db->select('*');
		$this->db->from('slider_tab');
		$this->db->where('slider_tab.slider_id',$id);
		return $this->db->get()->row();

	}
	public function get_slider_pics($sid){
		$this->db->select('*');
		$this->db->from('slider_pic_tab');
		$this->db->where('slider_id',$sid);

		$this->db->where('status',1);

		return $this->db->get()->result();

	}
	public function slider_edit_unique_check($slider_id,$s_name){
		$this->db->select('*');
	    $this->db->from('slider_tab');

		$this->db->where('slider_id !=',$slider_id);

		$this->db->group_start();
	   $this->db->where('status',1);
	   $this->db->or_where('status',2);
	   $this->db->group_end();


	   $result= $this->db->get()->result_array();


			$slider_names = array_column($result, 'slider_name');
			//echo $catname;exit;
			//echo in_array($catname,$cat_names);exit;
			if(in_array($s_name,$slider_names)){

			return 1;
			}
			else{
				return 0;
			}
	}
	public function save_edit_slider($data,$slider_id){

		$this->db->where('slider_id',$slider_id);
		$this->db->update('slider_tab',$data);
		return $this->db->affected_rows()?1:0;

	}
	public function save_edit_slider_images($pdata,$id){
		$this->db->where('pic_id',$id);
		$this->db->update('slider_pic_tab',$pdata);
		return $this->db->affected_rows()?1:0;

	}
	public function save_delete_slider_images($value){
		$this->db->where('pic_id',$value);
		$this->db->set('status',0);
		$this->db->update('slider_pic_tab');
		return $this->db->affected_rows()?1:0;

	}
	public  function remove_img($p_id){
		$this->db->where('pic_id',$p_id);
		return $this->db->delete('slider_pic_tab');
	}
}
