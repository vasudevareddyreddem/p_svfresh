

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
                            <h4>Add Address</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mx-auto">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <form method="post" id="add_user" action="<?php echo base_url('user/save_address');?>"  enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>User Phone numbers</label>
                                            <select class="form-control" name="aname">
                                                <option disabled selected>Select</option>
                                                <?php foreach($phone_list as $lis){?>
                                                    <option value="<?php echo $lis->phone_number;?>">
                                                        <?php echo $lis->phone_number;?></option>
                                                <?php }?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Apartments</label>
                                            <select class="form-control" name="aname">
                                                <option disabled selected>Select</option>
                                                <?php foreach($list as $lis){?>
                                                    <option value="<?php echo base64_encode($lis->apartment_id);?>">
                                                        <?php echo $lis->apartment_name;?></option>
                                                <?php }?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Blocks</label>
                                            <select class="form-control" name="aname">
                                                <option disabled selected>Select</option>
                                                <?php foreach($list as $lis){?>
                                                    <option value="<?php echo base64_encode($lis->apartment_id);?>">
                                                        <?php echo $lis->apartment_name;?></option>
                                                <?php }?>

                                            </select>
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
                        },
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'The username can only have numbers'
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
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'Password must be more than 6 and less than 30 characters long'
                        }

                    }
                }

            }
        })

    });

</script>
