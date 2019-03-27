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
				$p_nick_name=$this->input->post('p_nick_name');
				$act_price=$this->input->post('a_price');
				$qun=$this->input->post('quantity');
					$oqun=$this->input->post('oquantity');
				$dis_price= round($this->input->post('d_price'),2);
				$dis_percentage= round($this->input->post('dp_price'),2);
				$f_names=$this->input->post('fname');
				$f_values=$this->input->post('fvalue');
				$net_price=$act_price-$dis_price;
				$descr=$this->input->post('descr');
				$guaran=$this->input->post('guaran');
				$status=$this->Product_model->check_unique_product($product_name,$cat_id,$subcat_id);
				if($status==1){
					$this->session->set_flashdata('error','Product name  already existed');
					       redirect('product/add_product');

				}
				if(isset($_POST['f_names'])){
					 $cnt=count($f_names);
				}
				else{
					$cnt=0;
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

				 $config['upload_path']          = './assets/uploads/product_pics';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|Jpeg|Png';
              $this->load->library('upload', $config);
if ( ! $this->upload->do_upload('main_image',time()))
                {
                        $error = array('error' => $this->upload->display_errors());

                          $this->session->set_flashdata('error',$error['error']);
					      redirect($_SERVER['HTTP_REFERER']);
                }
				else{
					$upload_data = $this->upload->data();
                    $main_img =   $upload_data['file_name'];
				}



				$data=array(
				'product_name'=>$product_name,
				'product_nick_name'=>$p_nick_name,
				'product_img'=>$main_img,
				'cat_id'=>$cat_id,
				'subcat_id'=>$subcat_id,
				'actual_price'=>$act_price,
				'discount_price'=>$dis_price,
				'discount_percentage'=>$dis_percentage,
				'net_price'=>$net_price,
				'quantity'=>$qun,
				'o_quantity'=>$oqun,
				 'created_by'=>$adminid,
				 'description'=>$descr,
				 'guarantee_policy'=>$guaran
				);
				$product_id=$this->Product_model->save_product($data);
				//releated products
				$rproducts=$this->input->post('rel_products');

			if(!empty($rproducts)){
				foreach($rproducts as $product){
					$rdata[]=array('product_id'=>$product_id,
					'rel_product_id'=>$product,
					'created_by'=>$adminid);

				}
				$this->Product_model->save_rel_products($rdata);
			}
			// Count total files
			//statr of uploading images
			if(isset($_FILES['p_image']['name'])){
      $countfiles = count($_FILES['p_image']['name']);

	 $img_stat=0;

      // Looping all files
      for($i=0;$i<$countfiles;$i++){

        if($_FILES['p_image']['name'][$i]!=''){

          // Define new $_FILES array - $_FILES['file']
           $_FILES['image']['name']     = $_FILES['p_image']['name'][$i];
                $_FILES['image']['type']     = $_FILES['p_image']['type'][$i];
                $_FILES['image']['tmp_name'] = $_FILES['p_image']['tmp_name'][$i];
                $_FILES['image']['error']     = $_FILES['p_image']['error'][$i];
                $_FILES['image']['size']     = $_FILES['p_image']['size'][$i];

		 //echo   $_FILES['slide']['name'];exit;
		    if ( ! $this->upload->do_upload('image',time()))
                {


                          $this->session->set_flashdata('error',' Product image not uploaded');

					      redirect($_SERVER['HTTP_REFERER']);
                }
				else{
					$upload_data = $this->upload->data();
					$img_stat=1;
                    $slider_img =   $upload_data['file_name'];
					$pdata[]=array('image_name'=>$slider_img,
					'product_id'=>$product_id,
					'created_by'=>$adminid);
				}





        }

      }
	  if($img_stat==1){
 $this->Product_model->save_product_images($pdata);
	  }
			}
			//end of uploading images

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
				 $this->session->set_flashdata('success','Product added  successfully');
					      redirect('product/product_list');


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
			$data['images']=$this->Product_model->get_product_images($pid);
			$data['rel_products']=$this->Product_model->get_rel_proudcts_by_id($pid);
			//echo $this->db->last_query();exit;


			if(count($data['cat_list'])>0){
					$data['status']=1;


				}
				else{
					$data['status']=0;

				}

			$data['product']=$this->Product_model->edit_product($pid);

			if(!$data['product']){
				   $this->session->set_flashdata('error','This Product deleted by another session');
			         redirect('product/product_list');

			}
			$cat_id=$data['product']->cat_id;
			$subcat_id=$data['product']->subcat_id;
			$data['r_plist']=$this->Product_model->get_rel_products($cat_id,$subcat_id);
			//echo $pid;	print_r($data['rel_products']);print_r($data['r_plist']);exit;

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
				$p_nick_name=$this->input->post('p_nick_name');
				$act_price=$this->input->post('a_price');
				$qun=$this->input->post('quantity');
				$oqun=$this->input->post('oquantity');
				$dis_price=round($this->input->post('d_price'),2);
				$dis_percentage=round($this->input->post('dp_price'),2);
				$fids=$this->input->post('fid');
				$f_names=$this->input->post('fname');
				$f_values=$this->input->post('fvalue');
				$net_price=$act_price-$dis_price;
				$guaran=$this->input->post('guaran');

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
					$this->session->set_flashdata('error','Product name  already existed');
					       redirect($_SERVER['HTTP_REFERER']);

				}
								 $config['upload_path']          = './assets/uploads/product_pics';
                $config['allowed_types']        = 'gif|jpg|png';
              $this->load->library('upload', $config);
			  $add=array(
				'product_name'=>$product_name,
				'product_nick_name'=>$p_nick_name,

				'cat_id'=>$cat_id,
				'subcat_id'=>$subcat_id,
				'actual_price'=>$act_price,
				'discount_price'=>$dis_price,
				'discount_percentage'=>$dis_percentage,
				'net_price'=>$net_price,
				'quantity'=>$qun,
				'o_quantity'=>$oqun,
				 'updated_by'=>$adminid,
				 'description'=>$this->input->post('descr'),
				 'guarantee_policy'=>$guaran
				);
		if($_FILES['main_image']['name']!=''){
if ( ! $this->upload->do_upload('main_image',time()))
                {


                          $this->session->set_flashdata('error','Product image not uploaded');
					      redirect($_SERVER['HTTP_REFERER']);
                }
				else{

					$upload_data = $this->upload->data();
                    $main_img =  $upload_data['file_name'];

					$add['product_img']=$main_img;
				}
		}

        	//echo 'else';exit;


				$status=$this->Product_model->update_edit_product($pid,$add);



				//edit reltate products_list
				$rproducts=$this->input->post('rel_products');
			if(!empty($rproducts)){
				foreach($rproducts as $product){
					$rdata[]=array('product_id'=>$pid,
					'rel_product_id'=>$product,
					'created_by'=>$adminid);

				}
				$this->Product_model->delete_rel_products($pid,$adminid);
				$this->Product_model->save_rel_products($rdata);
			}
             else{
				 $this->Product_model->delete_rel_products($pid,$adminid);

			 }

				 $config['upload_path']          = './assets/uploads/product_pics';
                $config['allowed_types']        = 'gif|jpg|png';


                $this->load->library('upload', $config);



