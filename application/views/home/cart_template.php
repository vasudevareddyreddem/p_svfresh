<?php if(count($cart) > 0){ ?>
  <?php $cnt=1; foreach($cart as $c){ ?>
    <li class="product-info" id="item_ids<?php echo $c->id; ?>">
        <div class="p-left">
            <a href="#" class="remove_link remove_cart_item" data-cart_id="<?php echo $c->id; ?>"></a>
            <a href="<?php echo base_url('product/'.$c->product_id); ?>">
            <img class="img-responsive" src="<?php echo base_url('assets/uploads/product_pics/'.$c->product_img);?>" alt="item 1">
            </a>
        </div>
        <div class="p-right">
            <p class="p-name"><?php echo $c->product_name; ?></p>
            <p>Quantity : <?php echo $c->quantity; ?></p>
            <p class="p-rice">₹ <?php echo ($c->quantity * $c->net_price); ?> </p>
        </div>
    </li>
  <?php $cnt++;} ?>
<?php } else { ?>
<li class="product-info">
  <div>No product add to cart</div>
</li>
<?php } ?>
<script>
function removecart_item(c_id){
	if(c_id!=''){
		 jQuery.ajax({
					url: "<?php echo site_url('home/remove_cart_item');?>",
					data: {
						cart_id: c_id,
					},
					dataType: 'json',
					type: 'POST',
					success: function (data) {
					if(data.msg==1){
						$('#cart_count').empty();
						$('#cart_count1').empty();
						$('#cart_count2').empty();
						$('#cart_count').append(data.qty_count);
						$('#cart_count1').append(data.qty_count);
						$('#cart_count2').append(data.qty_count);
						$('#sucessmsg').html('<div class="alert_msg1 animated slideInUp bg-succ"> Item successfully removed to cart <i class="fa fa-check text-success ico_bac" aria-hidden="true"></i> </div>');

						jQuery('#item_ids'+c_id).hide();
					}
				 }
				});
			
}
}
</script>

