
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
                <form id="add_slider" action="<?php echo base_url('slider/save_slider')?>" method="post"   enctype="multipart/form-data">
				<div class="row">
					<div class="form-group col-md-6">
                           <label>Slider Name</label>
                           <input id="" type="text" class="form-control" name="s_name"
						   value="<?php echo $slider->slider_name;?>">
                            </div>
							 <div class="form-group">
                                            <label>sliders Left Old Image</label>
											
                                        <img alt="image" 
											src="<?php echo base_url('assets/uploads/slider_pics/').$slider->l_pic; ?>" class="rounded-circle dropdown-item-img" style="height:30px;width:auto"> 
											
											</div>
				<div class="form-group col-md-6">
				
                           <label>Sliders Left Image</label>
                           <input id="" type="file" class="form-control" name="sl_image">
                            </div>
							 <div class="form-group">
                                            <label>sliders Right Old Image</label>
											
                                        <img alt="image" 
											src="<?php echo base_url('assets/uploads/slider_pics/').$slider->r_pic; ?>" class="rounded-circle dropdown-item-img" style="height:30px;width:auto"> 
											
											</div>
							<div class="form-group col-md-6">
                                                <label>Sliders Right Image</label>
                                                <input id="n_price" type="file" class="form-control" name="sr_image">
                                            </div>
											<?php if($picstatus==1){ 
											foreach($pics as $pic):?>
											 <div class="form-group">
                                            <label>sliders  Old Images</label>
											
                                        <img alt="image" 
											src="<?php echo base_url('assets/uploads/slider_pics/').$pic->pic_name; ?>" class="rounded-circle dropdown-item-img" style="height:30px;width:auto"> 
											
											</div>
											<?php endforeach ;} ?>
                    <div class="entry col-md-6">
					 <label>Sliders </label>
					 <div class="input-group">
                        <input class="form-control" name="slider[]" type="file" placeholder="Type something"  required />
                    	<span class="input-group-btn">
                            <button class="btn btn-success btn-add" type="button">
                                <span class="font-18">+</span>
                            </button>
                        </span>
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



