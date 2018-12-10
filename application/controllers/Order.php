<?php

/**
 *
 */
class Order extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Cart_Model');
  }

  public function index()
  {
    if($this->session->userdata('logged_in') == TRUE){

    }else{
      redirect('home/login');
    }
  }
  public function create_order()
  {
    if($this->session->userdata('logged_in') == TRUE){
      $user_id = $this->session->userdata('id');
      $order = $this->Cart_Model->get_all_items_from_cart($user_id);
      print_r($order);
    }else{
      redirect('home/login');
    }
  }

}

?>
