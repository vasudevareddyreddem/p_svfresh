<!DOCTYPE html>
<html>
<head>
  <?php include("header.php"); ?>
  <div class="">
    <div class="container" >
      <div class="page-content checkout-page">
        <h3 class="checkout-sep">Orders List</h3>
        <div class="col-md-3 ">
          <div class="panel panel-default">
            <div class="panel-body text-center">
              <div class="">
                <img src="<?php echo base_url('assets/data/users.png'); ?>" alt="user" class="avatar thumbanail">
              </div>
              <h4 class="pd-tb10"><?php if($this->session->userdata('logged_in') == TRUE){ echo $this->session->userdata('phone_number'); } ?></h4>
            </div>
            <ul class="list-group">
              <a href="<?php echo base_url('home/profile'); ?>"><li class="list-group-item">My profile</li></a>
              <a href="<?php echo base_url('order'); ?>"><li class="list-group-item">My orders</li></a>
              <a href="<?php echo base_url('order/milk_orders'); ?>"><li class="list-group-item">My orders</li></a>
              <a href="<?php echo base_url('wishlist'); ?>"><li class="list-group-item">Wishlist</li></a>
              <a href="<?php echo base_url('checkout'); ?>"><li class="list-group-item">Checkout</li></a>
              <a href="<?php echo base_url('home/cpassword'); ?>"><li class="list-group-item">Change password</li></a>
              <a href="<?php echo base_url('home/logout'); ?>"><li class="list-group-item">logout</li></a>
            </ul>
          </div>
        </div>
        <div class="col-md-9 ">
          <div class="panel panel-default ">
            <div class="panel-heading bg-white">
              <span class=" border-radius-none"><strong class="h4">My Wishlist (<span class="wishlist_count"><?php if(count($wishlist) > 0){echo count($wishlist);}else{ echo '0'; } ?></span>)</strong></span>
            </div>
            <?php if (count($wishlist) > 0) { ?>
              <?php foreach ($wishlist as $w) { ?>
                <div class="panel-body" style="border-bottom:1px solid #ddd;">
                  <div class="row">
                    <div class="col-md-2">
                      <a href="<?php echo base_url('product/'.$w->product_id); ?>">
                        <?php if (!empty($w->product_img) && file_exists('assets/uploads/product_pics/'.$w->product_img)) { ?>
                          <img style="width:auto;height:80px;" src="<?php echo base_url('assets/uploads/product_pics/'.$w->product_img); ?>" alt="Product">
                        <?php } else { ?>
                          <img style="width:auto;height:80px;" src="<?php echo base_url('assets/uploads/product_pics/no-product.png'); ?>" alt="Product">
                        <?php } ?>
                      </a>
                    </div>
                    <div class="col-md-9">
                      <h3 class="text-success"><?php echo $w->product_name; ?></h3>
                      <div class="h4">₹ <?php echo $w->net_price; ?> &nbsp; <span  style="text-decoration: line-through;color:#aaa">₹ <?php echo $w->discount_price; ?></span></div>
                    </div>
                    <div class="col-md-1">
                      <a href="#" class="btn-add-cart addtocart_w" data-id="<?php echo $w->id; ?>" data-user_id="<?php echo $this->session->userdata('id'); ?>" data-product_id="<?php echo $w->product_id; ?>" data-product_img="<?php echo $w->product_img; ?>" data-product_name="<?php echo $w->product_name; ?>" data-net_price="<?php echo $w->net_price; ?>" data-quantity="1">Add to cart</a>
                     <a href="<?php echo base_url('wishlist/removewishlist/'.base64_encode($w->id)); ?>" class="h2" ><i class="fa fa-trash-o " aria-hidden="true"></i></a>
                    </div>
                  </div>
                </div>
              <?php } ?>
            <?php }else{ ?>
              <div class="panel-body" style="border-bottom:1px solid #ddd;">
                <div class="row">
                  <div class="col-md-12">
                    <h2>No items found in wishlist</h2>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include("footer.php"); ?>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.addtocart_w').click(function(e){
        e.preventDefault();
        var obj = $(this);
        var user_id = $(this).data('user_id');
        var product_id = $(this).data('product_id');
        var product_img = $(this).data('product_img');
        var product_name = $(this).data('product_name');
        var net_price = $(this).data('net_price');
        var quantity = $(this).data('quantity');
        var id = $(this).data('id');
        $.ajax({
          url:'<?php echo base_url('Wishlist/addtocart'); ?>',
          type:'POST',
          data:{'id':id,'user_id':user_id,'product_id':product_id,'product_name':product_name,'product_img':product_img,'net_price':net_price,'quantity':quantity},
          dataType:'JSON',
          success:function(data){
            $('.cart_count').html(data.count);
            $('.wishlist_count').html(data.count_w);
            $('#cart_template').html(data.cart_template);
            obj.attr("disabled",true);
            obj.html("Added to cart");
            obj.parent().parent().parent().remove();
          }
        });
      });
    });
  </script>
</body>
</html>
