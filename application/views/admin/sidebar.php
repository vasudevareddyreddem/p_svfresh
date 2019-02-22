<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?php echo base_url('admin');?>">SV Fresh</a>
        </div>
        <div class="sidebar-user">
            <div class="sidebar-user-picture">
                <img alt="image" src="<?php
				$admin=$this->session->userdata('svadmin_det');
				if($admin['profile_pic']=='')
				{echo base_url().'assets/uploads/profile_pics/profilepic.png';}
			else{
				echo base_url().'assets/uploads/profile_pics/'.$admin['profile_pic'];
			}?>">
            </div>
            <div class="sidebar-user-details">
                <div class="user-name"><?php
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
                <a href="#" class="has-dropdown"><i class="ion ion-pricetags"></i><span>Main Sliders</span></a>
                <ul class="menu-dropdown">
                    <li><a href="<?php  echo base_url('slider/addslider'); ?>"><i class="ion ion-ios-circle-outline"></i>Add Slider</a></li>
                    <li><a href="<?php  echo base_url('slider/slider_list'); ?>"><i class="ion ion-ios-circle-outline"></i>Slider List</a></li>

                </ul>
            </li>
            <li>
                <a href="#" class="has-dropdown"><i class="ion ion-pricetags"></i><span>Categories</span></a>
                <ul class="menu-dropdown">
                    <li><a href="<?php echo base_url('category/add_category');?>"><i class="ion ion-ios-circle-outline"></i>Add Category</a></li>
                    <li><a href="<?php echo base_url('category/category_list');?>"><i class="ion ion-ios-circle-outline"></i>Categories List</a></li>
					 <li><a href="<?php echo base_url('category/add_discount_image');?>"><i class="ion ion-ios-circle-outline"></i> Add Discount Image</a></li>
                    <li><a href="<?php echo base_url('category/add_sub_category');?>"><i class="ion ion-ios-circle-outline"></i>Add Sub Category</a></li>
					<li><a href="<?php echo base_url('category/sub_category_list');?>"><i class="ion ion-ios-circle-outline"></i>Sub Categories List</a></li>
					 <li><a href="<?php echo base_url('category/add_subcategory_slider');?>"><i class="ion ion-ios-circle-outline"></i>Add Sub Category Slider</a></li>
					  <li><a href="<?php echo base_url('category/subcat_slider_list');?>"><i class="ion ion-ios-circle-outline"></i> Sub Category Slider List</a></li>

                </ul>
            </li>
            <li>
                <a href="#" class="has-dropdown"><i class="ion ion-ios-albums-outline"></i><span>Products</span></a>
                <ul class="menu-dropdown">
                    <li><a href="<?php echo base_url('product/add_product');?>"><i class="ion ion-ios-circle-outline"></i>Add Product</a></li>
                    <li><a href="<?php echo base_url('product/product_list');?>"><i class="ion ion-ios-circle-outline"></i>Products List</a></li>

                </ul>
            </li>
            <li>
                <a href="#" class="has-dropdown"><i class="ion ion-ios-cart"></i><span>Orders</span></a>
                <ul class="menu-dropdown">
                    <li><a href="<?php echo base_url('orders/total_order_list');?>"><i class="ion ion-ios-circle-outline"></i>Total Orders List</a></li>
                    <li><a href="<?php echo base_url('orders/pending_order_list');?>"><i class="ion ion-ios-circle-outline"></i>Pending Order List</a></li>
                    <li><a href="<?php echo base_url('orders/delivered_order_list');?>"><i class="ion ion-ios-circle-outline"></i>Delivered Order List</a></li>
					<li><a href="<?php echo base_url('orders/cancel_order_list');?>"><i class="ion ion-ios-circle-outline"></i>Canceled Order List</a></li>

                </ul>
            </li>
			  <li>
                <a href="#" class="has-dropdown"><i class="ion ion-ios-cart"></i><span>Milk Orders</span></a>
                <ul class="menu-dropdown">
                    <li><a href="<?php echo base_url('milkorder/total_order_list');?>"><i class="ion ion-ios-circle-outline"></i>Total Orders List</a></li>
                    <li><a href="<?php echo base_url('milkorder/pending_order_list');?>"><i class="ion ion-ios-circle-outline"></i>Pending Order List</a></li>
                    <li><a href="<?php echo base_url('milkorder/delivered_order_list');?>"><i class="ion ion-ios-circle-outline"></i>Delivered Order List</a></li>
					<li><a href="<?php echo base_url('milkorder/cancel_order_list');?>"><i class="ion ion-ios-circle-outline"></i>Canceled Order List</a></li>
              <li><a href="<?php echo base_url('milkorder/boys_list');?>"><i class="ion ion-ios-circle-outline"></i>Boys Apartment List</a></li>
              <li><a href="<?php echo base_url('milkorder/total_order_list');?>"><i class="ion ion-ios-circle-outline"></i>Payments</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="has-dropdown"><i class="ion ion-pricetags"></i><span>Apartments</span></a>
                <ul class="menu-dropdown">
                    <li><a href="<?php  echo base_url('apartment/add_apartment'); ?>"><i class="ion ion-ios-circle-outline"></i>Add Apartment</a></li>
                    <li><a href="<?php  echo base_url('apartment/apartment_list'); ?>"><i class="ion ion-ios-circle-outline"></i>Apartment List</a></li>
                    <li><a href="<?php  echo base_url('apartment/add_block'); ?>"><i class="ion ion-ios-circle-outline"></i>Add Block</a></li>
                    <li><a href="<?php  echo base_url('apartment/block_list'); ?>"><i class="ion ion-ios-circle-outline"></i>Block List</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="has-dropdown"><i class="ion ion-pricetags"></i><span>Users</span></a>
                <ul class="menu-dropdown">
                    <li><a href="<?php  echo base_url('user/add_user'); ?>"><i class="ion ion-ios-circle-outline"></i>Add User</a></li>
                    <li><a href="<?php  echo base_url('user/user_list'); ?>"><i class="ion ion-ios-circle-outline"></i>User List</a></li>
                    <li><a href="<?php  echo base_url('user/add_address'); ?>"><i class="ion ion-ios-circle-outline"></i>Add Address</a></li>
                    <li><a href="<?php  echo base_url('user/address_list'); ?>"><i class="ion ion-ios-circle-outline"></i>Address List</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
