
<div class="main-content">
    <section class="section">
        <h1 class="section-header">
            <div>Milk Orders</div>
        </h1>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Boys Block List</h4>
                        </div>
                        <div class="card-body">
                                <form  id="add_apartment" class="" action="<?php echo base_url('milkorder/boys_list'); ?>" method="post">
                            <div class="row">
                                    <div class="col-md-3">
                                        <select class="form-control" name="apartment" id="apartment" data-block="<?php if (isset($filter) && ($filter['block'])) { echo $filter['block']; } else { echo ''; } ?>">
                                            <option value="">--Apartment--</option>
                                            <?php if(count($apartment) > 0){ ?>
                                                <?php foreach ($apartment as $a) { ?>
                                                    <option value="<?php echo $a->apartment_id; ?>" <?php if (isset($filter) && ($filter['apartment'] == $a->apartment_id)) { echo 'selected'; } else { echo ''; } ?>><?php echo $a->apartment_name; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-control" name="block" id="block">
                                            <option value="">--First select apartment--</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="date" class="form-control" id="datepicker" readonly value="<?php if (isset($filter) && ($filter['date'] != '' )) { echo $filter['date']; } else { echo ""; } ?>" placeholder="Pick a delivery date">
                                    </div>
                                    <!-- <div class="col-md-3">
                                        <input type="text" name="phonenum" class="form-control" id="phonenum"  value="<?php if (isset($filter) && ($filter['phonenum'] != '' )) { echo $filter['phonenum']; } else { echo ""; } ?>" placeholder="Enter Phone Number">
                                    </div> -->
                                    <div class="col-md-3">
                                        <button type="submit" name="button" class="btn btn-primary">Filter</button>

                                    </div>
                            </div>
                            </form>
                            <div class="clearfix">
                                &nbsp;
                            </div>

                            <div class="table-responsive">
                                <table id="example" class="table table-striped">
                                    <thead>
                                        <tr>

											<th>Apartment</th>
											<th>Block</th>
											<th>Flat/Door number</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            		<th>Delivery Date</th>
                                            <th>Apartments</th>
                                            <th>Blocks</th>
                                            <th>products</th>

                                            <th>packets</th>


                                        </tr>
                                    </thead>
                                    <tbody>
									<?php if($pending_status==1){
                    $cnt=1;
										foreach($pending_list as $order){?>
                                        <tr>
                                            <td><?php echo $order->apartment_name; ?></td>
											 <td><?php echo $order->block_name; ?></td>
											  <td><?php echo $order->flat_door_no; ?></td>
                                            <td><?php echo $order->product_name; ?>
                                            <br>Quantity:<?php echo $order->o_quantity; ?></td>
                                            <td><?php echo $order->quantity; ?> </td>
                                            <td>
                      											<?php echo $order->date.'-'.$order->month.'-'.$order->year; ?>
                      											</td>
                                            <?php if($cnt<=$product_count) { $index=$cnt-1; ?>
                                            <td><?php echo $block_products[$index]['apartment_name']; ?></td>
                       <td><?php echo $block_products[$index]['block_name']; ?></td>
                        <td><?php echo $block_products[$index]['product_name']; ?></td>
                                            <td><?php echo $block_products[$index]['packets']; ?></td>
                                          <?php }else{?>

                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                          <?php }?>


                                        </tr>
										<?php $cnt++;}}?>


                                    </tbody>
                                </table>
                            </div>

                </div>
            </div>
        </div>
    </section>
</div>
<!-- <script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
} );
</script> -->

    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/dataTables.buttons.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/buttons.bootstrap4.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jszip.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/buttons.html5.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-datepicker.min.js') ?>"></script>

    <script type="text/javascript">
    $(document).ready(function(){
        var table = $('#example').DataTable({

            lengthChange: true,
            searching: false,
            buttons: ['excel']
        });
        table.column(8).data().unique();
        table.buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );

        $('#apartment').on('change',function(){
            var apartment_id = $(this).val();
            if (apartment_id) {
                $('#block').html('<option value="">loading....</option>');
                var block = $(this).data('block');
                $.ajax({
                    url:'<?php echo base_url('milkorder/get_blocks_by_apartment_id'); ?>',
                    type:'POST',
                    data:{'apartment_id':apartment_id,'block':block},
                    success:function(data){
                        $('#block').html(data);
                    }
                });
            }
        }).trigger('change');

        $('#datepicker').datepicker({
            format: 'd/m/yyyy'
        });
    });
</script>
<!-- <script type="text/javascript">
    $(document).ready(function() {
        $('#add_apartment').bootstrapValidator({

            fields: {
                apartment: {
                    validators: {
                        notEmpty: {
                            message: 'apartment is required'
                        },

                    }
                },
                block: {
                    validators: {
                        notEmpty: {
                            message: 'block is required'
                        },

                    }
                },





            }
        })

    });

</script> -->
