
<style>
.font-18{
	font-size:35px;
}
</style>
<div class="main-content">
    <section class="section">
        <h1 class="section-header">
            <div>Add Slider</div>
        </h1>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Slider</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mx-auto">
                             
        <div class="control-group" id="fields">
            
            <div class="controls"> 
                <form id="add_slider" action="<?php echo base_url('slider/save_slider')?>" method="post"   enctype="multipart/form-data">
				
				<div class="row">
					<div class="form-group col-md-6">
                           <label>Banner Name</label>
                           <input id="" type="text" class="form-control" name="s_name">
                            </div>
				<div class="form-group col-md-6">
                           <label>Banner Left Image (<span
											class="text-warning">Best View 1000x1100</span>)</label>
                           <input id="n_price" type="file" class="form-control" name="sl_image">
                            </div>
							<div class="form-group col-md-6">
                                                <label>Banner Right Image (<span
											class="text-warning">Best View 1000x1100</span>)</label>
                                                <input id="n_price" type="file" class="form-control" name="sr_image">
                                            </div>
                    <div class="entry col-md-6">
					 
						<div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
									
									 
                                        <table id="myTable1" class="table1 order-list1">
                                            <thead>
                                                <tr>
                                                    <th> Slider Images (<span
											class="text-warning">Best View 650x310</span>)</th>
                                                   
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              
												
												<tr>
												
                                                    <td>
                                                        <input type="file" name="slider[]" placeholder="LastName" class="form-control"   />
                                                    </td>
                                                    <td>
                                                        <a class="deleteRow"></a>
                                                    </td>
													
													
													
                                                </tr>
												
                                            </tbody>
                                        </table>
									
                                        <button type="button" class="btn btn-md btn-info" id="slide">Add Slider Image</button>
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
						message: 'Name is required'
					}
					
				
				}
            },
			sl_image: {
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
             
			sr_image: {
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
			'slider[]': {
                validators: {
					notEmpty: {
						message: 'Image is required'
					},
					regexp: {
					regexp: "(.*?)\.(png|jpeg|jpg|gif)$",
					message: 'Uploaded file is not a valid. Only png,jpg,jpeg,gif files are allowed'
					}
				
				}
            }
            
           
            
			
			
           
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

    $("#slide").on("click", function () {
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



