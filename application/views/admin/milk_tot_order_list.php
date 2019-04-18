<style>
.dt-buttons{
	top:-55px;
	left:180px;
	margin-bottom:-25px;
}
</style>

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
							<h4>Total Orders List</h4>
						</div>
						<div class="card-body">
							<form class="" action="<?php echo base_url('milkorder/total_order_list'); ?>" method="post">
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
									</div>
									<br>
									<div class="row">
									<div class="col-md-3">
										<button type="submit" name="button" class="btn btn-primary">Filter</button>
										<?php if (isset($filter) && ($filter['apartment'] != '' || $filter['block'] != '' || $filter['date'] != '' )) { ?>
											<a href="<?php echo base_url('milkorder/total_order_list'); ?>" class="btn btn-warning">clear</a>
										<?php } ?>
									</div>
									</div>

							</form>
							<!--<div>
							<label>Enter Phone Number</label><input type='text' id='phn_num'>
							<button>Enter</button>
							</div> -->
							<div class="clearfix">
								&nbsp;
							</div>
							<hr>
							<form  id='pdf' method='post' target="_blank" action="<?php echo base_url('milkorder/list_pdf'); ?>">
							<div class="row">

									<div class="col-md-3">
										<select class="form-control" name="month" id="">
											<option value="">Month</option>
											<option value="1">January</option>
											<option value="2">February</option>
											<option value="3">March</option>
											<option value="4">April</option>
											<option value="5">May</option>
											<option value="6">June</option>
											<option value="7">July</option>
											<option value="8">August</option>
											<option value="9">September</option>
											<option value="10">October</option>
											<option value="11">November</option>
											<option value="12">December</option>
										</select>
									</div>
									<div class="col-md-3">
										<select class="form-control" name="year" id="">
											<?php $year=date('Y');?>
											<option value="<?php echo $year-1;?>"><?php echo $year-1;?></option>
											<option value="<?php echo $year;?>"><?php echo $year;?></option>
											<option value="<?php echo $year+1;?>"><?php echo $year+1;?></option>
											</select>
									</div>
									<div class="col-md-3">
										<input type="text" name="phonenum" class="form-control" id=""   placeholder="Enter Phone Number">
									</div>
									<div class="col-md-3">
										<button type="submit" class="btn btn-primary ">Export</button>
									</div>

							</div>
							</form>
							<hr>
							<div class="clearfix">&nbsp;</div>
							<div class="table-responsive">
								<table id="example" class="table table-striped">
									<thead>
										<tr>

											<th>Apartment</th>
											<th>Block</th>
											<th>Flat/Door number</th>
											<th>Product Name</th>
											<th>Quantity</th>
											<th>Date</th>
											<th>Mobile Number</th>
											<th>Payment Type</th>
											<th>Payment Status</th>
											<th>Payment screenshot</th>
											<th>Payment Date & Time</th>
											<th>Status</th>
											<th>Payment Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if($tot_status==1){
											foreach($tot_list as $order){?>
												<tr>

													<td><?php echo $order->apartment_name; ?></td>
													<td><?php echo $order->block_name; ?></td>
													<td><?php echo $order->flat_door_no; ?></td>
													<td><?php echo $order->product_nick_name; ?>
													<br>Quantity:<?php echo $order->o_quantity; ?></td>
													 <td><?php 
														$o_date=$order->year.'-'.$order->month.'-'.$order->date;
														$n_date=date('Y-m-d');
														$date1 = new DateTime($n_date);
														$date2 = new DateTime($o_date);
														if($date1 > $date2) { ?>
														 <?php echo $order->quantity; ?>
														<?php }else{ ?>
														<input name="order_qty" id="order_qty" onkeyup="update_qty(this.value,'<?php echo $order->calender_id; ?>');" value="<?php echo $order->quantity; ?>">
														<?php } ?>
													 </td>
													<td><?php echo $order->year.'-'.$order->month.'-'.$order->date; ?></td>
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
													<td><?php if($order->payment_status==1){ echo 'Paid'; }else{ echo "Unpaid"; } ?></td>
													<td>
													<?php if($order->payment_img!=''){?>
														<a target="_blank" href="<?php echo base_url('assets/uploads/screenshot/'.$order->payment_img); ?>"><img src="<?php echo base_url('assets/uploads/screenshot/'.$order->payment_img); ?>" width="50px;" height="50px;"></a>
													<?php } ?>
													</td>
													<td><?php echo $order->payment_date; ?></td>
													<td>
														<div class="badge badge-info">
															<?php if($order->delivery_status==1)
															{echo 'Delivered';}
															if($order->delivery_status==0)
															{echo 'Cancelled';}
															if($order->delivery_status==2)
															{echo 'Pending';}
															?></div>
														</td>
														<td>
														<?php if($order->order_id!=''){ ?>
															<a href="<?php echo base_url('Milkorder/paymetn_accept_order/'.base64_encode($order->order_id)); ?>">Accept</a> | <a href="<?php echo base_url('Milkorder/paymetn_reject_order/'.base64_encode($order->order_id)); ?>">Reject</a>
														<?php } ?>
														</td>

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
	<script>
	$(document).ready(function() {
		$('#bootstrap-data-table').DataTable({
			"order": [
				[5, "desc"]
			]
		});
	});
	function update_qty(qty,id){
	 jQuery.ajax({
			url: "<?php echo base_url('order/update_qty');?>",
			data: {
				c_id: id,
				c_qty: qty,
			},
			dataType: 'json',
			type: 'POST',
			success: function (data) {
					if(data.msg==1){
						 alert('Quantity Successfully updated');
					}else{
					    alert('Techincal proble occured. Please try again');
					}
			}
   	});
}
	</script>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#pdf').bootstrapValidator({

            fields: {
                year: {
                    validators: {
                        notEmpty: {
                            message: 'Year is required'
                        },

                    }
                },
                month: {
                    validators: {
											notEmpty: {
													message: 'Month is required'
											},


                    }
                },
								phonenum: {
										validators: {
												notEmpty: {
														message: 'Phone Number required'
												},

										}
								},



            }
        })

    });

</script>
