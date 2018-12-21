

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
                            <h4>Edit Category</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mx-auto">
                                <div class="col-md-3">
                                    <a href="<?php echo base_url('category/category_list') ?>" class="btn btn-sm btn-info">Back</a>
                                </div>
                                <div class="col-md-6">
                                    <form method="post" id="edit_category" action="<?php echo base_url('category/save_edit_category');?>" enctype="multipart/form-data">
									
									<div class="form-group"><input type="hidden" value="<?php 
									echo base64_encode($cat->cat_id); ?>" name="cat_id"></div>
                                        <div class="form-group">
                                            <label>Category Name</label>
											
                                            <input id="name" type="text" class="form-control" name="cat_name" 
											value="<?php echo $cat->cat_name; ?>">
                                        </div> 
										<div class="form-group">
                                            <label>Category  Scroll Content</label>
                                            <input id="name" type="text" class="form-control" name="cat_s_content"
											value="<?php echo $cat->cat_scr_content; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Category Image</label>
											<?php if(!$cat->cat_img==''){?>
                                        <img alt="image" 
											src="<?php echo base_url('assets/uploads/category_pics/').$cat->cat_img; ?>" class="rounded-circle dropdown-item-img" style="height:30px;width:auto"> 
											<?php }else{?><span> No Image</span><?php }?>
											<input id="image" type="file" class="form-control" name="cat_image">
                                        </div>
										<div class="form-group">
                                            <label>Category  Small Image (<span
											class="text-warning">Best View 32x32</span>)</label>
											<?php if(!$cat->cat_small_img==''){?>
                                        <img alt="image" 
											src="<?php echo base_url('assets/uploads/category_pics/').$cat->cat_small_img; ?>" class="rounded-circle dropdown-item-img" style="height:30px;width:auto"> 
											<?php }else{?><span> No Image</span><?php }?>
											<input id="image" type="file" class="form-control" name="cat_s_image">
                                        </div>
										 <div class="form-group">
                                            <label>Category Left Header Image (<span
											class="text-warning">Best View 585x65</span>)</label>
											<?php if(!$cat->cat_lh_img==''){?>
											<img alt="image" 
											src="<?php echo base_url('assets/uploads/category_pics/').$cat->cat_lh_img; ?>" class="rounded-circle dropdown-item-img" style="height:30px;width:auto"> 
											<?php }else{?><span> No Image</span><?php }?>
                                            <input id="image" type="file" class="form-control" name="cat_himage1">
                                        </div>
										<div class="form-group">
                                            <label>Category Right Header Image (<span
											class="text-warning">Best View 585x65</span>)</label>
											<?php if(!$cat->cat_rh_img==''){?>
											<img alt="image" 
											src="<?php echo base_url('assets/uploads/category_pics/').$cat->cat_rh_img; ?>" class="rounded-circle dropdown-item-img" style="height:30px;width:auto"> 
											<?php }else{?><span> No Image</span><?php }?>
                                            <input id="image" type="file" class="form-control" name="cat_himage2">
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
    $('#edit_category').bootstrapValidator({
        
        fields: {
             cat_name: {
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
            cat_image: {
                validators: {
					
					regexp: {
					regexp: "(.*?)\.(png|jpeg|jpg|gif)$",
					message: 'Uploaded file is not a valid. Only png,jpg,jpeg,gif files are allowed'
					}
				}
            },
cat_himage1: {
                validators: {
					
					regexp: {
					regexp: "(.*?)\.(png|jpeg|jpg|gif)$",
					message: 'Uploaded file is not a valid. Only png,jpg,jpeg,gif files are allowed'
					}
				}
            },
			cat_himage2: {
                validators: {
					
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