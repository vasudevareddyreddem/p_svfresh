

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
                            <h4>Add Category</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mx-auto">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <form method="post" id="add_category" action="<?php echo base_url('category/save_category');?>"  enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Category Name</label>
                                            <input id="name" type="text" class="form-control" name="cat_name">
                                        </div> 
										<div class="form-group">
                                            <label>Category  Scroll Content</label>
                                            <input id="name" type="text" class="form-control" name="cat_s_content">
                                        </div>
                                        <div class="form-group">
                                            <label>Category Image</label>
                                            <input id="" type="file" class="form-control" name="cat_image">
                                        </div>
										 <div class="form-group">
                                            <label>Category Small Image (<span
											class="text-warning">Best View 32x32</span>)</label>
                                            <input id="" type="file" class="form-control" name="cat_s_image">
                                        </div>
										 <div class="form-group">
                                            <label>Category Left Header Image (<span
											class="text-warning">Best View 585x65</span>)</label>
                                            <input id="" type="file" class="form-control" name="cat_himage1">
                                        </div>
										<div class="form-group">
                                            <label>Category Right Header Image (<span
											class="text-warning">Best View 585x65</span>)</label>
                                            <input id="" type="file" class="form-control" name="cat_himage2">
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
    $('#add_category').bootstrapValidator({
        
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
					notEmpty: {
						message: 'Image is required'
					},
					regexp: {
					regexp: "(.*?)\.(png|jpeg|jpg|gif)$",
					message: 'Uploaded file is not a valid. Only png,jpg,jpeg,gif files are allowed'
					}
				}
            },
			 cat_s_image: {
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
cat_himage1: {
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
			cat_himage2: {
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
