<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');

class Admin extends In_frontend{


	public function __construct()
	{
		parent::__construct();

		$this->load->model('Admin_model');


	}
	public function index(){
		if($this->session->userdata('svadmin_det')){
			$data['cat_count']=$this->Admin_model->count_cat();
			$data['users_count']=$this->Admin_model->count_users();
			$data['products_count']=$this->Admin_model->count_products();
			$data['orders_count']=$this->Admin_model->count_orders();

			$this->load->view('admin/index',$data);
		    $this->load->view('admin/footer');
		}
		else{
			redirect('login');
		}

	}
	public function dashboard(){
		if($this->session->userdata('svadmin_det')){

			redirect('admin');
		}
		else{
			redirect('login');
		}

	}
	public function change_password(){
		if($this->session->userdata('svadmin_det')){

			$this->load->view('admin/change_password');
		$this->load->view('admin/footer');
		}
		else{
			redirect('login');
		}

	}
	public function appcontent(){
		if($this->session->userdata('svadmin_det')){

			$data['m_details']=$this->Admin_model->get_app_content_data();
			$this->load->view('admin/appscroll_content',$data);
			$this->load->view('admin/footer');
		}else{
			redirect('login');
		}

	}
	public function update_scroll_content(){
		if($this->session->userdata('svadmin_det')){
			$admin=$this->session->userdata('svadmin_det');
			$post=$this->input->post();
				$u_con=array(
				  'text'=>isset($post['s_msg'])?$post['s_msg']:'',
				  'payment_option'=>isset($post['p_option'])?$post['p_option']:'',
				  'cus_mobile_num'=>isset($post['c_mobile'])?$post['c_mobile']:'',
				  'created_by'=>$admin['admin_id'],
				);
				$update=$this->Admin_model->update_app_content_data(1,$u_con);
				if(count($update)>0){
							$this->session->set_flashdata('success','Content successfully updated');
					       redirect($_SERVER['HTTP_REFERER']);
				}else{
					$this->session->set_flashdata('error','Technical problem occurred. Please try again');
					redirect($_SERVER['HTTP_REFERER']);
				}
		}else{
			redirect('login');
		}

	}
	public function new_password(){
	if($this->session->userdata('svadmin_det')){
	$this->form_validation->set_rules('oldpassword', 'olde Password', 'required');
	$this->form_validation->set_rules('newpassword', 'new Password', 'required|min_length[6]');
    $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|matches[newpassword]');
 if ($this->form_validation->run() == FALSE)
                {
          $this->session->set_flashdata('error',validation_errors());

                    redirect($_SERVER['HTTP_REFERER']);

               }
			   $det=$this->session->userdata('svadmin_det');
			   $id=$det['admin_id'];
			   $pwd=$this->input->post('oldpassword');
			   $newpwd=$this->input->post('newpassword');
			  $flag=$this->Admin_model->check_password($id,$pwd);
			  if($flag==1){
				 $flag=$this->Admin_model->set_new_password($id,$newpwd);
				 if($flag==1){
					 $this->session->set_flashdata('success','password successfully changed');
					 redirect('admin');
				 }
				 else{
					 $this->session->set_flashdata('error','your password  is as same as old password ,change password');
					redirect($_SERVER['HTTP_REFERER']);
				 }
			  }
			  else{
				 $this->session->set_flashdata('error','old password is incorrect enter correct password');
				   redirect($_SERVER['HTTP_REFERER']);

			  }

}
}

public  function delete_unwanted_data(){
	$user_list=$this->Admin_model->get_all_users_data();
	//echo $this->db->last_query();
	//echo '<pre>';print_r($user_list);exit;
	if(count($user_list)>0){
		foreach($user_list as $list){
				$minutes_to_add = 5;
				$time = new DateTime($list['otp_created_on']);
				$time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
				$stamp = $time->format('Y-m-d H:i:s');
				$time=date('Y-m-d H:i:s');
				
				if($time >=$list['otp_created_on'] && $time<= $stamp){
				
				}else{
					$this->Admin_model->user_delete($list['id']);
				}
		}
		
	}
}
 public function notifications()
    {
        
        
		$minutes_to_add = 1;
        $d              = date('Y-m-d H:i:s');
        $time           = new DateTime($d);
        $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
        $stamp = $time->format('Y-m-d H:i:s');
	    $newTime = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." -2 minutes"));
	   
		$this->load->model('Mobile_model');
		$users_lists=$this->Mobile_model->get_token_users_list();
		if(count($users_lists)>0){
			
			foreach($users_lists as $li){
				
				 $save=$this->Mobile_model->get_new_product_names_inbetween($stamp,$newTime);
				 //echo $this->db->last_query();exit;
				if(count($save)>0){
						foreach($save as $list){
							$lis[]=$list['product_name'].' having '.$list['discount_percentage'].' % discount ';
						}
						$n_msg=implode(', ',$lis);
						$serverKey = $this->config->item('server_key_push');
						$url          = "https://fcm.googleapis.com/fcm/send";
						$token        = $li['token'];
						$title        = "SVfresh";
						//$body = "Hello ".$details['name']." you have an appointment booked";
						$notification = array(
							'title' => $title,
							'text' => $n_msg,
							'sound' => 'default',
							'badge' => '1'
						);
						$arrayToSend  = array(
							'to' => $token,
							'notification' => $notification,
							'priority' => 'high'
						);
						$json         = json_encode($arrayToSend);
						$headers      = array();
						$headers[]    = 'Content-Type: application/json';
						$headers[]    = 'Authorization: key=' . $serverKey;
						$ch           = curl_init();
						curl_setopt($ch, CURLOPT_URL, $url);
						
						curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
						curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
						curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
						//Send the request
						$response = curl_exec($ch);
						
						echo '<pre>';print_r($response);
						//Close request
						if ($response === FALSE) {
							die('FCM Send Error: ' . curl_error($ch));
						}
						curl_close($ch);
						
				}
				
			}
			
		}
        
    }





}
