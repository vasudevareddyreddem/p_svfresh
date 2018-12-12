<!-- Footer -->
<script>
function increaseValue() {
  var value = parseInt(document.getElementById('number').value, 10);
  value = isNaN(value) ? 0 : value;
  value++;
  document.getElementById('number').value = value;
}

function decreaseValue() {
  var value = parseInt(document.getElementById('number').value, 10);
  value = isNaN(value) ? 0 : value;
  value < 1 ? value = 1 : '';
  value--;
  document.getElementById('number').value = value;
}
</script>
<footer id="footer">
     <div class="container">
            <!-- introduce-box -->
            <div id="introduce-box" class="row">
                <div class="col-md-3">
                    <div id="address-box">
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/logo.png" alt="" /></a>
                        <div id="address-list">
                            <div class="tit-name">Address:</div>
                            <div class="tit-contain">Flat No:123, ABC Apts, Your Street, Hyderabad-84</div>
                            <div class="tit-name">Phone:</div>
                            <div class="tit-contain">+00 123 456 789</div>
                            <div class="tit-name">Email:</div>
                            <div class="tit-contain">support@business.com</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="introduce-title">Company</div>
                            <ul id="introduce-company"  class="introduce-list">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Testimonials</a></li>
                                <li><a href="#">Affiliate Program</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="#">Contact Us</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-4">
                            <div class="introduce-title">My Account</div>
                            <ul id = "introduce-Account" class="introduce-list">
                                <li><a href="#">My Order</a></li>
                                <li><a href="#">My Wishlist</a></li>
                                <li><a href="#">My Credit Slip</a></li>
                                <li><a href="#">My Addresses</a></li>
                                <li><a href="#">My Personal In</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-4">
                            <div class="introduce-title">Support</div>
                            <ul id = "introduce-support"  class="introduce-list">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Testimonials</a></li>
                                <li><a href="#">Affiliate Program</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="#">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div id="contact-box">
						<form action="<?php echo base_url('home/newletterpost'); ?>" method="post">
							<div class="introduce-title">Newsletter</div>
							<div class="input-group" id="mail-box">
							  <input type="email" name="email" id="email" placeholder="Your Email Address" required>
							  <span class="input-group-btn">
								<button class="btn btn-default" type="submit">OK</button>
							  </span>
							</div><!-- /input-group -->
						</form>
                        <div class="introduce-title">Let's Socialize</div>
                        <div class="social-link">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            <a href="#"><i class="fa fa-vk"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-google-plus"></i></a>
                        </div>
                    </div>

                </div>
            </div><!-- /#introduce-box -->

        <div id="message">
        </div>
        </div>
</footer>

<a href="#" class="scroll_top" title="Scroll to Top" style="display: inline;">Scroll</a>
<script type="text/javascript" src="<?php echo base_url('assets/lib/jquery/jquery-1.11.2.min.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/lib/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/lib/select2/js/select2.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/lib/jquery.bxslider/jquery.bxslider.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/lib/owl.carousel/owl.carousel.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/lib/jquery.countdown/jquery.countdown.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/lib/jquery.elevatezoom.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/lib/jquery-ui/jquery-ui.min.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/lib/fancyBox/jquery.fancybox.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.actual.min.js'); ?>"></script>


<script type="text/javascript" src="<?php echo base_url('assets/js/theme-script.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/sweetalert.min.js'); ?>"></script>
<script type="text/javascript">
  $(document).ready(function(){
    //add to cart
    $('.addtocart').click(function(e){
      e.preventDefault();
      <?php
        if($this->session->userdata('logged_in') != TRUE){
          echo 'window.location = "'.base_url('home/login').'";';
        } else {
      ?>
      var obj = $(this);
      var user_id = $(this).data('user_id');
      var product_id = $(this).data('product_id');
      var product_img = $(this).data('product_img');
      var product_name = $(this).data('product_name');
      var net_price = $(this).data('net_price');
      var quantity = $(this).data('quantity');
      $.ajax({
        url:'<?php echo base_url('products/cart'); ?>',
        type:'POST',
        data:{'user_id':user_id,'product_id':product_id,'product_name':product_name,'product_img':product_img,'net_price':net_price,'quantity':quantity},
        dataType:'JSON',
        success:function(data){
          $('.cart_count').html(data.count);
          $('#cart_template').html(data.cart_template);
          obj.attr("disabled",true);
          obj.html("Added to cart");
          obj.off('click');
        }
      });
      <?php } ?>
    });
    //wishlist
    $('.whishlist').click(function(e){
      e.preventDefault();
      <?php
        if($this->session->userdata('logged_in') != TRUE){
          echo 'window.location = "'.base_url('home/login').'";';
        } else {
      ?>
      var obj = $(this);
      var user_id = $(this).data('user_id');
      var product_id = $(this).data('product_id');
      var product_img = $(this).data('product_img');
      var product_name = $(this).data('product_name');
      var net_price = $(this).data('net_price');
      var quantity = $(this).data('quantity');
      var discount_price = $(this).data('discount_price');
      $.ajax({
        url:'<?php echo base_url('products/Wishlist'); ?>',
        type:'POST',
        data:{'user_id':user_id,'product_id':product_id,'product_name':product_name,'product_img':product_img,'net_price':net_price,'quantity':quantity,'discount_price':discount_price},
        dataType:'JSON',
        success:function(data){
          if(data.success){
            $('#message').html('<div class="alert_msg1 animated slideInUp bg-succ">'+data.success+'<i class="fa fa-check text-success ico_bac" aria-hidden="true"></i></div>');
            obj.css('background','#57bb14');
            obj.attr('title','Added to your wishlist');
            obj.off('click');
          }else if(data.error){
            $('#message').html('<div class="alert_msg1 animated slideInUp bg-del">'+data.error+'<i class="fa fa-check text-success ico_bac" aria-hidden="true"></i></div>');
          }
        }
      });
      <?php } ?>
    });
    $('.remove_cart_item').click(function(e){
      e.preventDefault();
      var cart_id = $(this).data('cart_id');
      $.ajax({
        url:'<?php echo base_url('products/remove_cart_item'); ?>',
        type:'POST',
        data:{'cart_id':cart_id},
        dataType:'JSON',
        success:function(data){
          $('.cart_count').html(data.count);
          $('#cart_template').html(data.cart_template);
        }
      });
    });
  });
</script>
