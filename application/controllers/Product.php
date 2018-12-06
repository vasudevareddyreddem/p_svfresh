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
				$descr=$this->input->post('descr');
				$status=$this->Product_model->check_unique_product($product_name,$cat_id,$subcat_id);
				if($status==1){
					$this->session->set_flashdata('error','product name  already existed');
					       redirect('product/add_product');

				}
                  $cnt=count($f_names);
				   for($i=0;$i<$cnt;$i++){

					 if(isset($f_names[$i])){
					   {
						 for($j=0;$j<$cnt;$j++){
                             if(isset($f_names[$j]))
							 {
							     if($j!=$i){
                                     if($f_names[$i]==$f_names[$j]&&$f_values[$i]==$f_values[$j])
							        {
								 unset($f_names[$i]);
						         unset($f_values[$i]);
								 break;


							       }
							 }
						 }
						 }
					 }
					 }



								}




				//print_r($f_names);exit;


				 $config['upload_path']          = './assets/uploads/product_pics';
                $config['allowed_types']        = 'gif|jpg|png';
                // $config['max_size']             = 100;
                // $config['max_width']            = 1024;
                // $config['max_height']           = 768;

                $this->load->library('upload', $config);


				  if ( ! $this->upload->do_upload('p_image',time()))
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
				 'created_by'=>$adminid,
				 'description'=>$descr
				);
				$product_id=$this->Product_model->save_product($data);
				foreach($f_names as $key=>$value){
					if(!$f_values[$key]=='' && !$value=='')
					{
				  $features[]=array(
				  'feature_name'=>$value,
				  'feature_value'=>$f_values[$key],
				  'product_id'=>$product_id,
				  'created_by'=>$adminid
				  );
					}
				}
				if(!empty($features)){
				$status=$this->Product_model->save_features($features);
				}
				 $this->session->set_flashdata('success','product addded  successfully');
					      redirect('product/product_list');
				/* if($status==1){
				   $this->session->set_flashdata('success','product addded  successfully');
					      redirect('product/product_list');


				}
				 else{
					 $this->session->set_flashdata('error','features not added');
					       redirect('product/add_product');
				 }*/


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

				if(isset($_POST['fname'])){
					$cnt=count($f_names);
				 for($i=0;$i<$cnt;$i++){

					 if(isset($f_names[$i])){
					   {
						 for($j=0;$j<$cnt;$j++){
                             if(isset($f_names[$j]))
							 {
							     if($j!=$i){
                                     if($f_names[$i]==$f_names[$j]&&$f_values[$i]==$f_values[$j])
							        {
								 unset($f_names[$i]);
						         unset($f_values[$i]);
								 break;


							       }
							 }
						 }
						 }
					 }
					 }



								}
				}


				$status=$this->Product_model->check_unique_edit_product($pid,$product_name,$cat_id,$subcat_id);

				if($status==1){
					$this->session->set_flashdata('error','product name  already existed');
					       redirect($_SERVER['HTTP_REFERER']);

				}



				 $config['upload_path']          = './assets/uploads/product_pics';
                $config['allowed_types']        = 'gif|jpg|png';


                $this->load->library('upload', $config);
				$img_status=0;
			  if($_FILES['p_image']['name']!=''){
				  if ( ! $this->upload->do_upload('p_image',time()))
                {
                        //$error = array('error' => $this->upload->display_errors());

                          $this->session->set_flashdata('error','product image not uploaded');
					      redirect($_SERVER['HTTP_REFERER']);
                }
				else{
					$upload_data = $this->upload->data();
                    $product_img =   $upload_data['file_name'];
					$img_status=1;
				}
			  }
				if($img_status==1){
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
				}
				else{
					$data=array(
				'product_name'=>$product_name,
				'cat_id'=>$cat_id,
				'subcat_id'=>$subcat_id,
				'actual_price'=>$act_price,
				'discount_price'=>$dis_price,
				'discount_percentage'=>$dis_percentage,
				'net_price'=>$net_price,
				'quantity'=>$qun,
				 'created_by'=>$adminid,
				 'description'=>$this->input->post('descr')
				);

				}


				$status=$this->Product_model->save_edit_product($data,$pid);



				 $features=$this->Product_model->get_features_array($pid);

				$fets=array_column($features, 'feature_id');



					if(isset($_POST['fid'])){
				foreach($fids as $key=>$value){


						$up_features=array(

				  'feature_name'=>$f_names[$key],
				  'feature_value'=>$f_values[$key],
				  'product_id'=>$pid,
				  'updated_by'=>$adminid
				  );
				 //$key1=array_search($value, $names);
				 //
				 if(isset($f_names[$key])&& isset($f_values[$key]) ){
					 $this->Product_model->save_edit_features($up_features,$value);
				         				  unset($f_names[$key]);
										   unset($f_values[$key]);
                 }
				 else{
					 $this->Product_model->delete_features($value);
				 }
				  unset($fids[$key]);

				}
			}
                if(isset($f_names)){
				if(!empty($f_names)){
					foreach($f_names as $key=>$value){
						if(!$value==''&& !$f_values[$key]=='')
						{
						$in_features[]=array(

				  'feature_name'=>$value,
				  'feature_value'=>$f_values[$key],
				  'product_id'=>$pid,
				  'created_by'=>$adminid
				  );
					}
					}

				$ins_status=$this->Product_model->save_features($in_features);
				}
				}
				//loop the remaing feature elemnts

				// foreach($fids as $key=>$value){
					// $this->Product_model->delete_features($value);

				// }
				 if($status==1){
				   $this->session->set_flashdata('success','product updated  successfully');
					      redirect('product/product_list');


				}
				 else{
					 $this->session->set_flashdata('error','product updated');
					       redirect($_SERVER['HTTP_REFERER']);
				 }


			}
			else{redirect('login');}

		}

		public function delete_product(){
			if($this->session->userdata('svadmin_det')){
			$id=base64_decode($this->uri->segment(3));
			$status=$this->Product_model->delete_product($id);
			if($status==1){
				$this->session->set_flashdata('success',' product deleted');
			  redirect('product/product_list');
			}
			else{
				$this->session->set_flashdata('error','product not deleted');
			  redirect('product/product_list');
			}
		}
		else{redirect('login');}
		}
}
