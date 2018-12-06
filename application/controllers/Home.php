<?php

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
  }

  public function index()
  {
    if($this->session->userdata('logged_in') == TRUE){
      $data['pageTitle'] = 'Welcome to svfresh';
      $data['categories'] = $this->Category_model->get_all_category();
      $data['products'] = $this->Product_model->get_all_product();
      $user_id = $this->session->userdata('id');
      $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
      $data['count'] = count($data['cart']);
      $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
      $this->load->view('home/index',$data);
    }else{
      redirect('home/login');
    }
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

  public function logout()
  {
    $this->session->sess_destroy();
    redirect('home/login');
  }

}

?>
