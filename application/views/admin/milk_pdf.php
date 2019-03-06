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


							<div class="clearfix">
								&nbsp;
							</div>
							<hr>

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
											<?php }?>


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
