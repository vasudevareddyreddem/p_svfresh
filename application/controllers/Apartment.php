<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');

class Apartment extends In_frontend
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Apartment_model');


    }

    public function add_apartment(){
        if( $this->session->userdata('svadmin_det')){

            $this->load->view('admin/add_apartment');
            $this->load->view('admin/footer');


        }
        else{redirect('login');}
    }
    public  function  save_apartment(){
        $admin=$this->session->userdata('svadmin_det');
        $svadmin=$admin['admin_id'];
        $name=$this->input->post('apartment_name');
        $this->form_validation->set_rules('apartment_name', 'name', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error',validation_errors());
            redirect('apartment/add_apartment');

        }
        $status=$this->Apartment_model->check_apartment_name($name);
        if($status==1){
            $this->session->set_flashdata('error','Apartment Name existed');
            redirect('apartment/add_apartment');

        }
        $data=array('apartment_name'=>$name,
            'created_by'=>$svadmin);
        $flag=$this->Apartment_model->save_apartment($data);
        if($flag==1){
            $this->session->set_flashdata('success','Apartment Added successfully');
            redirect('apartment/apartment_list');
        }
        $this->session->set_flashdata('error','Apartment not added');
        redirect('apartment/add_apartment');

    }
    public function apartment_list(){
        if( $this->session->userdata('svadmin_det')){
            $res=$this->Apartment_model->get_all_apartments();
            if(count($res)>0){
                $data['status']=1;
                $data['list']=$res;
            }
            else{
                $data['status']=0;
            }

            $this->load->view('admin/apartment_list',$data);
            $this->load->view('admin/footer');


        }
        else{redirect('login');}

    }
}