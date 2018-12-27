<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apartment_model extends CI_Model

{
    function __construct()
    {
        parent::__construct();
        $this->load->database("default");
    }
    public function check_apartment_name($name){
        $this->db->select('1')->from('apartment_tab')->where('apartment_name',$name);
        $res=$this->db->get()->result();
        if(count($res)>0){
            return 1;

        }
        return 0;
    }
    public function save_apartment($data){
        $this->db->insert('apartment_tab',$data);
        return $this->db->affected_rows()?1:0;
    }
    public function get_all_apartments(){
        $this->db->select('apartment_id,apartment_name,created_date,status')->from('apartment_tab');
        return $this->db->get()->result();
    }
}