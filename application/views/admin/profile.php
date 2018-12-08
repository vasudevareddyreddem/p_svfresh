
<div class="main-content">
    <section class="section">
        <h1 class="section-header">
            <div>Profile</div>
        </h1>
        <div class="section-body">
            <div class="row">

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>My Profile</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <img class="mr-3 rounded-circle float-right" width="150" src="<?php if($admin['profile_pic']==''){echo base_url('assets/uploads/profile_pics/').'profilepic.png';}
									else{echo base_url('assets/uploads/profile_pics/').$admin['profile_pic'];}
									?>" alt="avatar">
                                </div>
                                <div class="col-md-7">
                                    <div class="mb-2">
                                        <b class="mr-1">Name</b> : <span class="ml-1"><?php echo  $admin['f_name']; ?></span>
                                    </div>
                                    <div class="mb-2">
                                        <b class="mr-1">Email</b> : <span class="ml-1">
										<?php echo  $admin['login_email'];?></span>
                                    </div>
                                    <div class="mb-2">
                                        <b class="mr-1">Phone Number</b> : <span class="ml-1"><?php echo  $admin['phone_number'];?></span>
                                    </div>
                                    

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Profile</h4>
                        </div>
                        <div class="card-body">
                            <form id="edit_profile" method="post" action="<?php echo base_url('profile/save_profile'); ?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" id="name" name="name" value="<?php echo  $admin['f_name']; ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" id="email" name="email" value="<?php echo  $admin['login_email']; ?>" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" id="mobile" name="mobile" value="<?php echo  $admin['phone_number']; ?>" class="form-control">
                                </div>
                              
                                <div class="form-group">
                                    <label class="form-control-label">Profile Pic</label>
                                    <input type="file" id="image" name="image" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>



<script type="text/javascript">
$(document).ready(function() {
    $('#edit_profile').bootstrapValidator({
        
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
            email: {
               validators: {
					notEmpty: {
						message: 'Email is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
					message: 'Please enter a valid email address. For example johndoe@domain.com.'
					}
				}
            },
            mobile: {
                validators: {
					notEmpty: {
						message: 'Mobile Number is required'
					},
					regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message:'Mobile Number must be 10 to 14 digits'
					}
				
				}
            },
            gender: {
                validators: {
					notEmpty: {
						message: 'Gender is required'
					}
				}
            },
            city: {
                validators: {
					notEmpty: {
						message: 'City is required'
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
            }
            }
        })
     
});

</script>
