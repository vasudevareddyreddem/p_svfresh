<?php
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
      $post_data = $this->input->post();
      $post_data = array_merge($post_data,array('created_date'=>date('Y-m-d H:i:s')));
      if($this->Cart_Model->insert($post_data)){
        $user_id = $this->input->post('user_id');
        if($user_id){
          $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
          $return['count'] = count($data['cart']);
          $return['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
          echo json_encode($return);exit(0);
        }
      }
    }
  }
}

?>