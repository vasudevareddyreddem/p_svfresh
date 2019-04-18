
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
                            <h4>Delivered Order List</h4>
                        </div>
                        <div class="card-body">
                             <form class="" action="<?php echo base_url('milkorder/delivered_order_list'); ?>" method="post">
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
										<select class="form-control" name="block" id="block"  data-block="<?php if (isset($filter) && ($filter['floor'])) { echo $filter['floor']; } else { echo ''; } ?>">
											<option value="">--First select apartment--</option>
										</select>
									</div>
									<div class="col-md-3">
										<select class="form-control" name="floor" id="floor" data-block="<?php if (isset($filter) && ($filter['floor'])) { echo $filter['floor']; } else { echo ''; } ?>">
											<option value="">--First select Floor--</option>
											<?php if(count($floor_detail) > 0){ ?>
												<?php foreach ($floor_detail as $a) { ?>
													<option value="<?php echo $a->flat_door_no; ?>" <?php if (isset($filter) && ($filter['floor'] == $a->flat_door_no)) { echo 'selected'; } else { echo ''; } ?>><?php echo $a->flat_door_no; ?></option>
												<?php } ?>
											<?php } ?>
										</select>
									</div>
                                    <div class="col-md-3">
                                        <input type="text" name="phonenum" class="form-control" id="phonenum"  value="<?php if (isset($filter) && ($filter['phonenum'] != '' )) { echo $filter['phonenum']; } else { echo ""; } ?>" placeholder="Enter Phone Number">
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" name="button" class="btn btn-primary">Filter</button>
                                        <?php if (isset($filter) && ($filter['apartment'] != '' || $filter['block'] != '' || $filter['date'] != '' )) { ?>
                                            <a href="<?php echo base_url('milkorder/milk_delivered_order_list'); ?>" class="btn btn-warning">clear</a>
                                        <?php } ?>
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
                                            <th>Price</th>
                                            <th>Customer Name</th>
                                            <th>Mobile Number</th>

                                            <th>Payment Type</th>
                                            <th>Status</th>
											<th>Delivery Date</th>
                                            <th>Delivered Date & Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php if($delivered_status==1){
										foreach($delivered_list as $order){?>
                                        <tr>
                                            <td><?php echo $order->apartment_name; ?></td>
											 <td><?php echo $order->block_name; ?></td>
											  <td><?php echo $order->flat_door_no; ?></td>
                                            <td><?php echo $order->product_nick_name; ?>
                                            <br>Quantity:<?php echo $order->o_quantity; ?></td>
                                            <td><?php echo $order->quantity; ?> </td>
                                            <td><?php echo $order->price; ?></td>
                                            <td><?php echo $order->email_id; ?></td>
                                            <td><?php echo $order->phone_number; ?></td>

                                            <td><?php if($order->payment_type==1){
												echo 'online payment';
											}
											if($order->payment_type==2){
												echo'Cash On Delivery';
											}
											if($order->payment_type==3){
												echo 'Swiping';
											}?></td>
                                             <td>
									<div class="badge badge-info" >

											 <?php echo'Delivered';?>
											 </div>

                                            </td>
											<td>
											<?php echo $order->date.'-'.$order->month.'-'.$order->year; ?>
											</td>

                                            <td><?php
											if($order->delivered_time!=''){

	       $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $order->delivered_time);
											$newDateString = $myDateTime->format('d-m-Y H:i:s');
											echo $newDateString ;
											}


											?></td>
                                        </tr>
										<?php }}?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



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
		$('#block').on('change',function(){
			var b_id = $(this).val();
			if (b_id) {
				$('#floor').html('<option value="">loading....</option>');
				var floor = $(this).data('block');
				$.ajax({
					url:'<?php echo base_url('milkorder/get_floor_by_block_id'); ?>',
					type:'POST',
					data:{'block_id':b_id,'block':floor},
					success:function(data){
						$('#floor').html(data);
					}
				});
			}
		}).trigger('change');

        $('#datepicker').datepicker({
            format: 'd/m/yyyy'
        });
    });
</script>
