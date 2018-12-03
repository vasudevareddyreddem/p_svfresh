<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');

class Admin extends In_frontend{

	
	public function __construct() 
	{
		parent::__construct();	
				
		
	
		
	}
	public function index(){
		if($this->session->userdata('svadmin_det')){
			
			$this->load->view('admin/index');
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
		
	}
	

		public function add_product(){
		if($this->session->userdata('svadmin_det')){
			$this->load->view('admin/add_product');
		    $this->load->view('admin/footer');
			
			
		}
	
	}
	public function product_list(){
		if($this->session->userdata('svadmin_det')){
			$this->load->view('admin/products_list');
		    $this->load->view('admin/footer');
			
			
		}
	
	}
	public function total_order_list(){
		if($this->session->userdata('svadmin_det')){
			$this->load->view('admin/total_orders_list');
		    $this->load->view('admin/footer');
			
			
		}
	
	}
	public function pending_order_list(){
		if($this->session->userdata('svadmin_det')){
			$this->load->view('admin/pending_orders_list');
		    $this->load->view('admin/footer');
			
			
		}
	
	}
	public function delivered_order_list(){
		if($this->session->userdata('svadmin_det')){
			$this->load->view('admin/delivered_orders_list');
		    $this->load->view('admin/footer');
			
			
		}
	
	}
}