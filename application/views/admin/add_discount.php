
<div class="main-content">
    <section class="section">
        <h1 class="section-header">
            <div>Category</div>
        </h1>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Discount</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mx-auto">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <form method="post" id="add_sub_category" action="
									<?php  echo base_url('category/save_discount_image')?>" enctype="multipart/form-data">
                                        <div class="form-group">
										 <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control" name="c_name">
                                                <option disabled selected>Select</option>
												<?php foreach($cat_list as $cat){?>
                                                <option value="<?php echo base64_encode($cat->cat_id);?>">
												<?php echo $cat->cat_name;?></option>
												<?php }?>
                                                
                                            </select>
                                        </div>
                                           
                                        </div>
                                        <div class="form-group">
                                            <label>Discount Image (<span
											class="text-warning">Best View 700x700</span>)</label>
                                            <input id="image" type="file" class="form-control" name="image">
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
            c_name: {
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
