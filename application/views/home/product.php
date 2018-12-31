<!DOCTYPE html>
<html>
<head>
  <?php include("header.php"); ?>
  <div class="columns-container">
    <?php if(isset($product)){ ?>
      <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
          <a class="home" href="<?php echo base_url('home'); ?>" title="Return to Home">Home</a>
          <span class="navigation-pipe">&nbsp;</span>
          <a href="#" title="Return to Home">Fruits & Vegetables</a>
        </div>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
          <!-- Left colunm -->
          <div class="column col-xs-12 col-sm-3" id="left_column">
            <!-- block category -->
            <div class="block left-module">
              <p class="title_block">CATEGORIES</p>
              <div class="block_content">
                <!-- layered -->
                <div class="layered layered-category">
                  <div class="layered-content">
                    <ul class="tree-menu">
                      <?php if (count($categories) > 0) { ?>
                        <?php foreach($categories as $c){ ?>
                          <li><span></span><a href="<?php echo base_url('category/'.$c->cat_id); ?>"><?php echo $c->cat_name; ?></a></li>
                        <?php } ?>
                      <?php } ?>
                    </ul>
                  </div>
                </div>
                <!-- ./layered -->
              </div>
              </div
              <!-- left silide -->

              <?php if(isset($slider_images) && count($slider_images)>0){ ?>
                <div class="col-left-slide left-module">
                  <ul class="owl-carousel owl-style2" data-loop="true" data-nav = "false" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-items="1" data-autoplay="true">
                    <?php foreach($slider_images as $imgs){ ?>
                      <li>
                        <a href="<?php echo base_url('category/'.$imgs['cat_id']); ?>">
                        <?php if (!empty($imgs['cat_dis_img']) && file_exists('assets/uploads/category_pics/'.$imgs['cat_dis_img'])){ ?>
                          <img src="<?php echo base_url('assets/uploads/category_pics/'.$imgs['cat_dis_img']); ?>" alt="<?php echo $imgs['cat_dis_img']; ?>">
                        <?php } else { ?>
                          <img src="<?php echo base_url('assets/uploads/category_pics/no-image.png'); ?>" alt="no image">
                        <?php } ?>
                        </a>
                      </li>
                    <?php } ?>
                  </ul>
                </div>
              <?php } ?>
              <!--./left silde-->
              <!-- block best sellers -->
            </div>
            <!-- ./left colunm -->
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
              <!-- Product -->
              <div id="product">
                <div class="primary-box row">
                  <div class="pb-left-column col-xs-12 col-sm-6">
                    <!-- product-imge-->
                    <div class="product-image">
                      <div class="product-full">
                        <?php if(!empty($product->product_img) && file_exists('assets/uploads/product_pics/'.$product->product_img)){ ?>
                          <img id="product-zoom" src='<?php echo base_url('assets/uploads/product_pics/'.$product->product_img); ?>' data-zoom-image="<?php echo base_url('assets/uploads/product_pics/'.$product->product_img); ?>"/>
                        <?php } else { ?>
                          <img id="product-zoom" src='<?php echo base_url('assets/uploads/product_pics/no-product.png'); ?>' data-zoom-image="<?php echo base_url('assets/uploads/product_pics/no-product.png'); ?>"/>
                        <?php } ?>
                      </div>
                      <!-- product thumbnail images -->
                      <?php if (count($product_related_images) > 0) { ?>
                        <div class="product-img-thumb" id="gallery_01">
                          <ul class="owl-carousel" data-items="3" data-nav="true" data-dots="false" data-margin="20" data-loop="true">
                            <?php foreach ($product_related_images as $pri) { ?>
                              <li>
                                <a href="#" data-image="<?php echo base_url('assets/uploads/product_pics/'.$pri->image_name); ?>" data-zoom-image="<?php echo base_url('assets/uploads/product_pics/'.$pri->image_name); ?>">
                                  <?php if (!empty($pri->image_name) && file_exists('assets/uploads/product_pics/'.$pri->image_name)) {
                                    ?>
                                    <img id="product-zoom"  src="<?php echo base_url('assets/uploads/product_pics/'.$pri->image_name); ?>" />
                                  <?php } else { ?>
                                    <img id="product-zoom"  src="<?php echo base_url('assets/uploads/product_pics/no-product.png'); ?>" />
                                  <?php }?>

                                </a>
                              </li>
                            <?php } ?>
                          </ul>
                        </div>
                      <?php } ?>

                    </div>
                    <!-- product-imge-->
                  </div>
                  <div class="pb-right-column col-xs-12 col-sm-6">
                    <h1 class="product-name"><?php if(isset($product->product_name)){ echo $product->product_name; } ?></h1>
                    <div class="product-comments">
                      <div class="product-star">
                        <?php if (count($rating) > 0) { ?>
                          <?php foreach ($rating as $r) { ?>
                            <?php if(isset($product->product_id) && ($product->product_id == $r->product_id)){ ?>
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
                          <div class="comments-advices">
                            <?php if(count($rating) > 0){ ?>
                              <a href="#">
                                <?php foreach ($rating as $r) { ?>
                                  <?php if(isset($product->product_id) && ($product->product_id == $r->product_id)){ ?>
                                    Based  on
                                    <?php echo $r->users_count; ?>
                                    ratings
                                  <?php } ?>
                                <?php } ?>
                              </a>
                            <?php } ?>
                          </div>
                        </div>
                        <div class="product-price-group">
                          <span class="price">₹ <?php if (isset($product->net_price)) {echo $product->net_price;} ?></span>
                          <?php if ((isset($product->net_price) && isset($product->actual_price)) && ($product->net_price != $product->actual_price)) { ?>
                            <span class="old-price">₹ <?php if (isset($product->actual_price)) { echo $product->actual_price; } ?></span>
                          <?php } ?>
                          <span class="discount"><?php if (isset($product->discount_percentage)) { echo $product->discount_percentage.' %'; } ?></span>
                        </div>
                        <div class="info-orther">
                          <p>Availability: <?php if (isset($product->quantity) && ($product->quantity > 0)) { ?> <span class="label label-success">In stock</span><?php } else { ?> <span class="label label-danger">Out of stock</span><?php } ?></p>
                        </div>
                        <?php if(isset($product->description)){ ?>
                          <div class="product-desc">
                            <?php echo $product->description; ?>
                          </div>
                        <?php } ?>
                        <?php if(isset($category_name->cat_name) && (strcasecmp($category_name->cat_name,'MILK') != 0)){ ?>
                          <?php if(isset($product->product_id) && (!in_array($product->product_id,$cart_product_id))){ ?>
                          <div class="form-option">
                              <div class="attributes">
                                <div class="attribute-label">Qty:</div>
                                <form class="" id="cart_form">
                                  <div style="padding:5px;" class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
                                  <input type="number" name="quantity" id="number" value="<?php if(isset($cart_quantity->quantity)){ echo $cart_quantity->quantity; } else { echo '1'; } ?>" />
                                  <div style="padding:5px;" class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+</div>
                                  <input type="hidden" name="product_id" value="<?php if (isset($product->product_id)) { echo $product->product_id; } ?>"/>
                                  <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('id'); ?>"/>
                                  <input type="hidden" name="product_name" value="<?php if (isset($product->product_name)) { echo $product->product_name; } ?>"/>
                                  <input type="hidden" name="net_price" value="<?php if (isset($product->net_price)) { echo $product->net_price; } ?>"/>
                                  <input type="hidden" name="product_img" value="<?php if (isset($product->product_img)) { echo $product->product_img; } ?>"/>
                                </form>
                              </div>
                          </div>
                        <?php } ?>
                        <?php } ?>
                        <div class="form-action">
                          <div class="button-group">
                            <?php if(isset($category_name->cat_name) && (strcasecmp($category_name->cat_name,'MILK') == 0)){ ?>
                              <a title="Add to Calender" class="btn-add-cart" href="<?php echo base_url('milkcalender/'.$product->product_id); ?>" >Add to Calender</a>
                            <?php } else if (isset($product->product_id) && (in_array($product->product_id,$cart_product_id))){ ?>
                              <button class="btn-add-cart" type="button" id="addtocart" disabled>Added to cart</button>
                            <?php }else{ ?>
                              <button class="btn-add-cart" type="button" id="addtocart">Add to cart</button>
                            <?php } ?>
                          </div>
                          <div class="button-group">
                            <?php if(isset($category_name->cat_name) && (strcasecmp($category_name->cat_name,'MILK') != 0)){ ?>
                                <?php if (isset($product->product_id) && (in_array($product->product_id,$wishlist_product_id))){ ?>
                                  <a class="wishlist whishlist" href="#" title="Added to your wishlist"><i class="fa fa-heart-o" style="background:#57bb14"></i> Wishlist</a>
                                <?php }else{ ?>
                                <?php if(isset($product)){ ?>
                                  <a class="wishlist whishlist" href="#" title="Add to my wishlist" data-user_id="<?php echo $this->session->userdata('id'); ?>" data-product_id="<?php echo $product->product_id; ?>" data-product_img="<?php echo $product->product_img; ?>" data-product_name="<?php echo $product->product_name; ?>" data-net_price="<?php echo $product->net_price; ?>" data-quantity="1" data-discount_price=<?php echo $product->discount_price; ?>><i class="fa fa-heart-o"></i> Wishlist</a>
                                <?php } ?>
                              <?php } ?>
                            <?php } ?>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- tab product -->
                    <div class="product-tab">
                      <ul class="nav-tab">
                        <li class="active">
                          <a aria-expanded="false" data-toggle="tab" href="#product-detail">Product Description</a>
                        </li>
                        <li>
                          <a aria-expanded="true" data-toggle="tab" href="#information">Product Details</a>
                        </li>
                        <li>
                          <a data-toggle="tab" href="#reviews">reviews</a>
                        </li>

                        <li>
                          <a data-toggle="tab" href="#guarantees">guarantees</a>
                        </li>
                      </ul>
                      <div class="tab-container">
                        <div id="product-detail" class="tab-panel active">
                          <?php if(isset($product->description)){ ?>
                            <p><?php echo $product->description; ?></p>
                          <?php } else { ?>
                            <p><h6>No product description</h6></p>
                          <?php } ?>
                        </div>
                        <div id="information" class="tab-panel">
                          <table class="table table-bordered">
                            <?php if(count($features) > 0){ ?>
                              <?php foreach ($features as $f) { ?>
                                <tr>
                                  <td width="200"><?php echo $f->feature_name; ?></td>
                                  <td><?php echo $f->feature_value; ?></td>
                                </tr>
                              <?php } ?>
                            <?php }else{ ?>
                              <tr>
                                <td colspan="2" style="text-align:center;">No product features found</td>
                              </tr>
                            <?php } ?>
                          </table>
                        </div>
                        <div id="reviews" class="tab-panel">
                          <?php if(isset($reviewandrating_lists) && count($reviewandrating_lists)>0){ ?>
                            <div class="product-comments-block-tab">
                              <?php foreach($reviewandrating_lists as $list){ ?>
                                <div class="comment row">
                                  <div class="col-sm-3 author">
                                    <div class="grade">
                                      <span>Grade</span>
                                      <span class="reviewRating">
                                        <?php if($list['rate']==1){ ?>
                                          <i class="fa fa-star"></i>
                                        <?php }else if($list['rate']==2){ ?>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                        <?php }else if($list['rate']==3){ ?>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                        <?php }else if($list['rate']==4){ ?>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                        <?php }else if($list['rate']==5){ ?>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                        <?php } ?>
                                      </span>
                                    </div>
                                    <div class="info-author">
                                      <span><strong><?php echo isset($list['user_name'])?$list['user_name']:''; ?></strong></span>
                                      <em><?php echo isset($list['created_at'])?$list['created_at']:''; ?></em>
                                    </div>
                                  </div>
                                  <div class="col-sm-9 commnet-dettail">
                                    <?php echo isset($list['message'])?$list['message']:''; ?>
                                  </div>
                                </div>

                              <?php } ?>

                            </div>
                          <?php }else{ ?>
                            No data available
                          <?php } ?>

                        </div>

                        <div id="guarantees" class="tab-panel">
                          <?php if(isset($product->guarantee_policy)){ ?>
                            <p><?php echo $product->guarantee_policy; ?></p>
                          <?php } else { ?>
                            <p><h6>No product guarantee</h6></p>
                          <?php } ?></div>
                        </div>
                      </div>
                      <!-- ./tab product -->
                      <!-- box product -->
                      <?php if(count($related_products) > 0){ ?>
                        <div class="page-product-box">
                          <h3 class="heading">Related Products</h3>
                          <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "30" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":3}}'>
                            <?php foreach ($related_products as $rp) { ?>
                              <li>
                                <div class="product-container">
                                  <div class="left-block">
                                    <a href="<?php echo base_url('product/'.$rp->product_id); ?>">
                                      <?php if (!empty($rp->product_img) && file_exists('assets/uploads/product_pics/'.$rp->product_img)) { ?>
                                        <img class="img-responsive" alt="product" src="<?php echo base_url('assets/uploads/product_pics/'.$rp->product_img); ?>" />
                                      <?php } else { ?>
                                        <img class="img-responsive" alt="product" src="<?php echo base_url('assets/uploads/product_pics/no-product.png'); ?>" />
                                      <?php } ?>
                                    </a>
                                    <div class="quick-view">
                                      <?php if (in_array($rp->product_id,$wishlist_product_id)) { ?>
                                        <a title="Added to your wishlist" class="heart whishlist" href="#" style="background:#57bb14"></a>
                                      <?php } else{ ?>
                                        <a title="Add to my wishlist" class="heart whishlist" href="#" data-user_id="<?php echo $this->session->userdata('id'); ?>" data-product_id="<?php echo $rp->product_id; ?>" data-product_img="<?php echo $rp->product_img; ?>" data-product_name="<?php echo $rp->product_name; ?>" data-net_price="<?php echo $rp->net_price; ?>" data-quantity="1" data-discount_price=<?php echo $rp->discount_price; ?>></a>
                                      <?php } ?>
                                      <!-- <a title="Add to compare" class="compare" href="#"></a> -->

                                    </div>
                                    <div class="add-to-cart">
                                      <?php if (in_array($rp->product_id,$cart_product_id)) { ?>
                                        <a title="Added to Cart" href="#add" class="addtocart">Added to Cart</a>
                                      <?php } else { ?>
                                        <a title="Add to Cart" href="#add" class="addtocart" data-user_id="<?php echo $this->session->userdata('id'); ?>" data-product_id="<?php echo $rp->product_id; ?>" data-product_img="<?php echo $rp->product_img; ?>" data-product_name="<?php echo $rp->product_name; ?>" data-net_price="<?php echo $rp->net_price; ?>" data-quantity="1">Add to Cart</a>
                                      <?php } ?>
                                    </div>
                                  </div>
                                  <div class="right-block">
                                    <h5 class="product-name"><a href="#"><?php echo $rp->product_name; ?></a></h5>
                                    <div class="product-star">
                                      <?php if (count($rating) > 0) { ?>
                                        <?php foreach ($rating as $r) { ?>
                                          <?php if($rp->product_id == $r->product_id){ ?>
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
                                          <!-- <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star"></i>
                                          <i class="fa fa-star-half-o"></i> -->
                                        </div>
                                        <div class="content_price">
                                          <span class="price product-price">₹ <?php echo $rp->net_price; ?></span>
                                          <span class="price old-price">₹ <?php echo $rp->actual_price; ?></span>
                                        </div>
                                      </div>
                                    </div>

                                  </li>
                                <?php } ?>
                              </ul>
                            </div>
                          <?php } ?>
                          <!-- ./box product -->
                          <!-- box product -->
                          <!-- ./box product -->
                        </div>
                        <!-- Product -->
                      </div>
                      <!-- ./ Center colunm -->
                    </div>
                    <!-- ./row-->
                  </div>
                <?php } else { ?>
                  <div class="container" id="columns">
                    This has been deactivated by Admin
                  </div>
                <?php  } ?>
              </div>

              <?php include("footer.php"); ?>
              <script type="text/javascript">
              $(document).ready(function(){
                $('#addtocart').click(function(){
                  var obj = $(this);
                  <?php
                  if($this->session->userdata('logged_in') != TRUE){
                    echo 'window.location = "'.base_url('home/login').'";';
                  } else {
                    ?>
                    var formData = new FormData($('#cart_form')[0]);
                    $.ajax({
                      url:'<?php echo base_url('products/cart'); ?>',
                      type:'POST',
                      data:formData,
                      contentType:false,
                      processData:false,
                      cache:false,
                      dataType:'JSON',
                      success:function(data){
                        $('.cart_count').html(data.count);
                        $('#cart_template').html(data.cart_template);
                        obj.attr("disabled",true);
                        obj.html("Added to cart");
                      }
                    });
                    <?php } ?>
                  });
                });
                </script>
              </body>
              </html>
