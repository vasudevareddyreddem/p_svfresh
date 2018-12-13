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
    $this->load->view('home/milk_calendar',$data);
  }

  public function month_calender()
  {
    $month = $this->input->post('month');
    $days = cal_days_in_month(CAL_GREGORIAN,$month,date('Y'));
    $days_array = array();
    for($d = 0;$d < $days; $d++){
      $days_array[] = $d;
    }
    $data['days'] = array_chunk($days_array,6);
    $return['calender_template'] = $this->load->view('home/calender_template',$data,TRUE);
    echo json_encode($return);
  }

}

?>
