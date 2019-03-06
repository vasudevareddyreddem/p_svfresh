<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*
*/
class Billing extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('Category_model');
    $this->load->model('Cart_Model');
    $this->load->model('Billing_Model');
    $this->load->model('Order_Model');
    $this->load->model('Calender_Model');
    $this->load->model('Apartment_model');
    $this->load->model('Auth_Model');
  }

  public function index()
  {
    if($this->session->userdata('logged_in') == TRUE){
      if($this->input->post()){

          $post_data = $this->input->post();

		  $user_id = $this->session->userdata('id');
		   $cart_tem= $this->Cart_Model->check_product_ava_qty($user_id);
		   foreach($cart_tem as $li){
			   if($li['quantity']> $li['av_qty']){
					$this->session->set_flashdata('error', $li['product_name'].' product is currently out of stock or less quantity');
					redirect('/checkout');
			   }
		   }
		   //echo '<pre>';print_r($cart_tem);exit;
          $data['billing'] = $this->Billing_Model->get_user_billing_details_by_userid($user_id);
          //$this->load->model('Auth_Model');
          $user_add=$this->Auth_Model->get_user_details($user_id);

          $addl_data = array('user_id' => $this->session->userdata('id'),'created_date' => date('Y-m-d H:i:s'),'created_by' => $this->session->userdata('id'),'status' => 'Active');
			$a_a =array(
			'email_address'=>$user_add->email_id,
			'mobile_number'=>$user_add->phone_number,
			'first_name'=>$user_add->first_name,
			'last_name'=>$user_add->last_name,
			'appartment'=>$user_add->appartment,
			'block'=>$user_add->block,
			'flat_door_no'=>$user_add->flat_door_no,
			);
			$post_data = array_merge($a_a,$addl_data);
			if($this->Billing_Model->insert($post_data)){
            $billing_id = $this->db->insert_id();
            if($this->session->userdata('milk_order') == 'MILK'){
              $calender_id = $this->session->userdata('calender_id');
              foreach ($calender_id as $key => $cid) {
                $this->Calender_Model->update(array('billing_id'=>$billing_id),$cid);
                $this->session->unset_userdata($calender_id[$key]);
              }
              $this->session->unset_userdata('milk_order');
              redirect('order/milk_orders');
            }else{
              $this->session->set_userdata('billing_id',$billing_id);
              redirect('/Paymentstype');
            }

          }else{
            $this->session->set_flashdata('error', 'Please,try again');
            redirect('/billing');
          }

      }else{
		  $user_id = $this->session->userdata('id');
		  $cart_tem= $this->Cart_Model->check_product_ava_qty($user_id);
		   foreach($cart_tem as $li){
			   if($li['quantity']> $li['av_qty']){
					$this->session->set_flashdata('error', $li['product_name'].' product is currently out of stock or less quantity ');
					redirect('/checkout');
			   }
		   }
        $data['categories'] = $this->Category_model->get_all_category();
        $user_id = $this->session->userdata('id');
        $data['billing'] = $this->Billing_Model->get_user_billing_details_by_userid($user_id);
        //$this->load->model('Auth_Model');
        $data['user'] =$this->Auth_Model->get_user_details_for_billing($user_id);
        $data['apartment'] = $this->Apartment_model->get_all_active_apartments();
        $data['blocks_list'] = $this->Apartment_model->get_balocks_by_apts($data['user']->appartment);
        $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
        $data['without_total_amt']= $this->Cart_Model->normal_cart_amount($user_id);
        $data['withmilk_total_amt']= $this->Cart_Model->special_cart_amount($user_id,date('Y-m-d'));
        $data['cart_total_amt']=(($data['without_total_amt']['c_amt'])+($data['withmilk_total_amt']['m_amt']));
        //echo '<pre>';print_r($data);exit;
        $data['count'] = count($data['cart']);
        $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
        $data['pageTitle'] = 'Billing';
        $this->load->view('home/billing',$data);
      }
    }else{
      redirect('home/login');
    }
  }
  public function old_delivery_address()
  {
    if($this->input->post()){
      // $billing_id = $this->input->post('billing_id');
      // if($this->session->userdata('milk_order') == 'MILK'){
      //   $calender_id = $this->session->userdata('calender_id');
      //   foreach ($calender_id as $key => $cid) {
      //     $this->Calender_Model->update(array('billing_id'=>$billing_id),$cid);
      //     $this->session->unset_userdata($calender_id[$key]);
      //   }
      //   $this->session->unset_userdata('milk_order');
      //   redirect('order/milk_orders');
      // }else{
      //   $this->session->set_userdata('billing_id',$billing_id);
      //   redirect('/Paymentstype');
      // }
      /* billing modification on 28-01-2019*/
      redirect('/Paymentstype');
      /*--ends here--*/
    }
  }
  //edit billing address
  public function edit()
  {
    if($this->session->userdata('logged_in') == TRUE){
        if($this->input->post()) {
          $this->form_validation->set_rules('first_name', 'First Name', 'required|callback_alpha_dash_space');
          $this->form_validation->set_rules('last_name', 'Last Name', 'required|callback_alpha_dash_space');
          $this->form_validation->set_rules('email_id', 'Email Address', 'required|valid_email');
          $this->form_validation->set_rules('phone_number', 'Moblie Number', 'required|regex_match[/^[0-9]{10}$/]');
          $this->form_validation->set_rules('appartment', 'Appartment', 'required');
          $this->form_validation->set_rules('block', 'Block', 'required');
          $this->form_validation->set_rules('flat_door_no', 'Flat/Door no', 'required');
          if ($this->form_validation->run() == FALSE) {
            $data['categories'] = $this->Category_model->get_all_category();
            $user_id = $this->session->userdata('id');
            //$this->load->model('Auth_Model');
      			$data['user'] =$this->Auth_Model->get_user_details($user_id);
      			$data['apartment'] = $this->Apartment_model->get_all_active_apartments();
      			$data['blocks_list'] = $this->Apartment_model->get_balocks_by_apts($data['user']->appartment);
            $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
            $data['count'] = count($data['cart']);
            $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
            $data['pageTitle'] = 'Billing';
            $this->load->view('home/edit_billing',$data);
          } else {
            $post_data = $this->input->post();
            $addl_data = array('updated_date' => date('Y-m-d H:i:s'),'updated_by' => $this->session->userdata('id'),'status' => 'Active');
            $post_data = array_merge($post_data,$addl_data);
            $post_id = $this->input->post('id');
            $this->Auth_Model->old_address($post_id);
            if($this->Auth_Model->Update($post_data,$post_id)) {
              $this->session->set_flashdata('success','Updated successfully');
              redirect('/billing');
            } else {
              $this->session->set_flashdata('error', 'Please,try again');
              redirect('/billing');
            }
          }
        } else {
          $data['categories'] = $this->Category_model->get_all_category();
          $user_id = $this->session->userdata('id');
    		  $this->load->model('Auth_Model');
    		  $data['user'] =$this->Auth_Model->get_user_details($user_id);
    		  $data['apartment'] = $this->Apartment_model->get_all_active_apartments();
    		  $data['blocks_list'] = $this->Apartment_model->get_balocks_by_apts($data['user']->appartment);
          $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
          $data['count'] = count($data['cart']);
          $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
          $data['pageTitle'] = 'Billing';
          $this->load->view('home/edit_billing',$data);
        }
    } else {
      redirect('home/login');
    }
  }
  //Delete billing Address
  public function delete($id='')
  {
    if ($this->session->userdata('logged_in') == TRUE) {
      if($id){
        $post_data = array('status'=>'Deleted');
        if ($this->Billing_Model->update($post_data,$id)) {
          $this->session->set_flashdata('success','Deleted successfully');
          redirect('/billing');
        } else {
          $this->session->set_flashdata('error','Please try agains');
          redirect('/billing');
        }
      } else {
        $this->session->set_flashdata('error','Sorry, there is a problem in deleting record');
        redirect('/billing');
      }
    } else {
      $this->session->set_flashdata('error','Please login to continue');
      redirect('home/login');
    }
  }
  //For validations
  public function alpha_dash_space($str){
      if (! preg_match('/^[a-zA-Z\s]+$/', $str)) {
          $this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha characters & White spaces');
          return FALSE;
      } else {
          return TRUE;
      }
  }
  //getting blocks by apartment id
  public function get_blocks_by_apartment_id()
  {
      $apartment_id = $this->input->post('apartment_id');
      $block = $this->input->post('block');
      if ($apartment_id) {
        $blocks = $this->Apartment_model->get_blocks_by_apartment_id($apartment_id);
        if(count($blocks) > 0){
          $result = '<option value="">--Select Block--</option>';
          foreach ($blocks as $b) {
            $selected = (isset($block) && ($block == $b->block_id)) ? "selected":"";
            $result .= '<option value='.$b->block_id.' '.$selected.'>'.$b->block_name.'</option>';
          }
          echo $result;exit();
        } else {
          $result = '<option value="">--No Block found--</option>';
          echo $result;exit();
        }
      } else {
        $this->session->set_flashdata('error','Sorry, there is a problem in getting blocks');
        redirect('/billing');
      }

  }

}

?>
