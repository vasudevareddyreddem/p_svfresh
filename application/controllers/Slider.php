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
					$sdata[]=array('pic_name'=>$slider_img,
					'slider_id'=>$sid);
					
				}
          

        
 
         
        }
 
      }
 
		
			$this->Slider_model->save_slider_pics($sdata);
			redirect('slider/addslider');
			
			
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
					$this->load->view('admin/slider_list');
		           $this->load->view('admin/footer');
					
					
				}
				else{redirect('login');}
			
		}
		}