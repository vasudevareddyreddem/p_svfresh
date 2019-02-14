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
            if($this->input->post('checkbank')==null or $this->input->post('checkbank')==''){
              if(($this->input->post('upi')==null or $this->input->post('upi')) and ($this->input->post('acc')==null or $this->input->post('acc')=='') )
              {
                $this->session->set_flashdata('error','You have to Enter Atleast one payment method');
                redirect('apartment/add_apartment');

              }
              if($this->input->post('upi')==null or $this->input->post('upi')){

              }
              else{
                $data['upi_code']=$this->input->post('upi');
              }
            if($this->input->post('acc')==null or $this->input->post('acc')==''){

            }
            else{
                  $ifsc=$this->input->post('ifsc');
                  if($ifsc=='' or $ifsc==null){
                        $this->session->set_flashdata('error','IFSC code is required');
                        redirect('apartment/add_apartment');


                  }
                  else{
                      $data['ifsc']=$ifsc;
                  }
              $data['account_number']=$this->input->post('acc');

            }
          }
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
    public function edit_apartment()
    {
        if ($this->session->userdata('svadmin_det')) {
            $id = base64_decode($this->uri->segment(3));
           $row=$this->Apartment_model->get_apartment_by_id($id);
            if(count($row)>0){
                $data['status']=1;
                $data['row']=$row;
            }
            else{
                $this->session->set_flashdata('error','This Aparment name deleted by another session');
                redirect('apartment/apartment_list');
            }
             $this->load->view('admin/edit_apartment',$data);
            $this->load->view('admin/footer');

    }
        else{redirect('login');}
    }
public function save_edit_apartment(){
    if ($this->session->userdata('svadmin_det')) {
        $admin=$this->session->userdata('svadmin_det');
        $svadmin=$admin['admin_id'];
        $id=base64_decode($this->input->post('ap_id'));
        $this->form_validation->set_rules('apartment_name', 'name', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error',validation_errors());
            redirect($_SERVER['HTTP_REFERER']);

        }
        $name=$this->input->post('apartment_name');
        $flag=$this->Apartment_model->check_edit_ap_name($name,$id);
        if($flag==1){
            $this->session->set_flashdata('error','Name Existed');
            redirect($_SERVER['HTTP_REFERER']);

        }
        $date=date('Y-m-d');
        $data=array('apartment_name'=>$name,
            'updated_date'=>$date,
            'updated_by'=>$svadmin);
            if($this->input->post('acc')==null or $this->input->post('acc')==''){
                     $data['account_number']=$this->input->post('acc');
                      $data['ifsc']=null;
            }
            else{
                  $ifsc=$this->input->post('ifsc');
                  if($ifsc=='' or $ifsc==null){
                        $this->session->set_flashdata('error','IFSC code is required');
                        redirect($_SERVER['HTTP_REFERER']);


                  }
                  else{
                      $data['account_name']=$this->input->post('accname');
                      $data['ifsc']=$ifsc;
                  }
              $data['account_number']=$this->input->post('acc');
                $data['account_status']=1;

            }
       $status=$this->Apartment_model->save_edit_apartment($data,$id);
       if($status==1){
        $this->session->set_flashdata('success','Apartment Name Updated Successfully');
           redirect('apartment/apartment_list');

       }
        $this->session->set_flashdata('success','Apartment Name Updated Successfully');
        redirect('apartment/apartment_list');




    }
    else{redirect('login');}


}
public function inactive_apartment(){
    if ($this->session->userdata('svadmin_det')) {
        $admin=$this->session->userdata('svadmin_det');
        $svadmin=$admin['admin_id'];
        $id=base64_decode($this->uri->segment(3));
        $date=date('Y-m-d');
        $data=array('status'=>2,
            'updated_date'=>$date,
            'updated_by'=>$svadmin);
       $status= $this->Apartment_model->inactive_apartment($data,$id);
       if($status==1){
           $this->session->set_flashdata('success','Inactivated successfully');
           redirect('apartment/apartment_list');


       }
        $this->session->set_flashdata('error','Not Inactivated ');
        redirect('apartment/apartment_list');



    }
    else{redirect('login');}

}
    public function active_apartment(){
        if ($this->session->userdata('svadmin_det')) {
            $admin=$this->session->userdata('svadmin_det');
            $svadmin=$admin['admin_id'];
            $id=base64_decode($this->uri->segment(3));
            $date=date('Y-m-d');
            $data=array('status'=>1,
                'updated_date'=>$date,
                'updated_by'=>$svadmin);
           $status=$this->Apartment_model->active_apartment($data,$id);
            if($status==1){
                $this->session->set_flashdata('success','Activated successfully');
                redirect('apartment/apartment_list');


            }
            $this->session->set_flashdata('error','Not Activated ');
            redirect('apartment/apartment_list');



        }
        else{redirect('login');}

    }
