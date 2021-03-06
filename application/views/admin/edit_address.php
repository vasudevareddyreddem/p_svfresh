

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
                            <h4>Edit Address</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mx-auto">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <form method="post" id="add_user" action="<?php echo base_url('user/save_edit_address');?>"  enctype="multipart/form-data">
                                       <input type="hidden" value="<?php echo base64_encode($address->id);?>" name="user_id" ?>
                                        <div class="form-group">
                                            <label>User Phone numbers</label>
                                            <select  id="mobile" class="form-control" name="mobile">

                                                <?php foreach($phone_list as $lis){?>
                                                    <option value="<?php echo $lis->phone_number;?>"
                      <?php if($address->phone_number==$lis->phone_number){echo "selected";}?>">
                                                        <?php echo $lis->phone_number;?></option>
                                                <?php }?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Apartments</label>
                                            <select  id="aname" class="form-control" name="aname" onchange="get_blocks(this.value)">

                                                <?php foreach($ap_list as $lis){?>
                                                    <option value="<?php echo base64_encode($lis->apartment_id);?>"
                                                    <?php if($address->appartment==$lis->apartment_id) {
                                                        echo "selected";
                                                    }?>>
                                                        <?php echo $lis->apartment_name;?></option>
                                                <?php }?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Blocks</label>
                                            <select id="bname" class="form-control" name="bname">
                                                <?php foreach($blocks as $lis){?>
                                                    <option value="<?php echo $lis->block_id;?>"
                                                        <?php if($address->block==$lis->block_id) {
                                                            echo "selected";
                                                        }?>>
                                                        <?php echo $lis->block_name;?></option>
                                                <?php }?>

                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Flat Address</label>
                                            <input id="flat" type="text" class="form-control"
                                                   value="<?php echo $address->flat_door_no; ?>" name="flat">

                                        </div>
                                        <div class="form-group">
                                            <label>User Name</label>
                                            <input id="fname" type="text" class="form-control" name="uname"
                                            value="<?php echo $address->user_name; ?>">
                                        </div>
                                       
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input id="email" type="text" class="form-control" name="email"
                                                   value="<?php echo $address->email_id; ?>">
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
                    temp='<option value="">NO Blocks Available</option>';

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
