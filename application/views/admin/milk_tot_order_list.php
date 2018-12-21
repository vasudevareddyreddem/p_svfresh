
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
                                            <th>Ordered/Delivered/Cancelled Date & Time</th>
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
											<td>
											<?php echo $order->date.'-'.$order->month.'-'.$order->year; ?>
											</td>
                                            <td><?php if($order->delivery_status==1)
												{
											if($order->delivered_time!=''){
	       $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $order->delivered_time);
											$newDateString = $myDateTime->format('d-m-Y H:i:s');echo $newDateString ;
											}

													}
											if($order->delivery_status==0)
												{	if($order->cancelled_time!=''){
	       $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $order->cancelled_time);
											$newDateString = $myDateTime->format('d-m-Y H:i:s');echo $newDateString ;
											}

													}
											if($order->delivery_status==2)
												{
													if($order->created_date!=''){
	       $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $order->created_date);
											$newDateString = $myDateTime->format('d-m-Y H:i:s');echo $newDateString ;
											}

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
<script>
// $(document).ready(function() {
//         $('#bootstrap-data-table').DataTable({
//             "order": [
//                 [6, "desc"]
//             ]
//         });
//     });
	</script>
  <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
	<script type="text/javascript">
  $(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: true,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );

    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );
</script>
