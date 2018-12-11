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
		$data['pageTitle'] = 'Payments Type';
        $data['categories'] = $this->Category_model->get_all_category();
        $user_id = $this->session->userdata('id');
        $billing_id = $this->session->userdata('billing_id');
       // $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
        //$data['count'] = count($data['cart']);
        //$data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
		$data['cart_total'] = $this->Cart_Model->get_cart_total_for_user($user_id);
		$data['billing_details'] = $this->Cart_Model->get_billing_details($this->session->userdata('billing_id'));
		echo '<pre>';print_r($data);exit;
        $this->load->view('home/paymentstype',$data);
     }else{
		 redirect('home/login'); 
	 }

	}
}

?>
