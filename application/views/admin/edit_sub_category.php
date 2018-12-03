

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
                                    <a href="sub_categories_list.php" class="btn btn-sm btn-info">Back</a>
                                </div>
                                <div class="col-md-6">
                                    <form method="" id="edit_sub_category" action="">
                                        <div class="form-group">
                                            <label>Sub-Category Name</label>
                                            <input id="name" type="text" class="form-control" name="name" value="Milk">
                                        </div>
                                        <div class="form-group">
                                            <label>Sub-Category Image</label>
                                            <input id="image" type="file" class="form-control" name="image">
                                        </div>
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control" name="c_name">
                                                <option disabled>Select</option>
                                                <option value="1" selected>Category 1</option>
                                                <option value="2">Category 2</option>
                                                <option value="3">Category 3</option>
                                                <option value="4">Category 4</option>
                                                <option value="5">Category 5</option>
                                            </select>
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
						message: 'Image is required'
					}
				}
            }
            }
        })
     
});

</script>