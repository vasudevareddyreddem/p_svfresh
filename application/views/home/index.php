<!DOCTYPE html>
<html>


<head>
<?php include("header.php"); ?>


<!-- Home slideder-->
<div id="home-slider">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 ">
			<img alt="Funky roots" src="assets/data/adsv2.jpg" />

			</div>
            <div class="col-sm-6 header-top-right">
                <div class="homeslider">
                    <div class="content-slide">
                        <ul id="contenhomeslider">
                          <li><img alt="Funky roots" src="<?php echo base_url('assets/data/slide.jpg'); ?>"  /></li>
                          <li><img alt="Funky roots" src="<?php echo base_url('assets/data/slide2.jpg'); ?>"  /></li>
                          <li><img  alt="Funky roots" src="<?php echo base_url('assets/data/slide3.jpg'); ?>" /></li>
                        </ul>
                    </div>
                </div>

            </div>
			   <div class="col-sm-3 ">
			<img alt="Funky roots" src="assets/data/ads1.jpg" />

			</div>
        </div>
    </div>
</div>
<!-- END Home slideder-->
<!-- servives -->
<section class="bg-success py-3">
<div class="container ">
    <div class="row ">
		<a href="">
			<div class="col-xs-6 col-md-3 ">
				<div class="category-bg" style="margin:0 auto;" >
					<img class="img-resonsive" src="<?php echo base_url('assets/images/milk-cat-icon.png'); ?>" alt="Milk"/>
				</div>
				<div class="text-center font-cat">Milk</div>
			</div>
		</a>
		 <a href="">
		<div class="col-xs-6 col-md-3 ">
			<div class="category-bg" style="margin:0 auto;" >
				<img class="img-resonsive" src="<?php echo base_url('assets/images/grocery-cat-icon.png'); ?>" alt="Grocery"/>
			</div>
			<div class="text-center font-cat">Grocery</div>
        </div>
		</a>
		<a href="">
		<div class="col-xs-6 col-md-3 ">
			<div class="category-bg" style="margin:0 auto;" >
				<img class="img-resonsive" src="assets/images/fruits-cat-icon.png" alt="Grocery"/>
			</div>
			<div class="text-center font-cat">Fruits & Vegetables </div>
        </div>
		</a>
		<a href="">
        	<div class="col-xs-6 col-md-3 ">
			<div class="category-bg" style="margin:0 auto;" >
				<img class="img-resonsive" src="assets/images/water-cat-icon.png" alt="Grocery"/>
			</div>
			<div class="text-center font-cat">Water can</div>
        </div>
		</a>


    </div>
</div>
</section>
<!--dispalying messages-->
<?php if($this->session->flashdata('success')): ?>
<div class="alert_msg1 animated slideInUp bg-succ">
    <?php echo $this->session->flashdata('success');?> &nbsp; <i class="fa fa-check text-success ico_bac" aria-hidden="true"></i> </div>
<?php endif; ?>
<?php if($this->session->flashdata('error')): ?>
<div class="alert_msg1 animated slideInUp bg-warn">
    <?php echo $this->session->flashdata('error');?> &nbsp; <i class="fa fa-exclamation-triangle text-success ico_bac" aria-hidden="true"></i> </div>
