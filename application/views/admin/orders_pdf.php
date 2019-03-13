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
	    <th>Date:<?php echo isset($post_data['o_date'])?$post_data['o_date']:'';?></th>
	    <th>Type:<?php if($post_data['type']==1){ echo "Delivered";}else{ echo "Delivery"; } ?></th>
	  </tr>

	</table>
<table id="customers">
  <tr>
	
		<th>Customer Name</th>
		<th>Mobile Number</th>
		<th>Address</th>
		<th>Product Name</th>
		<th>Quantity</th>
		<th>Price</th>
		<th>Total</th>
		<th>Payment Type</th>
  </tr>

		<?php if(isset($orders_list) && count($orders_list)>0){ ?>
			<?php $total_amt='';foreach($orders_list as $order){?>
				<tr>

					
					<td><?php echo $order['first_name'].' '.$order['last_name']; ?></td>
					<td><?php echo $order['phone_number']; ?></td>
					<td><?php echo $order['flat_door_no'].' ,'.$order['block_name'].', '.$order['apartment_name']; ?></td>
					<td><?php echo $order['product_name']; ?> : <?php echo $order['product_nick_name']; ?></td>
					<td><?php echo $order['quantity']; ?></td>
					<td><?php echo $order['net_price']; ?></td>
					<td><?php echo ($order['quantity']*$order['net_price']); ?></td>
				
					
					<td><?php if($order['payment_type']==1){ echo 'Online'; }else if($order['payment_type']==2){ echo "Cash On Delivery"; }else if($order['payment_type']==3){ echo "Swipe on Delivery"; } ?></td>
					
					<?php $total_amt +=($order['quantity']*$order['net_price']);}?>
  </tr>
  
  <?php }else{ ?>
  <tr ><td colspan="7">No data<td></tr>
  <?php } ?>
  
</table>
<table style="width:100% " id="customers">
	  <tr>
	    <td>Total Amount:<?php echo isset($total_amt)?$total_amt:'';?></td>
	   </tr>

	</table>
  

