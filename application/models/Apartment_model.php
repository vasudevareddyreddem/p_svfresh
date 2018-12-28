<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apartment_model extends CI_Model

{
    function __construct()
    {
        parent::__construct();
        $this->load->database("default");
    }
    public function check_apartment_name($name){
        $this->db->select('1')->from('apartment_tab')->where('apartment_name',$name)->where('status !=',0);
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
        $this->db->select('apartment_id,apartment_name,created_date,status')->from('apartment_tab')->where('status !=',0)
        ->order_by('updated_date','desc');
        return $this->db->get()->result();
    }
    public function get_apartment_by_id($id){
        $this->db->select('apartment_id,apartment_name')->from('apartment_tab')->where('apartment_id',$id);
        return $this->db->get()->row();
    }
    public function check_edit_ap_name($name,$id){
        $this->db->select('*');
        $this->db->from('apartment_tab');

        $this->db->where('apartment_id!=',$id);
        $this->db->where('status !=',0);

        $res= $this->db->get()->result_array();

        $list = array_column($res, 'apartment_name');

        //echo $catname;exit;
        //echo in_array($catname,$cat_names);exit;
        if(in_array($name,$list)){

            return 1;
        }
        else{
            return 0;
        }


    }
    public function save_edit_apartment($data,$id){
        $this->db->where('apartment_id',$id);
        $this->db->update('apartment_tab',$data);
        return $this->db->affected_rows()?1:0;


    }
    public function inactive_apartment($data,$id){
        $this->db->where('apartment_id',$id);
        $this->db->update('apartment_tab',$data);
        return $this->db->affected_rows()?1:0;

    }
    public function active_apartment($data,$id){
        $this->db->where('apartment_id',$id);
        $this->db->update('apartment_tab',$data);
        return $this->db->affected_rows()?1:0;

    }
    public function delete_apartment($data,$id){
        $this->db->where('apartment_id',$id);
        $this->db->update('apartment_tab',$data);
        return $this->db->affected_rows()?1:0;

    }
    public function check_block_name($name){
        $this->db->select('1')->from('block_tab')->where('block_name',$name)->where('status !=',0);
        return $this->db->get()->result();
    }
    public function save_block_name($data){
        $this->db->insert('block_tab',$data);
        return $this->db->affected_rows()?1:0;

    }
}