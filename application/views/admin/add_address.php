

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
                                            <select  id="mobile" class="form-control" name="mobile">
                                                <option disabled selected>Select</option>
                                                <?php foreach($phone_list as $lis){?>
                                                    <option value="<?php echo $lis->phone_number;?>">
                                                        <?php echo $lis->phone_number;?></option>
                                                <?php }?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Apartments</label>
                                            <select  id="aname" class="form-control" name="aname" onchange="get_blocks(this.value)">
                                                <option disabled selected>Select</option>
                                                <?php foreach($ap_list as $lis){?>
                                                    <option value="<?php echo base64_encode($lis->apartment_id);?>">
                                                        <?php echo $lis->apartment_name;?></option>
                                                <?php }?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Blocks</label>
                                            <select id="bname" class="form-control" name="bname">
                                                <option disabled selected>Select</option>


                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Flat Address</label>
                                            <input id="flat" type="text" class="form-control" name="flat">
                                        </div>
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input id="fname" type="text" class="form-control" name="fname">
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input id="lname" type="text" class="form-control" name="lname">
                                        </div>
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input id="email" type="text" class="form-control" name="email">
                                        </div>
                                        <div class="form-group">
                                            <label>Mobile Number</label>
                                            <input id="mob" type="text" class="form-control" name="mob">
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
                mobile: {
                    validators: {
                        notEmpty: {
                            message: 'Phone Number is required'
                        }

                    }
                },
                aname: {
                    validators: {
                        notEmpty: {
                            message: 'Apartment Name is required'
                        }


                    }
                },
                bname: {
                    validators: {
                        notEmpty: {
                            message: 'Block Name is required'
                        }


                    }
                },

                flat: {
                    validators: {
                        notEmpty: {
                            message: 'Flat Name is required'
                        }


                    }
                },
                mob: {
                    validators: {
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'The username can only have numbers'
                        },
                        stringLength: {
                            min: 10,
                            max: 10,
                            message: 'Mobile Number Must  be Ten digit Number'
                        }


                    }
                }

            }
        })

    });

</script>
<script>
    function get_blocks(value){
        $('#bname').empty();
        sel='<option value="">select</option>';
        $('#bname').append(sel);

        $.ajax({
            type: "GET",
            url: '<?php echo base_url('user/get_blocks_by_apt/'); ?>'+value,
            data: '',
            dataType: "json",

            success: function (result) {


                if(result.status==1){
                    $.each(result.block_list, function(i, block) {
                        temp='<option value="'+block.block_id+'">'+block.block_name+'</option>';

                        $('#bname').append(temp);


                    });
                }
                else{
                    temp='<option value="">No Blocks Available</option>';

                    $('#bname').append(temp);

                }


            }
            ,
            error: function() {
                //alert('error from server side');

            }
        });
    }


</script>
