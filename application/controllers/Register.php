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
      $this->form_validation->set_rules('first_name', 'First Name', 'required');
      $this->form_validation->set_rules('last_name', 'Last Name', 'required');
      $this->form_validation->set_rules('email_id', 'Email id', 'required|valid_email|is_unique[users_tab.email_id]');
      $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|regex_match[/^[0-9]{10}$/]|is_unique[users_tab.phone_number]');
      $this->form_validation->set_rules('user_name', 'User Name', 'required|is_unique[users_tab.user_name]');
      //$this->form_validation->set_rules('password', 'Password', 'required|matches[confirm_password]');
      //$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');
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
		$num=str_pad(mt_rand(0, 999999), 6,'0', STR_PAD_LEFT);
        $addl_array = array('created_date' => date('Y-m-d H:i:s'),'otp_created_on' => date('Y-m-d H:i:s'),'status'=>'Active','otp'=>$num,'role'=>'User');
        unset($post_array['submit']);
        $post_array = array_merge($post_array,$addl_array);
		
		$save=$this->Auth_Model->insert($post_array);
		//echo '<pre>';print_r($save);exit;
        if(count($save)>0){
					$this->session->set_flashdata('success', 'Your registration successful.');
					$mobile=$post_array['phone_number'];
					$username=$this->config->item('smsusername');
					$pass=$this->config->item('smspassword');
					$sender=$this->config->item('sender');
					$msg = "Dear Customer Your otp  is ".$num;
					 /* seller purpose*/
					$ch2 = curl_init();
					curl_setopt($ch2, CURLOPT_URL,"http://trans.smsfresh.co/api/sendmsg.php");
					curl_setopt($ch2, CURLOPT_POST, 1);
					curl_setopt($ch2, CURLOPT_POSTFIELDS,'user='.$username.'&pass='.$pass.'&sender='.$sender.'&phone='.$mobile.'&text='.$msg.'&priority=ndnd&stype=normal');
					curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
					$server_output = curl_exec ($ch2);
					redirect('register/otpverification/'.base64_encode($save));
           
          
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
  public  function otpverification(){
	  $id=base64_decode($this->uri->segment(3));
	  if($id!=''){
		  $detils=$this->Auth_Model->user_details($id);
		  if(count($detils)>0){
			    $data['id']=$id;
			    $data['pageTitle'] = 'Otp Verification';
				$data['categories'] = $this->Category_model->get_all_category();
				$user_id = $this->session->userdata('id');
				$data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
				$data['count'] = count($data['cart']);
				$this->load->model('Apartment_model');
				$data['apartment'] = $this->Apartment_model->get_all_active_apartments();
				$data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('home/otpverification',$data);
		  }else{
			$this->session->set_flashdata('error', 'Please,try again');
			redirect('register/otpverification/'.base64_encode($id));  
		  }
		 
		  //echo '<pre>';print_r($detils);exit;
		  
	  }else{
		  $this->session->set_flashdata('error', 'Please,try again');
          redirect('register'); 
	  }
  }
  public  function verifyotp(){
	     $post=$this->input->post();
		 $result = $this->Auth_Model->user_details($post['id']);
		 if(count($result)>0){
			 
		 }else{
			$this->session->set_flashdata('error', 'technical problem will occured. Please try again');
			redirect('register');    
		 }
		// echo '<pre>';print_r($post);exit;
		$this->form_validation->set_rules('password', 'Password', 'required|matches[confirm_password]');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');
		$this->form_validation->set_rules('otp', 'otp', 'required');
		if ($this->form_validation->run() == FALSE){
				$data['id']=$post['id'];
			    $data['pageTitle'] = 'Otp Verification';
				$data['categories'] = $this->Category_model->get_all_category();
				$user_id = $this->session->userdata('id');
				$data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
				$data['count'] = count($data['cart']);
				$this->load->model('Apartment_model');
				$data['apartment'] = $this->Apartment_model->get_all_active_apartments();
				$data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
			   $this->load->view('home/otpverification',$data);
		}else{
			  $result = $this->Auth_Model->user_details($post['id']);
			  if(count($result) > 0){
				  if($result['otp']==$post['otp']){
					  $post_password = $this->input->post('password');
					  $u_data=array('verified' =>1,'password' => password_hash($post_password,PASSWORD_DEFAULT));
					  $this->Auth_Model->update_user_data($post['id'],$u_data);
						$userData = array('id'=>$result['id'],'email_id'=>$result['email_id'],'phone_number'=>$result['phone_number'],'role'=>$result['role'],'logged_in'=>TRUE);
						$this->session->set_userdata($userData);
						redirect('home');
				  }else{
					$this->session->set_flashdata('error', 'otp are not matched. Please try again');
					redirect('register/otpverification/'.base64_encode($post['id']));   
				  }
				
			  }
         
		}

	  
  }

}

?>
