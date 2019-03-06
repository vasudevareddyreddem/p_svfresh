<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');

class Milkorder extends In_frontend{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Category_model')	;
		$this->load->model('Product_model')	;
		$this->load->model('Milkorders_model')	;
		$this->load->model('Apartment_model')	;

	}
	public function total_order_list(){
		if($this->session->userdata('svadmin_det')){
			//getting all active apartments
			$data['apartment'] = $this->Apartment_model->get_all_active_apartments();
			$post = $this->input->post();
			if ($post) {
				unset($post['button']);
				$apartment = $this->input->post('apartment');
				$block = $this->input->post('block');
				$date = $this->input->post('date');
				$mobile=$this->input->post('phonenum');
				$data['filter'] = $post;
				$data['tot_list']=$this->Milkorders_model->total_order_list($apartment,$block,$date,$mobile);
			} else {
				$data['tot_list']=$this->Milkorders_model->total_order_list();
			}

			if(count($data['tot_list'])>0){
				$data['tot_status']=1;
			}
			else{
				$data['tot_status']=0;
			}
			//echo '<pre>';print_r($data);exit;
			$this->load->view('admin/milk_tot_order_list',$data);
			$this->load->view('admin/milk-footer');

		}
		else{redirect('login');}
	}
	public function total_paymet_order_list(){
		if($this->session->userdata('svadmin_det')){
			//getting all active apartments
			$data['apartment'] = $this->Apartment_model->get_all_active_apartments();
			$post = $this->input->post();
			if ($post) {
				unset($post['button']);
				$apartment = $this->input->post('apartment');
				$block = $this->input->post('block');
				$date = $this->input->post('date');
				$mobile=$this->input->post('phonenum');
				$data['filter'] = $post;
				$data['tot_list']=$this->Milkorders_model->total_payment_order_list($apartment,$block,$date,$mobile);
			} else {
				$data['tot_list']=$this->Milkorders_model->total_payment_order_list();
			}

			if(count($data['tot_list'])>0){
				$data['tot_status']=1;
			}
			else{
				$data['tot_status']=0;
			}
			//echo '<pre>';print_r($data);exit;
			$this->load->view('admin/milk_tot_payment_order_list',$data);
			$this->load->view('admin/milk-footer');

		}
		else{redirect('login');}
	}

	public function pending_order_list(){
		if($this->session->userdata('svadmin_det')){
			$data['apartment'] = $this->Apartment_model->get_all_active_apartments();
			$post = $this->input->post();
			if ($post) {
				unset($post['button']);
				$apartment = $this->input->post('apartment');
				$block = $this->input->post('block');
				$date = $this->input->post('date');
				$mobile=$this->input->post('phonenum');
				$data['filter'] = $post;
				$data['pending_list']=$this->Milkorders_model->pending_order_list($apartment,$block,$date,$mobile);
			}
			else{
			$data['pending_list']=$this->Milkorders_model->pending_order_list();
		}
			if(count($data['pending_list'])>0){
				$data['pending_status']=1;
			}
			else{
				$data['pending_status']=0;
			}

			//echo '<pre>'	;print_r($data);exit;
			$this->load->view('admin/milk_pending_order_list',$data);
			$this->load->view('admin/milk-footer');

		}
		else{redirect('login');}
	}
	public function delivered_order_list(){
		if($this->session->userdata('svadmin_det')){
				$data['apartment'] = $this->Apartment_model->get_all_active_apartments();
			$post = $this->input->post();
			if ($post) {
				unset($post['button']);
				$apartment = $this->input->post('apartment');
				$block = $this->input->post('block');
				$date = $this->input->post('date');
				$mobile=$this->input->post('phonenum');
				$data['filter'] = $post;
				$data['delivered_list']=$this->Milkorders_model->delivered_order_list($apartment,$block,$date,$mobile);
			}
			else{
			$data['delivered_list']=$this->Milkorders_model->delivered_order_list();
		}

			if(count($data['delivered_list'])>0){
				$data['delivered_status']=1;
			}
			else{
				$data['delivered_status']=0;
			}
			$this->load->view('admin/milk_delivered_order_list',$data);
		$this->load->view('admin/milk-footer');

		}
		else{redirect('login');}
	}
	public function cancel_order_list(){
		if($this->session->userdata('svadmin_det')){
				$data['apartment'] = $this->Apartment_model->get_all_active_apartments();
			$post = $this->input->post();
			if ($post) {
				unset($post['button']);
				$apartment = $this->input->post('apartment');
				$block = $this->input->post('block');
				$date = $this->input->post('date');
				$mobile=$this->input->post('phonenum');
				$data['filter'] = $post;
				$data['cancel_list']=$this->Milkorders_model->cancel_order_list($apartment,$block,$date,$mobile);
			}
			else{
			$data['cancel_list']=$this->Milkorders_model->cancel_order_list();
		}
			if(count($data['cancel_list'])>0){
				$data['cancel_status']=1;
			}
			else{
				$data['cancel_status']=0;
			}

			//echo '<pre>'	;print_r($data);exit;
			$this->load->view('admin/milk_cancel_order_list',$data);
			$this->load->view('admin/milk-footer');

		}
		else{redirect('login');}
	}
	public function deliver_order(){
		if($this->session->userdata('svadmin_det')){
			$admin=$this->session->userdata('svadmin_det');
			$svadmin=$admin['admin_id'];
			$id=base64_decode($this->uri->segment(3));
			$status=$this->Milkorders_model->change_to_delivery_status($id,$svadmin);

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
			$status=$this->Milkorders_model->change_to_cancel_status($id,$svadmin);
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
			$status=$this->Milkorders_model->change_to_pending_status($id,$svadmin);
			if($status=1){
				redirect($_SERVER['HTTP_REFERER']);
			}
			else{
				redirect($_SERVER['HTTP_REFERER']);
			}



		}
		else{redirect('login');}
	}

	//getting blocks by apartment id
  public function get_blocks_by_apartment_id()
  {
    if ($this->session->userdata('svadmin_det')) {
      $apartment_id = $this->input->post('apartment_id');
			$block = $this->input->post('block');
      if ($apartment_id) {
        $blocks = $this->Apartment_model->get_blocks_by_apartment_id($apartment_id);
        if(count($blocks) > 0){
          $result = '<option value="">--Select Block--</option>';
          foreach ($blocks as $b) {
						$selected = (isset($block) && ($block == $b->block_id)) ? "selected":"";
            $result .= '<option value='.$b->block_id.' '.$selected.'>'.$b->block_name.'</option>';
          }
          echo $result;exit();
        } else {
          $result = '<option value="">--No Block found--</option>';
          echo $result;exit();
        }
      } else {
        $this->session->set_flashdata('error','Sorry, there is a problem in getting blocks');
        redirect($_SERVER['HTTP_REFERER']);
      }
    } else {
      $this->session->set_flashdata('error','Please login to continue');
      redirect('login');
    }
  }

