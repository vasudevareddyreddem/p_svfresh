

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
                                    <form id="add_product" method="post" action="<?php echo base_url('product/save_product');?>"  enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>Category Name</label>
                                                <select class="form-control" onchange="get_category(this.value)" name="c_name" id="c_name">
                                                    <option value=''>Select</option>
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
                                                 <option value=''>Select</option>
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
                                                <label>Discount percentage</label>
												<input type="checkbox" id='cid'name="" value=""> check this box for percentage<br>
                                                <input id="dp_price" type="text" class="form-control" name="dp_price" >
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Net price</label>
                                                <input id="n_price" type="text" class="form-control" name="n_price" readonly>
                                            </div>
											<div class="form-group col-md-4">
                                                <label>Product Image</label>
                                                <input id="n_price" type="file" class="form-control" name="p_image">
                                            </div>
															  <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="myTable" class=" table order-list">
                                            <thead>
                                                <tr>
                                                    <th> Feature Name</th>
                                                    <th>Feature value</th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="text" name="fname[]" placeholder="FirstName" class="form-control" />
                                                    </td>
                                                    <td>
                                                        <input type="text" name="fvalue[]" placeholder="LastName" class="form-control" />
                                                    </td>
                                                    <td>
                                                        <a class="deleteRow"></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button type="button" class="btn btn-md btn-info" id="addrow">Add Row</button>
                                    </div>
                                </div>
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
						message: 'quantity is required'
					},
					numeric:{
						message:'enter integer or decimal value'
					}
				}
            },
            a_price: {
                validators: {
					notEmpty: {
						message: 'Actual Price is required'
					},
					numeric:{
						message:'enter integer or decimal value'
					}
				}
            },
            d_price: {
                validators: {
					notEmpty: {
						message: 'Discount Price is required'
					},
					numeric:{
						message:'enter integer or decimal value'
					}
				
				}
            },
           
            }
        })
     
});

</script>
<script>
 function get_category(value){
	 $('#sc_name').empty();
	
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

// chech box 
 // $('#cid').click(function(){
		
		// if (this.checked) {
        // $('#d_price').attr('disabled', 'disabled');
		// $('#dp_price').removeAttr('disabled');
		
    // } else {
        // $('#dp_price').attr('disabled', 'disabled');
		// $('#d_price').removeAttr('disabled');
    // }
		
		
	// }); 
</script>
<script>
    $(document).ready(function () {
    var counter = 0;

    $("#addrow").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><input type="text" class="form-control" placeholder="FirstName" name="fname[]' +'"/></td>';
        cols += '<td><input type="text" class="form-control" placeholder="LastName" name="fvalue[]'+'"/></td>';

        cols += '<td><button type="button" class="ibtnDel btn btn-md btn-danger"><i class="ion ion-trash-b"></i></button></td>';
        newRow.append(cols);
        $("table.order-list").append(newRow);
        counter++;
    });



    $("table.order-list").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();       
        counter -= 1
    });


});


</script>
<script>
$('#d_price').on('keyup',function(){
	act_val=$('#a_price').val();
	
	if(act_val.length > 0){
	dis_price=$('#d_price').val();
	
	dis_perc=(dis_price/act_val)*100;
	$('#dp_price').val(dis_perc);
	net_price=act_val-dis_price;
	$('#n_price').val(net_price);
	

	}
	
}); 
$('#dp_price').on('keyup',function(){
	act_val=$('#a_price').val();
	
	if(act_val.length > 0){
	percentage=$('#dp_price').val();
	
	price=(percentage/100)*act_val;
	$('#d_price').val(price);
	net_price=act_val-price;
	$('#n_price').val(net_price);

	}
	
}); 

</script>
