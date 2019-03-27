<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');

class Profile extends In_frontend{


	public function __construct()
	{
		parent::__construct();
$this->load->model('Category_model');
$this->load->model('Product_model');
$this->load->model('Login_model');

		
		
}
public function index(){
if($this->session->userdata('svadmin_det')){
	$data['admin']=$this->session->userdata('svadmin_det');
          $this->load->view('admin/profile',$data);
		    $this->load->view('admin/footer');
}
else{
redirect('login');
}

}
public function save_profile(){
if($this->session->userdata('svadmin_det')){
	$admin=$this->session->userdata('svadmin_det');
	$svadmin=$admin['admin_id'];
	$data=array();
	if(!$this->input->post('name')==''){
		$data['f_name']=$this->input->post('name');
	}
	
	if(!$this->input->post('email')==''){
		$data['login_email']=$this->input->post('email');
	}
	if(!$this->input->post('mobile')==''){
		$data['phone_number']=$this->input->post('mobile');
	} $config['upload_path']          = './assets/uploads/profile_pics';
                $config['allowed_types']       = 'gif|jpg|png|jpeg|Jpeg|Png';


                $this->load->library('upload', $config);
				$img_status=0;
			  if($_FILES['image']['name']!=''){
				  if ( ! $this->upload->do_upload('image',time()))
                {
                        //$error = array('error' => $this->upload->display_errors());
 
                          $this->session->set_flashdata('error','profile image not uploaded');
					      redirect($_SERVER['HTTP_REFERER']);
                }
				else{
					$upload_data = $this->upload->data();
                    $profile_img =   $upload_data['file_name'];
					$img_status=1;
				}
			  }
			  if($img_status==1){
				  $data['profile_pic']=$profile_img;
			  }
			  $status=$this->Login_model->save_edit_profile($data,$svadmin);
			  if($status==1){
				  $this->session->unset_userdata('svadmin_det');
				  $row=$this->Login_model->get_admin_details($svadmin);
				  
				  $this->session->set_userdata('svadmin_det',$row);
				 $ts=$this->session->userdata('svadmin_det');
				// print_r($ts);exit;
				  
				   $this->session->set_flashdata('success','profile updated successfully');
			  redirect('profile');
			  }
			  else{
				   $this->session->set_flashdata('error','profile not updated successfully');
				  redirect('profile');
			  }
	
}

else{
redirect('login');
}
}

}