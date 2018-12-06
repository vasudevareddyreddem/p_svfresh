<!DOCTYPE html>
<html>
<head>
<?php include("header.php"); ?>
<div class="columns-container">
  <div class="container" id="columns">
    <!-- breadcrumb -->
    <div class="breadcrumb clearfix">
      <a class="home" href="#" title="Return to Home">Home</a>
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
                  <li><span></span><a href="#">Fruits & Vegetables</a></li>
                  <li><span></span><a href="#">Water</a></li>
                  <li><span></span><a href="#">Milk</a></li>
                  <li><span></span><a href="#">Grocery</a></li
                </ul>
              </div>
            </div>
            <!-- ./layered -->
          </div>
        </div
        <!-- left silide -->
        <div class="col-left-slide left-module">
          <ul class="owl-carousel owl-style2" data-loop="true" data-nav = "false" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-items="1" data-autoplay="true">
            <li><a href="#"><img src="assets/data/fruits-cat-img.jpg" alt="slide-left"></a></li>
            <li><a href="#"><img src="assets/data/grocery-cat-ban.jpg" alt="slide-left"></a></li>
            <li><a href="#"><img src="assets/data/milkcataban.jpg" alt="slide-left"></a></li>
          </ul>
        </div>
        <!--./left silde-->
        <!-- block best sellers -->
        <div class="block left-module">
          <p class="title_block">ON SALE</p>
          <div class="block_content product-onsale">
            <ul class="product-list owl-carousel" data-loop="true" data-nav = "false" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-items="1" data-autoplay="true">
              <li>
                <div class="product-container">
                  <div class="left-block">
                    <a href="#">
                      <img class="img-responsive" alt="product" src="assets/data/fruits-img1.png" />
                    </a>
                    <div class="price-percent-reduction2">-30% OFF</div>
                  </div>
                  <div class="right-block">
                    <h5 class="product-name"><a href="#">Simla Apples <?php echo $product->product_name; ?></a></h5>
                    <div class="product-star">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star-half-o"></i>
                    </div>
                    <div class="content_price">
                      <span class="price product-price">₹38,95</span>
                      <span class="price old-price">₹52,00</span>
                    </div>
                  </div>
                  <div class="product-bottom">
                    <a class="btn-add-cart" title="Add to Cart" href="#add">Add to Cart</a>
                  </div>
                </div>
              </li>
              <li>
                <div class="product-container">
                  <div class="left-block">
                    <a href="#">
                      <img class="img-responsive" alt="product" src="assets/data/waterimg1.jpg" />
                    </a>
                    <div class="price-percent-reduction2">-10% OFF</div>
                  </div>
                  <div class="right-block">
                    <h5 class="product-name"><a href="#">Bisleri water cans</a></h5>
                    <div class="product-star">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star-half-o"></i>
                    </div>
                    <div class="content_price">
                      <span class="price product-price">₹38,95</span>
                      <span class="price old-price">₹52,00</span>
                    </div>
                  </div>
                  <div class="product-bottom">
                    <a class="btn-add-cart" title="Add to Cart" href="#add">Add to Cart</a>
                  </div>
                </div>
              </li>
              <li>
                <div class="product-container">
                  <div class="left-block">
                    <a href="#">
                      <img class="img-responsive" alt="product" src="assets/data/grocery-img4.png" />
                    </a>
                    <div class="price-percent-reduction2">-42% OFF</div>
                  </div>
                  <div class="right-block">
                    <h5 class="product-name"><a href="#">KamaSutra Spark Spray</a></h5>
                    <div class="product-star">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star-half-o"></i>
                    </div>
                    <div class="content_price">
                      <span class="price product-price">₹38,95</span>
                      <span class="price old-price">₹52,00</span>
                    </div>
                  </div>
                  <div class="product-bottom">
                    <a class="btn-add-cart" title="Add to Cart" href="#add">Add to Cart</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>

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
                  <img id="product-zoom" src='<?php echo base_url('assets/uploads/product_pics/'.$product->product_img); ?>' data-zoom-image="<?php echo base_url('assets/uploads/product_pics/'.$product->product_img); ?>"/>
                </div>
                <!-- product thumbnail images -->
                <!-- <div class="product-img-thumb" id="gallery_01">
                  <ul class="owl-carousel" data-items="3" data-nav="true" data-dots="false" data-margin="20" data-loop="true">
                    <li>
                      <a href="#" data-image="assets/data/grocery-img1.png" data-zoom-image="assets/data/grocery-img1.png">
                        <img id="product-zoom"  src="assets/data/grocery-img1.png" />
                      </a>
                    </li>
                    <li>
                      <a href="#" data-image="assets/data/grocery-img2.png" data-zoom-image="assets/data/grocery-img2.png">
                        <img id="product-zoom"  src="assets/data/grocery-img2.png" />
                      </a>
                    </li>
                    <li>
                      <a href="#" data-image="assets/data/fruits-img2.png" data-zoom-image="assets/data/fruits-img2.png">
                        <img id="product-zoom"  src="assets/data/fruits-img2.png" />
                      </a>
                    </li>
                    <li>
                      <a href="#" data-image="assets/data/fruits-img3.png" data-zoom-image="assets/data/fruits-img3.png">
                        <img id="product-zoom"  src="assets/data/fruits-img3.png" />
                      </a>
                    </li>
                    <li>
                      <a href="#" data-image="assets/data/waterimg1.jpg" data-zoom-image="assets/data/waterimg1.jpg">
                        <img id="product-zoom"  src="assets/data/waterimg1.jpg" />
                      </a>
                    </li>
                    <li>
                      <a href="#" data-image="assets/data/waterimg2.jpeg" data-zoom-image="assets/data/waterimg2.jpeg">
                        <img id="product-zoom"  src="assets/data/waterimg2.jpeg" />
                      </a>
                    </li>
                  </ul>
                </div> -->
                <!-- product thumbnail images -->
              </div>
              <!-- product-imge-->
            </div>
            <div class="pb-right-column col-xs-12 col-sm-6">
              <h1 class="product-name"><?php echo $product->product_name; ?></h1>
              <div class="product-comments">
                <div class="product-star">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half-o"></i>
                </div>
                <div class="comments-advices">
                  <a href="#">Based  on 3 ratings</a>

                </div>
              </div>
              <div class="product-price-group">
                <span class="price">₹ <?php echo $product->net_price; ?></span>
                <span class="old-price">₹ <?php echo $product->actual_price; ?></span>
                <span class="discount"><?php echo $product->discount_percentage; ?></span>
              </div>
              <div class="info-orther">
                <p>Item Code: #453217907</p>
                <p>Availability: <span class="label label-success">In stock</span></p>
                <p>Condition: New</p>
              </div>
              <?php if($product->description){ ?>
              <div class="product-desc">
                <?php echo $product->description; ?>
              </div>
            <?php } ?>
              <div class="form-option">
                <!-- <p class="form-option-title">Available Options:</p>
                <div class="attributes">
                  <div class="attribute-label">Color:</div>
                  <div class="attribute-list">
                    <ul class="list-color">
                      <li style="background:#0c3b90;"><a href="#">red</a></li>
                      <li style="background:#036c5d;" class="active"><a href="#">red</a></li>
                      <li style="background:#5f2363;"><a href="#">red</a></li>
                      <li style="background:#ffc000;"><a href="#">red</a></li>
                      <li style="background:#36a93c;"><a href="#">red</a></li>
                      <li style="background:#ff0000;"><a href="#">red</a></li>
                    </ul>
                  </div>
                </div> -->
                <div class="attributes">
                  <div class="attribute-label">Qty:</div>

                  <form class="" id="cart_form">
                    <div style="padding:5px;" class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
                    <input type="number" name="quantity" id="number" value="1" />
                    <div style="padding:5px;" class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+</div>
                    <input type="hidden" name="product_id" value="<?php echo $product->product_id; ?>"/>
                    <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('id'); ?>"/>
                    <input type="hidden" name="product_name" value="<?php echo $product->product_name; ?>"/>
                    <input type="hidden" name="net_price" value="<?php echo $product->net_price; ?>"/>
                    <input type="hidden" name="product_img" value="<?php echo $product->product_img; ?>"/>
                  </form>

                </div>
                <!-- <div class="attributes">
                  <div class="attribute-label">Size:</div>
                  <div class="attribute-list">
                    <select>
                      <option value="1">X</option>
                      <option value="2">XL</option>
                      <option value="3">XXL</option>
                    </select>
                  </div>
                </div> -->
              </div>
              <div class="form-action">
                <div class="button-group">
                    <button class="btn-add-cart" type="button" id="addtocart">Add to cart</button>
                </div>
                <div class="button-group">
                  <a class="wishlist" href="#"><i class="fa fa-heart-o"></i>
                    <br>Wishlist</a>
                    <a class="compare" href="#"><i class="fa fa-signal"></i>
                      <br>
                      Compare</a>
                    </div>
                  </div>

                </div>
              </div>
              <!-- tab product -->
              <div class="product-tab">
                <ul class="nav-tab">
                  <li class="active">
                    <a aria-expanded="false" data-toggle="tab" href="#product-detail">Product Details</a>
                  </li>
                  <li>
                    <a aria-expanded="true" data-toggle="tab" href="#information">information</a>
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
                    <?php if($product->description){ ?>
                      <p><?php echo $product->description; ?></p>
                    <?php } else { ?>
                      <p><h6>No product description</h6></p>
                    <?php } ?>
                    <!-- <p>Morbi mollis tellus ac sapien. Nunc nec neque. Praesent nec nisl a purus blandit viverra. Nunc nec neque. Pellentesque auctor neque nec urna.</p>

                    <p>Curabitur suscipit suscipit tellus. Cras id dui. Nam ipsum risus, rutrum vitae, vestibulum eu, molestie vel, lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Maecenas vestibulum mollis diam.</p>

                    <p>Vestibulum facilisis, purus nec pulvinar iaculis, ligula mi congue nunc, vitae euismod ligula urna in dolor. Sed lectus. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Nam at tortor in tellus interdum sagittis. Pellentesque egestas, neque sit amet convallis pulvinar, justo nulla eleifend augue, ac auctor orci leo non est.</p> -->
                  </div>
                  <div id="information" class="tab-panel">
                    <table class="table table-bordered">
                      <tr>
                        <td width="200">Compositions</td>
                        <td>Cotton</td>
                      </tr>
                      <tr>
                        <td>Styles</td>
                        <td>Girly</td>
                      </tr>
                      <tr>
                        <td>Properties</td>
                        <td>Colorful Dress</td>
                      </tr>
                    </table>
                  </div>
                  <div id="reviews" class="tab-panel">
                    <div class="product-comments-block-tab">
                      <div class="comment row">
                        <div class="col-sm-3 author">
                          <div class="grade">
                            <span>Grade</span>
                            <span class="reviewRating">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                            </span>
                          </div>
                          <div class="info-author">
                            <span><strong>Jame</strong></span>
                            <em>04/08/2015</em>
                          </div>
                        </div>
                        <div class="col-sm-9 commnet-dettail">
                          Phasellus accumsan cursus velit. Pellentesque egestas, neque sit amet convallis pulvinar
                        </div>
                      </div>
                      <div class="comment row">
                        <div class="col-sm-3 author">
                          <div class="grade">
                            <span>Grade</span>
                            <span class="reviewRating">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                            </span>
                          </div>
                          <div class="info-author">
                            <span><strong>Author</strong></span>
                            <em>04/08/2015</em>
                          </div>
                        </div>
                        <div class="col-sm-9 commnet-dettail">
                          Phasellus accumsan cursus velit. Pellentesque egestas, neque sit amet convallis pulvinar
                        </div>
                      </div>
                      <p>
                        <a class="btn-comment" href="#">Write your review !</a>
                      </p>
                    </div>

                  </div>

                  <div id="guarantees" class="tab-panel">
                    <p>Phasellus accumsan cursus velit. Pellentesque egestas, neque sit amet convallis pulvinar, justo nulla eleifend augue, ac auctor orci leo non est. Sed lectus. Sed a libero. Vestibulum eu odio.</p>

                    <p>Maecenas vestibulum mollis diam. In consectetuer turpis ut velit. Curabitur at lacus ac velit ornare lobortis. Praesent ac sem eget est egestas volutpat. Nam eget dui.</p>

                    <p>Maecenas nec odio et ante tincidunt tempus. Vestibulum suscipit nulla quis orci. Aenean tellus metus, bibendum sed, posuere ac, mattis non, nunc. Aenean ut eros et nisl sagittis vestibulum. Aliquam eu nunc.</p>
                    <p>Maecenas vestibulum mollis diam. In consectetuer turpis ut velit. Curabitur at lacus ac velit ornare lobortis. Praesent ac sem eget est egestas volutpat. Nam eget dui.</p>
                  </div>
                </div>
              </div>
              <!-- ./tab product -->
              <!-- box product -->
              <div class="page-product-box">
                <h3 class="heading">Related Products</h3>
                <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "30" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":3}}'>
                  <!-- <li>
                    <div class="product-container">
                      <div class="left-block">
                        <a href="#">
                          <img class="img-responsive" alt="product" src="assets/data/milkbrand1.png" />
                        </a>
                        <div class="quick-view">
                          <a title="Add to my wishlist" class="heart" href="#"></a>
                          <a title="Add to compare" class="compare" href="#"></a>

                        </div>
                        <div class="add-to-cart">
                          <a title="Add to Cart" href="#add">Add to Cart</a>
                        </div>
                      </div>
                      <div class="right-block">
                        <h5 class="product-name"><a href="#">Heritage milk</a></h5>
                        <div class="product-star">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star-half-o"></i>
                        </div>
                        <div class="content_price">
                          <span class="price product-price">₹38,95</span>
                          <span class="price old-price">₹52,00</span>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="product-container">
                      <div class="left-block">
                        <a href="#">
                          <img class="img-responsive" alt="product" src="assets/data/milkbrand2.png" />
                        </a>
                        <div class="quick-view">
                          <a title="Add to my wishlist" class="heart" href="#"></a>
                          <a title="Add to compare" class="compare" href="#"></a>

                        </div>
                        <div class="add-to-cart">
                          <a title="Add to Cart" href="#add">Add to Cart</a>
                        </div>
                      </div>
                      <div class="right-block">
                        <h5 class="product-name"><a href="#">Thirumala milk</a></h5>
                        <div class="product-star">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star-half-o"></i>
                        </div>
                        <div class="content_price">
                          <span class="price product-price">₹38,95</span>
                          <span class="price old-price">₹52,00</span>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="product-container">
                      <div class="left-block">
                        <a href="#">
                          <img class="img-responsive" alt="product" src="assets/data/grocery-img1.png" />
                        </a>
                        <div class="quick-view">
                          <a title="Add to my wishlist" class="heart" href="#"></a>
                          <a title="Add to compare" class="compare" href="#"></a>

                        </div>
                        <div class="add-to-cart">
                          <a title="Add to Cart" href="#add">Add to Cart</a>
                        </div>
                      </div>
                      <div class="right-block">
                        <h5 class="product-name"><a href="#">Fortune Oil</a></h5>
                        <div class="product-star">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star-half-o"></i>
                        </div>
                        <div class="content_price">
                          <span class="price product-price">₹38,95</span>
                          <span class="price old-price">₹52,00</span>
                        </div>
                      </div>
                    </div>
                  </li> -->
                  <li>
                    <div class="product-container">
                      <div class="left-block">
                        <a href="#">
                          <img class="img-responsive" alt="product" src="assets/data/grocery-img2.png" />
                        </a>
                        <div class="quick-view">
                          <a title="Add to my wishlist" class="heart" href="#"></a>
                          <a title="Add to compare" class="compare" href="#"></a>

                        </div>
                        <!-- <div class="add-to-cart">
                          <a title="Add to Cart" href="#add">Add to Cart</a>
                        </div> -->
                      </div>
                      <div class="right-block">
                        <h5 class="product-name"><a href="#">Green Grams</a></h5>
                        <div class="product-star">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star-half-o"></i>
                        </div>
                        <div class="content_price">
                          <span class="price product-price">₹38,95</span>
                          <span class="price old-price">₹52,00</span>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
              <!-- ./box product -->
              <!-- box product -->
              <div class="page-product-box">
                <h3 class="heading">You might also like</h3>
                <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "30" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":3}}'>
                  <li>
                    <div class="product-container">
                      <div class="left-block">
                        <a href="#">
                          <img class="img-responsive" alt="product" src="assets/data/grocery-img3.png" />
                        </a>
                        <div class="quick-view">
                          <a title="Add to my wishlist" class="heart" href="#"></a>
                          <a title="Add to compare" class="compare" href="#"></a>

                        </div>
                        <!-- <div class="add-to-cart">
                          <a title="Add to Cart" href="#add">Add to Cart</a>
                        </div> -->
                      </div>
                      <div class="right-block">
                        <h5 class="product-name"><a href="#">Red Dal</a></h5>
                        <div class="product-star">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star-half-o"></i>
                        </div>
                        <div class="content_price">
                          <span class="price product-price">₹38,95</span>
                          <span class="price old-price">₹52,00</span>
                        </div>
                      </div>
                    </div>
                  </li>
                  <!-- <li>
                    <div class="product-container">
                      <div class="left-block">
                        <a href="#">
                          <img class="img-responsive" alt="product" src="assets/data/grocery-img4.png" />
                        </a>
                        <div class="quick-view">
                          <a title="Add to my wishlist" class="heart" href="#"></a>
                          <a title="Add to compare" class="compare" href="#"></a>

                        </div>
                        <div class="add-to-cart">
                          <a title="Add to Cart" href="#add">Add to Cart</a>
                        </div>
                      </div>
                      <div class="right-block">
                        <h5 class="product-name"><a href="#">KamaSutra </a></h5>
                        <div class="product-star">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star-half-o"></i>
                        </div>
                        <div class="content_price">
                          <span class="price product-price">₹38,95</span>
                          <span class="price old-price">₹52,00</span>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="product-container">
                      <div class="left-block">
                        <a href="#">
                          <img class="img-responsive" alt="product" src="assets/data/waterimg1.jpg" />
                        </a>
                        <div class="quick-view">
                          <a title="Add to my wishlist" class="heart" href="#"></a>
                          <a title="Add to compare" class="compare" href="#"></a>

                        </div>
                        <div class="add-to-cart">
                          <a title="Add to Cart" href="#add">Add to Cart</a>
                        </div>
                      </div>
                      <div class="right-block">
                        <h5 class="product-name"><a href="#">Water Can</a></h5>
                        <div class="product-star">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star-half-o"></i>
                        </div>
                        <div class="content_price">
                          <span class="price product-price">₹38,95</span>
                          <span class="price old-price">₹52,00</span>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="product-container">
                      <div class="left-block">
                        <a href="#">
                          <img class="img-responsive" alt="product" src="assets/data/waterimg2.jpeg" />
                        </a>
                        <div class="quick-view">
                          <a title="Add to my wishlist" class="heart" href="#"></a>
                          <a title="Add to compare" class="compare" href="#"></a>

                        </div>
                        <div class="add-to-cart">
                          <a title="Add to Cart" href="#add">Add to Cart</a>
                        </div>
                      </div>
                      <div class="right-block">
                        <h5 class="product-name"><a href="#">Cool Water Can</a></h5>
                        <div class="product-star">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star-half-o"></i>
                        </div>
                        <div class="content_price">
                          <span class="price product-price">₹38,95</span>
                          <span class="price old-price">₹52,00</span>
                        </div>
                      </div>
                    </div>
                  </li> -->
                </ul>
              </div>
              <!-- ./box product -->
            </div>
            <!-- Product -->
          </div>
          <!-- ./ Center colunm -->
        </div>
        <!-- ./row-->
      </div>
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