public function update_delv_sta_auto(){
	$this->Milkorders_model->auto_update_sataus();
exit;

}
public function boys_list(){
	  if ($this->session->userdata('svadmin_det')) {
			$data['apartment'] = $this->Apartment_model->get_all_active_apartments();
			$post = $this->input->post();

			if ($post) {

				$apartment = $this->input->post('apartment');
				$block = $this->input->post('block');
				$date = $this->input->post('date');
				if($this->input->post('date')==''){
					$this->session->set_flashdata('error','Please Enter date');
					redirect($_SERVER['HTTP_REFERER']);

				}
				$date1= DateTime::createFromFormat('d/m/Y', $date);
          $newdate= $date1->format('Y-m-d');
					$curdate=date('Y-m-d');
					if($newdate<$curdate){
						$this->session->set_flashdata('error','you dont enter past days');
						redirect($_SERVER['HTTP_REFERER']);

					}

        $data['filter'] = $post;
				$data['block_products']=$this->Milkorders_model->block_products($apartment,$block,$date);
				$data['pending_list']=$this->Milkorders_model->boys_order_list($apartment,$block,$date);
				$data['product_count']=count($data['block_products']);

				if(count($data['pending_list'])>0){
					$data['pending_status']=1;
				}
				else{
					$data['pending_status']=0;
				}
			//	$data['boys_list']=$this->Milkorders_model->boys_tot_list($apartment,$block,$date,$mobile);
}
else{
		$data['pending_status']=0;

}



			//echo '<pre>'	;print_r($data);exit;
			$this->load->view('admin/milk_pending_boys',$data);
			$this->load->view('admin/milk-footer');
		}
			else {
	      $this->session->set_flashdata('error','Please login to continue');
	      redirect('login');

}

}
 public  function paymetn_reject_order(){
	  $order_id=base64_decode($this->uri->segment(3));
	  if($order_id==''){
		$this->session->set_flashdata('error','Techinical problem will occured');
		redirect($_SERVER['HTTP_REFERER']);
	  }
	  $order_id_list=$this->Milkorders_model->get_milk_orders_list($order_id);
		if(count($order_id_list)>0){
		    foreach($order_id_list as $li){
			    $add=array('admin_accept_status'=>2,'payment_status'=>0);
				$p_update=$this->Milkorders_model->update_payment_details($li['calender_id'],$add);
			}
		}
		if(count($p_update)>0){
			$this->session->set_flashdata('success',"Payment Details successfully rejected.");
			redirect('milkorder/total_paymet_order_list');
		}else{
		   $this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
		   redirect('milkorder/total_paymet_order_list');
	    }
	}
	public  function paymetn_accept_order(){
	  $order_id=base64_decode($this->uri->segment(3));
	  if($order_id==''){
		$this->session->set_flashdata('error','Techinical problem will occured');
		redirect($_SERVER['HTTP_REFERER']);
	  }
	  $order_id_list=$this->Milkorders_model->get_milk_orders_list($order_id);
		if(count($order_id_list)>0){
		    foreach($order_id_list as $li){
			    $add=array('admin_accept_status'=>1);
				$p_update=$this->Milkorders_model->update_payment_details($li['calender_id'],$add);
			}
		}
		if(count($p_update)>0){
			$this->session->set_flashdata('success',"Payment details successfully accepted.");
			redirect('milkorder/total_paymet_order_list');
		}else{
		   $this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
		   redirect('milkorder/total_paymet_order_list');
	    }
	}
	public function list_pdf(){
		  if ($this->session->userdata('svadmin_det')) {
		$yr=$this->input->post('year');
	$mon=$this->input->post('month');
		$num=$this->input->post('phonenum');
	$data['tot_list']=$this->Milkorders_model->get_month_milk_list($yr,$mon,$num);
		//pdf start
		//$data['details']=$this->Resources_model->get_billing_details($pid,$bid);
					//echo '<pre>';print_r($data);exit;
					$path = rtrim(FCPATH,"/");
					$file_name = $yr.'-'.$mon.'_'.$num.'.pdf';
					$data['page_title'] = $yr.'-'.$mon.'_'.$num.'_milkorders'; // pass data to the view
					$pdfFilePath = $path."/assets/milk_pdf/".$file_name;
					ini_set('memory_limit','320M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$html = $this->load->view('admin/milk_pdf', $data, true); // render the view into HTML
					//echo '<pre>';print_r($html);exit;
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date('M-d-Y')); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$pdf->SetDisplayMode('fullpage');
					$pdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
					$pdf->WriteHTML($html); // write the HTML into the PDF
					$pdf->Output($pdfFilePath, 'F');
					redirect("milkorder/total_order_list");
		//pdf end
	}
	else {
		$this->session->set_flashdata('error','Please login to continue');
		redirect('login');

}

	}
}
