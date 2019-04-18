<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminuser_model extends CI_Model

{
    function __construct()
    {
        parent::__construct();
        $this->load->database("default");
        $this->db->query("SET time_zone='+5:30'");
    }

    public function get_user_list(){
        $this->db->select('users_tab.*,block_tab.block_name,apartment_tab.apartment_name')->from('users_tab');
		$this->db->join('block_tab','block_tab.block_id=users_tab.block','left');
		$this->db->join('apartment_tab','apartment_tab.apartment_id=users_tab.appartment','left');
		$this->db->where('users_tab.status !=','Deleted')->order_by('users_tab.created_date','desc');
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
    public function get_blocks_by_apt($apt_id){
        $this->db->select('block_id,block_name')->from('block_tab')->where('apartment_id',$apt_id)->
        where('status !=',0);
        return $this->db->get()->result();
    }
    public function get_user_id($mobile){
        $this->db->select('*')->from('users_tab')->where('phone_number',$mobile);

       return  $this->db->get()->row();


    }
    public function save_blling_address($data){
        $this->db->insert('billing_tab',$data);
        return $this->db->affected_rows()?1:0;

    }
    public function get_address_list(){
        $this->db->select('a.id,a.user_name,a.phone_number,a.email_id,ap.apartment_name,bl.block_name,a.created_date,a.flat_door_no')->from('users_tab a')->
            //join('billing_tab b','a.id=b.user_id','left')->
        join('apartment_tab ap','ap.apartment_id=a.appartment','left')->join('block_tab bl','bl.block_id=a.block','left')
//->where('b.status !=','Deleted')
            ->where('a.status !=','Deleted')->where('a.created_by is NOT NULL', NULL, FALSE)->
			where('a.updated_by_admin is NOT NULL', NULL, FALSE)->
          order_by('a.id')->order_by('a.updated_date_by_admin','desc');
        return $this->db->get()->result();


    }
    public function get_address_by_id($id){
        $this->db->select('ap.apartment_id,ap.apartment_name,bl.block_id,bl.block_name,u.*')->from('users_tab u')->
        join('apartment_tab ap','ap.apartment_id=u.appartment')->join('block_tab bl','bl.block_id=u.block')
            ->where('u.id',$id);
        return $this->db->get()->row();

    }
    public function update_user_address($data,$user_id){
        $this->db->where('id',$user_id);
        $this->db->update('users_tab',$data);
        return $this->db->affected_rows()?1:0;

    }
public function delete_address($data,$id){
    $this->db->where('id',$id);
    $this->db->update('users_tab',$data);
    return $this->db->affected_rows()?1:0;

}
public function save_user_address($data,$mobile){
	  $this->db->where('phone_number',$mobile);
    $this->db->update('users_tab',$data);
    return $this->db->affected_rows()?1:0;
	
	
}
public function get_adminuser_list(){
	 $this->db->select('*')->from('users_tab')->
		where('created_by is NOT NULL', NULL, FALSE)->
		where('updated_by_admin is  NULL', NULL, FALSE)->
		where('status !=','Deleted')->order_by('created_date','desc');
      return  $this->db->get()->result();
	
}
public function get_edit_adminuser_list($phone){
     $this->db->select('*')->from('users_tab')->
     group_start()->
        where('created_by is NOT NULL', NULL, FALSE)->
        where('updated_by_admin is  NULL', NULL, FALSE)->
        where('status !=','Deleted')->order_by('created_date','desc')->group_end()
        ->or_where('phone_number',$phone);

      return  $this->db->get()->result();
    
}


}