
<div class="main-content">
    <section class="section">
        <h1 class="section-header">
            <div>Apartment</div>
        </h1>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Block</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mx-auto">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <form method="post" id="add_block" action="
									<?php  echo base_url('apartment/save_block')?>" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Apartment Names</label>
                                                <select class="form-control" name="aname">
                                                    <option disabled selected>Select</option>
                                                    <?php foreach($list as $lis){?>
                                                        <option value="<?php echo base64_encode($lis->apartment_id);?>">
                                                            <?php echo $lis->apartment_name;?></option>
                                                    <?php }?>

                                                </select>
                                            </div>
                                            <label>Block Name</label>
                                            <input id="name" type="text" class="form-control" name="bname">
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
        $('#add_block').bootstrapValidator({

            fields: {
                aname: {
                    validators: {
                        notEmpty: {
                            message: ' Apartment Name is required'
                         }

                    }
                },
                bname: {
                    validators: {
                        notEmpty: {
                            message: 'Block Name is required'
                        }

                    }
                }


            }
        })

    });

</script>
