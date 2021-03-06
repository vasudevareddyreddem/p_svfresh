<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');

class Category extends In_frontend{

	
	public function __construct() 
	{
		parent::__construct();
$this->load->model('Category_model')	;	
$this->load->model('Product_model')	;	
				
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
			$data['subcat_list']=$this->Category_model->get_subcategory_list();
			if(count($data['subcat_list'])>0){
				$data['status']=1;
				
			}else{
				$data['status']=0;
				
			}
			
			$this->load->view('admin/sub_categories_list',$data);
		    $this->load->view('admin/footer');
			
			
		}
		else{redirect('login');}
		
	}
	public function save_category(){
		if($this->session->userdata('svadmin_det')){
			$admin=$this->session->userdata('svadmin_det');
			$svadmin=$admin['admin_id'];
			$this->form_validation->set_rules('cat_name', 'category name', 'required');
	    //$this->form_validation->set_rules('cat_image', 'category image ', 'required');
		//$this->form_validation->set_rules('cat_himage1', 'category header image', 'required');
	    //$this->form_validation->set_rules('cat_himage2', 'category header image  ', 'required');
		//$this->form_validation->set_rules('cat_s_content', 'scorolling content  ', 'required');
		 if ($this->form_validation->run() == FALSE)
                {
          $this->session->set_flashdata('error',validation_errors());
		   redirect('category/add_category');

               }
			   $status=$this->Category_model->category_name_check($this->input->post('cat_name'));
			   if($status==1){
				     $this->session->set_flashdata('error','Category name already existed'); 
					   redirect('category/add_category');
				   
			   }
			  
			    $config['upload_path']          = './assets/uploads/category_pics';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|Jpeg|Png';
                // $config['max_size']             = 100;
                // $config['max_width']            = 1024;
                // $config['max_height']           = 768;

                $this->load->library('upload', $config);
				
			
				  if ( ! $this->upload->do_upload('cat_image',time()))
                {
                        $error = array('error' => $this->upload->display_errors());

                          $this->session->set_flashdata('error',$error); 
					      redirect('category/add_category');
                }
				else{
					$upload_data = $this->upload->data(); 
                    $cat_img =   $upload_data['file_name'];
				}
				  if ( ! $this->upload->do_upload('cat_s_image',time()))
                {
                        $error = array('error' => $this->upload->display_errors());

                          $this->session->set_flashdata('error',$error); 
					      redirect('category/add_category');
                }
				else{
					$upload_data = $this->upload->data(); 
					$this->resize_image($upload_data, $config['upload_path'],32,32);
                    $cat_s_img =   $upload_data['file_name'];
				}
				  if ( ! $this->upload->do_upload('cat_himage1',time()))
                {
                        $error = array('error' => $this->upload->display_errors());

                          $this->session->set_flashdata('error',$error); 
					      redirect('category/add_category');
                }
				else{
					$upload_data = $this->upload->data();
                 $this->resize_image($upload_data, $config['upload_path'],585,65);					
                    $cat_lh_img =   $upload_data['file_name'];
				}
				  if ( ! $this->upload->do_upload('cat_himage2',time()))
                {
                        $error = array('error' => $this->upload->display_errors());

                          $this->session->set_flashdata('error',$error); 
					      redirect('category/add_category');
                }
				else{
					$upload_data = $this->upload->data(); 
					  $this->resize_image($upload_data, $config['upload_path'],585,65);
                    $cat_rh_img =   $upload_data['file_name'];
				}
                $data=array(
			   'cat_name'=>$this->input->post('cat_name'),
			   'cat_img'=>$cat_img,
			   'cat_small_img'=>$cat_s_img,
			   'cat_scr_content'=>$this->input->post('cat_s_content'),
			   'cat_lh_img'=>$cat_lh_img,
			   'cat_rh_img'=>$cat_rh_img,
			   'created_by'=>$svadmin
			   );
               
               
            $flag=$this->Category_model->insert_category($data);
			if(isset($_POST['slider_image'])){
				
			}
			if($flag==1){
				$this->session->set_flashdata('success','Category added successfully');
			     redirect('category/category_list');
				
			}
			else{
				$this->session->set_flashdata('error','Category not added');
				 redirect('category/add_category');
			}
			   
			
			
		}
		else{
			redirect('login');
			}
	}
	public function inactive_category(){
		if($this->session->userdata('svadmin_det')){
			$admin=$this->session->userdata('svadmin_det');
			$svadmin=$admin['admin_id'];
			$id=base64_decode($this->uri->segment(3));
			$status=$this->Category_model->inactive_category($id,$svadmin);
			if($status==1){
				$p_ids=$this->Category_model->check_cat_product_in_ptab($id);
				if(isset($p_ids) && count($p_ids)>0){
					foreach($p_ids as $lis){
						$p_udata=array('status'=>2);
						$this->Category_model->update_product($lis->product_id,$p_udata);
					}
				}
				$check=$this->Category_model->check_cat_product_cart($id);
				if(isset($check) && count($check)>0){
					foreach($check as $lis){
						$this->Category_model->delete_cart_id($lis->id);
					}
				}
				$w_check=$this->Category_model->check_wish_product_cart($id);
				if(isset($w_check) && count($w_check)>0){
					foreach($w_check as $lis){
						$this->Category_model->delete_wish_id($lis->id);
					}
				}
				$this->session->set_flashdata('success','Category inactivated');
			  redirect('category/category_list');
			}
			else{
				$this->session->set_flashdata('error','Category not inactivated');
			  redirect('category/category_list');
			}
		}
		else{redirect('login');}
		
	}
	public function active_category(){
		if($this->session->userdata('svadmin_det')){
			$admin=$this->session->userdata('svadmin_det');
			$svadmin=$admin['admin_id'];
			$id=base64_decode($this->uri->segment(3));
			$status=$this->Category_model->active_category($id,$svadmin);
			if($status==1){
				$p_ids=$this->Category_model->check_cat_product_in_ptab($id);
				if(isset($p_ids) && count($p_ids)>0){
					foreach($p_ids as $lis){
						$p_udata=array('status'=>1);
						$this->Category_model->update_product($lis->product_id,$p_udata);
					}
				}
				$this->session->set_flashdata('success','Category activated');
			  redirect('category/category_list');
			}
			else{
				$this->session->set_flashdata('error','Category not activated');
			  redirect('category/category_list');
			}
		}
		else{redirect('login');}
		
	}
	public function delete_category(){
		if($this->session->userdata('svadmin_det')){
			$admin=$this->session->userdata('svadmin_det');
			$svadmin=$admin['admin_id'];
			$id=base64_decode($this->uri->segment(3));
			
			//echo $this->db->last_query();exit;
			$status=$this->Category_model->delete_category($id,$svadmin);
			if($status==1){
				$p_ids=$this->Category_model->check_cat_product_in_ptab($id);
				if(isset($p_ids) && count($p_ids)>0){
					foreach($p_ids as $lis){
						$p_udata=array('status'=>2);
						$this->Category_model->update_product($lis->product_id,$p_udata);
					}
				}
				$check=$this->Category_model->check_cat_product_cart($id);
			if(isset($check) && count($check)>0){
				foreach($check as $lis){
					$this->Category_model->delete_cart_id($lis->id);
				}
			}
			$w_check=$this->Category_model->check_wish_product_cart($id);
			if(isset($w_check) && count($w_check)>0){
				foreach($w_check as $lis){
					$this->Category_model->delete_wish_id($lis->id);
				}
			}
				$this->session->set_flashdata('success','Category deleted');
			  redirect('category/category_list');
			}
			else{
				$this->session->set_flashdata('error','Category not deleted');
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
				$this->session->set_flashdata('error','Category not existed or deleted in antoher session');
			  redirect('category/category_list');
				}
			$this->load->view('admin/edit_category',$data);
			$this->load->view('admin/footer');
			
			
			
		}
		else{redirect('login');}
	}
	public function save_edit_category(){
		if($this->session->userdata('svadmin_det')){
			$admin=$this->session->userdata('svadmin_det');
			$svadmin=$admin['admin_id'];
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
				   $this->session->set_flashdata('error','Category name already existed');
		 
               redirect($_SERVER['HTTP_REFERER']);
				  
			  }
			    $config['upload_path']          = './assets/uploads/category_pics';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|Jpeg|Png';
                // $config['max_size']             = 100;
                // $config['max_width']            = 1024;
                // $config['max_height']           = 768;

                $this->load->library('upload', $config);
				$img_status=0;
				$simg_status=0;
				$lhimg_status=0;
				$rhimg_status=0;
				
				
			if($_FILES['cat_image']['name']!=''){
				  if ( ! $this->upload->do_upload('cat_image',time()))
                {
                        //$error = array('error' => $this->upload->display_errors());
						
                          $this->session->set_flashdata('error','Category image not uploaded'); 
						 
					      redirect($_SERVER['HTTP_REFERER']);
                }
				else{
					$upload_data = $this->upload->data(); 
                    $cat_img =   $upload_data['file_name'];
					$img_status=1;
				}
			}
			if($_FILES['cat_himage1']['name']!=''){
				  if ( ! $this->upload->do_upload('cat_himage1',time()))
                {
                        //$error = array('error' => $this->upload->display_errors());

                          $this->session->set_flashdata('error','Left header category image not uploaded'); 
					      redirect($_SERVER['HTTP_REFERER']);
                }
				else{
					$upload_data = $this->upload->data();
          $this->resize_image($upload_data, $config['upload_path'],585,65);					
                    $cat_lh_img =   $upload_data['file_name'];
					$lhimg_status=1;
				}
			}
			if($_FILES['cat_himage2']['name']!=''){
				  if ( ! $this->upload->do_upload('cat_himage2',time()))
                {
                        //$error = array('error' => $this->upload->display_errors());

                          $this->session->set_flashdata('error','Right header category image not uploaded'); 
					      redirect($_SERVER['HTTP_REFERER']);
                }
				else{
					$upload_data = $this->upload->data(); 
					  $this->resize_image($upload_data, $config['upload_path'],585,65);
                    $cat_rh_img =   $upload_data['file_name'];
					$rhimg_status=1;
				}
			}
			if($_FILES['cat_s_image']['name']!=''){
				 if ( ! $this->upload->do_upload('cat_s_image',time()))
                {
                        $error = array('error' => $this->upload->display_errors());

                          $this->session->set_flashdata('error',$error); 
					      redirect('category/add_category');
                }
				else{
					$upload_data = $this->upload->data();
  $this->resize_image($upload_data, $config['upload_path'],32,32);					
                    $cat_s_img =   $upload_data['file_name'];
				}
				$simg_status=1;
			} 
			  
                $data=array(
			   'cat_name'=>$this->input->post('cat_name'),
			   'cat_scr_content'=>$this->input->post('cat_s_content'),
			   'updated_by'=>$svadmin
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
				   $this->session->set_flashdata('success','Category updated successfully');
				   redirect('category/category_list');
			   }
			  
		}
		else{redirect('login');}
		
	}
	public function save_sub_category(){
		if($this->session->userdata('svadmin_det')){
			$admin=$this->session->userdata('svadmin_det');
			$svadmin=$admin['admin_id'];
			$categ=base64_decode($this->input->post('c_name'));
			$cstatus=$this->Category_model->subcategory_name_check($this->input->post('name'),$categ);
			if($cstatus==1){
				  $this->session->set_flashdata('error','Subcategory name already existed');
				  redirect('category/add_sub_category');
				  
			}
			$config['upload_path']          = './assets/uploads/sub_category_pics';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|Jpeg|Png';
                

                $this->load->library('upload', $config);
			
			
				  if ( ! $this->upload->do_upload('image',time()))
                {
                        //$error = array('error' => $this->upload->display_errors());
						
                          $this->session->set_flashdata('error','Sub category image not uploaded'); 
						 
					      redirect($_SERVER['HTTP_REFERER']);
                }
				else{
					$upload_data = $this->upload->data(); 
                    $subcat_img =   $upload_data['file_name'];
				}
				$data=array(
				'subcat_name'=>$this->input->post('name'),
				'subcat_img'=>$subcat_img,
				'cat_id'=>base64_decode($this->input->post('c_name')),
				'created_by'=>$svadmin
				);
				$status=$this->Category_model->save_sub_category($data);
				if($status==1){
					 $this->session->set_flashdata('success','Sub category added successfully'); 
						 
					      redirect('category/sub_category_list');
					
					
				}else{
					$this->session->set_flashdata('error','Sub category not added'); 
						 
					      redirect($_SERVER['HTTP_REFERER']);
				}
			
		}
		else{redirect('login');}
		
	}
	public function inactive_subcategory(){
		if($this->session->userdata('svadmin_det')){
			$admin=$this->session->userdata('svadmin_det');
			$svadmin=$admin['admin_id'];
			$id=base64_decode($this->uri->segment(3));
			$status=$this->Category_model->inactive_subcategory($id,$svadmin);
			if($status==1){
				$p_ids=$this->Category_model->check_sub_product_in_ptab($id);
				if(isset($p_ids) && count($p_ids)>0){
					foreach($p_ids as $lis){
						$p_udata=array('status'=>2);
						$this->Category_model->update_product($lis->product_id,$p_udata);
					}
				}
				$check=$this->Category_model->check_sub_product_cart($id);
				if(isset($check) && count($check)>0){
					foreach($check as $lis){
						$this->Category_model->delete_cart_id($lis->id);
					}
				}
				$w_check=$this->Category_model->check_wish_sub_product_cart($id);
				if(isset($w_check) && count($w_check)>0){
					foreach($w_check as $lis){
						$this->Category_model->delete_wish_id($lis->id);
					}
				}
				$this->session->set_flashdata('success','Subcategory inactivated');
			  redirect('category/sub_category_list');
			}
			else{
				$this->session->set_flashdata('error','Subcategory not inactivated');
			  redirect('category/sub_category_list');
			}
		}
		else{redirect('login');}
		
	}
	public function active_subcategory(){
		if($this->session->userdata('svadmin_det')){
			$admin=$this->session->userdata('svadmin_det');
			$svadmin=$admin['admin_id'];
			$id=base64_decode($this->uri->segment(3));
			$status=$this->Category_model->active_subcategory($id,$svadmin);
			if($status==1){
				$p_ids=$this->Category_model->check_sub_product_in_ptab($id);
				if(isset($p_ids) && count($p_ids)>0){
					foreach($p_ids as $lis){
						$p_udata=array('status'=>1);
						$this->Category_model->update_product($lis->product_id,$p_udata);
					}
				}
				$this->session->set_flashdata('success','Subcategory activated');
			  redirect('category/sub_category_list');
			}
			else{
				$this->session->set_flashdata('error','Subcategory not activated');
			  redirect('category/sub_category_list');
			}
		}
		else{redirect('login');}
		
	}
	public function edit_subcategory(){
		if($this->session->userdata('svadmin_det')){
		
		$scid=base64_decode($this->uri->segment(3));
		$status=$this->Category_model->get_subcategory($scid);
	    $data['cat_list']=$this->Category_model->category_list();
		if($status){
			$data['subcat']=$status;
				$this->load->view('admin/edit_sub_category',$data);
			$this->load->view('admin/footer');
			
		}
		else{
				$this->session->set_flashdata('error','Subcategory deleted by another session');
			  redirect('category/sub_category_list');
		}
		}
		else{redirect('login');}
		
	}
	public function save_edit_subcategory(){
		if($this->session->userdata('svadmin_det')){
			$admin=$this->session->userdata('svadmin_det');
			$svadmin=$admin['admin_id'];
			$scid=base64_decode($this->input->post('scid'));
		    $categ=base64_decode($this->input->post('c_name'));
			$cstatus=$this->Category_model->subcategory_editname_check($this->input->post('name'),$categ,$scid);
			if($cstatus==1){
				  $this->session->set_flashdata('error','Subcategory name already exited');
				  redirect('category/add_sub_category');
				  
			}
			    $config['upload_path']          = './assets/uploads/sub_category_pics';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|Jpeg|Png';

                $this->load->library('upload', $config);
			$img_status=0;
			if($_FILES['image']['name']!=''){
				  if ( ! $this->upload->do_upload('image',time()))
                {
                       
						
                          $this->session->set_flashdata('error','Sub category image not uploaded'); 
						 
					      redirect($_SERVER['HTTP_REFERER']);
                }
				else{
					$upload_data = $this->upload->data(); 
                    $subcat_img =   $upload_data['file_name'];
					$img_status=1;
				}
			}
				$data=array(
				'subcat_name'=>$this->input->post('name'),
				'cat_id'=>base64_decode($this->input->post('c_name')),
				'updated_by'=>$svadmin
				);
				if($img_status==1){
					$data['subcat_img']=$subcat_img;
				}
				$status=$this->Category_model->save_editsub_category($data,$scid);
				
				if($status==1){
					 $this->session->set_flashdata('success','Sub category updated successfully'); 
						 
					      redirect('category/sub_category_list');
					
					
				}else{
					$this->session->set_flashdata('error','Sub category  updated sucessfully'); 
						 
					      redirect('category/sub_category_list');
				}
		}
			else{redirect('login');}
		
		
	}
	public function delete_subcategory(){
		if($this->session->userdata('svadmin_det')){
			$admin=$this->session->userdata('svadmin_det');
			$svadmin=$admin['admin_id'];
			$id=base64_decode($this->uri->segment(3));
			$status=$this->Category_model->delete_subcategory($id,$svadmin);
			if($status==1){
				$p_ids=$this->Category_model->check_sub_product_in_ptab($id);
				if(isset($p_ids) && count($p_ids)>0){
					foreach($p_ids as $lis){
						$p_udata=array('status'=>2);
						$this->Category_model->update_product($lis->product_id,$p_udata);
					}
				}
				$check=$this->Category_model->check_sub_product_cart($id);
				if(isset($check) && count($check)>0){
					foreach($check as $lis){
						$this->Category_model->delete_cart_id($lis->id);
					}
				}
				$w_check=$this->Category_model->check_wish_sub_product_cart($id);
				if(isset($w_check) && count($w_check)>0){
					foreach($w_check as $lis){
						$this->Category_model->delete_wish_id($lis->id);
					}
				}
				$this->session->set_flashdata('success','Subcategory deleted');
			  redirect('category/sub_category_list');
			}
			else{
				$this->session->set_flashdata('error','Subcategory not deleted');
			  redirect('category/sub_category_list');
			}
		}
		else{redirect('login');}
		
	}
	public function add_discount_image(){
		if( $this->session->userdata('svadmin_det')){
			$data['cat_list']=$this->Category_model->get_category_names();
			$this->load->view('admin/add_discount',$data);
		    $this->load->view('admin/footer');
			
			
		}
		else{redirect('login');}
		
		
		
	}
	
	public function save_discount_image(){
		if( $this->session->userdata('svadmin_det')){
			$admin=$this->session->userdata('svadmin_det');
			$svadmin=$admin['admin_id'];
			//echo '<pre>';print_r($_FILES);exit;
			
			$config['upload_path']          = './assets/uploads/category_pics';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|Jpeg|Png';
                

                $this->load->library('upload', $config);
			
			
				  if ( ! $this->upload->do_upload('image',time()))
                {
                        //$error = array('error' => $this->upload->display_errors());
						
                          $this->session->set_flashdata('error','Discount image not uploaded'); 
						 
					      redirect($_SERVER['HTTP_REFERER']);
                }
				else{
					$upload_data = $this->upload->data(); 
					  $this->resize_image($upload_data, $config['upload_path'],700,700);
				
                      
                    $dis_img =   $upload_data['file_name'];
				}
				$data=array(
				
				'cat_dis_img'=>$dis_img,
				
				'updated_by'=>$svadmin
				);
				$cat_id=base64_decode($this->input->post('c_name'));
				$status=$this->Category_model->update_discount_category($data,$cat_id);
				if($status==1){
					 $this->session->set_flashdata('success','Discount Image added successfully'); 
						 
					      redirect($_SERVER['HTTP_REFERER']);
					
					
				}else{
					$this->session->set_flashdata('error','Discount Image not added'); 
						 
					      redirect($_SERVER['HTTP_REFERER']);
				}
			
		}
		else{redirect('login');}
		
		
		
	}
	public function add_subcategory_slider(){
		if( $this->session->userdata('svadmin_det')){
			$data['cat_list']=$this->Category_model->get_category_names();
			$this->load->view('admin/add_sub_category_slider',$data);
		    $this->load->view('admin/footer');
			
			
		}
		else{redirect('login');}
		
	}
	public function save_subcat_slider(){
		if( $this->session->userdata('svadmin_det')){
			$cat_id=base64_decode($this->input->post('c_name'));
			$subcat_id=$this->input->post('sc_name');
			$admin=$this->session->userdata('svadmin_det');
			$svadmin=$admin['admin_id'];
			$config['upload_path']          = './assets/uploads/sub_category_pics';
                $config['allowed_types']       = 'gif|jpg|png|jpeg|Jpeg|Png';
                

                $this->load->library('upload', $config);
				if(isset($_FILES['slider_image']['name'])){
    

	 

     
 
        if($_FILES['slider_image']['name'][$i]!=''){
 
          
		    if ( ! $this->upload->do_upload('slider_image',time()))
                {
                      
						
                          $this->session->set_flashdata('error',' Slider image not uploaded'); 
						 
					      redirect($_SERVER['HTTP_REFERER']);
                }
				else{
					$upload_data = $this->upload->data(); 
					$this->resize_image($upload_data, $config['upload_path'],454,125);
                    $slider_img =   $upload_data['file_name'];
					$data=array('image_path'=>$slider_img,
					'cat_id'=>$cat_id,
					'subcat_id'=>$subcat_id,
					'created_by'=>$svadmin);
				}
          

        
 
         
        }
 
   
 $flag=$this->Category_model->save_subcat_slider($data);
 if($flag==1){
	 
                          $this->session->set_flashdata('success','Subcategory slider images  uploaded successfully'); 
						 
					      redirect('category/subcat_slider_list');
	 
	 
 }
 else{
	   $this->session->set_flashdata('error','Subcategory slider images not   uploaded '); 
					 redirect($_SERVER['HTTP_REFERER']);	 
					     
	 
 }
			}
			
			
			
		}
		else{redirect('login');}
		
	}
	public function subcat_slider_list(){
		if( $this->session->userdata('svadmin_det')){
			$data['slider_list']=$this->Category_model->subcat_slider_list();
			//echo $this->db->last_query();
			//echo '<pre>';print_r($data); exit;
		
			if(count($data['slider_list'])>0)
			{
				$data['slider_status']=1;
				
			}
			else{
				$data['slider_status']=0;
				}
			$this->load->view('admin/subcat_slider_list',$data);
		    $this->load->view('admin/footer');
			
			
		}
		else{redirect('login');}
		
	}
	public function edit_subcat_slider(){
		if( $this->session->userdata('svadmin_det')){
			$id=base64_decode($this->uri->segment(3));
			$data['cat_list']=$this->Category_model->get_category_names();
			$data['slider']=$this->Category_model->get_slider_image($id);
			if(!count($data['slider'])>0){
				$this->session->set_flashdata('error','This Slider Image Deleted by another session '); 
					 redirect($_SERVER['HTTP_REFERER']);
				
			}
			$cat_id=$data['slider']->cat_id;
			
			 $data['sub_cats']=$this->Product_model->get_sub_category_names($cat_id);
			
			
			$this->load->view('admin/edit_subcat_slider',$data);
		    $this->load->view('admin/footer');
			
			
		}
		else{redirect('login');}
		
		
		
	}
	public function save_edit_subcat_slider(){
			if( $this->session->userdata('svadmin_det')){
			$subcat_id=$this->input->post('sc_name');
			$slider_id=base64_decode($this->input->post('slider_id'));
			$admin=$this->session->userdata('svadmin_det');
			$svadmin=$admin['admin_id'];
			$config['upload_path']          = './assets/uploads/sub_category_pics';
                $config['allowed_types']       = 'gif|jpg|png|jpeg|Jpeg|Png';
                

                $this->load->library('upload', $config);
				$data=array(
					'subcat_id'=>$subcat_id,
					'updated_by'=>$svadmin,
					             );
				if(isset($_FILES['slider_image']['name'])){
					
     
               if($_FILES['slider_image']['name']!=''){
				  
	          if ( ! $this->upload->do_upload('slider_image',time()))
                {
                      
						
                          $this->session->set_flashdata('error',' Slider image not uploaded'); 
						 
					      redirect($_SERVER['HTTP_REFERER']);
                }
				else{
					 
					$upload_data = $this->upload->data(); 
					$this->resize_image($upload_data, $config['upload_path'],454,125);
					
                    $slider_img =   $upload_data['file_name'];
					$data['image_path']=$slider_img;
				}
          
}
 
      } 
	 
	   $flag=$this->Category_model->update_subcat_slider($slider_id,$data);
 
 if($flag==1){
	 
                          $this->session->set_flashdata('success','Updated successfully'); 
						 
					      redirect('category/subcat_slider_list');	 
	 
	 
 }
 else{
	   $this->session->set_flashdata('success','updated successfully'); 
					 redirect('category/subcat_slider_list');	 
					     
	 
 }
			}
			
			
			
		
		else{redirect('login');}
		
		
		
	}
	public function delete_subcat_slider(){
		if( $this->session->userdata('svadmin_det')){
			$id=base64_decode($this->uri->segment(3));
		
			$flag=$this->Category_model->delete_slider_image($id);
			if($flag==1){
				$this->session->set_flashdata('success','Slider Image Delete successfully '); 
					 redirect($_SERVER['HTTP_REFERER']);
				
			}
			$this->session->set_flashdata('error','Slider Image not deleted '); 
					 redirect($_SERVER['HTTP_REFERER']);
			
		
			
			
		}
		else{redirect('login');}
		
	}
	public function resize_image($image_data,$path,$width,$height){
    $this->load->library('image_lib');
    $w = $image_data['image_width']; // original image's width
    $h = $image_data['image_height']; // original images's height

    $n_w = $width; // destination image's width
    $n_h = $height; // destination image's height

    $source_ratio = $w / $h;
    $new_ratio = $n_w / $n_h;
    if($source_ratio != $new_ratio){

        $config['image_library'] = 'gd2';
        $config['source_image'] = $image_data['full_path'];
        $config['maintain_ratio'] = FALSE;
        if($new_ratio > $source_ratio || (($new_ratio == 1) && ($source_ratio < 1))){
            $config['width'] = $w;
            $config['height'] = round($w/$new_ratio);
            $config['y_axis'] = round(($h - $config['height'])/2);
            $config['x_axis'] = 0;

        } else {

            $config['width'] = round($h * $new_ratio);
            $config['height'] = $h;
            $size_config['x_axis'] = round(($w - $config['width'])/2);
            $size_config['y_axis'] = 0;

        }

        $this->image_lib->initialize($config);
        $this->image_lib->crop();
        $this->image_lib->clear();
    }
    $config['image_library'] = 'gd2';
    $config['source_image'] = $image_data['full_path'];
    $config['new_image'] = $path;
    $config['maintain_ratio'] = TRUE;
    $config['width'] = $n_w;
    $config['height'] = $n_h;
    $this->image_lib->initialize($config);

    if (!$this->image_lib->resize()){



    } else {

      

    }
}
	

}
