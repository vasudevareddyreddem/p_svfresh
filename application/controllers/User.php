<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');

class User extends In_frontend
{


    public function __construct()
    {
        parent::__construct();

        $this->load->model('Adminuser_model');


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
            'status'=>'active',
            'created_by'=>$svadmin
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

}