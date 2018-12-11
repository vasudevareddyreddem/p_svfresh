<?php

/**
 *
 */
class Order extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Order_Model');
    $this->load->model('Category_model');
    $this->load->model('Cart_Model');
    $this->load->model('Wishlist_Model');
  }

  public function index()
  {
    if($this->session->userdata('logged_in') == TRUE){
      $data['categories'] = $this->Category_model->get_all_category();
      $user_id = $this->session->userdata('id');
      $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
      $data['count'] = count($data['cart']);
      $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
      $data['order'] = $this->Order_Model->get_order_by_user($user_id);
      $data['pageTitle'] = 'Order';
      $this->load->view('home/orders',$data);
    }else{
      redirect('home/login');
    }
  }

}

?>
