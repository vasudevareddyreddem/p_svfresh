
<style>
.font-18{
	font-size:35px;
}
</style>
<div class="main-content">
    <section class="section">
        <h1 class="section-header">
            <div>Edit Slider</div>
        </h1>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Slider</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mx-auto">
                             
        <div class="control-group" id="fields">
            
            <div class="controls"> 
                <form id="add_slider" action="<?php echo base_url('slider/save_edit_slider')?>" method="post"   enctype="multipart/form-data">
				<div class="row">
					<div class="form-group col-md-6">
                           <label>Banner Name</label>
						    <input id="" type="hidden" class="form-control" name="sid"
						   value="<?php echo $slider->slider_id;?>">
                           <input id="" type="text" class="form-control" name="s_name"
						   value="<?php echo $slider->slider_name;?>">
                            </div>
							
				<div class="form-group col-md-6">
				
                           <label>Banner Left Image (<span
											class="text-warning">Best View 1000x1100</span>) <img alt="image" 
											src="<?php echo base_url('assets/uploads/slider_pics/').$slider->l_pic; ?>" class="rounded-circle dropdown-item-img" style="height:20px;width:auto"></label>
                           <input id="" type="file" class="form-control" name="sl_image">
                            </div>
							 
							<div class="form-group col-md-6">
                                                <label>Banner Right Image (<span
											class="text-warning">Best View 1000x1100</span>) <img alt="image" 
											src="<?php echo base_url('assets/uploads/slider_pics/').$slider->r_pic; ?>" class="rounded-circle dropdown-item-img" style="height:20px;width:auto"> </label>
                                                <input id="n_price" type="file" class="form-control" name="sr_image">
                                            </div>
											
                    <div class="entry col-md-6">
					
						<div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
									
									 
                                        <table id="myTable1" class="table1 order-list1">
                                            <thead >
                                                <tr>
                                                    <th colspan="2"> Slider Images (<span
											class="text-warning">Best View 650x310</span>)</th>
                                                   
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                              
												<?php if($picstatus==1){ 
												$count=1;
											foreach($pics as $pic){ ?>
												<input type="hidden" 
												value="<?php echo base64_encode($pic->pic_id);?>" name="slider_id[]" >
												<tr>
												<td>
                                                   <img alt="image" 
											src="<?php echo base_url('assets/uploads/slider_pics/').$pic->pic_name; ?>" class="rounded-circle dropdown-item-img" style="height:30px;width:auto"> 
											</td>
                                                    <td>
                                                        <input type="file" name="slider[]" placeholder="LastName" class="form-control"   />
                                                    </td>
                                                    <td>
                                                        <a class="deleteRow"></a>
                                                    </td>
													 <?php  if($count!=1){?>
													<td><button type="button" class="ibtnDel btn btn-md btn-danger"><i class="ion ion-trash-b"></i></button></td>
													 <?php }?>
                                                </tr>
												<?php $count++;}}?>
                                            </tbody>
                                        </table>
									
                                        <button type="button" class="btn btn-md btn-info" id="addslider">Add Slider Image</button>
                                    </div>
                                </div>
                            </div>
                                   
                    </div>
				</div>
            <br>
           
           
			<div class="clearfix">&nbsp;</div>
				<button type='submit' class="btn btn-primary btn-sm">Submit</button>
                </form>
        </div>
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
    $('#add_slider').bootstrapValidator({
		
        
        fields: {
             
              s_name: {
                validators: {
					notEmpty: {
						message: 'name is required'
					}
					
				
				}
            },
			sl_image: {
                validators: {
					
					regexp: {
					regexp: "(.*?)\.(png|jpeg|jpg|gif)$",
					message: 'Uploaded file is not a valid. Only png,jpg,jpeg,gif files are allowed'
					}
				
				}
            },
             
			sr_image: {
                validators: {
					
					regexp: {
					regexp: "(.*?)\.(png|jpeg|jpg|gif)$",
					message: 'Uploaded file is not a valid. Only png,jpg,jpeg,gif files are allowed'
					}
				
				}
            },
            
           
            
			
			
           
            }
        })
     
});

</script>
<script>
$(function()
{
    $(document).on('click', '.btn-add', function(e)
    {
        e.preventDefault();

        var controlForm = $('.controls form:first'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);

        newEntry.find('input').val('');
        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="font-18">-</span>');
    }).on('click', '.btn-remove', function(e)
    {
		$(this).parents('.entry:first').remove();

		e.preventDefault();
		return false;
	});
});

</script>
<script>
 $(document).ready(function () {
    var counter = 0;

    $("#addslider").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><input type="file" name="slider[]" class="form-control" placeholder="FirstName" /></td>';
        

        cols += '<td><button type="button" class="ibtnDel btn btn-md btn-danger"><i class="ion ion-trash-b"></i></button></td>';
        newRow.append(cols);
        $("#myTable1").append(newRow);
        counter++;
    });



    $("#myTable1").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();       
        counter -= 1
    });


});
</script>



