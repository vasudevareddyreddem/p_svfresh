<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');

class Milkorder extends In_frontend{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Category_model')	;
		$this->load->model('Product_model')	;
		$this->load->model('Milkorders_model')	;
		$this->load->model('Apartment_model')	;

	}
	public function total_order_list(){
		if($this->session->userdata('svadmin_det')){
			//getting all active apartments
			$data['apartment'] = $this->Apartment_model->get_all_active_apartments();
			$post = $this->input->post();
			if ($post) {
				unset($post['button']);
				$apartment = $this->input->post('apartment');
				$block = $this->input->post('block');
				$date = $this->input->post('date');
				$mobile=$this->input->post('phonenum');
				$data['filter'] = $post;
				$data['tot_list']=$this->Milkorders_model->total_order_list($apartment,$block,$date,$mobile);
			} else {
				$data['tot_list']=$this->Milkorders_model->total_order_list();
			}

			if(count($data['tot_list'])>0){
				$data['tot_status']=1;
			}
			else{
				$data['tot_status']=0;
			}
			//echo '<pre>';print_r($data);exit;
			$this->load->view('admin/milk_tot_order_list',$data);
			$this->load->view('admin/milk-footer');

		}
		else{redirect('login');}
	}

	public function pending_order_list(){
		if($this->session->userdata('svadmin_det')){
			$data['apartment'] = $this->Apartment_model->get_all_active_apartments();
			$post = $this->input->post();
			if ($post) {
				unset($post['button']);
				$apartment = $this->input->post('apartment');
				$block = $this->input->post('block');
				$date = $this->input->post('date');
				$mobile=$this->input->post('phonenum');
				$data['filter'] = $post;
				$data['pending_list']=$this->Milkorders_model->pending_order_list($apartment,$block,$date,$mobile);
			}
			else{
			$data['pending_list']=$this->Milkorders_model->pending_order_list();
		}
			if(count($data['pending_list'])>0){
				$data['pending_status']=1;
			}
			else{
				$data['pending_status']=0;
			}

			//echo '<pre>'	;print_r($data);exit;
			$this->load->view('admin/milk_pending_order_list',$data);
			$this->load->view('admin/milk-footer');

		}
		else{redirect('login');}
	}
	public function delivered_order_list(){
		if($this->session->userdata('svadmin_det')){
				$data['apartment'] = $this->Apartment_model->get_all_active_apartments();
			$post = $this->input->post();
			if ($post) {
				unset($post['button']);
				$apartment = $this->input->post('apartment');
				$block = $this->input->post('block');
				$date = $this->input->post('date');
				$mobile=$this->input->post('phonenum');
				$data['filter'] = $post;
				$data['delivered_list']=$this->Milkorders_model->delivered_order_list($apartment,$block,$date,$mobile);
			}
			else{
			$data['delivered_list']=$this->Milkorders_model->delivered_order_list();
		}

			if(count($data['delivered_list'])>0){
				$data['delivered_status']=1;
			}
			else{
				$data['delivered_status']=0;
			}
			$this->load->view('admin/milk_delivered_order_list',$data);
		$this->load->view('admin/milk-footer');

		}
		else{redirect('login');}
	}
	public function cancel_order_list(){
		if($this->session->userdata('svadmin_det')){
				$data['apartment'] = $this->Apartment_model->get_all_active_apartments();
			$post = $this->input->post();
			if ($post) {
				unset($post['button']);
				$apartment = $this->input->post('apartment');
				$block = $this->input->post('block');
				$date = $this->input->post('date');
				$mobile=$this->input->post('phonenum');
				$data['filter'] = $post;
				$data['cancel_list']=$this->Milkorders_model->cancel_order_list($apartment,$block,$date,$mobile);
			}
			else{
			$data['cancel_list']=$this->Milkorders_model->cancel_order_list();
		}
			if(count($data['cancel_list'])>0){
				$data['cancel_status']=1;
			}
			else{
				$data['cancel_status']=0;
			}

			//echo '<pre>'	;print_r($data);exit;
			$this->load->view('admin/milk_cancel_order_list',$data);
			$this->load->view('admin/milk-footer');

		}
		else{redirect('login');}
	}
	public function deliver_order(){
		if($this->session->userdata('svadmin_det')){
			$admin=$this->session->userdata('svadmin_det');
			$svadmin=$admin['admin_id'];
			$id=base64_decode($this->uri->segment(3));
			$status=$this->Milkorders_model->change_to_delivery_status($id,$svadmin);

			if($status=1){
				redirect($_SERVER['HTTP_REFERER']);
			}
			else{
				redirect($_SERVER['HTTP_REFERER']);
			}

		}
		else{redirect('login');}
	}
	public function cancel_order(){
		if($this->session->userdata('svadmin_det')){
			$admin=$this->session->userdata('svadmin_det');
			$svadmin=$admin['admin_id'];
			$id=base64_decode($this->uri->segment(3));
			$status=$this->Milkorders_model->change_to_cancel_status($id,$svadmin);
			if($status=1){
				redirect($_SERVER['HTTP_REFERER']);
			}
			else{
				redirect($_SERVER['HTTP_REFERER']);
			}



		}
		else{redirect('login');}
	}
	public function pending_order(){
		if($this->session->userdata('svadmin_det')){
			$admin=$this->session->userdata('svadmin_det');
			$svadmin=$admin['admin_id'];
			$id=base64_decode($this->uri->segment(3));
			$status=$this->Milkorders_model->change_to_pending_status($id,$svadmin);
			if($status=1){
				redirect($_SERVER['HTTP_REFERER']);
			}
			else{
				redirect($_SERVER['HTTP_REFERER']);
			}



		}
		else{redirect('login');}
	}

	//getting blocks by apartment id
  public function get_blocks_by_apartment_id()
  {
    if ($this->session->userdata('svadmin_det')) {
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
        redirect($_SERVER['HTTP_REFERER']);
      }
    } else {
      $this->session->set_flashdata('error','Please login to continue');
      redirect('login');
    }
  }

public function update_delv_sta_auto(){
	$this->Milkorders_model->auto_update_sataus();
exit;

}
public function boys_list(){
	  if ($this->session->userdata('svadmin_det')) {
			$data['apartment'] = $this->Apartment_model->get_all_active_apartments();
			$post = $this->input->post();

			if ($post) {

				$apartment = $this->input->post('apartment');
				$block = $this->input->post('block');
				$date = $this->input->post('date');

        $data['filter'] = $post;
				$data['pending_list']=$this->Milkorders_model->boys_order_list($apartment,$block,$date);
				if(count($data['pending_list'])>0){
					$data['pending_status']=1;
				}
				else{
					$data['pending_status']=0;
				}
			//	$data['boys_list']=$this->Milkorders_model->boys_tot_list($apartment,$block,$date,$mobile);
}
else{
		$data['pending_status']=0;

}



			//echo '<pre>'	;print_r($data);exit;
			$this->load->view('admin/milk_pending_boys',$data);
			$this->load->view('admin/milk-footer');
		}
			else {
	      $this->session->set_flashdata('error','Please login to continue');
	      redirect('login');

}

}
}
