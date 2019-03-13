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
<?php //echo '<pre>';print_r($tot_list);exit; ?>
<body>

	<table style="width:100%">
	  <tr>
	    <th>Apartment:<?php echo isset($tot_list[0]->apartment_name)?$tot_list[0]->apartment_name:'';?>, Block: <?php echo isset($tot_list[0]->block_name)?$tot_list[0]->block_name:''; ?>, Flat/Door number:<?php echo isset($tot_list[0]->flat_door_no)?$tot_list[0]->flat_door_no:''; ?></th>
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
	
		<th>Date</th>
		<th>Product Name</th>
		<th>Quantity</th>
		<th>Price</th>
		<th>Total</th>
		<th>Payment Status</th>
		<th>Status</th>
  </tr>
  <tr>

		<?php 	foreach($tot_list as $order){?>
				<tr>

					
					<td><?php echo $order->date; ?>-<?php echo $order->month; ?>-<?php echo $order->year; ?></td>
					<td><?php echo $order->product_nick_name; ?></td>
					<td><?php echo $order->quantity; ?> </td>
					<td><?php echo $order->net_price; ?> </td>
					<td><?php echo $order->price; ?> </td>
					
					<td><?php if($order->payment_status==1){ echo 'Paid'; }else{ echo "Unpaid"; } ?></td>
					
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
   <table style="width:100% " id="customers">
	  <tr>
	    <td>Total Amount:<?php echo $amount['total'];?></td>
	    <td>Paid Amount:<?php echo $paid['total'];?></td>
	    <td>Unpaid Amount:<?php echo $unpaid['total'];?></td>
	  </tr>
	  <?php if(isset($brands) && count($brands)>0){ ?>
	  <?php foreach($brands as $lis){ ?>
	  <tr>
	    <td>Product Type:<?php echo isset($lis['product_nick_name'])?$lis['product_nick_name']:'';?></td>
	    <td>Product Quantity:<?php echo isset($lis['qty'])?$lis['qty']:'';?></td>
	    <td>Total Price:<?php echo isset($lis['b_total'])?$lis['b_total']:'';?></td>
	  </tr>
	  <?php } ?>
	  <?php } ?>
	  <tr>
	    <td colspan="3"><b>Total Amount with Delivery charges &nbsp;: &nbsp;&nbsp;(<?php echo $amount['total'];?> + 30 ) = <?php echo ($amount['total']+30);?><b></td>
	  </tr>

	</table>

