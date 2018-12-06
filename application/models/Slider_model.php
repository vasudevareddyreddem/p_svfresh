<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slider_model extends CI_Model

{
	function __construct()
	{
		parent::__construct();
		$this->load->database("default");
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
		//return $this->db->get_where('slider_pic_tab',array('status','1'))->result();
		$this->db->select('sp.pic_name');
		$this->db->from('slider_tab s');
		$this->db->join('slider_pic_tab sp','s.slider_id = sp.slider_id','left');
		return $this->db->where('s.status','1')->get()->result();
		//return $this->db->last_query();
		//SELECT * FROM slider_tab AS s LEFT JOIN slider_pic_tab AS sp ON s.slider_id = sp.slider_id WHERE s.status = '1'
	}

	

	public function get_sliders(){
		$this->db->select('*');
		$this->db->from('slider_tab');
		$this->db->where('status',1);
		$this->db->or_where('status',2);
		$this->db->order_by('updated_at');
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
		$this->db->where('slider_id',$id);
		return $this->db->get()->result();

	}
}


