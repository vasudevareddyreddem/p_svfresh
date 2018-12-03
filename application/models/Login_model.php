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
	}