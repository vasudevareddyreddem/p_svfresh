<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  /**
   *
   */
  class Categories extends CI_controller
  {

    function __construct()
    {
      parent::__construct();
      $this->load->model('Category_model');
      $this->load->model('Cart_Model');
    }

    public function index()
    {

    }

    public function category($id='')
    {
        $data['categories'] = $this->Category_model->get_all_category();
        $data['sub_categories'] = $this->Category_model->get_sub_category($id);
        $data['category'] = $this->Category_model->get_category_name_by_id($id);
        $user_id = $this->session->userdata('id');
        $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
        $data['count'] = count($data['cart']);
        $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
        $data['pageTitle'] = 'Categories';
        $data['id'] = $id;
		//echo '<pre>';print_r($data);exit;
        $this->load->view('home/category',$data);
    }

  }

?>
