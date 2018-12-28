<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminuser_model extends CI_Model

{
    function __construct()
    {
        parent::__construct();
        $this->load->database("default");
    }

    public function get_user_list(){
        $this->db->select('*')->from('users_tab')->where('created_by is NOT NULL', NULL, FALSE)->where('status !=',0);
      return  $this->db->get()->result();

    }
    }