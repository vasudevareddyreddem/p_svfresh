

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
                            <h4>Add Product</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="card-body">
                                    <form id="add_product" method="post" action="">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>Category Name</label>
                                                <select class="form-control" name="c_name" id="c_name">
                                                    <option disabled selected>Select</option>
													<?php  if($status==1){
														foreach($cat_list as $cat){ ?>
                                                    <option value="<?php echo base64_encode($cat->cat_id) ;?>">
													<?php echo $cat->cat_name ; ?>
													</option>
														<?php }}?>
                                                   
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Sub-Category Name</label>
                                                <select class="form-control" name="sc_name" id="sc_name">
                                                    <option disabled selected>Select</option>
                                                    <option value="1">Sub-Category 1</option>
                                                    <option value="2">Sub-Category 2</option>
                                                    <option value="3">Sub-Category 3</option>
                                                    <option value="4">Sub-Category 4</option>
                                                    <option value="5">Sub-Category 5</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Product Name</label>
                                                <input id="p_name" type="text" class="form-control" name="p_name">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Quantity</label>
                                                <input id="quantity" type="text" class="form-control" name="quantity">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Actual Price</label>
                                                <input id="a_price" type="text" class="form-control" name="a_price">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Discount Price</label>
                                                <input id="d_price" type="text" class="form-control" name="d_price">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Net price</label>
                                                <input id="n_price" type="text" class="form-control" name="n_price">
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
    $('#add_product').bootstrapValidator({
        
        fields: {
             c_name: {
                validators: {
					notEmpty: {
						message: 'Category Name is required'
					}
				}
            },
            sc_name: {
               validators: {
					notEmpty: {
						message: 'Sub-Category is required'
					}
				}
            },
            p_name: {
                validators: {
					notEmpty: {
						message: 'Product Name is required'
                    }
				}
            },
            quantity: {
                validators: {
					notEmpty: {
						message: 'Gender is required'
					}
				}
            },
            a_price: {
                validators: {
					notEmpty: {
						message: 'Actual Price is required'
					}
				}
            },
            d_price: {
                validators: {
					notEmpty: {
						message: 'Discount Price is required'
					}
				}
            },
            n_price: {
                validators: {
					notEmpty: {
						message: 'Net Price is required'
					}
				}
            }
            }
        })
     
});

</script>
<script>
$('#add_product').on('change',function(){
	alert('odk');
    cat=$('#add_product').val();
    $.ajax({
                    type: "POST",    
                    url: "<?php echo base_url('product/get_sub_category/'); ?>"+cat,    
                    data: '',    
                    dataType: "json",   
                    
                    success: function (result) {
						
						$.each(result.subcat_list, function(i, subcat) {
							//temp='<option value="'+
							
							
						});
						
       
                                           }
                    ,
                    error: function() { 
                    	//alert('error from server side');

                    } 
                });
});

</script>

