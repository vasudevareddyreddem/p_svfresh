<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apartment_model extends CI_Model

{
    function __construct()
    {
        parent::__construct();
        $this->load->database("default");
        $this->db->query("SET time_zone='+5:30'");
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
        $this->db->select('apartment_id,apartment_name,account_number,ifsc,upi_code,created_date,status')->from('apartment_tab')->where('status !=',0)
        ->order_by('updated_date','desc');
        return $this->db->get()->result();
    }
    public function get_apartment_by_id($id){
        $this->db->select('apartment_id,apartment_name,account_number,ifsc,upi_code,account_name')->from('apartment_tab')->where('apartment_id',$id);
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
    public function check_block_name($name,$apt_id){
        $this->db->select('1')->from('block_tab')->where('block_name',$name)
        ->where('apartment_id',$apt_id)->where('status !=',0);
        return $this->db->get()->result();
    }
    public function save_block_name($data){
        $this->db->insert('block_tab',$data);
        return $this->db->affected_rows()?1:0;

    }

    public function get_block_list(){
        $this->db->select('a.apartment_name,b.block_name,b.created_date,b.status,b.block_id')->
            from('apartment_tab a')->join('block_tab b','a.apartment_id=b.apartment_id')->where('b.status !=',0)
        ->order_by('b.updated_date','desc');
        return $this->db->get()->result();
    }
    public function get_block_by_id($id){
        $this->db->select('a.apartment_id,a.apartment_name,b.block_id,b.block_name')->from('block_tab b')->
        join('apartment_tab a','a.apartment_id=b.apartment_id')->where('b.block_id',$id);
        return $this->db->get()->row();
    }
    public function check_edit_block_name($aid,$bname,$bid){
        $this->db->select('*');
        $this->db->from('block_tab');

        $this->db->where('apartment_id=',$aid);
        $this->db->where('block_name=',$bname);
        $this->db->where('block_id!=',$bid);
        $this->db->where('status !=',0);

        $res= $this->db->get()->result_array();

        $list = array_column($res, 'block_name');

        //echo $catname;exit;
        //echo in_array($catname,$cat_names);exit;
        if(in_array($bname,$list)){

            return 1;
        }
        else{
            return 0;
        }


    }
    public function save_edit_block($data,$bid){
        $this->db->where('block_id',$bid);
        $this->db->update('block_tab',$data);
        return $this->db->affected_rows()?1:0;

    }
    public function inactive_block($data,$id){
        $this->db->where('block_id',$id);
        $this->db->update('block_tab',$data);
        return $this->db->affected_rows()?1:0;
    }
    public function active_block($data,$id){
        $this->db->where('block_id',$id);
        $this->db->update('block_tab',$data);
        return $this->db->affected_rows()?1:0;

    }
    public  function delete_block($data,$id){
        $this->db->where('block_id',$id);
        $this->db->update('block_tab',$data);
        return $this->db->affected_rows()?1:0;

    }


    //get all apartments where status active -- Rana
    public function get_all_active_apartments()
    {
      return $this->db->get_where('apartment_tab',array('status'=>'1'))->result();
    }
    //get all blocks where status active and apartment id -- Rana
    public function get_blocks_by_apartment_id($apartment_id='')
    {
      return $this->db->get_where('block_tab',array('apartment_id' => $apartment_id,'status' => '1'))->result();
    }

	public function  get_balocks_by_apts($apts){
		$this->db->select('*')->from('block_tab');
		$this->db->where('apartment_id',$apts);
		$this->db->where('status',1);
		return $this->db->get()->result_array();

	}
  //account status
  public function online_payment_options_for_apartment($user_id='')
  {
    $this->db->select('account_name,account_number,ifsc,upi_code,account_status');
    $this->db->from('apartment_tab a');
    $this->db->join('users_tab u','a.apartment_id = u.appartment','left');
    $this->db->where('u.id',$user_id);
    return $this->db->get()->row();
  }
}
