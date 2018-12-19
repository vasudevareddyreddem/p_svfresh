
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/lib/bootstrap/css/bootstrap.min.css'); ?>" />
		<link rel="icon" href="<?php base_url('assets/images/fav.png'); ?>" >

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/lib/font-awesome/css/font-awesome.min.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/lib/select2/css/select2.min.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/lib/jquery.bxslider/jquery.bxslider.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/lib/owl.carousel/owl.carousel.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/lib/jquery-ui/jquery-ui.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/animate.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/reset.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/u-style.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/responsive.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/sweetalert.min.css'); ?>">

    <title>SV Fresh | <?php echo $pageTitle; ?></title>
</head>
<body class="home">

<div id="header" class="header">
    <div class="top-header">
        <div class="container">
            <div class="nav-top-links">
                <a class="first-item" href="#"><img alt="phone" src="<?php echo base_url('assets/images/phone.png'); ?>" />850022xxxx</a>
                <a href=""><img alt="email" src="<?php echo base_url('assets/images/email.png'); ?>" />info@svfresh.com</a>
            </div>
            <div class="currency ">
                <div class="dropdown">
                      <a class="current-open" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">USD</a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Dollar</a></li>
                        <li><a href="#">Rupee</a></li>
                      </ul>
                </div>
            </div>
            <div class="support-link">
                <a href="#">Services</a>
                <a href="#">Support</a>
            </div>

            <div id="user-info-top" class="user-info pull-right">
                <div class="dropdown">
                    <a class="current-open" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><span>My Account</span></a>
                    <ul class="dropdown-menu mega_dropdown" role="menu">
                        <?php if($this->session->userdata('logged_in') == TRUE){ ?>
                        <li><a href="<?php echo base_url('home/logout'); ?>">Logout</a></li>
                        <?php }else{ ?>
                        <li><a href="<?php echo base_url('home/login'); ?>">Login</a></li>
                        <?php } ?>
                        <li><a href="<?php echo base_url('order'); ?>">Orders</a></li>
                        <li><a href="<?php echo base_url('order/milk_orders'); ?>">Milk Orders</a></li>
                        <!-- <li><a href="">Compare</a></li> -->
                        <li><a href="<?php echo base_url('wishlist'); ?>">Wishlists</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--/.top-header -->
    <!-- MAIN HEADER -->
	 <div class=" main-header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-3 logo">
                <a href="<?php echo base_url('home'); ?>"><img  style="height:70px;width:auto;"alt="SV Fresh" src="<?php echo base_url('assets/images/logo.png'); ?>" /></a>
            </div>
            <div class="col-xs-7 col-sm-7 header-search-box">
                <form class="form-inline" method="post" action="<?php echo base_url('home/search'); ?>">

                      <div class="form-group input-serach">
                        <input class="palce-hold-col"  id="search_value" name="search_value"  style="color:#fff;line-height:40px;" type="text"  placeholder="Keyword here...">
						<input  type="hidden" name="search_key" id="search_key" value="">
					 </div>
                      <button type="submit" class="pull-right btn-search"></button>
                </form>
            </div>
            <div id="cart-block" class="col-xs-5 col-sm-2 shopping-cart-box">
                <a class="cart-link" <?php if($count > 0){ ?>href="<?php echo base_url('Checkout'); ?>"<?php }else{ ?> href="#" <?php } ?>>
                    <span class="title">Shopping cart</span>
                    <span class="total"><span class="cart_count" id="cart_count"><?php if($count){echo $count;}else{ echo '0'; } ?></span> items</span>
                    <span class="notify notify-left"><span class="cart_count" id="cart_count1"><?php if($count){echo $count;}else{ echo '0'; } ?></span></span>
                </a>
                <div class="cart-block">
                    <div class="cart-block-content">
                        <h5 class="cart-title"><span class="cart_count" id="cart_count2"><?php if($count){echo $count;}else{ echo '0'; } ?></span> Items in my cart</h5>
                        <div class="cart-block-list">
                            <ul id="cart_template">
                                <?php echo $cart_template; ?>
                                <!-- <li class="product-info">
                                    <div class="p-left">
                                        <a href="#" class="remove_link"></a>
                                        <a href="#">
                                        <img class="img-responsive" src="<?php base_url('assets/data/fruits-img2.png'); ?>" alt="p10">
                                        </a>
                                    </div>
                                    <div class="p-right">
                                        <p class="p-name">Donec Ac Tempus</p>
                                        <p class="p-rice">₹ 61,19 </p>
                                        <p>Qty: 1</p>
                                    </div>
                                </li> -->
                            </ul>
                        </div>
                        <!-- <div class="toal-cart">
                            <span>Total</span>
                            <span class="toal-price pull-right">₹ 122.38 </span>
                        </div> -->
                        <?php if ($count > 0) { ?>
                          <div class="cart-buttons">
                              <a href="<?php echo base_url('checkout'); ?>" class="btn-check-out">Checkout</a>
                          </div>
                        <?php }else{ ?>
                          <div class="cart-buttons">
                              <a href="<?php echo base_url('checkout'); ?>" class="btn-check-out">Checkout</a>
                          </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    <!-- END MANIN HEADER -->
	<div id="nav-top-menu" class="nav-top-menu">
        <div class="container">
            <div class="">
                <div id="main-menu" class="col-md-9  ">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <a class="navbar-brand" href="#">MENU</a>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                              <?php //if($this->session->userdata('logged_in') == TRUE){ ?>
                                <ul class="nav navbar-nav">
                                    <li <?php if(!empty($id)){ echo 'class=" "'; } else { echo 'class="active"'; } ?>><a href="<?php echo base_url('home'); ?>">Home</a></li>
                                    <?php if(count($categories) > 0){ ?>
                                      <?php foreach ($categories as $c) { ?>
                                        <li <?php if(!empty($id) && ($id == $c->cat_id)){ echo 'class="active"'; } else { echo 'class=" "'; } ?>><a href="<?php echo base_url('category/'.$c->cat_id); ?>"><?php echo $c->cat_name; ?></a></li>
                                      <?php  } ?>
                                    <?php } ?>
                  									<!-- <li class=""><a href="#">Grocery </a></li>
                  									<li class=""><a href="milk-category.php">Milk </a></li>
                  									<li class=""><a href="#">Water can </a></li> -->
                                </ul>
                              <?php //} ?>
                            </div><!--/.nav-collapse -->
                        </div>
                    </nav>
                </div>
            </div>
            <!-- userinfo on top-->
            <div id="form-search-opntop">
            </div>
            <!-- userinfo on top-->
            <div id="user-info-opntop">
            </div>
            <!-- CART ICON ON MMENU -->
            <div id="shopping-cart-box-ontop">
                <i class="fa fa-shopping-cart"></i>
                <div class="shopping-cart-box-ontop-content"></div>
            </div>
        </div>
    </div>
</div>
 <div id="sucessmsg" style=""></div>
  <?php if($this->session->flashdata('success')): ?>
        <div class="alert_msg1 animated slideInUp bg-succ">
            <?php echo $this->session->flashdata('success');?> &nbsp; <i class="fa fa-check text-success ico_bac" aria-hidden="true"></i> </div>
        <?php endif; ?>
        <?php if($this->session->flashdata('error')): ?>
        <div class="alert_msg1 animated slideInUp bg-warn">
            <?php echo $this->session->flashdata('error');?> &nbsp; <i class="fa fa-exclamation-triangle text-success ico_bac" aria-hidden="true"></i> </div>
        <?php endif; ?>
