

<div class="main-content">
    <section class="section">
        <h1 class="section-header">
            <div>Dashboard</div>
        </h1>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <div class="card card-sm-3">
                    <div class="card-icon bg-primary">
                        <i class="ion ion-pricetags"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Categories</h4>
                        </div>
                        <div class="card-body">
                           <?php echo $cat_count;?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="card card-sm-3">
                    <div class="card-icon bg-danger">
                        <i class="ion ion-ios-albums-outline"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Products</h4>
                        </div>
                        <div class="card-body">
                           <?php echo $products_count;?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="card card-sm-3">
                    <div class="card-icon bg-warning">
                        <i class="ion ion-ios-cart"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Orders</h4>
                        </div>
                        <div class="card-body">
                         <?php echo $orders_count;?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="card card-sm-3">
                    <div class="card-icon bg-success">
                        <i class="ion ion-person"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Customers</h4>
                        </div>
                        <div class="card-body">
                           <?php echo $users_count;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
    </section>
</div>

