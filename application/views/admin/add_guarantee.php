
<div class="main-content">
    <section class="section">
        <h1 class="section-header">
            <div>Product</div>
        </h1>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Guarantee Policy</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mx-auto">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <form method="post" id="add_sub_category" action="
									<?php  echo base_url('category/save_subcat_slider')?>" enctype="multipart/form-data">
                                        <div class="row">
										  <div class="form-group col-md-12">
                                            <label>Category</label>
                                            <select class="form-control" id="c_name" name="c_name" onchange="get_category(this.value)">
                                                <option disabled selected>Select</option>
												<?php foreach($cat_list as $cat){?>
                                                <option value="<?php echo base64_encode($cat->cat_id);?>">
												<?php echo $cat->cat_name;?></option>
												<?php }?>
                                                
                                            </select>
                                        </div>
										  <div class="form-group col-md-12">
                                                <label>Sub-Category Name</label>
                                                <select class="form-control  " name="sc_name" id="sc_name" onchange="get_products(this.value)" >
                                                 <option value=''>Select</option>
                                                </select>
                                            </div>
											 <div class="form-group col-md-12">
                                                <label>Product Name</label>
                                                <select class="form-control  " name="product" id="product" >
                                                 <option value=''>Select</option>
                                                </select>
                                            </div>
											
                                           
                                        </div>
                      
							
                                       
                                        <button type="submit" class="btn btn-primary">
                                            Add
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<script type="text/javascript">
$(document).ready(function() {
    $('#add_sub_category').bootstrapValidator({
        
        fields: {
             name: {
                validators: {
					notEmpty: {
						message: 'Name is required'
					},
					regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Question wont allow <> [] = % '
					}
				}
            },
            image: {
                validators: {
					notEmpty: {
						message: 'Image is required'
					},
					regexp: {
					regexp: "(.*?)\.(png|jpeg|jpg|gif)$",
					message: 'Uploaded file is not a valid. Only png,jpg,jpeg,gif files are allowed'
					}
				}
            },
            sc_name: {
                validators: {
					notEmpty: {
						message: 'category is required'
					}
				}
            }
            }
        })
     
});

</script>
<script>
 function get_category(value){
	 $('#sc_name').empty();
	 sel='<option value="">select</option>';
	 $('#sc_name').append(sel);
	
	 $.ajax({
                    type: "GET",    
                    url: '<?php echo base_url('product/get_sub_category/'); ?>'+value,    
                    data: '',    
                    dataType: "json",   
                    
                    success: function (result) {
						console.log(result.status);
						
						if(result.status==1){
						$.each(result.subcat_list, function(i, subcat) {
							temp='<option value="'+subcat.subcat_id+'">'+subcat.subcat_name+'</option>';
							
							$('#sc_name').append(temp);
							
							
						});
						}
						
       
                                           }
                    ,
                    error: function() { 
                    	//alert('error from server side');

                    } 
                });
 }


</script>
<script>
 function get_products(value){
	 
	
	 cat_id=$('#c_name').val();
	 if(value==''){
		 return false;
	 }
	
	 $.ajax({
                    type: "GET",    
                    url: '<?php echo base_url('product/get_rel_products/'); ?>'+cat_id+'/'+value,    
                    data: '',    
                    dataType: "json",   
                    
                    success: function (result) {
						
						
						if(result.status==1){
						console.log(result);
							 $('#rel_products').empty();
							 temp1='<option value="" disabled>select</option>';
							 $('#rel_products').append(temp1); 
						$.each(result.r_plist, function(i, product) {
							
							
							
							$('#rel_products').append('<option value="'+product.product_id+'">'+product.product_name+'</option>').trigger("chosen:updated");
							
							
						});
						
						
						
						}
						else{
							$('#rel_products').empty();
						}
       
                                           }
                    ,
                    error: function() { 
                    alert('error from server side');

                    } 
                });
 }

</script>

