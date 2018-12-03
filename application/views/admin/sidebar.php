<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?php echo base_url('admin');?>">SV Fresh</a>
        </div>
        <div class="sidebar-user">
            <div class="sidebar-user-picture">
                <img alt="image" src="<?php echo base_url().'assets/img/avatar/avatar-1.jpeg';?>">
            </div>
            <div class="sidebar-user-details">
                <div class="user-name"><?php $admin=$this->session->userdata('svadmin_det');
				echo $admin['login_email'];?>
				</div>
                <div class="user-role">
                    Administrator
                </div>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="active">
                <a href="<?php echo base_url('admin');?>"><i class="ion ion-speedometer"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a href="#" class="has-dropdown"><i class="ion ion-pricetags"></i><span>Categories</span></a>
                <ul class="menu-dropdown">
                    <li><a href="<?php echo base_url('category/add_category');?>"><i class="ion ion-ios-circle-outline"></i>Add Category</a></li>
                    <li><a href="<?php echo base_url('category/category_list');?>"><i class="ion ion-ios-circle-outline"></i>Categories List</a></li>
                    <li><a href="<?php echo base_url('category/add_sub_category');?>"><i class="ion ion-ios-circle-outline"></i>Add Sub Category</a></li>
                    <li><a href="<?php echo base_url('category/sub_category_list');?>"><i class="ion ion-ios-circle-outline"></i>Sub Categories List</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="has-dropdown"><i class="ion ion-ios-albums-outline"></i><span>Products</span></a>
                <ul class="menu-dropdown">
                    <li><a href="<?php echo base_url('product/add_product');?>"><i class="ion ion-ios-circle-outline"></i>Add Product</a></li>
                    <li><a href="<?php echo base_url('admin/product_list');?>"><i class="ion ion-ios-circle-outline"></i>Products List</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="has-dropdown"><i class="ion ion-ios-cart"></i><span>Orders</span></a>
                <ul class="menu-dropdown">
                    <li><a href="<?php echo base_url('admin/total_order_list');?>"><i class="ion ion-ios-circle-outline"></i>Total Orders List</a></li>
                    <li><a href="<?php echo base_url('admin/pending_order_list');?>"><i class="ion ion-ios-circle-outline"></i>Pending Order List</a></li>
                    <li><a href="<?php echo base_url('admin/delivered_order_list');?>"><i class="ion ion-ios-circle-outline"></i>Delivered Order List</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="has-dropdown"><i class="ion ion-ios-copy-outline"></i><span>Pages</span></a>
                <ul class="menu-dropdown">
                    <li><a href="login.php"><i class="ion ion-ios-circle-outline"></i> Login</a></li>
                    <li><a href="register.php"><i class="ion ion-ios-circle-outline"></i> Register</a></li>
                    <li><a href="forgot.php"><i class="ion ion-ios-circle-outline"></i> Forgot Password</a></li>
                    <li><a href="reset.php"><i class="ion ion-ios-circle-outline"></i> Reset Password</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>