<?php endif; ?>
<div class="content-page">
    <div class="container">


        <div class="category-featured">
            <div class="bg-white show-brand">
              <div class="container">

                  <div class="navbar-brand"><a href="#"><img alt="fashion" src="assets/data/milk.png" />Milk</a></div>


                <div class=" col-md-9" >
                  <ul class="nav navbar-nav">

                    <li><a href="#">
					<marquee id="scroll_news" >
						<div onmouseover="document.getElementById('scroll_news').stop();" onmouseout="document.getElementById('scroll_news').start();">
							<h4 class="text-success">Order Milk your Dialy or for Month ------ Contact us for any functions @ 8500xxxxxxx or 9493 xxxxxxx </h4>
						</div>
					</marquee>
					</a></li>

                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->

            </div>
            <div class="category-banner">
                <div class="col-sm-6 banner">
                    <a href="#"><img alt="ads2" class="img-responsive" src="assets/data/milkad1.png" /></a>
                </div>
                <div class="col-sm-6 banner">
                    <a href="#"><img alt="ads2" class="img-responsive" src="assets/data/milkad2.png" /></a>
                </div>
           </div>
           <div class="product-featured clearfix">
                <div class="banner-featured">
                    <div class="featured-text"><span>featured</span></div>
                    <div class="banner-img">
                        <a href="#"><img  style="height:240px;"class="img-responsive"  src="assets/data/milkcataban.jpg" /></a>
                    </div>
                </div>
                <div class="product-featured-content">
                    <div class="product-featured-list">
                        <div class="tab-container autoheight">
                            <!-- tab product -->
                            <div class="tab-panel active" id="tab-6">
                                <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                    <li>
                                        <div class="left-block">
                                            <a href="#"><img class="img-responsive" alt="product" src="assets/data/milkbrand1.png" /></a>
                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>

                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="#">Heritage Milk</a></h5>
                                            <div class="content_price">
                                                <span class="price product-price">₹ 38,95</span>
                                                <span class="price old-price"> ₹ 52,00</span>
                                            </div>
                                            <div class="product-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left-block">

                                            <a href="#"><img class="img-responsive" alt="product" src="assets/data/milkbrand2.png" /></a>

                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>

                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="#">Thirumala Milk</a></h5>
                                            <div class="content_price">
                                                <span class="price product-price">₹ 38,95</span>
                                                <span class="price old-price"> ₹ 52,00</span>
                                            </div>
                                            <div class="product-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left-block">
                                            <a href="#"><img class="img-responsive" alt="product" src="assets/data/milkbrand3.png" /></a>
                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>

                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="#">Nandini Milk</a></h5>
                                            <div class="content_price">
                                                <span class="price product-price">₹ 30,95</span>
                                                <span class="price old-price">₹ 50,00</span>
                                            </div>
                                            <div class="product-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left-block">
                                            <a href="#"><img class="img-responsive" alt="product" src="assets/data/milkbrand4.png" /></a>
                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>

                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="#">Amul Milk</a></h5>
                                            <div class="content_price">
                                                <span class="price product-price">₹ 28,95</span>
                                                <span class="price old-price">₹ 42,00</span>
                                            </div>
                                            <div class="product-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left-block">
                                            <a href="#"><img class="img-responsive" alt="product" src="assets/data/milkbrand5.png" /></a>
                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>

                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="#">Dodla milk</a></h5>
                                            <div class="content_price">
                                                <span class="price product-price">₹ 37,95</span>
                                                <span class="price old-price">₹ 50,00</span>
                                            </div>
                                            <div class="product-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left-block">
                                            <a href="#"><img class="img-responsive" alt="product" src="assets/data/milkbrand6.png" /></a>
                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>

                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="#">Jersey Milk</a></h5>
                                            <div class="content_price">
                                                <span class="price product-price">₹ 38,95</span>
                                                <span class="price old-price">₹ 52,00</span>
                                            </div>
                                            <div class="product-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- tab product -->

                        </div>
                    </div>
                </div>
           </div>
        </div>
        <!-- end featured category Milk-->
		<div class="category-featured">
            <div class="bg-white show-brand">
              <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-brand"><a href="#"><img alt="fashion" src="assets/data/fruitsicon.png" />Vegetables & Fruits</a></div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class=" col-md-9" >
                  <ul class="nav navbar-nav">

                    <li><a href="#">
					<marquee id="scroll_news" >
						<div onmouseover="document.getElementById('scroll_news').stop();" onmouseout="document.getElementById('scroll_news').start();">
							<h4 class="text-success">Order Vegetables and fruits or for Month  ------ Contact us for any functions @ 8500xxxxxxx or 9493 xxxxxxx  ---- Note : Order befor 24 hours for Delivery </h4>
						</div>
					</marquee>
					</a></li>

                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->

            </div>
            <div class="category-banner">
                <div class="col-sm-6 banner">
                    <a href="#"><img alt="ads2" class="img-responsive" src="assets/data/fruitsad1.png" /></a>
                </div>
                <div class="col-sm-6 banner">
                    <a href="#"><img alt="ads2" class="img-responsive" src="assets/data/fruitsad2.png" /></a>
                </div>
           </div>
           <div class="product-featured clearfix">
                <div class="banner-featured">
                    <div class="featured-text"><span>featured</span></div>
                    <div class="banner-img">
                        <a href="#"><img  style="height:240px;"class="img-responsive"  src="assets/data/fruits-cat-img.jpg" /></a>
                    </div>
                </div>
                <div class="product-featured-content">
                    <div class="product-featured-list">
                        <div class="tab-container autoheight">
                            <!-- tab product -->
                            <div class="tab-panel active" id="tab-6">
                                <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                    <li>
                                        <div class="left-block">
                                            <a href="#"><img class="img-responsive" alt="product" src="assets/data/fruits-img1.png" /></a>
                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>

                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="#">Apple</a></h5>
                                            <div class="content_price">
                                                <span class="price product-price">₹ 138,95</span>
                                                <span class="price old-price"> ₹ 152,00</span>
                                            </div>
                                            <div class="product-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left-block">

                                            <a href="#"><img class="img-responsive" alt="product" src="assets/data/fruits-img2.png" /></a>

                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>

                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="#">Oranges</a></h5>
                                            <div class="content_price">
                                                <span class="price product-price">₹ 58,95</span>
                                                <span class="price old-price"> ₹ 82,00</span>
                                            </div>
                                            <div class="product-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left-block">
                                            <a href="#"><img class="img-responsive" alt="product" src="assets/data/fruits-img3.png" /></a>
                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>

                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="#">Tomatoes</a></h5>
                                            <div class="content_price">
                                                <span class="price product-price">₹ 20,95</span>
                                                <span class="price old-price">₹ 30,00</span>
                                            </div>
                                            <div class="product-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left-block">
                                            <a href="#"><img class="img-responsive" alt="product" src="assets/data/fruits-img4.png" /></a>
                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>

                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="#">Potato</a></h5>
                                            <div class="content_price">
                                                <span class="price product-price">₹ 18,95</span>
                                                <span class="price old-price">₹ 32,00</span>
                                            </div>
                                            <div class="product-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left-block">
                                            <a href="#"><img class="img-responsive" alt="product" src="assets/data/fruits-img5.png" /></a>
                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>

                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="#">Fresh Brinjal </a></h5>
                                            <div class="content_price">
                                                <span class="price product-price">₹ 17,95</span>
                                                <span class="price old-price">₹ 20,00</span>
                                            </div>
                                            <div class="product-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left-block">
                                            <a href="#"><img class="img-responsive" alt="product" src="assets/data/fruits-img6.png" /></a>
                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>

                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="#">LadyFinger</a></h5>
                                            <div class="content_price">
                                                <span class="price product-price">₹ 38,95</span>
                                                <span class="price old-price">₹ 52,00</span>
                                            </div>
                                            <div class="product-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- tab product -->

                        </div>
                    </div>
                </div>
           </div>
        </div>
        <!-- end featured category vegetables-->
		<div class="category-featured">
            <div class="bg-white show-brand">
              <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-brand"><a href="#"><img alt="fashion" src="assets/data/fruitsicon.png" />Grocery</a></div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class=" col-md-9" >
                  <ul class="nav navbar-nav">

                    <li><a href="#">
					<marquee id="scroll_news" >
						<div onmouseover="document.getElementById('scroll_news').stop();" onmouseout="document.getElementById('scroll_news').start();">
							<h4 class="text-success">Order Grocery   ------ Contact us for any functions @ 8500xxxxxxx or 9493 xxxxxxx  ---- Note : Order befor 24 hours for Delivery </h4>
						</div>
					</marquee>
					</a></li>

                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->

            </div>
            <div class="category-banner">
                <div class="col-sm-6 banner">
                    <a href="#"><img alt="ads2" class="img-responsive" src="assets/data/groceryad1.png" /></a>
                </div>
                <div class="col-sm-6 banner">
                    <a href="#"><img alt="ads2" class="img-responsive" src="assets/data/groceryad2.png" /></a>
                </div>
           </div>
           <div class="product-featured clearfix">
                <div class="banner-featured">
                    <div class="featured-text"><span>featured</span></div>
                    <div class="banner-img">
                        <a href="#"><img  style="height:240px;"class="img-responsive"  src="assets/data/grocery-cat-ban.jpg" /></a>
                    </div>
                </div>
                <div class="product-featured-content">
                    <div class="product-featured-list">
                        <div class="tab-container autoheight">
                            <!-- tab product -->
                            <div class="tab-panel active" id="tab-6">
                                <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                    <li>
                                        <div class="left-block">
                                            <a href="#"><img class="img-responsive" alt="product" src="assets/data/grocery-img1.png" /></a>
                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>

                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="#">Fortune Refined Sunflower</a></h5>
                                            <div class="content_price">
                                                <span class="price product-price">₹ 438,95</span>
                                                <span class="price old-price"> ₹ 552,00</span>
                                            </div>
                                            <div class="product-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left-block">

                                            <a href="#"><img class="img-responsive" alt="product" src="assets/data/grocery-img2.png" /></a>

                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>

                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="#">Green Gram</a></h5>
                                            <div class="content_price">
                                                <span class="price product-price">₹ 58,95</span>
                                                <span class="price old-price"> ₹ 82,00</span>
                                            </div>
                                            <div class="product-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left-block">
                                            <a href="#"><img class="img-responsive" alt="product" src="assets/data/grocery-img3.png" /></a>
                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>

                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="#">Dal</a></h5>
                                            <div class="content_price">
                                                <span class="price product-price">₹ 120,95</span>
                                                <span class="price old-price">₹ 130,00</span>
                                            </div>
                                            <div class="product-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left-block">
                                            <a href="#"><img class="img-responsive" alt="product" src="assets/data/grocery-img4.png" /></a>
                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>

                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="#">KamaSutra Spark Spray</a></h5>
                                            <div class="content_price">
                                                <span class="price product-price">₹ 118,95</span>
                                                <span class="price old-price">₹ 212,00</span>
                                            </div>
                                            <div class="product-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left-block">
                                            <a href="#"><img class="img-responsive" alt="product" src="assets/data/grocery-img5.jpg" /></a>
                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>

                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="#">Whisper Ultra Clean </a></h5>
                                            <div class="content_price">
                                                <span class="price product-price">₹ 117,95</span>
                                                <span class="price old-price">₹ 120,00</span>
                                            </div>
                                            <div class="product-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left-block">
                                            <a href="#"><img class="img-responsive" alt="product" src="assets/data/grocery-img6.png" /></a>
                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>

                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="#">Loin Dates</a></h5>
                                            <div class="content_price">
                                                <span class="price product-price">₹ 118,95</span>
                                                <span class="price old-price">₹ 152,00</span>
                                            </div>
                                            <div class="product-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- tab product -->

                        </div>
                    </div>
                </div>
           </div>
        </div>
        <!-- end featured category grocery-->
		<div class="category-featured">
            <div class="bg-white show-brand">
              <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-brand"><a href="#"><img alt="fashion" src="assets/data/fruitsicon.png" />Water Can</a></div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class=" col-md-9" >
                  <ul class="nav navbar-nav">

                    <li><a href="#">
					<marquee id="scroll_news" >
						<div onmouseover="document.getElementById('scroll_news').stop();" onmouseout="document.getElementById('scroll_news').start();">
							<h4 class="text-success">Order Watercan   ------ Contact us for any functions @ 8500xxxxxxx or 9493 xxxxxxx  ---- Note : Order befor 24 hours for Delivery </h4>
						</div>
					</marquee>
					</a></li>

                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->

            </div>
            <div class="category-banner">
                <div class="col-sm-6 banner">
                    <a href="#"><img alt="ads2" class="img-responsive" src="assets/data/waterad1.png" /></a>
                </div>
                <div class="col-sm-6 banner">
                    <a href="#"><img alt="ads2" class="img-responsive" src="assets/data/waterad2.png" /></a>
                </div>
           </div>
           <div class="product-featured clearfix">
                <div class="banner-featured">
                    <div class="featured-text"><span>featured</span></div>
                    <div class="banner-img">
                        <a href="#"><img  style="height:240px;"class="img-responsive"  src="assets/data/watercan-cat-ban.png" /></a>
                    </div>
                </div>
                <div class="product-featured-content">
                    <div class="product-featured-list">
                        <div class="tab-container autoheight">
                            <!-- tab product -->
                            <div class="tab-panel active" id="tab-6">
                                <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                    <li>
                                        <div class="left-block">
                                            <a href="#"><img class="img-responsive" alt="product" src="assets/data/waterimg1.jpg" /></a>
                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>

                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="#">AquaSure water</a></h5>
                                            <div class="content_price">
                                                <span class="price product-price">₹ 35,95</span>
                                                <span class="price old-price"> ₹ 52,00</span>
                                            </div>
                                            <div class="product-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left-block">

                                            <a href="#"><img class="img-responsive" alt="product" src="assets/data/waterimg2.jpeg" /></a>

                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>

                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="#">Cool Water</a></h5>
                                            <div class="content_price">
                                                <span class="price product-price">₹ 38,95</span>
                                                <span class="price old-price"> ₹ 62,00</span>
                                            </div>
                                            <div class="product-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                        </div>
                                    </li>
									<li>
                                        <div class="left-block">
                                            <a href="#"><img class="img-responsive" alt="product" src="assets/data/waterimg1.jpg" /></a>
                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>

                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="#">AquaSure water</a></h5>
                                            <div class="content_price">
                                                <span class="price product-price">₹ 35,95</span>
                                                <span class="price old-price"> ₹ 52,00</span>
                                            </div>
                                            <div class="product-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left-block">

                                            <a href="#"><img class="img-responsive" alt="product" src="assets/data/waterimg2.jpeg" /></a>

                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>

                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="#">Cool Water</a></h5>
                                            <div class="content_price">
                                                <span class="price product-price">₹ 38,95</span>
                                                <span class="price old-price"> ₹ 62,00</span>
                                            </div>
                                            <div class="product-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                        </div>
                                    </li>


                                </ul>
                            </div>
                            <!-- tab product -->

                        </div>
                    </div>
                </div>
           </div>
        </div>






        <!-- end banner bottom -->
    </div>
</div>



<?php include("footer.php"); ?>
</body>

</html>
