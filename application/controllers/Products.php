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
    $data['pageTitle'] = 'Products';
    $this->load->view('home/products',$data);
  }

  public function product($id='')
  {
    $data['categories'] = $this->Category_model->get_all_category();
    $data['product'] = $this->Product_model->get_product_by_id($id);
    $data['pageTitle'] = 'Product';
    $this->load->view('home/product',$data);
  }
}

?>
