<?php

/**
 *
 */
class Order extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Order_Model');
    $this->load->model('Category_model');
    $this->load->model('Cart_Model');
    $this->load->model('Wishlist_Model');
    $this->load->model('Auth_Model');
    $this->load->model('Calender_Model');
		$this->load->library('user_agent');

  }

  public function index()
  {
    if($this->session->userdata('logged_in') == TRUE){
      $data['categories'] = $this->Category_model->get_all_category();
      $user_id = $this->session->userdata('id');
      $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
      $data['count'] = count($data['cart']);
      $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
      $data['order'] = $this->Order_Model->get_order_by_user($user_id);
      $data['pageTitle'] = 'Order';
      $this->load->view('home/orders',$data);
    }else{
      redirect('home/login');
    }
  }
  public function details()
  {
    if($this->session->userdata('logged_in') == TRUE){
       $data['pageTitle'] = 'Order details';
      $data['categories'] = $this->Category_model->get_all_category();
      $user_id = $this->session->userdata('id');
      $data['user'] = $this->Auth_Model->get_user_details($user_id);
      $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
      $data['count'] = count($data['cart']);
      $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
      $order_item_id = base64_decode($this->uri->segment(3));
      $data['order_details'] = $this->Order_Model->get_order_item_details($order_item_id);
      $data['pageTitle'] = 'Order Details';
      $this->load->view('home/orders_details',$data);
    }else{
      redirect('home/login');
    }
  }

  public function cancel_order()
  {
    $order_items_id = $this->input->post('order_items_id');
    if($this->Order_Model->cancel_order($order_items_id)){
      $return['success'] = 'Order cancelled successfully';
    }else{
      $return['error'] = 'Please try again';
    }
    echo json_encode($return);exit(0);
  }

  public  function update_review_ratings(){
	 if($this->session->userdata('logged_in') == TRUE){
	   $user_id = $this->session->userdata('id');
	  $post=$this->input->post();
	  //echo '<pre>';print_r($post);exit;
	  $add=array(
	  'rate'=>isset($post['rate'])?$post['rate']:'',
	  'name'=>isset($post['name'])?$post['name']:'',
	  'email'=>isset($post['email'])?$post['email']:'',
	  'message'=>isset($post['message'])?$post['message']:'',
	  'order_item_id'=>isset($post['order_item_id'])?$post['order_item_id']:'',
	  'product_id'=>isset($post['product_id'])?$post['product_id']:'',
	  'user_id'=>$user_id,
	  );
	  $check=$this->Order_Model->check_rating_exits($user_id,$post['order_item_id']);
	  if(count($check)>0){
			$this->session->set_flashdata('error',"you are already submitted your rating");
			 redirect($this->agent->referrer());
	  }else{
		  $save=$this->Order_Model->save_item_review($add);
		  if(count($save)>0){
			  $this->session->set_flashdata('success',"Rating successfully submitted.");
			  redirect($this->agent->referrer());
		  }else{
			 $this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
			 redirect($this->agent->referrer());
		  }
	  }
	  //echo '<pre>';print_r($post);exit;
	 }else{
		 $this->session->set_flashdata('error',"Please login and continue.");
		redirect('home/login');
    }

  }

  public function milk_orders()
  {

    if ($this->session->userdata('logged_in') == TRUE) {
      $data['categories'] = $this->Category_model->get_all_category();
      $user_id = $this->session->userdata('id');
      $data['cart'] = $this->Cart_Model->get_all_items_from_cart($user_id);
      $data['count'] = count($data['cart']);
      $data['cart_template'] = $this->load->view('home/cart_template',$data,TRUE);
      $post = $this->input->post();
			if ($post) {
				unset($post['button']);
				$fromdate = $this->input->post('fromdate');
				$todate = $this->input->post('todate');
				$data['filter'] = $post;
				$data['calender_orders'] = $this->Calender_Model->get_all_calender_items_by_user_id($user_id,$fromdate,$todate);
				//echo $this->db->last_query();exit;
			} else {
				$data['calender_orders'] = $this->Calender_Model->get_all_calender_items_by_user_id($user_id,'','');
			}
			$data['bank_detail']=$this->Calender_Model->get_bank_details($user_id);
		//echo '<pre>';print_r($data);exit;
      $data['pageTitle'] = 'Milk Order';
      $this->load->view('home/milk_orders',$data);
    } else {
      $this->session->set_flashdata('error',"Please login and continue.");
      redirect('home/login');
    }

  }
  public  function update_qty(){
	  $post=$this->input->post();
	  $u_data=array('quantity'=>$post['c_qty'],'updated_time'=>date('Y-m-d H:i:s'),'edited_by'=> $this->session->userdata('id'));
	  $update=$this->Calender_Model->update_qty_amount($post['c_id'],$u_data);
	  if(count($update)>0)
		{
			$data['msg']=1;
			echo json_encode($data);exit;
		}else{
			$data['msg']=2;
			echo json_encode($data);exit;
		}
  }
  public  function adding_payment_method(){
	  //echo '<pre>';print_r($_FILES);exit;
	  $post=$this->input->post();
	  if($post['c_ids']=='' && $post['all_c_ids']==''){
		$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
		redirect('order/milk_orders');
	  }
	  if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=''){
		$img_details= $this->Calender_Model->get_payment_img_details($post['c_ids']);
		unlink("assets/uploads/screenshot/".$img_details['payment_img']);
		$temp = explode(".", $_FILES["image"]["name"]);
		$img = round(microtime(true)) . '.' . end($temp);
		move_uploaded_file($_FILES['image']['tmp_name'], "assets/uploads/screenshot/" . $img);
	 }
	 if(isset($post['c_ids']) && $post['c_ids']!=''){
		 $time=time();
			$add=array('payment_img'=>isset($img)?$img:'','order_id'=>$time,'payment_type'=>4,'payment_status'=>1,'payment_date'=>date('Y-m-d H:i:s'));
		  $p_update=$this->Calender_Model->update_payment_details($post['c_ids'],$add);
	 }else{
		 $id=explode(",",$post['all_c_ids']);
			if(count($id)>0){
			$time=time();
			 foreach($id as $li){
				$add=array('payment_img'=>isset($img)?$img:'','order_id'=>$time,'payment_type'=>4,'payment_status'=>1,'payment_date'=>date('Y-m-d H:i:s'));
				$p_update=$this->Calender_Model->update_payment_details($li,$add);
			}
		 }
	 } if(count($p_update)>0){
		 $this->session->set_flashdata('success',"Payment Details successfully updated.");
		redirect('order/milk_orders');
	 }else{
		$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
		redirect('order/milk_orders');
	 }


  }
  public  function get_payments_inbetween_dates(){
	  $post=$this->input->post();
	   $user_id = $this->session->userdata('id');
	  $c_data=$this->Calender_Model->get_payments_inbetween_dates($user_id,$post['f_date'],$post['t_date']);
	  if(isset($c_data) && count($c_data)>0){
		 $amt=''; foreach($c_data as $c_li){
			  $amt +=$c_li['price']*$c_li['quantity'];
			  $c_ids[]=$c_li['calender_id'];
			}
			$data['msg']=1;
			$data['amt']=isset($amt)?$amt:'';
			$data['c_ids']=$c_ids;
			echo json_encode($data);exit;

	  }else{
			$data['msg']=0;
			echo json_encode($data);exit;
	  }
	  //echo '<pre>';print_r($c_data);exit;
  }


}

?>
