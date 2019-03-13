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
				if(count($data['tot_list'])>0){
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
				if(count($data['pending_list'])>0){
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
				if(count($data['delivered_list'])>0){
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
			
				if(count($data['cancel_list'])>0){
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
		public function list_pdf(){
			if($this->session->userdata('svadmin_det')){
					$admin=$this->session->userdata('svadmin_det');
					$post=$this->input->post();
					$data['post_data']=$post;
					$data['orders_list']=$this->Orders_model->get_delivery_order_list($post['o_date'],$post['type']);
					$path = rtrim(FCPATH,"/");
					$file_name = 'order_'.$post['o_date'].'_'.$post['type'].'_'.time().'.pdf';
					$data['page_title'] = $post['o_date'].'_'.$post['type'].'_orders'; // pass data to the view
					$pdfFilePath = $path."/assets/orders_pdf/".$file_name;

					ini_set('memory_limit','320M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$html = $this->load->view('admin/orders_pdf', $data, true); // render the view into HTML
					//echo '<pre>';print_r($html);exit;
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date('M-d-Y')); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$pdf->SetDisplayMode('fullpage');
					$pdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
					$pdf->WriteHTML($html); // write the HTML into the PDF
					//$pdf->Output();exit;
					$pdf->Output($pdfFilePath, 'F');
					redirect("/assets/orders_pdf/".$file_name);
					echo '<pre>';print_r($orders_list);exit;
			
			}else{
				redirect('login');
			}
		}


}
