<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');

class Slider extends In_frontend{

	
	public function __construct() 
	{
		parent::__construct();
$this->load->model('Category_model');	
$this->load->model('Product_model');
$this->load->model('Slider_model');	
				
		}
		public function addslider(){
			if($this->session->userdata('svadmin_det')){
				
				$this->load->view('admin/add_slider');
		    $this->load->view('admin/footer');
			
		}
		else{redirect('login');}
		}
		public function save_slider(){
			if($this->session->userdata('svadmin_det'))
			{
			$admin=$this->session->userdata('svadmin_det');
			$svadmin=$admin['admin_id'];
			$s_name=$this->input->post('s_name');
			$status=$this->Slider_model->slider_unique_check($s_name);
			if($status==1){
				 $this->session->set_flashdata('error','name already exited');
				  redirect($_SERVER['HTTP_REFERER']);
			}
			$config['upload_path']          = './assets/uploads/slider_pics';
                $config['allowed_types']        = 'gif|jpg|png';

                $this->load->library('upload', $config);
				
			if(!$_FILES['sl_image']['name']=='')
			{
				  if ( ! $this->upload->do_upload('sl_image',time()))
                {
                        //$error = array('error' => $this->upload->display_errors());
						
                          $this->session->set_flashdata('error','Left slider image not uploaded'); 
						 
					      redirect($_SERVER['HTTP_REFERER']);
                }
				else{
					$upload_data = $this->upload->data(); 
                    $l_img =   $upload_data['file_name'];
					$this->resize_image($upload_data,1000,1100);
										
					
				}
				
			}
			
			if(!$_FILES['sr_image']['name']=='')
			{
				  if ( ! $this->upload->do_upload('sr_image',time()))
                {
                        //$error = array('error' => $this->upload->display_errors());
						
                          $this->session->set_flashdata('error','Right slider image not uploaded'); 
						 
					      redirect($_SERVER['HTTP_REFERER']);
                }
				else{
					$upload_data = $this->upload->data(); 
                    $r_img =   $upload_data['file_name'];
					$this->resize_image($upload_data,1000,1100);
										
					
				}
				
			}
			$data=array('slider_name'=>$s_name,
			'l_pic'=>$l_img,
			'r_pic'=>$r_img,
			'created_by'=>$svadmin);
			
			$sid=$this->Slider_model->save_slider($data);
		
		
			// Count total files
      $countfiles = count($_FILES['slider']['name']);

      // Looping all files
      for($i=0;$i<$countfiles;$i++){
 
        if($_FILES['slider']['name'][$i]!=''){
 
          // Define new $_FILES array - $_FILES['file']
           $_FILES['slide']['name']     = $_FILES['slider']['name'][$i];
                $_FILES['slide']['type']     = $_FILES['slider']['type'][$i];
                $_FILES['slide']['tmp_name'] = $_FILES['slider']['tmp_name'][$i];
                $_FILES['slide']['error']     = $_FILES['slider']['error'][$i];
                $_FILES['slide']['size']     = $_FILES['slider']['size'][$i];
                
		 //echo   $_FILES['slide']['name'];exit;
		    if ( ! $this->upload->do_upload('slide',time()))
                {
                      
						
                          $this->session->set_flashdata('error',' slider image not uploaded'); 
						 
					      redirect($_SERVER['HTTP_REFERER']);
                }
				else{
					$upload_data = $this->upload->data(); 
                    $slider_img =   $upload_data['file_name'];
						$this->resize_image($upload_data,650,310);
					$sdata[]=array('pic_name'=>$slider_img,
					'slider_id'=>$sid);
					
				}
          

        
 
         
        }
 
      }
 
		
			$this->Slider_model->save_slider_pics($sdata);
			redirect('slider/slider_list');
			
			
		}
			else{redirect('login');}
		}
		public function slider_list(){
				if($this->session->userdata('svadmin_det')){
					$data['slider_list']=$this->Slider_model->get_sliders();
					if(count($data['slider_list'])>0){
						$data['status']=1;
					}
					else{
						$data['status']=0;
						
					}
					$this->load->view('admin/slider_list',$data);
		            $this->load->view('admin/footer');
					
					
				}
				else{redirect('login');}
			
		}
		public function inactive_slider(){
		if($this->session->userdata('svadmin_det')){
			$admin=$this->session->userdata('svadmin_det');
			$svadmin=$admin['admin_id'];
			$id=base64_decode($this->uri->segment(3));
			$status=$this->Slider_model->inactive_slider($id,$svadmin);
			if($status==1){
				$this->session->set_flashdata('success','slider inactivated');
			  redirect('slider/slider_list');
			}
			else{
				$this->session->set_flashdata('error','slider not inactivated');
			  redirect('slider/slider_list');
			}
		}
		else{redirect('login');}
		
	}
	public function active_slider(){
		if($this->session->userdata('svadmin_det')){
			$admin=$this->session->userdata('svadmin_det');
			$svadmin=$admin['admin_id'];
			$id=base64_decode($this->uri->segment(3));
			$this->Slider_model->all_inactive($svadmin);
			$status=$this->Slider_model->active_slider($id,$svadmin);
			if($status==1){
				$this->session->set_flashdata('success','slider activated');
			  redirect('slider/slider_list');
			}
			else{
				$this->session->set_flashdata('error','slider not activated');
			  redirect('slider/slider_list');
			}
		}
		else{redirect('login');}
		
	}
	public function delete_slider(){
		if($this->session->userdata('svadmin_det')){
			$admin=$this->session->userdata('svadmin_det');
			$svadmin=$admin['admin_id'];
			$id=base64_decode($this->uri->segment(3));
			$status=$this->Slider_model->delete_slider($id,$svadmin);
			if($status==1){
				$this->session->set_flashdata('success','Slider  deleted');
			  redirect('slider/slider_list');
			}
			else{
				$this->session->set_flashdata('error','slider not deleted');
			  redirect('slider/slider_list');
			}
		}
		else{redirect('login');}
		
	}
	public function edit_slider(){
		if($this->session->userdata('svadmin_det')){
			$id=base64_decode($this->uri->segment(3));
			$data['slider']=$this->Slider_model->get_single_slider($id);
			
			if($data['slider']){
				$sid=$data['slider']->slider_id;
				$data['pics']=$this->Slider_model->get_slider_pics($sid);
				if(count($data['pics']>0)){
					$data['picstatus']=1;
				}
				else{
					$data['picstatus']=0;
				}
			$this->load->view('admin/edit_slider',$data);
		            $this->load->view('admin/footer');
			}else{
					$this->session->set_flashdata('error','This slider delted by another session');
			  redirect('slider/slider_list');
			}
			
		}
		else{redirect('login');}
		
		
	}
	public function save_edit_slider(){
			if($this->session->userdata('svadmin_det'))
			{
			$admin=$this->session->userdata('svadmin_det');
			$svadmin=$admin['admin_id'];
			$s_name=$this->input->post('s_name');
			$slider_id=$this->input->post('sid');
			$status=$this->Slider_model->slider_edit_unique_check($slider_id,$s_name);
			if($status==1){
				 $this->session->set_flashdata('error','name already exited');
				  redirect($_SERVER['HTTP_REFERER']);
			}
			$config['upload_path']          = './assets/uploads/slider_pics';
                $config['allowed_types']        = 'gif|jpg|png';

                $this->load->library('upload', $config);
				$data=array('slider_name'=>$s_name,'updated_by'=>$svadmin);
				
			if(!$_FILES['sl_image']['name']=='')
			{
				  if ( ! $this->upload->do_upload('sl_image',time()))
                {
                        //$error = array('error' => $this->upload->display_errors());
						
                          $this->session->set_flashdata('error','Left slider image not uploaded'); 
						 
					      redirect($_SERVER['HTTP_REFERER']);
                }
				else{
					$upload_data = $this->upload->data(); 
					$this->resize_image($upload_data,1000,1100);
                    $l_img =   $upload_data['file_name'];
					$data['l_pic']=$l_img;
					
				}
				
			}
			
			if(!$_FILES['sr_image']['name']=='')
			{
				  if ( ! $this->upload->do_upload('sr_image',time()))
                {
                        //$error = array('error' => $this->upload->display_errors());
						
                          $this->session->set_flashdata('error','Right slider image not uploaded'); 
						 
					      redirect($_SERVER['HTTP_REFERER']);
                }
				else{
					$upload_data = $this->upload->data(); 
					$this->resize_image($upload_data,1000,1100);
                    $r_img =   $upload_data['file_name'];
					$data['r_pic']=$r_img;
					
				}
				
			}
			
			
			$this->Slider_model->save_edit_slider($data,$slider_id);
		//start edit slider images
		$slider_ids=$this->input->post('slider_id');
	

				$count=0;
				foreach($slider_ids as $key=>$value){
					
					$value=base64_decode($value);
                             if(isset($_FILES['slider']['name'][$key])){
								 $count++;
                           if($_FILES['slider']['name'][$key]!=''){
 
          // Define new $_FILES array - $_FILES['file']
           $_FILES['image']['name']     = $_FILES['slider']['name'][$key];
                $_FILES['image']['type']     = $_FILES['slider']['type'][$key];
                $_FILES['image']['tmp_name'] = $_FILES['slider']['tmp_name'][$key];
                $_FILES['image']['error']     = $_FILES['slider']['error'][$key];
                $_FILES['image']['size']     = $_FILES['slider']['size'][$key];
                
		 //echo   $_FILES['slide']['name'];exit;
		    if ( ! $this->upload->do_upload('image',time()))
                {
                      
						
                          $this->session->set_flashdata('error',' slider image not uploaded'); 
						 
					      redirect($_SERVER['HTTP_REFERER']);
                }
				else{
					$upload_data = $this->upload->data(); 
					$this->resize_image($upload_data,650,310);
                    $slider_img =   $upload_data['file_name'];
					$pdata=array('pic_name'=>$slider_img,
					
					'updated_by'=>$svadmin);
					$this->Slider_model->save_edit_slider_images($pdata,$value);
				
				
				}
  }
							 }
							 //delete image
							 else{
								
								 $this->Slider_model->save_delete_slider_images($value);
								
								 
							 }
				}
			$countfiles = count($_FILES['slider']['name']);
			if($count<$countfiles){
				    $img_status=0;
				
      // Looping all files
      for($i=$count;$i<$countfiles;$i++){
		 
 
        if($_FILES['slider']['name'][$i]!=''){
			
 
          // Define new $_FILES array - $_FILES['file']
           $_FILES['image']['name']     = $_FILES['slider']['name'][$i];
                $_FILES['image']['type']     = $_FILES['slider']['type'][$i];
                $_FILES['image']['tmp_name'] = $_FILES['slider']['tmp_name'][$i];
                $_FILES['image']['error']     = $_FILES['slider']['error'][$i];
                $_FILES['image']['size']     = $_FILES['slider']['size'][$i];
                
		 //echo   $_FILES['slide']['name'];exit;
		    if ( ! $this->upload->do_upload('image',time()))
                {
                      
						
                          $this->session->set_flashdata('error',' Slider image not uploaded'); 
						 
					      redirect($_SERVER['HTTP_REFERER']);
                }
				else{
					$img_status=1;
					$upload_data = $this->upload->data(); 
					$this->resize_image($upload_data,650,310);
                    $slider_img =   $upload_data['file_name'];
					$image_data[]=array('pic_name'=>$slider_img,
					'slider_id'=>$slider_id,
					'created_by'=>$svadmin);
				}
          

        
		}
         
        }
		
			if($img_status==1){
				
				
 $this->Slider_model->save_slider_pics($image_data);
 
			}
 
      }
		//end edit slider
		$this->session->set_flashdata('success',' Slider Images updated successfully'); 
						 
					      redirect('slider/slider_list');
			
			
		}
			else{redirect('login');}
		}
		
		public function resize_image($image_data,$newwidth,$new_height){
    $this->load->library('image_lib');
    $w = $image_data['image_width']; // original image's width
    $h = $image_data['image_height']; // original images's height

    $n_w = $newwidth; // destination image's width
    $n_h = $new_height; // destination image's height

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
    $config['new_image'] = './assets/uploads/slider_pics';
    $config['maintain_ratio'] = TRUE;
    $config['width'] = $n_w;
    $config['height'] = $n_h;
    $this->image_lib->initialize($config);

    if (!$this->image_lib->resize()){

        //echo $this->image_lib->display_errors();

    } else {

       // echo "done";

    }
}
		}