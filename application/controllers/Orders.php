<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');

class Orders extends In_frontend{

	
	public function __construct() 
	{
		parent::__construct();
$this->load->model('Category_model');	
$this->load->model('Product_model');
$this->load->model('Slider_model');	
$this->load->model('Orders_model');	
				
		}
		public function total_order_list(){
			if($this->session->userdata('svadmin_det')){
				$data['tot_list']=$this->Orders_model->total_order_list();
				if(count($data['tot_list']>0)){
					$data['tot_status']=1;
				}
				else{
					$data['tot_status']=0;
				}
			$this->load->view('admin/total_orders_list',$data);
		    $this->load->view('admin/footer');
			
		}
		else{redirect('login');}
		}
		
		public function pending_order_list(){
			if($this->session->userdata('svadmin_det')){
				$data['pending_list']=$this->Orders_model->pending_order_list();
				if(count($data['pending_list']>0)){
					$data['pending_status']=1;
				}
				else{
					$data['pending_status']=0;
				}
				
			//echo '<pre>'	;print_r($data);exit;
			$this->load->view('admin/pending_orders_list',$data);
		    $this->load->view('admin/footer');
			
		}
		else{redirect('login');}
		}
			public function delivered_order_list(){
			if($this->session->userdata('svadmin_det')){
				$data['delivered_list']=$this->Orders_model->delivered_order_list();
				if(count($data['delivered_list']>0)){
					$data['delivered_status']=1;
				}
				else{
					$data['delivered_status']=0;
				}
			$this->load->view('admin/delivered_orders_list',$data);
		    $this->load->view('admin/footer');
			
		}
		else{redirect('login');}
		}
		public function cancel_order_list(){
			if($this->session->userdata('svadmin_det')){
				$data['cancel_list']=$this->Orders_model->cancel_order_list();
				if(count($data['cancel_list']>0)){
					$data['cancel_status']=1;
				}
				else{
					$data['cancel_status']=0;
				}
				
			//echo '<pre>'	;print_r($data);exit;
			$this->load->view('admin/cancel_orders_list',$data);
		    $this->load->view('admin/footer');
			
		}
		else{redirect('login');}
		}
		public function deliver_order(){
			if($this->session->userdata('svadmin_det')){
				$admin=$this->session->userdata('svadmin_det');
			$svadmin=$admin['admin_id'];
			  $id=base64_decode($this->uri->segment(3));
             $status=$this->Orders_model->change_to_delivery_status($id,$svadmin);			  
				
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
             $status=$this->Orders_model->change_to_cancel_status($id,$svadmin);	
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
             $status=$this->Orders_model->change_to_pending_status($id,$svadmin);	
           if($status=1){
				redirect($_SERVER['HTTP_REFERER']);
			} 
			else{
				redirect($_SERVER['HTTP_REFERER']);
			}			 
				
			
			
		}
		else{redirect('login');}
		}
		
		
}
		
		