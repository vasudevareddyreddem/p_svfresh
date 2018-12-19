<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Wishlist extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Category_model');
    $this->load->model('Wishlist_Model');
    $this->load->model('Cart_Model');
  }

  public function index(){
    if($this->session->userdata('logged_in') == TRUE){
      $data['pageTitle'] = 'Wishlist';
      $data['categories'] = $this->Category_model->get_all_category();
      $user_id = $this->session->userdata('id');
      $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
      $data['count'] = count($data['cart']);
      $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
      if($user_id){
        $data['wishlist'] = $this->Wishlist_Model->get_all_wishlist_by_user_id($user_id);
        $this->load->view('home/wishlist',$data);
      }
    }else{
      redirect('home/login');
    }
  }

  public function addtocart()
  {
    if($this->session->userdata('logged_in') == TRUE){
      if($this->input->post()){
        $post_data = array(
          'user_id' => $this->input->post('user_id'),
          'product_id' => $this->input->post('product_id'),
          'product_name' => $this->input->post('product_name'),
          'product_img' => $this->input->post('product_img'),
          'net_price' => $this->input->post('net_price'),
          'quantity' => $this->input->post('quantity'),
          'created_date'=>date('Y-m-d H:i:s')
        );
        if($this->Cart_Model->insert($post_data)){
          $id = $this->input->post('id');
          if($id){
            if($this->Wishlist_Model->delete($id)){
              $user_id = $this->input->post('user_id');
              if($user_id){
                $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
                $data['wishlist'] = $this->Wishlist_Model->get_all_wishlist_by_user_id($user_id);
                $return['count_w'] = count($data['wishlist']);
                $return['count'] = count($data['cart']);
                $return['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
                echo json_encode($return);
              }
            }
          }
        }
      }
    }else{
       $this->session->set_flashdata('error',"Please log in or sign up to continue");
		 redirect('home/login');
    }
  }

  public  function removewishlist(){
	  if($this->session->userdata('logged_in') == TRUE){
		  $wish_id=base64_decode($this->uri->segment(3));
		  $delete=$this->Wishlist_Model->remove_wishlist_item($wish_id);
		  if(count($delete)>0){
			  $this->session->set_flashdata('success',"Item successfully removed from wishlist");
			 redirect('wishlist');
		  }else{
			 $this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
			 redirect('wishlist');
		  }

	 }else{
       $this->session->set_flashdata('error',"Please log in or sign up to continue");
		 redirect('home/login');
    }
  }
}

?>