//$pimages=$this->input->post('p_image');

 //echo $countfiles;
//print_r($pimages);exit;
if(isset($_POST['image_id'])){
            $img_ids=$this->input->post('image_id');

}
else{
	$img_ids=array();

}
if(isset($_FILES['p_image']['name'])){
         $countfiles = count($_FILES['p_image']['name']);
//echo $countfiles;exit;
}
else{
	$countfiles=0;
}

				$count=0;
				foreach($img_ids as $key=>$value){

					$value=base64_decode($value);
                             if(isset($_FILES['p_image']['name'][$key])){
								 $count++;

                           if($_FILES['p_image']['name'][$key]!=''){

          // Define new $_FILES array - $_FILES['file']
           $_FILES['image']['name']     = $_FILES['p_image']['name'][$key];
                $_FILES['image']['type']     = $_FILES['p_image']['type'][$key];
                $_FILES['image']['tmp_name'] = $_FILES['p_image']['tmp_name'][$key];
                $_FILES['image']['error']     = $_FILES['p_image']['error'][$key];
                $_FILES['image']['size']     = $_FILES['p_image']['size'][$key];

		 //echo   $_FILES['slide']['name'];exit;
		    if ( ! $this->upload->do_upload('image',time()))
                {


                          $this->session->set_flashdata('error',' Product image not uploaded');

					      redirect($_SERVER['HTTP_REFERER']);
                }
				else{
					$upload_data = $this->upload->data();
                    $product_img =   $upload_data['file_name'];
					$pdata=array('image_name'=>$product_img,

					'updated_by'=>$adminid);
					$this->Product_model->save_edit_product_images($pdata,$value);


				}
  }
							 }
							 //delete image
							 else{
								 $this->Product_model->save_delete_product_images($value,$adminid);


							 }
				}

			if($count<$countfiles){
				    $img_status=0;

      // Looping all files
      for($i=$count;$i<$countfiles;$i++){


        if($_FILES['p_image']['name'][$i]!=''){


          // Define new $_FILES array - $_FILES['file']
           $_FILES['image']['name']     = $_FILES['p_image']['name'][$i];
                $_FILES['image']['type']     = $_FILES['p_image']['type'][$i];
                $_FILES['image']['tmp_name'] = $_FILES['p_image']['tmp_name'][$i];
                $_FILES['image']['error']     = $_FILES['p_image']['error'][$i];
                $_FILES['image']['size']     = $_FILES['p_image']['size'][$i];

		 //echo   $_FILES['slide']['name'];exit;
		    if ( ! $this->upload->do_upload('image',time()))
                {


                          $this->session->set_flashdata('error',' Product image not uploaded');

					      redirect($_SERVER['HTTP_REFERER']);
                }
				else{
					$img_status=1;
					$upload_data = $this->upload->data();
                    $product_img =   $upload_data['file_name'];
					$image_data[]=array('image_name'=>$product_img,
					'product_id'=>$pid,
					'created_by'=>$adminid);
				}



		}

        }

			if($img_status==1){


 $sta=$this->Product_model->save_product_images($image_data);
			}

      }


				//features edit

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
					 $this->Product_model->delete_features($value,$adminid);
				 }
				  unset($fids[$key]);

				}
			}
                if(isset($f_names)){
				if(!empty($f_names)){
					$fet_status=0;
					foreach($f_names as $key=>$value){
						if(!$value==''&& !$f_values[$key]=='')
						{
							$fet_status=1;
						$in_features[]=array(

				  'feature_name'=>$value,
				  'feature_value'=>$f_values[$key],
				  'product_id'=>$pid,
				  'created_by'=>$adminid
				  );
					}
					}
              if($fet_status==1){
				$ins_status=$this->Product_model->save_features($in_features);
			  }
				}
				}
				//end features edit
				//loop the remaing feature elemnts

				// foreach($fids as $key=>$value){
					// $this->Product_model->delete_features($value);

				// }
				 if($status==1){
				   $this->session->set_flashdata('success','Product updated  successfully');
					      redirect('product/product_list');


				}
				 else{
					 $this->session->set_flashdata('error','Product updated');
					       redirect('product/product_list');
				 }


			}
			else{redirect('login');}

		}



		public function delete_product(){
			if($this->session->userdata('svadmin_det')){

			$id=base64_decode($this->uri->segment(3));
			$status=$this->Product_model->delete_product($id);
			if($status==1){
				$this->session->set_flashdata('success',' Product deleted');
			  redirect('product/product_list');
			}
			else{
				$this->session->set_flashdata('error','Product not deleted');
			  redirect('product/product_list');
			}
		}
		else{redirect('login');}
		}

		public function get_rel_products(){
			if( $this->session->userdata('svadmin_det')){

				$cat_id=base64_decode($this->uri->segment(3));
				$subcat_id=$this->uri->segment(4);
			//echo $cat_id; exit;

				$data['r_plist']=$this->Product_model->get_rel_products($cat_id,$subcat_id);


				if(count($data['r_plist'])>0){
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
		public function inactive_product(){
		if($this->session->userdata('svadmin_det')){
			$admin=$this->session->userdata('svadmin_det');
			$svadmin=$admin['admin_id'];
			$id=base64_decode($this->uri->segment(3));
			$status=$this->Product_model->inactive_product($id,$svadmin);
			if($status==1){
				$this->session->set_flashdata('success','Product inactivated');
			  redirect('product/product_list');
			}
			else{
				$this->session->set_flashdata('error','Product not inactivated');
			  redirect('product/product_list');
			}
		}
		else{redirect('login');}

	}
	public function active_product(){
		if($this->session->userdata('svadmin_det')){
			$admin=$this->session->userdata('svadmin_det');
			$svadmin=$admin['admin_id'];
			$id=base64_decode($this->uri->segment(3));
			$status=$this->Product_model->active_product($id,$svadmin);
			if($status==1){
				$this->session->set_flashdata('success','Product activated');
			  redirect('product/product_list');
			}
			else{
				$this->session->set_flashdata('error','Product not activated');
			  redirect('product/product_list');
			}
		}
		else{redirect('login');}

	}
		public function add_guarantee(){
		if($this->session->userdata('svadmin_det')){
			$data['cat_list']=$this->Category_model->get_category_names();
				if(count($data['cat_list'])>0){
					$data['status']=1;


				}
				else{
					$data['status']=0;

				}

			$this->load->view('admin/add_guarantee',$data);
		    $this->load->view('admin/footer');


		}
		else{redirect('login');}

	}

}
