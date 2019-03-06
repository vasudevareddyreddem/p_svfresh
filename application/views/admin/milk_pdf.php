<head>
<style>
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
</head>
<body>

	<table style="width:100%">
	  <tr>
	    <th>Year:<?php echo $det['year'];?></th>
	    <th>Month:<?php $monthNum=$det['month'];
			$dateObj   = DateTime::createFromFormat('!m', $monthNum);
         $monthName = $dateObj->format('F');
				 echo $monthName;?></th>
	    <th>phone Number:<?php echo $det['phonenum'];?> </th>
	  </tr>

	</table>
<table id="customers">
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
  </tr>
  <tr>

		<?php 	foreach($tot_list as $order){?>
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
					<?php }?>
  </tr>
</table>
<br>
Total Amount:<?php echo $amount['total'];?>
<br>
Paid Amount:<?php echo $paid['total'];?>
<br>
Unpaid Amount:<?php echo $unpaid['total'];?>
