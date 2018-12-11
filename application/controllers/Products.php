<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Products extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Product_model');
    $this->load->model('Category_model');
    $this->load->model('Cart_Model');
    $this->load->model('Wishlist_Model');
  }

  public function index()
  {
    // code...
  }

  public function products($id='')
  {
    $data['categories'] = $this->Category_model->get_all_category();
    $data['product'] = $this->Product_model->get_products_by_sub_category($id);
    $data['sub_category'] = $this->Category_model->get_sub_category_name_by_id($id);
    $user_id = $this->session->userdata('id');
    $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
    $data['count'] = count($data['cart']);
    $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
    $data['pageTitle'] = 'Products';
    $this->load->view('home/products',$data);
  }

  public function product($id='')
  {
    $data['categories'] = $this->Category_model->get_all_category();
    $data['product'] = $this->Product_model->get_product_by_id($id);
    $data['related_products'] = $this->Product_model->get_related_products_by_prdouct($id);
    $data['features'] = $this->Product_model->get_product_feature_by_product($id);
    $data['product_related_images'] = $this->Product_model->get_product_related_images($id);
    $user_id = $this->session->userdata('id');
    $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
    $data['count'] = count($data['cart']);
    $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
    $data['pageTitle'] = 'Product';
    $this->load->view('home/product',$data);
  }

  public function Cart()
  {
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
        $user_id = $this->input->post('user_id');
        if($user_id){
          $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
          $return['count'] = count($data['cart']);
          $return['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
          echo json_encode($return);
        }
      }
    }
  }

  public function Wishlist()
  {
    if($this->input->post()){
      $post_data = array(
        'user_id' => $this->input->post('user_id'),
        'product_id' => $this->input->post('product_id'),
        'product_name' => $this->input->post('product_name'),
        'product_img' => $this->input->post('product_img'),
        'net_price' => $this->input->post('net_price'),
        'quantity' => $this->input->post('quantity'),
        'discount_price' => $this->input->post('discount_price'),
        'created_date'=>date('Y-m-d H:i:s')
      );
      if($this->Wishlist_Model->insert($post_data)){
        $return['success'] = 'Added to wishlist';
      }else{
        $return['error'] = 'Failed to add wishlist';
      }
      echo json_encode($return);
    }
  }
}

?>
