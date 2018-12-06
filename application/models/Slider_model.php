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
	}