<?php
/**
 *
 */
class Paymentstype extends CI_Controller
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
    if ($this->session->userdata('logged_in') == TRUE) {

      if($this->input->post()){
        $this->form_validation->set_rules('payment_type', 'Payment Type', 'required');
        if ($this->form_validation->run() == FALSE) {
          $data['pageTitle'] = 'Payments Type';
          $data['categories'] = $this->Category_model->get_all_category();
          $user_id = $this->session->userdata('id');
          $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
          $data['count'] = count($data['cart']);
          $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
          $this->load->view('home/paymentstype',$data);
        } else {
          if ($this->input->post('payment_type') == 1) {
          //billing id for user
          print_r($this->session->userdata('billing_id'));
            // $user_id = $this->session->userdata('id');
            // $cart = $this->Cart_Model->get_all_items_from_cart($user_id);
            // foreach ($cart as $c) {
            //   unset($c->id);
            //   unset($c->created_date);
            //   $c->billing_id = $billing_id;
            //   $this->Order_Model->insert($c);
            //   $this->Order_Model->delete_cart_after_order($c->user_id);
            // }

            //cart total for user
            $user_id = $this->session->userdata('id');
            $data['cart_total'] = $this->Cart_Model->get_cart_total_for_user($user_id);
            print_r($data['cart_total']);
            echo $this->input->post('payment_type');
            // code...
          } elseif ($this->input->post('payment_type') == 2) {

            //cart total for user
            $user_id = $this->session->userdata('id');
            $data['cart_total'] = $this->Cart_Model->get_cart_total_for_user($user_id);
            print_r($data['cart_total']);
            echo $this->input->post('payment_type');
            // code...
          } elseif ($this->input->post('payment_type') == 3) {

            //cart total for user
            $user_id = $this->session->userdata('id');
            $data['cart_total'] = $this->Cart_Model->get_cart_total_for_user($user_id);
            print_r($data['cart_total']);
            echo $this->input->post('payment_type');
            // code...
          }
        }

      }else{
        $data['pageTitle'] = 'Payments Type';
        $data['categories'] = $this->Category_model->get_all_category();
        $user_id = $this->session->userdata('id');
        $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
        $data['count'] = count($data['cart']);
        $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
        $this->load->view('home/paymentstype',$data);
      }

    }

  }

}

?>
