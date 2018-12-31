<!DOCTYPE html>
<html>
<head>
  <?php include("header.php"); ?>
  <div class="columns-container">
    <div class="container" id="columns">
      <!-- breadcrumb -->
      <div class="breadcrumb clearfix">
        <a class="home" href="<?php echo base_url('home'); ?>" title="Return to Home">Home</a>
        <span class="navigation-pipe">&nbsp;</span>
        <span class="navigation_page"><?php echo ucwords($sub_category->subcat_name); ?></span>
      </div>
      <!-- ./breadcrumb -->
      <!-- row -->
      <div class="row">
        <div class=" col-xs-12 col-sm-12" id="center_column">
          <!-- category-slider -->
		  <?php if(isset($slider_images) && count($slider_images)>0){ ?>
          <div class="category-slider">
            <ul class="owl-carousel owl-style2" data-dots="false" data-loop="true" data-nav = "true" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-items="1">
              <?php foreach($slider_images as $imgs){ ?>
			  <li>
                <img src="<?php echo base_url('assets/uploads/sub_category_pics/'.$imgs['image_path']); ?>" alt="<?php echo $imgs['image_path']; ?>">
              </li>
			  <?php } ?>

            </ul>
          </div>
		  <?php } ?>
          <div id="view-product-list" class="view-product-list">
            <h2 class="page-heading">
              <span class="page-heading-title"><?php echo ucwords($sub_category->subcat_name); ?></span>
            </h2>
            <ul class="display-product-option">
              <li class="view-as-grid">
                <span>grid</span>
              </li>
              <li class="view-as-list selected">
                <span>list</span>
              </li>
            </ul>
            <!-- PRODUCT LIST -->
            <ul class="row product-list list">
              <?php //print_r($category_name->cat_name); ?>
              <?php if(count($product) > 0){ ?>
                <?php foreach ($product as $p) { ?>
                  <li class="col-md-3">
                    <div class="product-container">
                      <div class="left-block">
                        <a href="<?php echo base_url('product/'.$p->product_id); ?>">
                          <?php if(!empty($p->product_img) && file_exists('assets/uploads/product_pics/'.$p->product_img)){ ?>
                            <img class="img-responsive" alt="product" src="<?php echo base_url('assets/uploads/product_pics/'.$p->product_img); ?>" />
                          <?php } else { ?>
                            <img class="img-responsive" alt="product" src="<?php echo base_url('assets/uploads/product_pics/no-product.png'); ?>" />
                          <?php } ?>
                        </a>
                        <div class="quick-view">
                          <?php if(strcasecmp($category_name->cat_name,'MILK') != 0){ ?>
                            <?php if (in_array($p->product_id,$wishlist_product_id)) { ?>
                                <a title="Added to your wishlist" class="heart whishlist" href="#" style="background:#57bb14"></a>
                            <?php  } else { ?>
                              <a title="Add to my wishlist" class="heart whishlist" href="#" data-user_id="<?php echo $this->session->userdata('id'); ?>" data-product_id="<?php echo $p->product_id; ?>" data-product_img="<?php echo $p->product_img; ?>" data-product_name="<?php echo $p->product_name; ?>" data-net_price="<?php echo $p->net_price; ?>" data-quantity="1" data-discount_price=<?php echo $p->discount_price; ?>></a>
                            <?php } ?>
                          <?php } ?>
                          <!---a title="Add to compare" class="compare" href="#"></a-->
                        </div>
                        <div class="add-to-cart">
                          <?php if(strcasecmp($category_name->cat_name,'MILK') == 0){ ?>
                            <a title="Add to Calender" class="" href="<?php echo base_url('milkcalender/'.$p->product_id); ?>" >Add to Calender</a>
                          <?php }elseif (in_array($p->product_id,$cart_product_id)) { ?>
                            <a title="Added to Cart" class="addtocart" href="#" >Added to Cart</a>
                          <?php  }else{ ?>
                            <a title="Add to Cart" class="addtocart" href="#" data-user_id="<?php echo $this->session->userdata('id'); ?>" data-product_id="<?php echo $p->product_id; ?>" data-product_img="<?php echo $p->product_img; ?>" data-product_name="<?php echo $p->product_name; ?>" data-net_price="<?php echo $p->net_price; ?>" data-quantity="1">Add to Cart</a>
                          <?php  } ?>

                        </div>
                      </div>
                      <div class="right-block">
                        <h5 class="product-name"><a href="<?php echo base_url('product/'.$p->product_id); ?>"><?php echo $p->product_name;  ?></a></h5>
                        <div class="product-star">
                          <?php if (count($rating) > 0) { ?>
                            <?php foreach ($rating as $r) { ?>
                              <?php if($p->product_id == $r->product_id){ ?>
                                <?php for ($i=1; $i <= $r->rate; $i++) { ?>
                                  <i class="fa fa-star"></i>
                                <?php } ?>
                                <?php if (strpos($r->rate,'.')) { ?>
                                  <i class="fa fa-star-half-o"></i>
                                <?php $i++; } ?>
                                <?php while ($i<=5) { ?>
                                    <i class="fa fa-star-o"></i>
                                <?php $i++; } ?>
                              <?php } ?>
                            <?php } ?>
                          <?php } ?>
                        </div>
                        <div class="content_price">
                          <span class="price product-price">₹ <?php echo $p->net_price; ?></span>
                          <?php if($p->net_price != $p->actual_price){ ?>
                            <span class="price old-price">₹ <?php echo $p->actual_price; ?></span>
                          <?php } ?>
                        </div>
                        <div class="info-orther">
                          <!-- <p>Item Code: #453217907</p> -->
                          <p class="availability">Availability: <span>In stock</span></p>
                          <div class="product-desc">
                            <?php echo $p->description; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
              <?php  } ?>
            <?php } else { ?>
              <li><h2>No product found</h2></li>
            <?php } ?>
            </ul>
            <!-- ./PRODUCT LIST -->
          </div>

        </div>
        <!-- ./ Center colunm -->
      </div>
      <!-- ./row-->
    </div>
  </div>
  <?php include("footer.php"); ?>
</body>
</html>
