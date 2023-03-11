
<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>

<!-- Topbar Search -->
<!-- <form
    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
            aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-primary" type="button">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>
</form> -->

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <!-- <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
        </a>
        Dropdown - Messages
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
            aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small"
                        placeholder="Search for..." aria-label="Search"
                        aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </li> -->

    <!-- Nav Item - Contact us -->
    <li class="nav-item dropdown no-arrow mx-1">
        <?php
            $contact_us_query = "select * from contact_us where status='0'";  
            $contact_us_query_run = mysqli_query($con, $contact_us_query);
            if($contact_us_query_count=mysqli_num_rows($contact_us_query_run)){?>
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    <!-- Counter - Alerts -->
                    <span class="badge badge-danger badge-counter"><?php echo $contact_us_query_count ?></span>
                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">
                        Contact Us
                    </h6>
                    <?php while($contact_us_query_row=mysqli_fetch_assoc($contact_us_query_run)){ ?>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500"><?php echo 'By-'.$contact_us_query_row['name'].' on '.date("d-M-Y",strtotime($contact_us_query_row['added_on'])) ?></div>
                                <span class="font-weight-bold"><?php echo substr($contact_us_query_row['comment'],0,35).'...' ?></span>
                            </div>
                        </a>
                    <?php } ?>
                    <a class="dropdown-item text-center small text-gray-500" href="<?php echo SITE_PATH ?>admin/contactResponses.php">View All</a>
                </div>
        <?php } ?>
    </li>

    <!-- Nav Item - Product Review -->
    <li class="nav-item dropdown no-arrow mx-1">
        <?php
            $product_review_query = "select `product_review`.*,`users`.id,`users`.name as username from product_review,users where product_review.status='0' and product_review.user_id=users.id";  
            $product_review_query_run = mysqli_query($con, $product_review_query);
            if($product_review_query_count=mysqli_num_rows($product_review_query_run)){?>
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-clipboard fa-fw"></i>
                    <!-- Counter - Alerts -->
                    <span class="badge badge-danger badge-counter"><?php echo $contact_us_query_count ?></span>
                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">
                        Product Reviews
                    </h6>
                    <?php while($product_review_query_row=mysqli_fetch_assoc($product_review_query_run)){ ?>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500"><?php echo 'By-'.$product_review_query_row['username'].' on '.date("d-M-Y",strtotime($product_review_query_row['added_on'])) ?></div>
                                <span class="font-weight-bold"><?php echo substr($product_review_query_row['review'],0,35).'...' ?></span>
                            </div>
                        </a>
                    <?php } ?>
                    <a class="dropdown-item text-center small text-gray-500" href="<?php echo SITE_PATH ?>admin/reviews.php">View All</a>
                </div>
        <?php } ?>
    </li>
    <!-- Nav Item - Get In Touch -->
    <li class="nav-item dropdown no-arrow mx-1">
        <?php
            $get_in_touch_query = "SELECT * FROM `get_in_touch` WHERE `get_in_touch_satus`=0";  
            $get_in_touch_query_run = mysqli_query($con, $get_in_touch_query);
            if($get_in_touch_query_count=mysqli_num_rows($get_in_touch_query_run)){?>
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    <!-- Counter - Alerts -->
                    <span class="badge badge-danger badge-counter"><?php echo $get_in_touch_query_count ?></span>
                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">
                        Get in touch
                    </h6>
                    <?php while($get_in_touch_query_row=mysqli_fetch_assoc($get_in_touch_query_run)){ ?>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-file-alt text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500"><?php echo 'By-'.$get_in_touch_query_row['get_in_touch_name'].' on '.date("d-M-Y",strtotime($get_in_touch_query_row['added_on'])) ?></div>
                            <span class="font-weight-bold"><?php echo substr($get_in_touch_query_row['get_in_touch_message'],0,35).'...' ?></span>
                        </div>
                    </a>
                    <?php } ?>
                    <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                </div>        
        <?php } ?>
    </li>
    <!-- Nav Item - Orders -->
    <li class="nav-item dropdown no-arrow mx-1">
        <?php
            $get_orders_query = "SELECT orders.*,users.name from orders,users where orders.user_id=users.id and orders.order_status=1";  
            $get_orders_query_run = mysqli_query($con, $get_orders_query);
            if($get_orders_query_count=mysqli_num_rows($get_orders_query_run)){?>
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    <!-- Counter - Alerts -->
                    <span class="badge badge-danger badge-counter"><?php echo $get_orders_query_count ?></span>
                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">
                        New Orders
                    </h6>
                    <?php while($get_orders_query_row=mysqli_fetch_assoc($get_orders_query_run)){ ?>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-file-alt text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500"><?php echo 'By-'.$get_orders_query_row['name'].' on '.date("d-M-Y",strtotime($get_orders_query_row['added_on'])) ?></div>
                            <span class="font-weight-bold">Payment Type - <?php echo $get_orders_query_row['payment_type'] ?></span>
                        </div>
                    </a>
                    <?php } ?>
                    <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                </div>        
        <?php } ?>
    </li>

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['ADMIN_USERNAME'] ?></span>
            <img class="img-profile rounded-circle"
                src="assets/img/undraw_profile.svg">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            <a class="dropdown-item" href="../">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Main Site
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
            </a>
        </div>
    </li>

</ul>

</nav>
<!-- End of Topbar -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
