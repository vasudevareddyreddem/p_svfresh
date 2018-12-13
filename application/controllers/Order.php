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
    $this->load->model('Auth_Model');
		$this->load->library('user_agent');

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
  public function details()
  {
    if($this->session->userdata('logged_in') == TRUE){
       $data['pageTitle'] = 'Order details';
      $data['categories'] = $this->Category_model->get_all_category();
      $user_id = $this->session->userdata('id');
      $data['user'] = $this->Auth_Model->get_user_details($user_id);
      $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
      $data['count'] = count($data['cart']);
      $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
      $order_item_id = base64_decode($this->uri->segment(3));
      $data['order_details'] = $this->Order_Model->get_order_item_details($order_item_id);
      $data['pageTitle'] = 'Order Details';
      $this->load->view('home/orders_details',$data);
    }else{
      redirect('home/login');
    }
  }

  public function cancel_order()
  {
    $order_items_id = $this->input->post('order_items_id');
    if($this->Order_Model->cancel_order($order_items_id)){
      $return['success'] = 'Order cancelled successfully';
    }else{
      $return['error'] = 'Please try again';
    }
    echo json_encode($return);exit(0);
  }
  
  public  function update_review_ratings(){
	 if($this->session->userdata('logged_in') == TRUE){ 
	   $user_id = $this->session->userdata('id');
	  $post=$this->input->post();
	  //echo '<pre>';print_r($post);exit;
	  $add=array(
	  'rate'=>isset($post['rate'])?$post['rate']:'',
	  'name'=>isset($post['name'])?$post['name']:'',
	  'email'=>isset($post['email'])?$post['email']:'',
	  'message'=>isset($post['message'])?$post['message']:'',
	  'order_item_id'=>isset($post['order_item_id'])?$post['order_item_id']:'',
	  'user_id'=>$user_id,
	  );
	  $check=$this->Order_Model->check_rating_exits($user_id,$post['order_item_id']);
	  if(count($check)>0){
			$this->session->set_flashdata('error',"you are already submitted your rating");
			 redirect($this->agent->referrer());
	  }else{
		  $save=$this->Order_Model->save_item_review($add);
		  if(count($save)>0){
			  $this->session->set_flashdata('success',"Rating successfully submitted.");
			  redirect($this->agent->referrer());
		  }else{
			 $this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
			 redirect($this->agent->referrer()); 
		  }
	  }
	  //echo '<pre>';print_r($post);exit;
	 }else{
		 $this->session->set_flashdata('error',"Please login and continue.");
		redirect('home/login');
    }
	  
  }

}

?>
