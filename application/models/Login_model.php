<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	public function logincheck($userid, $password){
     $this->db->select('*');
	  $this->db->from('admin_tab');
	  $this->db->where('login_email',$userid);
	  $this->db->where('password',$password);
	  return $this->db->get()->row_array();
	
	}
	public function save_edit_profile($data,$id){
		$this->db->where('admin_id',$id);
		$this->db->update('admin_tab',$data);
		 return $this->db->affected_rows()?1:0;
	}
public function	get_admin_details($svadmin){
	$this->db->select('*');
	$this->db->from('admin_tab');
	$this->db->where('admin_id',$svadmin);
	return $this->db->get()->row_array();
}
public  function get_email_details_check($email){
	  $this->db->select('*')->from('admin_tab');
	  $this->db->where('login_email',$email);
	  return $this->db->get()->row_array();
	}


	}