<?php
require_once ('razorpay-php/Razorpay.php');
use Razorpay\Api\Api as RazorpayApi;
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
      $data['pageTitle'] = 'Payments Type';
      $data['categories'] = $this->Category_model->get_all_category();
      $user_id = $this->session->userdata('id');
      $billing_id = $this->session->userdata('billing_id');
      $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
      $data['count'] = count($data['cart']);
      $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
      $cart_total = $this->Cart_Model->get_cart_total_for_user($user_id);
      $billing_details = $this->Cart_Model->get_billing_details($this->session->userdata('billing_id'));
      //echo '<pre>';print_r($cart_total);exit;
      /*  payment */
      $api_id= $this->config->item('keyId');
      $api_Secret= $this->config->item('API_keySecret');
      $api = new RazorpayApi($api_id,$api_Secret);
      //$api = new RazorpayApi($this->config->load('keyId'), $this->config->load('API_keySecret'));
      $orderData = [
        'receipt'         => $user_id.$billing_details['id'],
        'amount'          => $cart_total->total_cart * 100, // 2000 rupees in paise
        'currency'        => 'INR',
        'payment_capture' => 1 // auto capture
      ];

      $razorpayOrder = $api->order->create($orderData);
      $razorpayOrderId = $razorpayOrder['id'];
      $displayAmount = $amount = $orderData['amount'];
      $displayCurrency=$orderData['currency'];
      $data['details'] = [
        "key"               => $api_id,
        "amount"            => $amount,
        "name"              => $billing_details['first_name'].$billing_details['last_name'],
        "description"       => "Activate for cloud account",
        "image"             => "",
        "prefill"           => [
          "name"              => $billing_details['first_name'].$billing_details['last_name'],
          "email"             => $billing_details['email_address'],
          "contact"           => $billing_details['telephone'],
        ],
        "notes"             => [
          "address"           => $billing_details['address'].$billing_details['city'],
          "merchant_order_id" => $user_id.$billing_details['id'],
        ],
        "theme"             => [
          "color"             => "#F37254"
        ],
        "order_id"          => $razorpayOrderId,
        "display_currency"          => $orderData['currency'],
      ];

      //echo '<pre>';print_r($data);exit;
      /*  payment */
      $this->load->view('home/paymentstype',$data);
    }else{
      redirect('home/login');
    }

  }

  public  function success(){
    // $post=$this->input->post();
    // echo '<pre>';print_r($post);exit;
    $user_id = $this->session->userdata('id');
    $cart = $this->Cart_Model->get_all_items_from_cart($user_id);
    $billing_id = $this->session->userdata('billing_id');
    $payment_type=$this->input->post('payment');
    $razorpay_payment_id=$this->input->post('razorpay_payment_id');
    $razorpay_order_id=$this->input->post('razorpay_order_id');
    $razorpay_signature=$this->input->post('razorpay_signature');
    // $c->billing_id = $billing_id;
    // $c->payment_type = $payment;
    // $c->razorpay_payment_id = $razorpay_payment_id;
    // $c->razorpay_order_id = $razorpay_order_id;
    // $c->razorpay_signature = $razorpay_signature;
    $post_data = array('user_id' => $user_id,'billing_id' => $billing_id,'payment_type' => $payment_type,'razorpay_payment_id' => $razorpay_payment_id,'razorpay_order_id' => $razorpay_order_id,'razorpay_signature'=>$razorpay_signature);
      $this->Order_Model->insert_order($post_data);
      $order_id = $this->db->insert_id();
      foreach ($cart as $c) {
        unset($c->id);
        unset($c->created_date);
        $str = date('Ymd').$order_id;
        $c->order_number =  'SV'.str_pad($str,10,'0',STR_PAD_LEFT);
        $c->order_id = $order_id;
        $this->Order_Model->insert_order_items($c);
        $this->Order_Model->delete_cart_after_order($c->user_id);
      }
      $this->session->unset_userdata('billing_id');
      redirect('/order');
  }

}

?>
