
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
                            <div class="table-responsive">
                                <table id="bootstrap-data-table" class="table table-striped">
                                    <thead>
                                        <tr>
                                           
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Customer Name</th>
                                            <th>Mobile Number</th>
                                            <th>Address</th>
                                            <th>Payment Type</th>
                                            <th>Status</th>
                                            <th>Ordered Date & Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php if($tot_status==1){
										foreach($tot_list as $order){?>
                                        <tr>
                                           
                                            <td><?php echo $order->product_name; ?></td>
                                            <td><?php echo $order->quantity; ?> </td>
                                            <td><?php echo $order->price; ?></td>
                                            <td><?php echo $order->email_id; ?></td>
                                            <td><?php echo $order->phone_number; ?></td>
                                            <td><span><?php echo $order->address; ?></span>
											<span><?php echo $order->city; ?></span>
											<span><?php echo $order->state; ?></span>
											<span><?php echo $order->zip; ?></span>
											<span><?php echo $order->country; ?></span>
											<span><?php echo $order->telephone; ?></span></td>
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
                                            <td><?php if($order->delivery_status==1)
												{echo $order->delivered_time;}
											if($order->delivery_status==0)
												{echo $order->cancelled_time;}
											if($order->delivery_status==2)
												{echo $order->created_date;}
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

