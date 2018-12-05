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
  }

  public function index()
  {
    if($this->input->post()){
      //validations
      $this->form_validation->set_rules('email_id', 'Email id', 'required|is_unique[users_tab.email_id]');
      $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|regex_match[/^[0-9]{10}$/]|is_unique[users_tab.phone_number]');
      $this->form_validation->set_rules('user_name', 'User Name', 'required|is_unique[users_tab.user_name]');
      $this->form_validation->set_rules('password', 'Password', 'required|matches[password]');
      if ($this->form_validation->run() == FALSE){
        $data['pageTitle'] = 'Register';
        $data['categories'] = $this->Category_model->get_all_category();
        $this->load->view('home/register',$data);
      }else{
        //posting formdata and inserting into database
        $post_array = $this->input->post();
        $post_password = $this->input->post('password');
        $addl_array = array('created_date' => date('Y-m-d H:i:s'),'status'=>'Active','password' => password_hash($post_password,PASSWORD_DEFAULT),'role'=>'User');
        unset($post_array['submit']);
        unset($post_array['confirm_password']);
        $post_array = array_merge($post_array,$addl_array);
        if($this->Auth_Model->insert($post_array)){
          $this->session->set_flashdata('success', 'Your registation successful.');
          $post_phone_number = array('phone_number' => $this->input->post('phone_number'));
          $result = $this->Auth_Model->login($post_phone_number);
          if(count($result) > 0){
            $userData = array('email_id'=>$result->email_id,'phone_number'=>$result->phone_number,'role'=>$result->role,'logged_in'=>TRUE);
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
      $this->load->view('home/register',$data);
    }
  }

}

?>
