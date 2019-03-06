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
										<select class="form-control" name="block" id="block">
											<option value="">--First select apartment--</option>
										</select>
									</div>
									<div class="col-md-3">
										<input type="text" name="date" class="form-control" id="datepicker" readonly value="<?php if (isset($filter) && ($filter['date'] != '' )) { echo $filter['date']; } else { echo ""; } ?>" placeholder="Pick a delivery date">
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
							<form>
							<div class="row">
						
									<div class="col-md-3">
										<select class="form-control" name="block" id="">
											<option value="">Month</option>
											<option value="">Month</option>
											<option value="">Month</option>
										</select>
									</div>
									<div class="col-md-3">
										<select class="form-control" name="block" id="">
											<option value="">Year</option>
											<option value="">1</option>
											<option value="">2019</option>
										</select>
									</div>
									<div class="col-md-3">
										<input type="text" name="phonenum" class="form-control" id=""   placeholder="Enter Phone Number">
									</div>
									<div class="col-md-3">
										<button class="btn btn-primary ">Export</button>
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
													<td><?php echo $order->product_name; ?>
													<br>Quantity:<?php echo $order->o_quantity; ?></td>
													<td><?php echo $order->quantity; ?> </td>
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
				[6, "desc"]
			]
		});
	});
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

		$('#datepicker').datepicker({
			format: 'd/m/yyyy'
		});
	});
</script>
