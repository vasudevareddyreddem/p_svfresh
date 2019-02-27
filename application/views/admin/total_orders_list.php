
<div class="main-content">
    <section class="section">
        <h1 class="section-header">
            <div>Orders</div>
        </h1>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Total Orders List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Order Id</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Single Product Price</th>
                                            <th>Total Price</th>
                                            <th>Customer Name</th>
                                            <th>Mobile Number</th>
                                            <th>Address</th>
                                            <th>Payment Type</th>
                                            <th>Status</th>
											<th>Ordered Date & Time</th>
                                            <th>Ordered/Delivered/Cancelled Date & Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php if($tot_status==1){
										foreach($tot_list as $order){?>
                                        <tr>
                                            <td><?php echo $order->order_number; ?></td>
                                            <td><?php echo $order->product_name; ?>
                                            <br>Quantity:<?php echo $order->o_quantity; ?>
                                          </td>
                                            <td><?php echo $order->quantity; ?> </td>
                                            <td><?php echo $order->net_price; ?></td>
                                            <td><?php echo $order->quantity*$order->net_price; ?></td>
                                            <td><?php echo $order->user_name; ?></td>
                                            <td><?php echo $order->phone_number; ?></td>
                                            <td><span>Apartment Name:<?php echo $order->apartment_name; ?></span>
											<span> Block_name:<?php echo $order->block_name; ?></span>
											<span>Flat Number:<?php echo $order->flat_door_no; ?></span>
											</td>
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
                                                <div class="badge badge-info">
												<?php if($order->delivery_status==1)
												{echo 'Delivered';}
											if($order->delivery_status==0)
												{echo 'Cancelled';}
											if($order->delivery_status==2)
												{echo 'Pending';}
											?></div>
                                            </td>
											<td><?php
	       $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $order->created_date);
           $newDateString = $myDateTime->format('d-m-Y H:i:s');echo $newDateString ; ?></td>
                                           <td><?php if($order->delivery_status==1)
												{
													if($order->delivered_time!=''){
													$myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $order->delivered_time);
                         $newDateString = $myDateTime->format('d-m-Y H:i:s');echo $newDateString ;
													}
												}
											if($order->delivery_status==0)
												{
													if($order->cancelled_time!=''){
													  $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $order->cancelled_time);
           $newDateString = $myDateTime->format('d-m-Y H:i:s');echo $newDateString ;
													}

													}
											if($order->delivery_status==2)
												{
													if($order->created_date!=''){
													  $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $order->created_date);
           $newDateString = $myDateTime->format('d-m-Y H:i:s');echo $newDateString ;}

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
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
