

<div class="main-content">
    <section class="section">
        <h1 class="section-header">
            <div>Users</div>
        </h1>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit User</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mx-auto">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <form method="post" id="add_user" action="<?php echo base_url('user/save_password');?>"  enctype="multipart/form-data">
                                        <input type="hidden" value="<?php echo base64_encode($uid); ?>" name="uid"?>

                                        <div class="form-group">
                                            <label>Old Password</label>
                                            <input id="opassword" type="text" class="form-control" name="opassword">
                                        </div>
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input id="npassword" type="text" class="form-control" name="npassword">
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
        $('#add_user').bootstrapValidator({

            fields: {
                opassword: {
                    validators: {
                        notEmpty: {
                            message: 'Old password is required'
                        }

                    }
                },
                npassword: {
                    validators: {
                        notEmpty: {
                            message: 'New Password is required'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'Password must be more than 6 and less than 30 characters long'
                        }

                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'Email is required'
                        }

                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'Password is required'
                        }

                    }
                }

            }
        })

    });

</script>
