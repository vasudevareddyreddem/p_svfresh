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
	$this->session->unset_userdata('milk_order');	
  }

  public function index()
  {
    if ($this->session->userdata('logged_in') == TRUE) {
      $data['pageTitle'] = 'Checkout';
      $data['categories'] = $this->Category_model->get_all_category();
      $user_id = $this->session->userdata('id');
      $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
      $data['cart_total'] = $this->Cart_Model->get_cart_total_for_user($user_id);
      $data['count'] = count($data['cart']);
      $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
      $this->load->view('home/checkout',$data);
    }else{
      $this->session->set_flashdata('error',"Please log in or sign up to continue");
      redirect('home/login');
    }
  }

  public function update_quantity()
  {
    if ($this->session->userdata('logged_in') == TRUE) {
      $quantity = $this->input->post('quantity');
      $id = $this->input->post('id');
      if($this->Cart_Model->update($quantity,$id)){
        $this->session->set_flashdata('success',"Qty successfully updated");
        $return['success'] = 'Updated successfully';
      }
      echo json_encode($return);
    }else{
      $this->session->set_flashdata('error',"Please log in or sign up to continue");
      redirect('home/login');
    }
  }

  public function delete_cart_item()
  {
    if($this->session->userdata('logged_in') == TRUE){
      $id = $this->input->post('id');
      if($this->Cart_Model->delete($id)){
        $this->session->set_flashdata('success',"Item deleted successfully");
        $return['success'] = 'Deleted successfully';
      }
      echo json_encode($return);
    }else{
      $this->session->set_flashdata('error',"Please log in or sign up to continue");
      redirect('home/login');
    }
  }

}

?>
