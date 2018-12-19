
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
                            <h4>Cancelled Order List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped">
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
											<th>Delivery Date</th> 
                                            <th>Cancelled Date & Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php if($cancel_status==1){
										foreach($cancel_list as $order){?>
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
									<div class="badge badge-info" >
											 
											 <?php echo'Cancelled';?>
											 </div>
                                                <div class="badge badge-info" >
											 <a 
							href="<?php echo base_url('milkorder/pending_order/').base64_encode($order->calender_id) ;?>" class="btn btn-danger btn-action" ><i >
											 <?php echo'Pending';?></i></a>
											 </div>
											 
											 <div class="badge badge-info" >
								<a href="<?php echo base_url('milkorder/deliver_order/').base64_encode($order->calender_id);?>" class="btn btn-danger btn-action" ><i >
											 <?php echo'Delivered';?></i></a>
											 </div>
                                            </td>
											<td>
											<?php echo $order->date.'-'.$order->month.'-'.$order->year; ?>
											</td>
                                            
											
                                            <td><?php 
											if($order->cancelled_time!=''){
												
	       $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $order->cancelled_time);
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
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>