public function delete_apartment(){
    if ($this->session->userdata('svadmin_det')) {
        $admin=$this->session->userdata('svadmin_det');
        $svadmin=$admin['admin_id'];
        $id=base64_decode($this->uri->segment(3));
        $date=date('Y-m-d');
        $data=array('status'=>0,
            'updated_date'=>$date,
            'updated_by'=>$svadmin);
        $status=$this->Apartment_model->delete_apartment($data,$id);
        if($status==1){
            $this->session->set_flashdata('success','Deleted successfully');
            redirect('apartment/apartment_list');


        }
        $this->session->set_flashdata('error','Not Deleted ');
        redirect('apartment/apartment_list');



    }
    else{redirect('login');}

}
public function add_block(){
    if ($this->session->userdata('svadmin_det')) {
        $res=$this->Apartment_model->get_all_apartments();
        if(count($res)>0){
            $data['status']=1;
            $data['list']=$res;
        }
        else{
            $data['status']=1;
        }
        $this->load->view('admin/add_block',$data);
        $this->load->view('admin/footer');
    }
    else{redirect('login');}

}
public  function save_block(){
    if ($this->session->userdata('svadmin_det')) {
        $admin=$this->session->userdata('svadmin_det');
        $svadmin=$admin['admin_id'];
        $this->form_validation->set_rules('aname', 'name', 'required');
        $this->form_validation->set_rules('bname', 'name', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error',validation_errors());
            redirect($_SERVER['HTTP_REFERER']);

        }
        $name=$this->input->post('bname');
        $apt_id=base64_decode($this->input->post('aname'));
        $res=$this->Apartment_model->check_block_name($name,$apt_id);
        if(count($res)>0){
            $this->session->set_flashdata('error','Block Name Existed');
            redirect($_SERVER['HTTP_REFERER']);

        }
         $data=array('block_name'=>$name,
             'apartment_id'=>$apt_id,
             'created_by'=>$svadmin
             );
       $status= $this->Apartment_model->save_block_name($data);
       if($status==1){
           $this->session->set_flashdata('success','Block Name Added');
           redirect('apartment/block_list');
       }
        $this->session->set_flashdata('success','Block Name Not Added');
        redirect($_SERVER['HTTP_REFERER']);



    }
    else{redirect('login');}

}
public  function block_list(){
    if ($this->session->userdata('svadmin_det')) {
        $res=$this->Apartment_model->get_block_list();
        if(count($res)>0){
            $data['status']=1;
            $data['list']=$res;
        }
        else{
            $data['status']=0;
        }
        $this->load->view('admin/block_list',$data);
        $this->load->view('admin/footer');
    }
    else{redirect('login');}


}
    public function edit_block()
    {
        if ($this->session->userdata('svadmin_det')) {
            $id = base64_decode($this->uri->segment(3));

            $row=$this->Apartment_model->get_block_by_id($id);
            $data['ap_list']=$this->Apartment_model->get_all_apartments();
            if(count($row)>0){
                $data['status']=1;
                $data['row']=$row;
            }
            else{
                $this->session->set_flashdata('error','This Block name deleted by another session');
                redirect('apartment/block_list');
            }
            $this->load->view('admin/edit_block',$data);
            $this->load->view('admin/footer');

        }
        else{redirect('login');}
    }
    public function save_edit_block(){
        if ($this->session->userdata('svadmin_det')) {
            $admin=$this->session->userdata('svadmin_det');
            $svadmin=$admin['admin_id'];
            $bid=base64_decode($this->input->post('bid'));

            $this->form_validation->set_rules('bname', 'name', 'required');
            $this->form_validation->set_rules('aname', 'name', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('error',validation_errors());
                redirect($_SERVER['HTTP_REFERER']);

            }
            $aid=base64_decode($this->input->post('aname'));

            $bname=$this->input->post('bname');

            $flag=$this->Apartment_model->check_edit_block_name($aid,$bname,$bid);
            if($flag==1){
                $this->session->set_flashdata('error','Block Name Existed');
                redirect($_SERVER['HTTP_REFERER']);

            }
            $date=date('Y-m-d');
            $data=array('block_name'=>$bname,
                'apartment_id'=>$aid,
                'updated_date'=>$date,
                'updated_by'=>$svadmin);

            $status=$this->Apartment_model->save_edit_block($data,$bid);

            if($status==1){
                $this->session->set_flashdata('success','Block Name Updated Successfully');
                redirect('apartment/block_list');

            }
            $this->session->set_flashdata('success','Block Name  Not Updated ');
            redirect('apartment/block_list');




        }
        else{redirect('login');}


    }
    public function inactive_block(){
        if ($this->session->userdata('svadmin_det')) {
            $admin=$this->session->userdata('svadmin_det');
            $svadmin=$admin['admin_id'];
            $id=base64_decode($this->uri->segment(3));
            $date=date('Y-m-d');
            $data=array('status'=>2,
                'updated_date'=>$date,
                'updated_by'=>$svadmin);
            $status= $this->Apartment_model->inactive_block($data,$id);
            if($status==1){
                $this->session->set_flashdata('success','Inactivated successfully');
                redirect('apartment/block_list');


            }
            $this->session->set_flashdata('error','Not Inactivated ');
            redirect('apartment/block_list');



        }
        else{redirect('login');}

    }
    public function active_block(){
        if ($this->session->userdata('svadmin_det')) {
            $admin=$this->session->userdata('svadmin_det');
            $svadmin=$admin['admin_id'];
            $id=base64_decode($this->uri->segment(3));
            $date=date('Y-m-d');
            $data=array('status'=>1,
                'updated_date'=>$date,
                'updated_by'=>$svadmin);
            $status=$this->Apartment_model->active_block($data,$id);
            if($status==1){
                $this->session->set_flashdata('success','Activated successfully');
                redirect('apartment/block_list');


            }
            $this->session->set_flashdata('error','Not Activated ');
            redirect('apartment/block_list');



        }
        else{redirect('login');}

    }
    public function delete_block(){
        if ($this->session->userdata('svadmin_det')) {
            $admin=$this->session->userdata('svadmin_det');
            $svadmin=$admin['admin_id'];
            $id=base64_decode($this->uri->segment(3));
            $date=date('Y-m-d');
            $data=array('status'=>0,
                'updated_date'=>$date,
                'updated_by'=>$svadmin);
            $status=$this->Apartment_model->delete_block($data,$id);
            if($status==1){
                $this->session->set_flashdata('success','Deleted successfully');
                redirect('apartment/block_list');


            }
            $this->session->set_flashdata('error','Not Deleted ');
            redirect('apartment/block_list');



        }
        else{redirect('login');}

    }
    public function test_qrcode(){
      $this->load->library('ciqrcode');


$params['data'] = 'siva is very good boy';

$params['level'] = 'H';

$params['size'] = 10;

$params['cachedir'] = FCPATH.'assets/qrcode/';

$params['savename'] =FCPATH.'assets/qrcode/'.'test_1.png';


$this->ciqrcode->generate($params);

    }

}
