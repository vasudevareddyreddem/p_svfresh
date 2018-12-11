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
          $addl_data = array('user_id' => $this->session->userdata('id'),created_date => date('Y-m-d H:i:s'),created_by => $this->session->userdata('id'),status => 'Active');
          $post_data = array_merge($post_data,$addl_data);
          if($this->Billing_Model->insert($post_data)){
            $billing_id = $this->db->insert_id();
            // $user_id = $this->session->userdata('id');
            // $cart = $this->Cart_Model->get_all_items_from_cart($user_id);
            // foreach ($cart as $c) {
            //   unset($c->id);
            //   unset($c->created_date);
            //   $c->billing_id = $billing_id;
            //   $this->Order_Model->insert($c);
            //   $this->Order_Model->delete_cart_after_order($c->user_id);
            // }
            $this->session->set_userdata('billing_id',$billing_id);
            redirect('/Paymentstype');
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
      // $user_id = $this->session->userdata('id');
      // $cart = $this->Cart_Model->get_all_items_from_cart($user_id);
      // foreach ($cart as $c) {
      //   unset($c->id);
      //   unset($c->created_date);
      //   $c->billing_id = $billing_id;
      //   $this->Order_Model->insert($c);
      //   $this->Order_Model->delete_cart_after_order($c->user_id);
      // }
      $this->session->set_userdata('billing_id',$billing_id);
      redirect('/Paymentstype');
    }
  }

}

?>
