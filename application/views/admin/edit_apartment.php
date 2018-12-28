

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
                            <h4>Edit Apartment</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mx-auto">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <form method="post" id="edit_apartment" action="<?php echo base_url('apartment/save_edit_apartment');?>"  enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Apartment Name</label>
                                            <input type="hidden" value="<?php  echo base64_encode($row->apartment_id);?>" name="ap_id" >
                                            <input id="name" type="text" class="form-control"
                                                   value="<?php echo $row->apartment_name;?>" name="apartment_name">
                                        </div>

                                        <button type="submit" class="btn btn-primary">
                                            Update
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
                apartment_name: {
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



            }
        })

    });

</script>