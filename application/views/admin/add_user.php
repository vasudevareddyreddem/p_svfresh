

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
                            <h4>Add User</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mx-auto">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <form method="post" id="add_user" action="<?php echo base_url('user/save_user');?>"  enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>User Name</label>
                                            <input id="name" type="text" class="form-control" name="uname">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input id="email" type="text" class="form-control" name="email">
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input id="phone" type="text" class="form-control" name="phone">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input id="password" type="text" class="form-control" name="password">
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
                uname: {
                    validators: {
                        notEmpty: {
                            message: 'Name is required'
                        }

                    }
                },
                phone: {
                    validators: {
                        notEmpty: {
                            message: 'Phone Number is required'
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
