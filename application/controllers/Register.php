<?php
/**
 *
 */
class Register extends CI_controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Auth_Model');
    $this->load->model('Category_model');
    $this->load->library('form_validation');
    $this->load->model('Cart_Model');
  }

  public function index()
  {
    if($this->input->post()){
      //validations
      $this->form_validation->set_rules('email_id', 'Email id', 'required|valid_email|is_unique[users_tab.email_id]');
      $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|regex_match[/^[0-9]{10}$/]|is_unique[users_tab.phone_number]');
      $this->form_validation->set_rules('user_name', 'User Name', 'required|is_unique[users_tab.user_name]');
      $this->form_validation->set_rules('password', 'Password', 'required|matches[confirm_password]');
      $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');
	   $this->form_validation->set_rules('appartment', 'Appartment', 'required');
        $this->form_validation->set_rules('block', 'Block', 'required');
        $this->form_validation->set_rules('flat_door_no', 'Flat/Door no', 'required');
      if ($this->form_validation->run() == FALSE){
        $data['pageTitle'] = 'Register';
        $data['categories'] = $this->Category_model->get_all_category();
        $user_id = $this->session->userdata('id');
        $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
        $data['count'] = count($data['cart']);
		$this->load->model('Apartment_model');
	    $data['apartment'] = $this->Apartment_model->get_all_active_apartments();
        $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
        $this->load->view('home/register',$data);
      }else{
        //posting formdata and inserting into database
		
        $post_array = $this->input->post();
        $post_password = $this->input->post('password');
        $addl_array = array('created_date' => date('Y-m-d H:i:s'),'status'=>'Active','password' => password_hash($post_password,PASSWORD_DEFAULT),'role'=>'User');
        unset($post_array['submit']);
        unset($post_array['confirm_password']);
        $post_array = array_merge($post_array,$addl_array);
		//echo '<pre>';print_r($post_array);
        if($this->Auth_Model->insert($post_array)){
          $this->session->set_flashdata('success', 'Your registration successful.');
          $post_phone_number = array('phone_number' => $this->input->post('phone_number'));
          $result = $this->Auth_Model->login($post_phone_number);
          if(count($result) > 0){
            $userData = array('id'=>$result->id,'email_id'=>$result->email_id,'phone_number'=>$result->phone_number,'role'=>$result->role,'logged_in'=>TRUE);
            $this->session->set_userdata($userData);
          }
          redirect('home');
        }else{
          $this->session->set_flashdata('error', 'Please,try again');
          redirect('register');
        }
      }
    }else{
      //loading view
      $data['pageTitle'] = 'Register';
      $data['categories'] = $this->Category_model->get_all_category();
      $user_id = $this->session->userdata('id');
      $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
	  $this->load->model('Apartment_model');
	  $data['apartment'] = $this->Apartment_model->get_all_active_apartments();
      $data['count'] = count($data['cart']);
      $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
      $this->load->view('home/register',$data);
    }
  }

}

?>
