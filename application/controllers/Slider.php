<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');

class Slider extends In_frontend{

	
	public function __construct() 
	{
		parent::__construct();
$this->load->model('Category_model');	
$this->load->model('Product_model');	
				
		}
		public function addslider(){
			if($this->session->userdata('svadmin_det')){
				$this->load->view('admin/add_slider');
		    $this->load->view('admin/footer');
			
		}
		else{redirect('login');}
		}
		}