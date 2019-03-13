

<div class="main-content">
    <section class="section">
        <h1 class="section-header">
            <div>Add Scroll Content & Payment Option  & Contact Number</div>
        </h1>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add App Scroll Content & Payment Option Enable And Disable & Contact Number</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mx-auto">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <form method="post" id="add_content" action="<?php echo base_url('admin/update_scroll_content');?>"  enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Content</label>
                                            <textarea id="s_msg" type="text" class="form-control" name="s_msg"><?php echo isset($m_details['text'])?$m_details['text']:''; ?></textarea>
                                        </div>
										<div class="form-group">
                                            <label>Payment Options (Swipe and cash Delivery)</label>
                                            <select id="p_option" type="text" class="form-control" name="p_option">
											<option value="" >Select</option>
											<option value="1" <?php if($m_details['payment_option']==1){ echo "selected"; } ?>>Enable</option>
											<option value="0" <?php if($m_details['payment_option']==0){ echo "selected"; } ?>>Disable</option>
											</select>
                                        </div>
										 <div class="form-group">
                                            <label>Customer care mobile number</label>
                                            <input id="c_mobile" type="text" class="form-control" name="c_mobile" value="<?php echo isset($m_details['cus_mobile_num'])?$m_details['cus_mobile_num']:''; ?>">
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
        $('#add_content').bootstrapValidator({

            fields: {
                s_msg: {
                    validators: {
                        notEmpty: {
                            message: 'Content is required'
                        }

                    }
                },p_option: {
                    validators: {
                        notEmpty: {
                            message: 'Option is required'
                        }

                    }
                },c_mobile: {
                    validators: {
                        notEmpty: {
                            message: 'Customer care mobile number is required'
                        }

                    }
                }

            }
        })

    });

</script>
