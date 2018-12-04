<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');

class Category extends In_frontend{

	
	public function __construct() 
	{
		parent::__construct();
$this->load->model('Category_model')	;	
				
		}
		public function add_category(){
		if( $this->session->userdata('svadmin_det')){
			$this->load->view('admin/add_category');
		    $this->load->view('admin/footer');
			
			
		}
		else{redirect('login');}
		}
			public function category_list(){
		if($this->session->userdata('svadmin_det')){
			$data['cat_list']=$this->Category_model->category_list();
			if(count($data['cat_list'])>0){
			  $data['cstatus']=1;
			}
			else{
			$data['cstatus']=0;
			}
			$this->load->view('admin/categories_list',$data);
		    $this->load->view('admin/footer');
			
			
		}
		else{redirect('login');}
	}
		public function add_sub_category(){
		if($this->session->userdata('svadmin_det')){
			$data['cat_list']=$this->Category_model->get_category_names();
			
			$this->load->view('admin/add_sub_category',$data);
		    $this->load->view('admin/footer');
			
			
		}
		else{redirect('login');}
		}
			public function sub_category_list(){
		if($this->session->userdata('svadmin_det')){
			$this->load->view('admin/sub_categories_list');
		    $this->load->view('admin/footer');
			
			
		}
		else{redirect('login');}
		
	}
	public function save_category(){
		if($this->session->userdata('svadmin_det')){
			$this->form_validation->set_rules('cat_name', 'category name', 'required');
	    //$this->form_validation->set_rules('cat_image', 'category image ', 'required');
		//$this->form_validation->set_rules('cat_himage1', 'category header image', 'required');
	    //$this->form_validation->set_rules('cat_himage2', 'category header image  ', 'required');
		$this->form_validation->set_rules('cat_s_content', 'scorolling content  ', 'required');
		 if ($this->form_validation->run() == FALSE)
                {
          $this->session->set_flashdata('error',validation_errors());
		   redirect('category/add_category');

               }
			   $status=$this->Category_model->category_name_check($this->input->post('cat_name'));
			   if($status==1){
				     $this->session->set_flashdata('error','category name already existed'); 
					   redirect('category/add_category');
				   
			   }
			  
			    $config['upload_path']          = './assets/uploads/category_pics';
                $config['allowed_types']        = 'gif|jpg|png';
                // $config['max_size']             = 100;
                // $config['max_width']            = 1024;
                // $config['max_height']           = 768;

                $this->load->library('upload', $config);
				
			
				  if ( ! $this->upload->do_upload('cat_image'))
                {
                        $error = array('error' => $this->upload->display_errors());

                          $this->session->set_flashdata('error',$error); 
					      redirect('category/add_category');
                }
				else{
					$upload_data = $this->upload->data(); 
                    $cat_img =   $upload_data['file_name'];
				}
				  if ( ! $this->upload->do_upload('cat_s_image'))
                {
                        $error = array('error' => $this->upload->display_errors());

                          $this->session->set_flashdata('error',$error); 
					      redirect('category/add_category');
                }
				else{
					$upload_data = $this->upload->data(); 
                    $cat_s_img =   $upload_data['file_name'];
				}
				  if ( ! $this->upload->do_upload('cat_himage1'))
                {
                        $error = array('error' => $this->upload->display_errors());

                          $this->session->set_flashdata('error',$error); 
					      redirect('category/add_category');
                }
				else{
					$upload_data = $this->upload->data(); 
                    $cat_lh_img =   $upload_data['file_name'];
				}
				  if ( ! $this->upload->do_upload('cat_himage2'))
                {
                        $error = array('error' => $this->upload->display_errors());

                          $this->session->set_flashdata('error',$error); 
					      redirect('category/add_category');
                }
				else{
					$upload_data = $this->upload->data(); 
                    $cat_rh_img =   $upload_data['file_name'];
				}
                $data=array(
			   'cat_name'=>$this->input->post('cat_name'),
			   'cat_img'=>$cat_img,
			   'cat_small_img'=>$cat_s_img,
			   'cat_scr_content'=>$this->input->post('cat_s_content'),
			   'cat_lh_img'=>$cat_lh_img,
			   'cat_rh_img'=>$cat_rh_img,
			 
			   );
               
               
            $flag=$this->Category_model->insert_category($data);
			if($flag==1){
				$this->session->set_flashdata('success','category added successfully');
			     redirect('category/category_list');
				
			}
			else{
				$this->session->set_flashdata('error','category not added');
				 redirect('category/add_category');
			}
			   
			
			
		}
		else{
			redirect('login');
			}
	}
	public function inactive_category(){
		if($this->session->userdata('svadmin_det')){
			$id=base64_decode($this->uri->segment(3));
			$status=$this->Category_model->inactive_category($id);
			if($status==1){
				$this->session->set_flashdata('success','category inactivated');
			  redirect('category/category_list');
			}
			else{
				$this->session->set_flashdata('error','category not inactivated');
			  redirect('category/category_list');
			}
		}
		else{redirect('login');}
		
	}
	public function active_category(){
		if($this->session->userdata('svadmin_det')){
			$id=base64_decode($this->uri->segment(3));
			$status=$this->Category_model->active_category($id);
			if($status==1){
				$this->session->set_flashdata('success','category activated');
			  redirect('category/category_list');
			}
			else{
				$this->session->set_flashdata('error','category not activated');
			  redirect('category/category_list');
			}
		}
		else{redirect('login');}
		
	}
	public function delete_category(){
		if($this->session->userdata('svadmin_det')){
			$id=base64_decode($this->uri->segment(3));
			$status=$this->Category_model->delete_category($id);
			if($status==1){
				$this->session->set_flashdata('success','category deleted');
			  redirect('category/category_list');
			}
			else{
				$this->session->set_flashdata('error','category not deleted');
			  redirect('category/category_list');
			}
		}
		else{redirect('login');}
		
	}
	public function edit_category(){
		if($this->session->userdata('svadmin_det')){
			$id=base64_decode($this->uri->segment(3));
			$data['cat']=$this->Category_model->get_category($id);
			//print_r($data);exit;
			if(empty($data['cat'])){
				$this->session->set_flashdata('error','category not existed or deleted in antoher session');
			  redirect('category/category_list');
				}
			$this->load->view('admin/edit_category',$data);
			$this->load->view('admin/footer');
			
			
			
		}
		else{redirect('login');}
	}
	public function save_edit_category(){
		if($this->session->userdata('svadmin_det')){
		//$this->form_validation->set_rules('cat_name', 'category name', 'required');
	    
		//$this->form_validation->set_rules('cat_s_content', 'scorolling content  ', 'required');
		 // if ($this->form_validation->run() == FALSE)
                // {
          // $this->session->set_flashdata('error',validation_errors());
		 
               // redirect($_SERVER['HTTP_REFERER']);

               // }
			   $cid=$this->input->post('cat_id');
			   
                $cid=base64_decode($cid); 			   
			   
			   
			   $cname=$this->input->post('cat_name');
			   
			  $status=$this->Category_model->category_edit_name_check($cid,$cname);
			 
			  if($status==1){
				   $this->session->set_flashdata('error','category name already existed');
		 
               redirect($_SERVER['HTTP_REFERER']);
				  
			  }
			    $config['upload_path']          = './assets/uploads/category_pics';
                $config['allowed_types']        = 'gif|jpg|png';
                // $config['max_size']             = 100;
                // $config['max_width']            = 1024;
                // $config['max_height']           = 768;

                $this->load->library('upload', $config);
				$img_status=0;
				$simg_status=0;
				$lhimg_status=0;
				$rhimg_status=0;
				
				
			if($_FILES['cat_image']['name']!=''){
				  if ( ! $this->upload->do_upload('cat_image'))
                {
                        //$error = array('error' => $this->upload->display_errors());
						
                          $this->session->set_flashdata('error','category image not uploaded'); 
						 
					      redirect($_SERVER['HTTP_REFERER']);
                }
				else{
					$upload_data = $this->upload->data(); 
                    $cat_img =   $upload_data['file_name'];
					$img_status=1;
				}
			}
			if($_FILES['cat_himage1']['name']!=''){
				  if ( ! $this->upload->do_upload('cat_himage1'))
                {
                        //$error = array('error' => $this->upload->display_errors());

                          $this->session->set_flashdata('error','left header category image not uploaded'); 
					      redirect($_SERVER['HTTP_REFERER']);
                }
				else{
					$upload_data = $this->upload->data(); 
                    $cat_lh_img =   $upload_data['file_name'];
					$lhimg_status=1;
				}
			}
			if($_FILES['cat_himage2']['name']!=''){
				  if ( ! $this->upload->do_upload('cat_himage2'))
                {
                        //$error = array('error' => $this->upload->display_errors());

                          $this->session->set_flashdata('error','right header category image not uploaded'); 
					      redirect($_SERVER['HTTP_REFERER']);
                }
				else{
					$upload_data = $this->upload->data(); 
                    $cat_rh_img =   $upload_data['file_name'];
					$rhimg_status=1;
				}
			}
			if($_FILES['cat_s_image']['name']!=''){
				 if ( ! $this->upload->do_upload('cat_s_image'))
                {
                        $error = array('error' => $this->upload->display_errors());

                          $this->session->set_flashdata('error',$error); 
					      redirect('category/add_category');
                }
				else{
					$upload_data = $this->upload->data(); 
                    $cat_s_img =   $upload_data['file_name'];
				}
				$simg_status=1;
			} 
			  
                $data=array(
			   'cat_name'=>$this->input->post('cat_name'),
			   'cat_scr_content'=>$this->input->post('cat_s_content'),
			  );
			  if($this->input->post('cat_s_content')){
				  $data['cat_scr_content']=$this->input->post('cat_s_content'); 
			  }
			    if($img_status==1){
				   $data['cat_img']=$cat_img;
			   }
			   if($simg_status==1){
				   $data['cat_small_img']=$cat_s_img;
			   }
			    if($lhimg_status==1){
				   $data['cat_lh_img']=$cat_lh_img;
			   }
			    if($rhimg_status==1){
				   $data['cat_rh_img']=$cat_rh_img;
			   }
			   
			   $status=$this->Category_model->edit_category($cid,$data);
			   if($status=1){
				   $this->session->set_flashdata('success','category updated successfully');
				   redirect('category/category_list');
			   }
			  
		}
		else{redirect('login');}
		
	}
	public function save_sub_category(){
		if($this->session->userdata('svadmin_det')){
			$config['upload_path']          = './assets/uploads/category_pics';
                $config['allowed_types']        = 'gif|jpg|png';
                // $config['max_size']             = 100;
                // $config['max_width']            = 1024;
                // $config['max_height']           = 768;

                $this->load->library('upload', $config);
				
				
			
				  if ( ! $this->upload->do_upload('image'))
                {
                        //$error = array('error' => $this->upload->display_errors());
						
                          $this->session->set_flashdata('error','sub category image not uploaded'); 
						 
					      redirect($_SERVER['HTTP_REFERER']);
                }
				else{
					$upload_data = $this->upload->data(); 
                    $cat_img =   $upload_data['file_name'];
				}
				$data=array(
				'subcat_name'=>$this->input->post('name'),
				'subcat_img'=>$this->input->post('image'),
				'cat_id'=>base64_decode($this->input->post('c_name'))
				);
				$status=$this->Category_model->save_sub_category($data);
				if($status==1){
					 $this->session->set_flashdata('success','sub category added successfully'); 
						 
					      redirect('category/sub_category_list');
					
					
				}else{
					$this->session->set_flashdata('success','sub category added successfully'); 
						 
					      redirect($_SERVER['HTTP_REFERER']);
				}
			
		}
		else{redirect('login');}
		
	}
	
	
}
