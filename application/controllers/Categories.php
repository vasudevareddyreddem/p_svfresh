<?php
  /**
   *
   */
  class Categories extends CI_controller
  {

    function __construct()
    {
      parent::__construct();
      $this->load->model('Category_model');
    }

    public function index()
    {

    }

    public function category($id='')
    {
      //if($this->session->userdata('logged_in') == TRUE){
        $data['categories'] = $this->Category_model->get_all_category();
        $data['sub_categories'] = $this->Category_model->get_sub_category($id);
        $data['category'] = $this->Category_model->get_category_name_by_id($id);
        $data['pageTitle'] = 'Categories';
        $this->load->view('home/category',$data);
      //}
    }

  }

?>
