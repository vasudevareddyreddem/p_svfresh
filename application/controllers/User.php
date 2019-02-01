<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');

class User extends In_frontend
{


    public function __construct()
    {
        parent::__construct();

        $this->load->model('Adminuser_model');
        $this->load->model('Apartment_model');
        $this->load->model('Mobile_model');


    }
    public function add_user(){
        if( $this->session->userdata('svadmin_det')){

            $this->load->view('admin/add_user');
            $this->load->view('admin/footer');
        }
        else{redirect('login');}

    }
    public function save_user(){
        if( $this->session->userdata('svadmin_det')){
            $admin=$this->session->userdata('svadmin_det');
            $svadmin=$admin['admin_id'];

        $uname=$this->input->post('uname');

        $username=$uname;
        $email=$this->input->post('email');
        $mobile=$this->input->post('phone');
        $org_password=$this->input->post('password');
        $password=password_hash($this->input->post('password'),PASSWORD_DEFAULT);
        $flag=$this->Mobile_model->user_email_checking($email);
        //echo $this->db->last_query();exit;
        if($flag==1){
            $this->session->set_flashdata('error','Email Existed');
            redirect('user/add_user');


        }
        $flag=$this->Mobile_model->user_mobile_checking($mobile);
        if($flag==1){
            $this->session->set_flashdata('error','Phone Number Existed');
            redirect('user/add_user');


        }

        $data=array('email_id'=>$email,
            'phone_number'=>$mobile,
            'user_name'=>$username,
            'org_password'=>$org_password,
            'password'=>$password,
            'status'=>'Active',
            'created_by'=>$svadmin,
			'created_date'=>date('Y-m-d H:i:s'),
			'updated_date_by_admin'=>date('Y-m-d H:i:s')
        );

        $status=$this->Mobile_model->insert_user_reg($data);
        if($status==0){

            $this->session->set_flashdata('error','User Not Added');
            redirect('user/add_user');


        }
            $this->session->set_flashdata('success','User  Added');
            redirect('user/user_list');


    }
        else{redirect('login');}
    }
    public function user_list(){
        if( $this->session->userdata('svadmin_det')){
            $res=$this->Adminuser_model->get_user_list();
			//echo '<pre>';print_r($res);exit;
            if(count($res)>0){
                $data['status']=1;
                $data['list']=$res;
            }
            else{
                $data['status']=0;
            }
            $this->load->view('admin/user_list',$data);
            $this->load->view('admin/footer');


        }
        else{redirect('login');}


    }
    public function edit_user(){
        if( $this->session->userdata('svadmin_det')){
            $id=base64_decode($this->uri->segment(3));
            $user=$this->Adminuser_model->get_user_by_id($id);
            if(count($user)>0) {
                $data['status']=1;
                $data['user']=$user;

            }
            else{
                $this->session->set_flashdata('error','This User name deleted by another session');
                redirect('user/user_list');

            }
            $this->load->view('admin/edit_user',$data);
            $this->load->view('admin/footer');

            }
        else{redirect('login');}

        }
        public function save_edit_user(){
            if( $this->session->userdata('svadmin_det')){
                $admin=$this->session->userdata('svadmin_det');
                $svadmin=$admin['admin_id'];
                $id=base64_decode($this->input->post('uid'));
                $this->form_validation->set_rules('uname', 'name', 'required');
                $this->form_validation->set_rules('email', 'email', 'required');
                $this->form_validation->set_rules('phone', 'phone', 'required');


                if ($this->form_validation->run() == FALSE)
                {
                    $this->session->set_flashdata('error',validation_errors());
                    redirect($_SERVER['HTTP_REFERER']);

                }
                $name=$this->input->post('uname');
                $email=$this->input->post('email');
                $mobile=$this->input->post('phone');
                $flag=$this->Adminuser_model->check_edit_email($email,$id);
                if($flag==1){
                    $this->session->set_flashdata('error',' Email Existed');
                    redirect($_SERVER['HTTP_REFERER']);

                }
                $flag=$this->Adminuser_model->check_edit_mobile($mobile,$id);
                if($flag==1){
                    $this->session->set_flashdata('error',' Mobile Number Existed');
                    redirect($_SERVER['HTTP_REFERER']);

                }
                $date=date('Y-m-d H:i:s');
                $data=array('user_name'=>$name,
                    'email_id'=>$email,
                    'phone_number'=>$mobile,
                    'updated_date_by_admin'=>$date,
                    'updated_by_admin'=>$svadmin);
                $status=$this->Adminuser_model->save_edit_user($data,$id);
             //echo   $this->db->last_query();exit;
                if($status==1){
                    $this->session->set_flashdata('success','User Details Updated Successfully');
                    redirect('user/user_list');

                }
                $this->session->set_flashdata('error','User Details Not Updated ');
                redirect('user/user_list');


            }
            else{redirect('login');}


        }
        public function change_password(){
            if( $this->session->userdata('svadmin_det')){
                $data['uid']=base64_decode($this->uri->segment(3));
                $this->load->view('admin/user_change_password',$data);
                $this->load->view('admin/footer');


            }
            else{redirect('login');}

        }
        public function  save_password(){
            if( $this->session->userdata('svadmin_det')){
                $user_id= base64_decode($this->input->post('uid'));
                $flag=$this->Mobile_model->user_checking($user_id);
                if($flag==0){
                    $this->session->set_flashdata('error','User Deleted by another Session ');
                    redirect('user/user_list');
                }
                $password=$this->input->post('opassword');
                $newpassword=$this->input->post('npassword');

                $user=$this->Mobile_model->get_user_details($user_id);
                if(password_verify($this->input->post('opassword'),$user['password']))
                {

                    $hashpassword=password_hash($this->input->post('npassword'),PASSWORD_DEFAULT);
                    $this->Mobile_model->change_password($hashpassword,$newpassword,$user_id);

                    $this->session->set_flashdata('success','Password Changed Successfully');
                    redirect('user/user_list');

                }
                $this->session->set_flashdata('error','Old Password is Wrong');
                redirect($_SERVER['HTTP_REFERER']);




            }
            else{redirect('login');}


        }
    public function inactive_user(){
        if ($this->session->userdata('svadmin_det')) {
            $admin=$this->session->userdata('svadmin_det');
            $svadmin=$admin['admin_id'];
            $id=base64_decode($this->uri->segment(3));
            $date=date('Y-m-d H:i:s');
            $data=array('status'=>"Inactive",
                'updated_date_by_admin'=>$date,
                'updated_by_admin'=>$svadmin);
            $status= $this->Adminuser_model->inactive_user($data,$id);
            if($status==1){
                $this->session->set_flashdata('success','Inactivated successfully');
                redirect('user/user_list');


            }
            $this->session->set_flashdata('error','Not Inactivated ');
            redirect('user/user_list');



        }
        else{redirect('login');}

    }
    public function active_user(){
        if ($this->session->userdata('svadmin_det')) {
            $admin=$this->session->userdata('svadmin_det');
            $svadmin=$admin['admin_id'];
            $id=base64_decode($this->uri->segment(3));
            $date=date('Y-m-d H:i:s');
            $data=array('status'=>'Active',
                'updated_date_by_admin'=>$date,
                'updated_by_admin'=>$svadmin);
            $status=$this->Adminuser_model->active_user($data,$id);
            if($status==1){
                $this->session->set_flashdata('success','Activated successfully');
                redirect('user/user_list');


            }
            $this->session->set_flashdata('error','Not Activated ');
            redirect('user/user_list');



        }
        else{redirect('login');}

    }
    public function delete_user(){
        if ($this->session->userdata('svadmin_det')) {
            $admin=$this->session->userdata('svadmin_det');
            $svadmin=$admin['admin_id'];
            $id=base64_decode($this->uri->segment(3));
            $date=date('Y-m-d H:i:s');
            $data=array('status'=>'Deleted',
                'updated_date_by_admin'=>$date,
                'updated_by_admin'=>$svadmin);
            $status=$this->Adminuser_model->delete_user($data,$id);
            if($status==1){
                $this->session->set_flashdata('success','Deleted successfully');
                redirect('user/user_list');


            }
            $this->session->set_flashdata('error','Not Deleted ');
            redirect('user/user_list');



        }
        else{redirect('login');}

    }
    public function add_address(){
        if ($this->session->userdata('svadmin_det')) {
             $data['phone_list']=$this->Adminuser_model->get_adminuser_list();
           $data['ap_list']=$this->Apartment_model->get_all_apartments();
            $this->load->view('admin/add_address',$data);
            $this->load->view('admin/footer');


        }
        else{redirect('login');}

    }

