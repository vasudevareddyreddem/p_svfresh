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
          <?php if (count($slides) > 0) { ?>
            <div class="homeslider">
              <div class="content-slide">
                <ul id="contenhomeslider">
                  <?php foreach($slides as $s){ ?>
                    <li><img alt="Funky roots" src="<?php echo base_url('assets/uploads/slider_pics/'.$s->pic_name); ?>"/></li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          <?php } ?>
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
        <?php if(count($categories) > 0){ ?>
          <?php foreach ($categories as $c) { ?>
            <a href="<?php echo base_url('category/'.$c->cat_id); ?>">
              <div class="col-xs-6 col-md-3 ">
                <div class="category-bg" style="margin:0 auto;">
                  <?php if(!empty($c->cat_img) && file_exists('assets/uploads/category_pics/'.$c->cat_img)){  ?>
                    <img class="img-resonsive" src="<?php echo base_url('assets/uploads/category_pics/'.$c->cat_img); ?>" alt="<?php echo $c->cat_img; ?>"/>
                  <?php } ?>
                </div>
                <div class="text-center font-cat"><?php if($c->cat_name){ echo $c->cat_name;} ?></div>
              </div>
            </a>
          <?php } ?>
        <?php } ?>
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
          <?php if(count($categories) > 0){ ?>
            <?php foreach ($categories as $c) { ?>
              <div class="category-featured">
                <div class="bg-white show-brand">
                  <div class="container">

                    <div class="navbar-brand"><a href="<?php echo base_url('category/'.$c->cat_id); ?>"><?php if(!empty($c->cat_small_img) && file_exists('assets/uploads/category_pics/'.$c->cat_small_img)){ ?><img alt="fashion" src="<?php echo base_url('assets/uploads/category_pics/'.$c->cat_small_img ); ?>" /><?php } ?> <?php if($c->cat_name){ echo $c->cat_name;} ?></a></div>


                    <div class=" col-md-9" >
                      <ul class="nav navbar-nav">

                        <li><a href="#">
                          <marquee id="scroll_news" >
                            <div onmouseover="document.getElementById('scroll_news').stop();" onmouseout="document.getElementById('scroll_news').start();">
                              <h4 class="text-success"><?php echo $c->cat_scr_content; ?></h4>
                            </div>
                          </marquee>
                        </a></li>

                      </ul>
                    </div><!-- /.navbar-collapse -->
                  </div><!-- /.container-fluid -->

                </div>
                <div class="category-banner">
                  <div class="col-sm-6 banner">
                    <a href="<?php echo base_url('category/'.$c->cat_id); ?>"><?php if(!empty($c->cat_lh_img) && file_exists('assets/uploads/category_pics/'.$c->cat_lh_img)){ ?><img alt="ads2" class="img-responsive" src="<?php echo base_url('assets/uploads/category_pics/'.$c->cat_lh_img); ?>" /><?php } ?></a>
                  </div>
                  <div class="col-sm-6 banner">
                    <a href="<?php echo base_url('category/'.$c->cat_id); ?>"><?php if(!empty($c->cat_rh_img) && file_exists('assets/uploads/category_pics/'.$c->cat_rh_img)){ ?><img alt="ads2" class="img-responsive" src="<?php echo base_url('assets/uploads/category_pics/'.$c->cat_rh_img);?>" /><?php } ?></a>
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
                            <?php if(count($products) > 0){ ?>
                              <?php foreach ($products as $p) { if($p->cat_id == $c->cat_id){ ?>

                                <li>
                                  <div class="left-block">
                                    <a href="<?php echo base_url('product/'.$p->product_id); ?>"><img class="img-responsive" alt="product" src="<?php echo base_url('assets/uploads/product_pics/'.$p->product_img); ?>" /></a>
                                    <div class="quick-view">
                                      <a title="Add to my wishlist" class="heart whishlist" href="#" data-user_id="<?php echo $this->session->userdata('id'); ?>" data-product_id="<?php echo $p->product_id; ?>" data-product_img="<?php echo $p->product_img; ?>" data-product_name="<?php echo $p->product_name; ?>" data-net_price="<?php echo $p->net_price; ?>" data-quantity="1"></a>
                                      <!-- <a title="Add to compare" class="compare" href="#"></a> -->

                                    </div>
                                    <div class="add-to-cart">
                                      <a title="Add to Cart" class="addtocart" href="#" data-user_id="<?php echo $this->session->userdata('id'); ?>" data-product_id="<?php echo $p->product_id; ?>" data-product_img="<?php echo $p->product_img; ?>" data-product_name="<?php echo $p->product_name; ?>" data-net_price="<?php echo $p->net_price; ?>" data-quantity="1">Add to Cart</a>
                                    </div>
                                  </div>
                                  <div class="right-block">
                                    <h5 class="product-name"><a href="#"><?php echo $p->product_name; ?></a></h5>
                                    <div class="content_price">
                                      <span class="price product-price">₹ <?php echo $p->net_price; ?></span>
                                      <span class="price old-price"> ₹ <?php echo $p->actual_price; ?></span>
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
                              <?php  } }?>
                            <?php } ?>
                          </ul>
                        </div>
                        <!-- tab product -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
          <?php } ?>
          <!-- end featured category Milk-->

          <!-- end featured category vegetables-->

          <!-- end featured category grocery-->

          <!-- end banner bottom -->
        </div>
      </div>
      <?php include("footer.php"); ?>
    </body>
    </html>
