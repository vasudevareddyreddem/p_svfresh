<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model

{
	function __construct()
	{
		parent::__construct();
		$this->load->database("default");
	}
	public function check_loging($username){
		$this->db->select('*')->from('users_tab')->
		where('phone_number',$username)->or_where('email_id',$username);

		return $this->db->get()->row_array();
		
	}
	}