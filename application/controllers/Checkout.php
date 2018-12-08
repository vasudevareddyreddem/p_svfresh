<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Checkout extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Category_model');
    $this->load->model('Cart_Model');
  }

  public function index()
  {
    $data['pageTitle'] = 'Checkout';
    $data['categories'] = $this->Category_model->get_all_category();
    $user_id = $this->session->userdata('id');
    $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
    $data['cart_total'] = $this->Cart_Model->get_cart_total_for_user($user_id);
    $data['count'] = count($data['cart']);
    $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
    $this->load->view('home/checkout',$data);
  }

  public function update_quantity()
  {
    $quantity = $this->input->post('quantity');
    $id = $this->input->post('id');
    if($this->Cart_Model->update($quantity,$id)){

    }
  }
}

?>
