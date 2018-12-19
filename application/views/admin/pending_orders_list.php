

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
                            <h4>Pending Order List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Order Id</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Customer Name</th>
                                            <th>Mobile Number</th>
                                            <th>Address</th>
                                            <th>Payment Type</th>
                                            <th>Status</th>
											
                                            <th>Ordered Date&Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($pending_status==1){
										foreach($pending_list as $order){?>
                                        <tr>
                                            <td><?php echo $order->order_number; ?></td>
                                            <td><?php echo $order->product_name; ?></td>
                                            <td><?php echo $order->quantity; ?> </td>
                                            <td><?php echo $order->net_price; ?></td>
                                            <td><?php echo $order->first_name; ?></td>
                                            <td><?php echo $order->phone_number; ?></td>
                                            <td><span><?php echo $order->address; ?></span>
											<span><?php echo $order->city; ?></span>
											<span><?php echo $order->state; ?></span>
											<span><?php echo $order->zip; ?></span>
											<span><?php echo $order->country; ?></span></td>
                                            <td><?php if($order->payment_type==1){
												echo 'Online Payment';
											}
											if($order->payment_type==2){
												echo'Cash on Delivery';
											}
											if($order->payment_type==3){
												echo'Swiping';
											}
											?></td>
                                            <td>
									<div class="badge badge-info" >
											 
											 <?php echo'Pending';?>
											 </div>
                                                <div class="badge badge-info" >
											 <a 
							href="<?php echo base_url('orders/deliver_order/').base64_encode($order->order_id) ;?>" class="btn btn-danger btn-action" ><i >
											 <?php echo'Delivered';?></i></a>
											 </div>
											 
											 <div class="badge badge-info" >
								<a href="<?php echo base_url('orders/cancel_order/').base64_encode($order->order_id);?>" class="btn btn-danger btn-action" ><i >
											 <?php echo'cancelled';?></i></a>
											 </div>
                                            </td>
                                            	<td><?php 
												if($order->created_date!=''){
	       $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $order->created_date);
           $newDateString = $myDateTime->format('d-m-Y H:i:s');echo $newDateString ;
												}		   ?></td>
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


