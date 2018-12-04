<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');

class Product extends In_frontend{

	
	public function __construct() 
	{
		parent::__construct();
$this->load->model('Category_model');	
$this->load->model('Product_model');	
				
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
			//echo $cat_id; exit;
			
				$data['subcat_list']=$this->Product_model->get_sub_category_names($cat_id);
				//print_r($data);exit;
				
				if(count($data['subcat_list'])>0){
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
		public function save_product(){
			if( $this->session->userdata('svadmin_det')){
				$admin=$this->session->userdata('svadmin_det');
				$adminid=$admin['admin_id'];
				$cat_id=base64_decode($this->input->post('c_name'));
				$subcat_id=$this->input->post('sc_name');
				$product_name=$this->input->post('p_name');
				$act_price=$this->input->post('a_price');
				$qun=$this->input->post('quantity');
				$dis_price=$this->input->post('d_price');
				$dis_percentage=$this->input->post('dp_price');
				$f_names=$this->input->post('fname');
				$f_values=$this->input->post('fvalue');
				$net_price=$act_price-$dis_price;
				
				
				
				
				 $config['upload_path']          = './assets/uploads/category_pics';
                $config['allowed_types']        = 'gif|jpg|png';
                // $config['max_size']             = 100;
                // $config['max_width']            = 1024;
                // $config['max_height']           = 768;

                $this->load->library('upload', $config);
				
			
				  if ( ! $this->upload->do_upload('p_image'))
                {
                        //$error = array('error' => $this->upload->display_errors());

                          $this->session->set_flashdata('error','product image not uploaded'); 
					      redirect('product/add_product');
                }
				else{
					$upload_data = $this->upload->data(); 
                    $product_img =   $upload_data['file_name'];
				}
				
				$data=array(
				'product_name'=>$product_name,
				'product_img'=>$product_img,
				'cat_id'=>$cat_id,
				'subcat_id'=>$subcat_id,
				'actual_price'=>$act_price,
				'discount_price'=>$dis_price,
				'discount_percentage'=>$dis_percentage,
				'net_price'=>$net_price,
				'quantity'=>$qun,
				 'created_by'=>$adminid
				);
				$product_id=$this->Product_model->save_product($data);
				foreach($f_names as $key=>$value){
				  $features[]=array(
				  'feature_name'=>$value,
				  'feature_value'=>$f_values[$key],
				  'product_id'=>$product_id,
				  'created_by'=>$adminid
				  );
					
				}
				$status=$this->Product_model->save_features($features);
				
				 if($status==1){
				   $this->session->set_flashdata('success','product addded  successfully'); 
					      redirect('product/product_list');
					
					
				}
				 else{
					 $this->session->set_flashdata('error','features not added'); 
					       redirect('product/add_product');
				 }
				
				
			}
			else{redirect('login');}
			
		}
		public function product_list(){
		if($this->session->userdata('svadmin_det')){
			$data['product_list']=$this->Product_model->get_product_list();
			if(count($data['product_list'])>0){
				
				$data['status']=1;
			}
			else{
				
				$data['status']=0;
			}
			
			$this->load->view('admin/products_list',$data);
		    $this->load->view('admin/footer');
			
			
		}
	
	}
	public function edit_product(){
		if($this->session->userdata('svadmin_det')){
			$pid=base64_decode($this->uri->segment(3));
			$data['cat_list']=$this->Category_model->get_category_names();
			
			if(count($data['cat_list'])>0){
					$data['status']=1;
					
					
				}
				else{
					$data['status']=0;
					
				}
			
			$data['product']=$this->Product_model->edit_product($pid);
			if(!$data['product']){
				   $this->session->set_flashdata('error','this product deleted by another session'); 
			         redirect('product/product_list');
				
			}
		
			$data['fet_data']=$this->Product_model->get_features($pid);
			if(count($data['fet_data'])>0){
				$data['fstatus']=1;
			}
			else{
				$data['fstatus']=0;
			}
			  $cat_id=$data['product']->cat_id;
			   $data['sub_cats']=$this->Product_model->get_sub_category_names($cat_id);
		     $this->load->view('admin/edit_product',$data);
		    $this->load->view('admin/footer');
			
		
		}	
		else{redirect('login');}
		
	}
	public function save_edit_product(){
			if( $this->session->userdata('svadmin_det')){
				$admin=$this->session->userdata('svadmin_det');
				$adminid=$admin['admin_id'];
				$pid=base64_decode($this->input->post('pid'));
				$cat_id=base64_decode($this->input->post('c_name'));
				$subcat_id=$this->input->post('sc_name');
				$product_name=$this->input->post('p_name');
				$act_price=$this->input->post('a_price');
				$qun=$this->input->post('quantity');
				$dis_price=$this->input->post('d_price');
				$dis_percentage=$this->input->post('dp_price');
				$fids=$this->input->post('fid');
				$f_names=$this->input->post('fname');
				$f_values=$this->input->post('fvalue');
				$net_price=$act_price-$dis_price;
				
				
				
				
				 $config['upload_path']          = './assets/uploads/category_pics';
                $config['allowed_types']        = 'gif|jpg|png';
                // $config['max_size']             = 100;
                // $config['max_width']            = 1024;
                // $config['max_height']           = 768;

                $this->load->library('upload', $config);
				
			
				  if ( ! $this->upload->do_upload('p_image'))
                {
                        //$error = array('error' => $this->upload->display_errors());

                          $this->session->set_flashdata('error','product image not uploaded'); 
					      redirect('product/add_product');
                }
				else{
					$upload_data = $this->upload->data(); 
                    $product_img =   $upload_data['file_name'];
				}
				
				$data=array(
				'product_name'=>$product_name,
				'product_img'=>$product_img,
				'cat_id'=>$cat_id,
				'subcat_id'=>$subcat_id,
				'actual_price'=>$act_price,
				'discount_price'=>$dis_price,
				'discount_percentage'=>$dis_percentage,
				'net_price'=>$net_price,
				'quantity'=>$qun,
				 'created_by'=>$adminid
				);
				$status=$this->Product_model->save_edit_product($data,$pid);
				 
				
				
				 $features=$this->Product_model->get_features($pid);
				$fids = array_column($features, 'feature_id');
			//print_r($group_names);exit;
			
		
				foreach($fids as $key=>$value){
					if(in_array($value,$fids)){
						$up_features[]=array(
				  'feature_name'=>$value,
				  'feature_value'=>$f_values[$key],
				  'product_id'=>$product_id,
				  'created_by'=>$adminid
				  );
				 //$key1=array_search($value, $names);
				  unset($fids[$key]);
				
			
			}
			else{
				  $in_features[]=array(
				  'feature_name'=>$value,
				  'feature_value'=>$f_values[$key],
				  'product_id'=>$product_id,
				  'created_by'=>$adminid
				  );
				    unset($fids[$key]);
			}
				}
				$up_status=$this->Product_model->save_edit_features($up_features,$pid);
				$ins_status=$this->Product_model->save_features($in_features);
				 if($status==1){
				   $this->session->set_flashdata('success','product addded  successfully'); 
					      redirect('product/product_list');
					
					
				}
				 else{
					 $this->session->set_flashdata('error','product not added'); 
					       redirect('product/add_product');
				 }
				
				
			}
			else{redirect('login');}
			
		}
}