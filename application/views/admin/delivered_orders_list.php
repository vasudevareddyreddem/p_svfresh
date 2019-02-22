

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
                            <h4>Delivered Orders List</h4>
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
                                            <th>Delivered Date & Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php if($delivered_status==1){
										foreach($delivered_list as $order){?>
                                        <tr>
                                            <td><?php echo $order->order_number; ?></td>
                                            <td><?php echo $order->product_name; ?></td>
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
												echo 'Online Payment';
											}
											if($order->payment_type==2){
												echo'Cash on Delivery';
											}
											if($order->payment_type==3){
												echo'Swiping';
											}?></td>
                                             <td>
									<div class="badge badge-info" >

											 <?php echo'Delivered';?>
											 </div>
											 <br>
                                             
                                            </td>
											<td><?php
											if($order->created_date!=''){
	       $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $order->created_date);
											$newDateString = $myDateTime->format('d-m-Y H:i:s');echo $newDateString ;} ?></td>
                                            <td><?php
											if($order->delivered_time!=''){
	       $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $order->delivered_time);
											$newDateString = $myDateTime->format('d-m-Y H:i:s');echo $newDateString ;
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
