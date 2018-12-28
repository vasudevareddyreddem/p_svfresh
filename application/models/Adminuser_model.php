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
    public function get_user_by_id($id){
        $this->db->select('id,email_id,user_name,phone_number')->from('users_tab')->where('id',$id);
        return $this->db->get()->row();

    }
    public function check_edit_email($email,$id){
        $this->db->select('*');
        $this->db->from('users_tab');

        $this->db->where('email_id!=',$email);
        $this->db->where('id !=',$id);

        $this->db->where('status !=','deleted');

        $res= $this->db->get()->result_array();

        $list = array_column($res, 'email_id');

        //echo $catname;exit;
        //echo in_array($catname,$cat_names);exit;
        if(in_array($email,$list)){

            return 1;
        }
        else{
            return 0;
        }


    }
    public function check_edit_mobile($mobile,$id){
        $this->db->select('*');
        $this->db->from('users_tab');

        $this->db->where('phone_number !=',$mobile);
        $this->db->where('id !=',$id);

        $this->db->where('status !=','deleted');

        $res= $this->db->get()->result_array();

        $list = array_column($res, 'phone_number');

        //echo $catname;exit;
        //echo in_array($catname,$cat_names);exit;
        if(in_array($mobile,$list)){

            return 1;
        }
        else{
            return 0;
        }

    }
    public function save_edit_user($data,$id){
        $this->db->where('id',$id);
        $this->db->update('users_tab',$data);
        return $this->db->affected_rows()?1:0;

}
    public function user_checking($userid){

        $this->db->select('*')->from('users_tab')->where('id',$userid);
        return $this->db->get()->result()?1:0;

    }
    public function get_user_details($user_id){

        $this->db->select('password')->from('users_tab')->where('id',$user_id);
        return $this->db->get()->row_array();
    }
    public function change_password($hashpassword,$newpassword,$user_id){
        $this->db->where('id',$user_id);
        $this->db->set('password',$hashpassword);
        $this->db->set('org_password',$newpassword);
        $this->db->update('users_tab');
        return $this->db->affected_rows()?1:0;

    }
    public function inactive_user($data,$id){
        $this->db->where('id',$id);
        $this->db->update('users_tab',$data);
        return $this->db->affected_rows()?1:0;
    }
    public function active_user($data,$id){
        $this->db->where('id',$id);
        $this->db->update('users_tab',$data);
        return $this->db->affected_rows()?1:0;

    }
    public  function delete_user($data,$id){
        $this->db->where('id',$id);
        $this->db->update('users_tab',$data);
        return $this->db->affected_rows()?1:0;

    }

}