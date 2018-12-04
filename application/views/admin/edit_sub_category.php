

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
                            <h4>Edit Sub-Category</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mx-auto">
                                <div class="col-md-3">
                                    <a href="<?php echo base_url('category/sub_category_list');?>" class="btn btn-sm btn-info">Back</a>
                                </div>
                                <div class="col-md-6">
                                    <form method="post" id="edit_sub_category" 
									action="<?php echo base_url('category/save_edit_subcategory') ?>" enctype="multipart/form-data">
									    <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control" name="c_name">
                                                <option disabled>Select</option>
												<?php foreach($cat_list as $cat):?>
                                                <option 
												value="<?php echo $cat->cat_id;?>"  <?php if($cat->cat_id==$subcat->cat_id){
													echo 'selected';
												}?>><?php echo $cat->cat_name?></option>
                                                <?php endforeach; ?>
                                            </select> 
                                        </div>
                                        <div class="form-group">
                                            <label>Sub-Category Name</label>
											<input type="hidden" value="<?php echo $subcat->subcat_id ?>" name="scid" ?>
                                            <input id="name" type="text" class="form-control" name="name" value="<?php echo $subcat->subcat_name;?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Sub-Category Image</label>
                                            <input id="image" type="file" class="form-control" name="image">
                                        </div>
                                    
                                        <button type="submit" class="btn btn-primary">
                                            Save Changes
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
    $('#edit_sub_category').bootstrapValidator({
        
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
					
					regexp: {
					regexp: "(.*?)\.(png|jpeg|jpg|gif)$",
					message: 'Uploaded file is not a valid. Only png,jpg,jpeg,gif files are allowed'
					}
				}
            },
            c_name: {
                validators: {
					notEmpty: {
						message: 'category name is required'
					}
				}
            }
            }
        })
     
});

</script>