<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('Auth_Model');
    $this->load->model('Category_model');
    $this->load->model('Product_model');
    $this->load->model('Cart_Model');
    $this->load->model('Slider_model');
  }

  public function index()
  {
    //if($this->session->userdata('logged_in') == TRUE){
    $data['pageTitle'] = 'Welcome to svfresh';
    $data['categories'] = $this->Category_model->get_all_category();
    $data['products'] = $this->Product_model->get_all_product();
    $data['slides'] = $this->Slider_model->get_all_slides();
    $data['slider_side_images'] = $this->Slider_model->get_slides_side_images();
    $user_id = $this->session->userdata('id');
    $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
    $data['count'] = count($data['cart']);
    $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
    $this->load->view('home/index',$data);
    // }else{
    //   redirect('home/login');
    // }
  }
  //user login
  public function Login()
  {
    if($this->input->post()){
      //validating login form
      $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|regex_match[/^[0-9]{10}$/]');
      $this->form_validation->set_rules('password', 'Password', 'required');
      if ($this->form_validation->run() == FALSE){
        $data['pageTitle'] = 'Login';
        $data['categories'] = $this->Category_model->get_all_category();
        $user_id = $this->session->userdata('id');
        $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
        $data['count'] = count($data['cart']);
        $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
        $this->load->view('home/login',$data);
      }else{
        //checking user data
        $post_array = array('phone_number' => $this->input->post('phone_number'));
        $result = $this->Auth_Model->login($post_array);
        if(count($result) > 0){
          if(password_verify($this->input->post('password'),$result->password)){
            $userData = array('id'=>$result->id,'email_id'=>$result->email_id,'phone_number'=>$result->phone_number,'role'=>$result->role,'logged_in'=>TRUE);
            $this->session->set_userdata($userData);
            redirect('home');//redirecting user to home page with user details
          }else{
            $this->session->set_flashdata('error','Password entered with phone number is incorrect');
            redirect('home/login');//redirecting user to login page for invalid password
          }
        }else{
          $this->session->set_flashdata('error','Phone number is not registered');
          redirect('home/login');//redirecting user to login page for invalid Phone number
        }
      }
    }else{
      //displaying login view page
      $data['pageTitle'] = 'Login';
      $data['categories'] = $this->Category_model->get_all_category();
      $user_id = $this->session->userdata('id');
      $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
      $data['count'] = count($data['cart']);
      $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
      $this->load->view('home/login',$data);
    }
  }

  public function profile(){
    if ($this->session->userdata('logged_in') == TRUE) {
      if($this->input->post()){
        $this->form_validation->set_rules('email_id', 'Email id', 'required|callback_is_unique_email');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|callback_is_unique_phone_number');
        $this->form_validation->set_rules('user_name', 'User Name', 'required|callback_is_unique_username');
        if($this->form_validation->run() == FALSE){
          $data['pageTitle'] = 'Profile';
          $data['categories'] = $this->Category_model->get_all_category();
          $user_id = $this->session->userdata('id');
          $data['user'] = $this->Auth_Model->get_user_details($user_id);
          $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
          $data['count'] = count($data['cart']);
          $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
          $this->load->view('home/profile',$data);
        }else{
          $post_data = $this->input->post();
          $id = $this->input->post('id');
          unset($post_data['submit']);
          if($this->Auth_Model->update($post_data,$id)){
            $this->session->set_flashdata('success', 'Profile updated successfully.');
            redirect($_SERVER['HTTP_REFERER']);
          }else{
            $this->session->set_flashdata('error', 'Please try again.');
            redirect($_SERVER['HTTP_REFERER']);
          }
        }
      }else{
        $data['pageTitle'] = 'Profile';
        $data['categories'] = $this->Category_model->get_all_category();
        $user_id = $this->session->userdata('id');
        $data['user'] = $this->Auth_Model->get_user_details($user_id);
        $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
        $data['count'] = count($data['cart']);
        $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
        $this->load->view('home/profile',$data);
      }
    }else{
      redirect('home/login');
    }
  }
  //checking email unique
  public function is_unique_email($email)
  {
    $id = $this->input->post('id');
    if ($this->Auth_Model->check_email_exists($email,$id)){
      $this->form_validation->set_message('is_unique_email','The Email id field must contain a unique value.');
      $return = FALSE;
    }else{
      $return = TRUE;
    }
    return $return;
  }
  //checking user name unique
  public function is_unique_username($user_name)
  {
    $id = $this->input->post('id');
    if ($this->Auth_Model->check_username_exists($user_name,$id)){
      $this->form_validation->set_message('is_unique_username','The User Name field must contain a unique value.');
      $return = FALSE;
    }else{
      $return = TRUE;
    }
    return $return;
  }
  //checing phone number unique
  public function is_unique_phone_number($phone_number)
  {
    $id = $this->input->post('id');
    if ($this->Auth_Model->check_phone_number_exists($phone_number,$id)){
      $this->form_validation->set_message('is_unique_phone_number','The Phone Number field must contain a unique value.');
      $return = FALSE;
    }else{
      $return = TRUE;
    }
    return $return;
  }

  public function cpassword()
  {
    if ($this->input->post()) {
      $this->form_validation->set_rules('password', 'New Password', 'required|required|matches[confirm_password]');
      $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');
      if ($this->form_validation->run() == FALSE) {
        $data['pageTitle'] = 'Change password';
        $data['categories'] = $this->Category_model->get_all_category();
        $user_id = $this->session->userdata('id');
        $data['user'] = $this->Auth_Model->get_user_details($user_id);
        $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
        $data['count'] = count($data['cart']);
        $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
        $this->load->view('home/changepassword');
      } else {
        $user_id = $this->session->userdata('id');
        $password = password_hash($this->input->post('password'),PASSWORD_DEFAULT);
        if ($this->Auth_Model->change_password($user_id,array('password' => $password))) {
          $this->session->set_flashdata('success', 'Password changed successfully.');
          redirect($_SERVER['HTTP_REFERER']);
        } else {
          $this->session->set_flashdata('error', 'Please try again.');
          redirect($_SERVER['HTTP_REFERER']);
        }
      }
    } else {
      $data['pageTitle'] = 'Change password';
      $data['categories'] = $this->Category_model->get_all_category();
      $user_id = $this->session->userdata('id');
      $data['user'] = $this->Auth_Model->get_user_details($user_id);
      $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
      $data['count'] = count($data['cart']);
      $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
      $this->load->view('home/changepassword');
    }
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect('home/login');
  }

}

?>
