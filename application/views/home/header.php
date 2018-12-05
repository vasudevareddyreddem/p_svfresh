
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
                        <li><a href="orders.php">Orders</a></li>
                        <li><a href="">Compare</a></li>
                        <li><a href="whishlist.php">Wishlists</a></li>
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
                <form class="form-inline">
                      <div class="form-group form-category">
                        <select class="select-category">
                            <option value="2">All Categories</option>
                            <option value="1">Fruits & Vegetables</option>
                            <option value="2">grocery</option>
                            <option value="2">Milk</option>
                            <option value="2">water</option>
                        </select>
                      </div>
                      <div class="form-group input-serach">
                        <input class="palce-hold-col" style="color:#fff" type="text"  placeholder="Keyword here...">
                      </div>
                      <button type="submit" class="pull-right btn-search"></button>
                </form>
            </div>
            <div id="cart-block" class="col-xs-5 col-sm-2 shopping-cart-box">
                <a class="cart-link" href="">
                    <span class="title">Shopping cart</span>
                    <span class="total">2 items - ₹ 22.38 </span>
                    <span class="notify notify-left">2</span>
                </a>
                <div class="cart-block">
                    <div class="cart-block-content">
                        <h5 class="cart-title">2 Items in my cart</h5>
                        <div class="cart-block-list">
                            <ul>
                                <li class="product-info">
                                    <div class="p-left">
                                        <a href="#" class="remove_link"></a>
                                        <a href="#">
                                        <img class="img-responsive" src="<?php echo base_url('assets/data/milkbrand1.png');?>" alt="item 1">
                                        </a>
                                    </div>
                                    <div class="p-right">
                                        <p class="p-name">Donec Ac Tempus</p>
                                        <p class="p-rice">₹ 61,19 </p>
                                        <p>Qty: 1</p>
                                    </div>
                                </li>
                                <li class="product-info">
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
                                </li>
                            </ul>
                        </div>
                        <div class="toal-cart">
                            <span>Total</span>
                            <span class="toal-price pull-right">₹ 122.38 </span>
                        </div>
                        <div class="cart-buttons">
                            <a href="checkout.php" class="btn-check-out">Checkout</a>
                        </div>
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
                                    <li class="active"><a href="<?php echo base_url('home'); ?>">Home</a></li>
                                    <?php if(count($categories) > 0){ ?>
                                      <?php foreach ($categories as $c) { ?>
                                        <li class=""><a href="<?php echo base_url('category/'.$c->cat_id); ?>"><?php echo $c->cat_name; ?></a></li>
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
<!-- end header -->
