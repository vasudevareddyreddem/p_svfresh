<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Milkcalender extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Category_model');
    $this->load->model('Cart_Model');
    $this->load->model('Calender_Model');
  }

  public function index()
  {
    //code
  }

  public function milkcalender($id='')
  {
    $data['categories'] = $this->Category_model->get_all_category();
    $user_id = $this->session->userdata('id');
    $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
    $data['count'] = count($data['cart']);
    $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
    $data['pageTitle'] = 'Milk Calender';
    $data['product_id'] = $id;
    $this->load->view('home/milk_calendar',$data);
  }

  public function month_calender()
  {
    $month = $this->input->post('month');
    $product_id = $this->input->post('product_id');
    $days = cal_days_in_month(CAL_GREGORIAN,$month,date('Y'));;
    for($d = 1;$d <= $days; $d++){
      $days_array[] = $d;
    }
    $data['days'] = array_chunk($days_array,5);
    $data['month'] = $month;
    $data['year'] = date('Y');
    $data['product_id'] = $product_id;
    $data['user_id'] = $this->session->userdata('id');
    $return['calender_template'] = $this->load->view('home/calender_template',$data,TRUE);
    echo json_encode($return);
  }

  public function insert_calender()
  {
    $post = $this->input->post();
    for($i = 1;$i <= count($post['quant']);$i++){
      if(($post['quant'][$i]) != 0 ){
        $this->Calender_Model->insert(array('product_id' => $post['product_id'][$i],'user_id' => $post['user_id'][$i],'year' => $post['year'][$i],'month' => $post['month'][$i],'date' => $post['date'][$i],'quantity' => $post['quant'][$i],'created_date' =>date('Y-m-d H:i:s'),'created_by'=>$this->session->userdata('id')));
      }
    }
    redirect('/billing');
  }

}

?>
