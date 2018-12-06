<?php if(count($cart) > 0){ ?>
  <?php foreach($cart as $c){ ?>
    <li class="product-info">
        <div class="p-left">
            <a href="#" class="remove_link"></a>
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
  <?php } ?>
<?php } else { ?>
<li class="product-info">
  <div>No product add to cart</div>
</li>
<?php } ?>
