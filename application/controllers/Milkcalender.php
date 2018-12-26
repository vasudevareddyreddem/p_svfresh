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
    $this->load->library('user_agent');
    $this->load->model('Category_model');
    $this->load->model('Cart_Model');
    $this->load->model('Calender_Model');
    $this->load->model('Product_model');
  }

  public function index()
  {
    //code
  }

  public function milkcalender($id='')
  {

    if($this->session->userdata('logged_in') == TRUE){
      $data['categories'] = $this->Category_model->get_all_category();
      $user_id = $this->session->userdata('id');
      $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
      $data['count'] = count($data['cart']);
      $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
      $data['pageTitle'] = 'Milk Calender';
      $data['product_id'] = $id;
      $data['product_name'] = $this->Product_model->get_product_name_by_product_id($id);
      $this->load->view('home/milk_calendar',$data);
    }else{
      redirect('home/login');
    }

  }

  public function month_calender()
  {
    $month = $this->input->post('month');
    $c_year = date('Y');
    $product_id = $this->input->post('product_id');
    $days = cal_days_in_month(CAL_GREGORIAN,$month,$c_year);
    $current_month = date('n');
    $current_day = date('j',strtotime('+1day'));
    if($current_month == $month){
      for($d = $current_day;$d <= $days; $d++){
            $days_array[] = $d;
      }
    } else {
      for($d = 1;$d <= $days; $d++){
          $days_array[] = $d;
      }
    }
    $data['days'] = array_chunk($days_array,5);
    $data['month'] = $month;
    $year = '';
    $current_month_year = date('Y-m');
    $selected_month_year = date('Y-m',mktime(0,0,0,$month,1));
    if ($current_month_year > $selected_month_year) {
      $year .= date('Y', strtotime('+1 years'));
    } else {
      $year .= date('Y');
    }
    $data['year'] = $year;
    $data['product_id'] = $product_id;
    $data['product_price'] = $this->Product_model->get_product_price_by_product_id($product_id);
    $user_id = $this->session->userdata('id');
    $data['user_id'] = $user_id;
    $data['calender_orders'] = $this->Calender_Model->get_all_calender_items_by_user_id_and_month($user_id,$month);
    $return['calender_template'] = $this->load->view('home/calender_template',$data,TRUE);
    echo json_encode($return);
  }

  public function insert_calender()
  {
    $post = $this->input->post();
    if(!empty($post)){
      $calender_id = array();
      foreach ($post['quant'] as $key => $value) {
        $id = $this->Calender_Model->check_unique_order($post['product_id'][$key],$post['user_id'][$key],$post['date'][$key],$post['month'][$key],$post['year'][$key]);
        if ($id) {
          if(($post['quant'][$key]) != 0 ){
            $this->Calender_Model->update(array('price' => $post['product_price'][$key],'product_id' => $post['product_id'][$key],'user_id' => $post['user_id'][$key],'year' => $post['year'][$key],'month' => $post['month'][$key],'date' => $post['date'][$key],'quantity' => $post['quant'][$key],'created_date' =>date('Y-m-d H:i:s'),'created_by'=>$this->session->userdata('id')),$id->calender_id);
            $calender_id[] = $id->calender_id;
          } else {
            $this->session->set_flashdata('error','Calendar date quantity should not be empty');
            redirect($this->agent->referrer());
          }
        } else {
          if(($post['quant'][$key]) != 0 ){
            $this->Calender_Model->insert(array('price' => $post['product_price'][$key],'product_id' => $post['product_id'][$key],'user_id' => $post['user_id'][$key],'year' => $post['year'][$key],'month' => $post['month'][$key],'date' => $post['date'][$key],'quantity' => $post['quant'][$key],'created_date' =>date('Y-m-d H:i:s'),'created_by'=>$this->session->userdata('id')));
            $calender_id[] = $this->db->insert_id();
          } else {
            $this->session->set_flashdata('error','Calendar date quantity should not be empty');
            redirect($this->agent->referrer());
          }
        }
      }
      $this->session->set_userdata('calender_id',$calender_id);
      $this->session->set_userdata('milk_order','MILK');
      redirect('/billing');

    }
  }

  public function cancel_order()
  {
    $calendar_id = $this->input->post('calendar_id');
    if($this->Calender_Model->cancel_order($calendar_id)){
      $return['success'] = 'Order cancelled successfully';
    }else{
      $return['error'] = 'Please try again';
    }
    echo json_encode($return);exit(0);
  }

}

?>
