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
    $this->load->model('Category_model');
    $this->load->model('Cart_Model');
    $this->load->model('Billing_Model');
  }

  public function index()
  {
    if($this->session->userdata('logged_in') == TRUE){
      if($this->input->post()){
        $post_data = $this->input->post();
        $addl_data = array('user_id' => $this->session->userdata('id'),created_date => date('Y-m-d H:i:s'),created_by => $this->session->userdata('id'),status => 'Active');
        $post_data = array_merge($post_data,$addl_data);
        if($this->Billing_Model->insert($post_data)){
          redirect('/home');
        }else{
          $this->session->set_flashdata('error', 'Please,try again');
          redirect('/billing');
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

}

?>
