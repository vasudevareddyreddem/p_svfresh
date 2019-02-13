<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_controller
{

  function __construct()
  {
    parent::__construct();
	$this->load->library('user_agent');

    $this->load->library('form_validation');
    $this->load->model('Auth_Model');
    $this->load->model('Category_model');
    $this->load->model('Product_model');
    $this->load->model('Cart_Model');
    $this->load->model('Slider_model');
    $this->load->model('Wishlist_Model');
  }

  public function index()
  {
    //if($this->session->userdata('logged_in') == TRUE){
    $data['pageTitle'] = 'Welcome to svfresh';
    $data['categories'] = $this->Category_model->get_all_category();
    $data['products'] = $this->Product_model->get_all_product();
    $data['rating'] = $this->Product_model->get_product_rating();
    $data['slides'] = $this->Slider_model->get_all_slides();
    $data['slider_side_images'] = $this->Slider_model->get_slides_side_images();
    $user_id = $this->session->userdata('id');
    $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
    $data['cart_product_id'] = $this->Cart_Model->get_product_ids_in_cart($user_id);
    $data['wishlist_product_id'] = $this->Wishlist_Model->get_product_ids_in_wishlist($user_id);
    $data['count'] = count($data['cart']);
    $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);

	//echo '<pre>';print_r($data);exit;
    $this->load->view('home/index',$data);
    // }else{
    //   redirect('home/login');
    // }
  }
  //user login
  public function Login()
  {

	if (!$this->session->userdata('logged_in') == TRUE) {
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
        $post_array = array('phone_number' => $this->input->post('phone_number'),'status' => 'Active');
        $result = $this->Auth_Model->login($post_array);
        if(count($result) > 0){
          if(password_verify($this->input->post('password'),$result->password)){
            $userData = array('id'=>$result->id,'email_id'=>$result->email_id,'phone_number'=>$result->phone_number,'role'=>$result->role,'logged_in'=>TRUE);
            $this->session->set_userdata($userData);
			redirect('home');
			//redirect($this->agent->referrer());
			//redirecting user to home page with user details
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
  }else{
	  $this->session->set_flashdata('error','You have no permissions to access');
     redirect('home');
  }

  }

  public function profile(){
    if ($this->session->userdata('logged_in') == TRUE) {
      if($this->input->post()){
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email_id', 'Email id', 'required|valid_email|callback_is_unique_email');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|regex_match[/^[0-9]{10}$/]|callback_is_unique_phone_number');
        $this->form_validation->set_rules('user_name', 'User Name', 'required|callback_is_unique_username');
        $this->form_validation->set_rules('appartment', 'Apartment', 'required');
        $this->form_validation->set_rules('block', 'Block', 'required');
        $this->form_validation->set_rules('flat_door_no', 'Flat/Door Number', 'required');
        if($this->form_validation->run() == FALSE){
		  $data['pageTitle'] = 'Profile';
          $data['categories'] = $this->Category_model->get_all_category();
          $user_id = $this->session->userdata('id');
          $data['user'] = $this->Auth_Model->get_user_details($user_id);
          $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
          $data['count'] = count($data['cart']);
		  $this->load->model('Apartment_model');
	      $data['apartment'] = $this->Apartment_model->get_all_active_apartments();
          $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
          $this->load->view('home/profile',$data);
        }else{
          $post_data = $this->input->post();
          $id = $this->input->post('id');
		  //echo '<pre>';print_r($post_data);exit;

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
		$this->load->model('Apartment_model');
	    $data['apartment'] = $this->Apartment_model->get_all_active_apartments();
	    $data['blocks_list'] = $this->Apartment_model->get_balocks_by_apts($data['user']->appartment);
		//echo $this->db->last_query();
        $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
	    //echo '<pre>';print_r($data);exit;

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
  //forgot password
  public function fpassword()
  {
    if ($this->input->post()) {
      $this->form_validation->set_rules('phone_number', 'Phone Number', 'required');
      if ($this->form_validation->run() == FALSE) {
        $data['pageTitle'] = 'Forgot password';
        $this->load->view('home/forgotpassword',$data);
      } else {
        $phone_number = $this->input->post('phone_number');
        $user_data = $this->Auth_Model->get_user_details_by_phone_number($phone_number);
        if ($user_data) {
          $otp = $this->generate_otp();
          if ($otp) {
            $post_data = array('status' => 'Inactive','otp' => $otp,'otp_created_on' => date('Y-m-d H:i:s'));
            if ($this->Auth_Model->update($post_data,$user_data->id)) {
              //sms for opt
              $mobile = $user_data->phone_number;
              $username = $this->config->item('smsusername');
              $password = $this->config->item('smspassword');
              $sender = $this->config->item('sender');
              $message = "Dear Customer Your otp  is ".$otp;
              $ch2 = curl_init();
              curl_setopt($ch2, CURLOPT_URL,"http://trans.smsfresh.co/api/sendmsg.php");
              curl_setopt($ch2, CURLOPT_POST, 1);
              curl_setopt($ch2, CURLOPT_POSTFIELDS,'user='.$username.'&pass='.$password.'&sender='.$sender.'&phone='.$mobile.'&text='.$message.'&priority=ndnd&stype=normal');
              curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
              $server_output = curl_exec ($ch2);
              curl_close ($ch2);
              //--->
              $this->session->set_userdata('phone_number',$phone_number);
              $this->session->set_flashdata('success','Otp send to user registered phone number');
              redirect('home/otp');
            } else {
              $this->session->set_flashdata('error','Please try again');
              redirect($this->agent->referrer());
            }
          } else {
            $this->session->set_flashdata('error','Please try again');
            redirect($this->agent->referrer());
          }
        } else {
          $this->session->set_flashdata('error','Invalid Phone Number');
          redirect($this->agent->referrer());
        }
      }
    } else {
      $data['pageTitle'] = 'Forgot password';
      $this->load->view('home/forgotpassword',$data);
    }
  }
  //enter otp
  public function otp()
  {
    if($this->session->userdata('phone_number')) {
      if ($this->input->post()) {
        $this->form_validation->set_rules('otp', 'otp', 'required');
        if ($this->form_validation->run() == FALSE) {
          $data['pageTitle'] = 'Forgot password';
          $this->load->view('home/otp',$data);
        } else {
          $phone_number = $this->input->post('phone_number');
          $otp = $this->input->post('otp');
          $user_data = $this->Auth_Model->get_user_details_by_otp_phone_number($phone_number,$otp);
          if ($user_data) {
            $this->session->unset_userdata('phone_number');
            $start_date = new DateTime(date('Y-m-d  H:i:s'));
            $since_start = $start_date->diff(new DateTime($user_data->otp_created_on));
            $time = $since_start->s;
            if ($time > 300) {
              $this->session->set_flashdata('error','Otp entered is invalid');
              redirect('home/fpassword');
            } else {
              $this->session->set_userdata('userid',$user_data->id);
              $this->session->set_flashdata('success','Reset your new password');
              redirect('home/rpassword');
            }
          } else {
            $this->session->set_flashdata('error','Otp entered is invalid');
            redirect($this->agent->referrer());
          }
        }
      } else {
        $data['pageTitle'] = 'Otp';
        $this->load->view('home/otp',$data);
      }
    } else {
      $this->session->set_flashdata('error','No direct access allowed');
      redirect('home/fpassword');
    }
  }
  //reset password
  public function rpassword()
  {
    if ($this->session->userdata('userid')) {
      if ($this->input->post()) {
        $this->form_validation->set_rules('password', 'New Password', 'required|required|matches[confirm_password]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');
        if ($this->form_validation->run() == FALSE) {
          $data['pageTitle'] = 'Reset password';
          $this->load->view('home/resetpassword',$data);
        } else {
          $user_id = $this->input->post('id');
          $password = password_hash($this->input->post('password'),PASSWORD_DEFAULT);
          if ($this->Auth_Model->change_password($user_id,array('password' => $password,'status' => 'Active'))) {
            $this->session->unset_userdata('userid');
            $this->session->set_flashdata('success', 'Password changed successfully.');
            redirect('home/login');
          } else {
            $this->session->set_flashdata('error', 'Please try again.');
            redirect($this->agent->referrer());
          }
        }
      } else {
        $data['pageTitle'] = 'Reset password';
        $this->load->view('home/resetpassword',$data);
      }
    } else {
      $this->session->set_flashdata('error','No direct access allowed');
      redirect('home/fpassword');
    }
  }
  //generate otp
  function generate_otp() {
      $numbers_string = "1357902468";
      $result = "";
      for ($i = 1; $i <= 6; $i++) {
          $result .= substr($numbers_string, (rand()%(strlen($numbers_string))), 1);
      }
      return $result;
  }
	public  function newletterpost(){
		$post=$this->input->post();
		$add=array(
		'email'=>isset($post['email'])?$post['email']:'',
		'created_at'=>date('Y-m-d H:i:s'),
		);
		$check=$this->Auth_Model->check_email_ornot($post['email']);
		if(count($check)>0){
			$this->session->set_flashdata('error',"Your are already subscribed. Please try another email id");
			redirect($this->agent->referrer());
		}else{
			$save=$this->Auth_Model->save_newsletters_emails($add);
			if(count($save)>0){
				$this->session->set_flashdata('success',"Successfully subscribed newsletter");
				redirect($this->agent->referrer());
			}else{
				$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
				redirect($this->agent->referrer());
			}
		}


	}
	/* remove cart item*/
	public  function remove_cart_item(){
		 if ($this->session->userdata('logged_in') == TRUE) {
			 $post=$this->input->post();
			 $delete=$this->Auth_Model->delete_cart_item($post['cart_id']);
			 if(count($delete)>0){
				  $user_id = $this->session->userdata('id');
				 $qty_cnt=$this->Auth_Model->get_cart_item_qty($user_id);
				 $data['msg']=1;
				 $data['qty_count']=$qty_cnt['cnt'];
				 echo json_encode($data);
			 }else{
				 $data['msg']=0;
				 echo json_encode($data);
			 }

		 }else{
				$this->session->set_flashdata('error',"Please log in or sign up to continue");
			  redirect('home/login');
		 }


	}
  public function contactus()
  {
	  $data['pageTitle'] = 'Contact Us';
      $data['categories'] = $this->Category_model->get_all_category();
      $user_id = $this->session->userdata('id');
      $data['user'] = $this->Auth_Model->get_user_details($user_id);
      $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
      $data['count'] = count($data['cart']);
      $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
    $this->load->view('home/contactus',$data);
  }
  public  function contactuspost(){
	  $post=$this->input->post();

		$addcontact=array(
		'name'=>isset($post['name'])?$post['name']:'',
		'email'=>isset($post['email'])?$post['email']:'',
		'mobile'=>isset($post['mobile'])?$post['mobile']:'',
		'message'=>isset($post['message'])?$post['message']:'',
		'create_at'=>date('Y-m-d H:i:s'),
		);

		//echo '<pre>';print_r($post);exit;

		$save=$this->Auth_Model->save_contactus($addcontact);
		if(count($save)>0){
				$data['details']=$post;
				$this->load->library('email');
				$this->load->library('email');
			    $this->email->set_newline("\r\n");
			    $this->email->set_mailtype("html");
				$this->email->from($post['email']);
				$this->email->to('support@svfresh.com');
				$this->email->subject('Contact us - Request');
				//$body = $this->load->view('email/contactus.php',$data,true);
				//$html = $this->load->view('email/orderconfirmation.php', $data, true);

				$msg='Name:'.$post['name'].' Email :'.$post['email'].'<br> Phone  number :'.$post['phone'].'<br> Message :'.$post['message'];
				$this->email->message($msg);
				//echo $body;exit;
				$this->email->send();

				//echo "test";exit;
				$this->session->set_flashdata('success',"Your message was successfully sent.");
				redirect($this->agent->referrer());
			}else{
				$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
				redirect($this->agent->referrer());
			}
  }

  public  function get_all_products_list(){
	  $post=$this->input->post();
	  $p_list=$this->Auth_Model->get_all_products_lists($post['serach']);
	  foreach($p_list as $list){
			$product_lists[] = $list['product_name'];
		}
		$imp = "'" . implode( "','", $product_lists) . "'";
		$data['msg']=$imp ;
		echo json_encode($data);

  }
  public  function search(){
	  $post=$this->input->post();
	  //echo '<pre>';print_r($post);exit;
	  if($post['search_key']!=''){
		  redirect('product/'.$post['search_key']);

	  }else{
			$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
				redirect($this->agent->referrer());
	  }

  }
  public function logout()
  {
    $this->session->sess_destroy();
    redirect('home/login');
  }

}

?>
