<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');

class Product extends In_frontend{

	
	public function __construct() 
	{
		parent::__construct();
$this->load->model('Category_model');	
//$this->load->model('Product_model');	
				
		}
	public	function encode_subcat($value)
{
  return base64_encode($value);
}
		public function add_product(){
		if($this->session->userdata('svadmin_det')){
			$data['cat_list']=$this->Category_model->get_category_names();
				if(count($data['cat_list'])>0){
					$data['status']=1;
					
					
				}
				else{
					$data['status']=0;
					
				}
			
			$this->load->view('admin/add_product',$data);
		    $this->load->view('admin/footer');
			
			
		}
		else{redirect('login');}
	
	}
		
		
		public function get_sub_category(){
			if( $this->session->userdata('svadmin_det')){
				$cat_id=base64_decode($this->uri->segment(3));
			
				$data['cat_list']=$this->Product_model->get_sub_category_names($cat_id);
				
				if(count($data['cat_list'])>0){
					$data['status']=1;
					echo json_encode($data);exit;
					
					
				}
				else{
					$data['status']=0;
					echo json_encode($data);exit;
					
				}
				
				
				}
			else{redirect('login');}
			
		}
}