<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*
*/
class Billing extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('Category_model');
    $this->load->model('Cart_Model');
    $this->load->model('Billing_Model');
    $this->load->model('Order_Model');
    $this->load->model('Calender_Model');
  }

  public function index()
  {
    if($this->session->userdata('logged_in') == TRUE){
      if($this->input->post()){
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('company_name', 'Company Name', 'required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('zip', 'Zip/Postal Code', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('telephone', 'Telephone', 'required');
        $this->form_validation->set_rules('fax', 'Fax', 'required');
        if ($this->form_validation->run() == FALSE){
          $data['categories'] = $this->Category_model->get_all_category();
          $user_id = $this->session->userdata('id');
          $data['billing'] = $this->Billing_Model->get_user_billing_details_by_userid($user_id);
          $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
          $data['count'] = count($data['cart']);
          $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
          $data['pageTitle'] = 'Billing';
          $this->load->view('home/billing',$data);
        }else{
          $post_data = $this->input->post();
          $addl_data = array('user_id' => $this->session->userdata('id'),'created_date' => date('Y-m-d H:i:s'),'created_by' => $this->session->userdata('id'),'status' => 'Active');
          $post_data = array_merge($post_data,$addl_data);
          if($this->Billing_Model->insert($post_data)){
            $billing_id = $this->db->insert_id();
            if($this->session->userdata('milk_order') == 'MILK'){
              $calender_id = $this->session->userdata('calender_id');
              foreach ($calender_id as $key => $cid) {
                $this->Calender_Model->update(array('billing_id'=>$billing_id),$cid);
                $this->session->unset_userdata($calender_id[$key]);
              }
              $this->session->unset_userdata('milk_order');
              redirect('order/milk_orders');
            }else{
              $this->session->set_userdata('billing_id',$billing_id);
              redirect('/Paymentstype');
            }

          }else{
            $this->session->set_flashdata('error', 'Please,try again');
            redirect('/billing');
          }
        }
      }else{
        $data['categories'] = $this->Category_model->get_all_category();
        $user_id = $this->session->userdata('id');
        $data['billing'] = $this->Billing_Model->get_user_billing_details_by_userid($user_id);
        $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
        $data['count'] = count($data['cart']);
        $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
        $data['pageTitle'] = 'Billing';
        $this->load->view('home/billing',$data);
      }
    }else{
      redirect('home/login');
    }
  }
  public function old_delivery_address()
  {
    if($this->input->post()){
      $billing_id = $this->input->post('billing_id');
      if($this->session->userdata('milk_order') == 'MILK'){
        $calender_id = $this->session->userdata('calender_id');
        foreach ($calender_id as $key => $cid) {
          $this->Calender_Model->update(array('billing_id'=>$billing_id),$cid);
          $this->session->unset_userdata($calender_id[$key]);
        }
        $this->session->unset_userdata('milk_order');
        redirect('order/milk_orders');
      }else{
        $this->session->set_userdata('billing_id',$billing_id);
        redirect('/Paymentstype');
      }

    }
  }
  //edit billing address
  public function edit($id='')
  {
    if($this->session->userdata('logged_in') == TRUE){
      if ($id) {
        if($this->input->post()){
          $this->form_validation->set_rules('first_name', 'First Name', 'required');
          $this->form_validation->set_rules('last_name', 'Last Name', 'required');
          $this->form_validation->set_rules('company_name', 'Company Name', 'required');
          $this->form_validation->set_rules('email_address', 'Email Address', 'required');
          $this->form_validation->set_rules('address', 'Address', 'required');
          $this->form_validation->set_rules('city', 'City', 'required');
          $this->form_validation->set_rules('state', 'State', 'required');
          $this->form_validation->set_rules('zip', 'Zip/Postal Code', 'required');
          $this->form_validation->set_rules('country', 'Country', 'required');
          $this->form_validation->set_rules('telephone', 'Telephone', 'required');
          $this->form_validation->set_rules('fax', 'Fax', 'required');
          if ($this->form_validation->run() == FALSE){
            $data['categories'] = $this->Category_model->get_all_category();
            $user_id = $this->session->userdata('id');
            $data['billing'] = $this->Billing_Model->get_billing_details_by_id($id);
            $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
            $data['count'] = count($data['cart']);
            $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
            $data['pageTitle'] = 'Billing';
            $this->load->view('home/edit_billing',$data);
          }else{
            $post_data = $this->input->post();
            $addl_data = array('user_id' => $this->session->userdata('id'),'updated_date' => date('Y-m-d H:i:s'),'updated_by' => $this->session->userdata('id'),'status' => 'Active');
            $post_data = array_merge($post_data,$addl_data);
            $post_id = $this->input->post('id');
            if($this->Billing_Model->Update($post_data,$post_id)){
              $this->session->set_flashdata('success','Updated successfully');
              redirect('/billing');
            }else{
              $this->session->set_flashdata('error', 'Please,try again');
              redirect('/billing');
            }
          }
        }else{
          $data['categories'] = $this->Category_model->get_all_category();
          $user_id = $this->session->userdata('id');
          //$data['billing'] = $this->Billing_Model->get_user_billing_details_by_userid($user_id);
          $data['billing'] = $this->Billing_Model->get_billing_details_by_id($id);
          $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
          $data['count'] = count($data['cart']);
          $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
          $data['pageTitle'] = 'Billing';

          $this->load->view('home/edit_billing',$data);
        }
      } else {
        $this->session->set_flashdata('error','Sorry, there is a problem in updating record');
        redirect('/billing');
      }
    }else{
      redirect('home/login');
    }
  }
  //Delete billing Address
  public function delete($id='')
  {
    if ($this->session->userdata('logged_in') == TRUE) {
      if($id){
        $post_data = array('status'=>'Deleted');
        if ($this->Billing_Model->update($post_data,$id)) {
          $this->session->set_flashdata('success','Deleted successfully');
          redirect('/billing');
        } else {
          $this->session->set_flashdata('error','Please try agains');
          redirect('/billing');
        }
      } else {
        $this->session->set_flashdata('error','Sorry, there is a problem in deleting record');
      }
    } else {
      $this->session->set_flashdata('error','Please login to continue');
      redirect('home/login');
    }
  }

}

?>