    public function get_blocks_by_apt(){

        $apt_id= base64_decode($this->uri->segment(3));
        //echo $apt_id;exit;
        $res=$this->Adminuser_model->get_blocks_by_apt($apt_id);
        if(count($res)>0){
            $data['status']=1;
            $data['block_list']=$res;
        }
        else{
            $data['status']=0;
        }
        echo json_encode($data);exit;

    }
    public function save_address()
    {
        if ($this->session->userdata('svadmin_det')) {
            $admin = $this->session->userdata('svadmin_det');
            $svadmin = $admin['admin_id'];
            $aname = base64_decode($this->input->post('aname'));
            $bname = $this->input->post('bname');
            $mobile = $this->input->post('mobile');
           // $fname=$this->input->post('fname');
            //$lname = $this->input->post('lname');
             // $email = $this->input->post('email');
                //$phone = $this->input->post('mob');
                $flat= $this->input->post('flat');

            $user = $this->Adminuser_model->get_user_id($mobile);
            if (count($user) > 0) {
                $user_id = $user->id;

            } else {
                $this->session->set_flashdata('error', 'Phone Number Deleted by another session');
                redirect($_SERVER['HTTP_REFERER']);

            }
            $date = date('Y-m-d H:i:s');
            $data = array(
                'appartment' => $aname,
                'block' => $bname,
                'updated_date_by_admin' => $date,
                'updated_by_admin'=>$svadmin,
                
                
                
               
                'flat_door_no'=>$flat
            );
          //$flag= $this->Adminuser_model->save_blling_address($data);
		 $flag=$this->Adminuser_model->save_user_address($data,$mobile);
		  
          if($flag==1){
              $this->session->set_flashdata('success', 'Address Added Successfully');
              redirect('user/address_list');

          }
          else{
              $this->session->set_flashdata('error', 'Address Not Added ');
              redirect($_SERVER['HTTP_REFERER']);

          }
        }
        else{redirect('login');}

    }
    public function address_list(){
        if ($this->session->userdata('svadmin_det')) {

            $res=$this->Adminuser_model->get_address_list();
            if(count($res)>0){
                $data['alist']=$res;
            $data['status']=1;

            }
            else{
                $data['status']=0;
            }
            $this->load->view('admin/address_list',$data);
            $this->load->view('admin/footer');

        }
        else{redirect('login');}

    }

public  function edit_address(){
    if ($this->session->userdata('svadmin_det')) {
        $id=base64_decode($this->uri->segment(3));
        $data['phone_list']=$this->Adminuser_model->get_user_list();
        $data['ap_list']=$this->Apartment_model->get_all_apartments();
        $user=$this->Adminuser_model->get_address_by_id($id);
        $data['blocks']=$this->Adminuser_model->get_blocks_by_apt($user->appartment);


        if(count($user)>0) {
            $data['status']=1;
            $data['address']=$user;

        }
        else{
            $this->session->set_flashdata('error','This Address deleted by another session');
            redirect('user/address_list');

        }
        $this->load->view('admin/edit_address',$data);
        $this->load->view('admin/footer');


    }
    else{redirect('login');}


    }
public  function save_edit_address(){
    if ($this->session->userdata('svadmin_det')) {
        $admin = $this->session->userdata('svadmin_det');
        $svadmin = $admin['admin_id'];
        $aname = base64_decode($this->input->post('aname'));
        $bname = $this->input->post('bname');
        $mobile = $this->input->post('mobile');
        $fname=$this->input->post('fname');
        $lname = $this->input->post('lname');
        $email = $this->input->post('email');
        $phone = $this->input->post('mob');
        $flat= $this->input->post('flat');

        $user = $this->Adminuser_model->get_user_id($mobile);
        if (count($user) > 0) {
            $user_id = $user->id;

        } else {
            $this->session->set_flashdata('error', 'Phone Number Deleted by another session');
            redirect($_SERVER['HTTP_REFERER']);

        }
        $date = date('Y-m-d H:i:s');
        $data = array('user_id' => $user_id,
            'appartment' => $aname,
            'block' => $bname,
            'updated_date_by_admin' => $date,
            'updated_by_admin'=>$svadmin,
            'first_name'=>$fname,
            'last_name'=>$lname,
            'email_address'=>$email,
            'mobile_number'=>$phone,

            'flat_door_no'=>$flat
        );
        $bill_id= base64_decode($this->input->post('bill_id'));
        $flag= $this->Adminuser_model->update_blling_address($data,$bill_id);
        if($flag==1){
            $this->session->set_flashdata('success', 'Address Updated Successfully');
            redirect('user/address_list');

        }
        else{
            $this->session->set_flashdata('error', 'Address Not Updated ');
            redirect($_SERVER['HTTP_REFERER']);

        }

    }
    else{redirect('login');}


}
public function delete_address(){
    if ($this->session->userdata('svadmin_det')) {
        $admin=$this->session->userdata('svadmin_det');
        $svadmin=$admin['admin_id'];
        $id=base64_decode($this->uri->segment(3));
        $date=date('Y-m-d H:i:s');
        $data=array('status'=>'Deleted',
            'updated_date_by_admin'=>$date,
            'updated_by_admin'=>$svadmin);
        $status=$this->Adminuser_model->delete_address($data,$id);
        if($status==1){
            $this->session->set_flashdata('success',' Address Deleted successfully');
            redirect('user/address_list');


        }
        $this->session->set_flashdata('error','Address Not Deleted ');
        redirect('user/address_list');



    }
    else{redirect('login');}

}


}