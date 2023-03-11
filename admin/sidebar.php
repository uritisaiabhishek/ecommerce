
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo SITE_PATH ?>admin">
                <?php echo SITE_NAME ?>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <?php if($_SESSION['ADMIN_ROLE']==0){ ?>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <?php } ?>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Main
            </div>

            <?php if($_SESSION['ADMIN_ROLE']==0){ ?>
            <!-- Nav Item - Categories Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Categories</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Categories:</h6>
                        <a class="collapse-item" href="categories.php">List</a>
                        <a class="collapse-item" href="addCategory.php">Add New</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Color master Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#colormaster"
                    aria-expanded="true" aria-controls="colormaster">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Color</span>
                </a>
                <div id="colormaster" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Colors:</h6>
                        <a class="collapse-item" href="categories.php">List</a>
                        <a class="collapse-item" href="addCategory.php">Add New</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Size master Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sizemaster"
                    aria-expanded="true" aria-controls="sizemaster">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Size</span>
                </a>
                <div id="sizemaster" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Colors:</h6>
                        <a class="collapse-item" href="categories.php">List</a>
                        <a class="collapse-item" href="addCategory.php">Add New</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Categories Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#subcategories"
                    aria-expanded="true" aria-controls="subcategories">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Sub Categories</span>
                </a>
                <div id="subcategories" class="collapse" aria-labelledby="subcategoriesheading" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Sub Categories:</h6>
                        <a class="collapse-item" href="sub_categories.php">List</a>
                        <a class="collapse-item" href="addSubCategory.php">Add New</a>
                    </div>
                </div>
            </li>
            <?php } ?>
            <?php if($_SESSION['ADMIN_ROLE']==1||$_SESSION['ADMIN_ROLE']==0){ ?>
            <!-- Nav Item - Products Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts"
                    aria-expanded="true" aria-controls="collapseProducts">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Products</span>
                </a>
                <div id="collapseProducts" class="collapse" aria-labelledby="headingProducts"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Products:</h6>
                        <a class="collapse-item" href="products.php">Products List</a>
                        <a class="collapse-item" href="addProduct.php">Add New</a>
                    </div>
                </div>
            </li>
            <?php } ?>
            <?php if($_SESSION['ADMIN_ROLE']==0){ ?>
            <!-- Nav Item - Categories Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#banner"
                    aria-expanded="true" aria-controls="banner">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Banner</span>
                </a>
                <div id="banner" class="collapse" aria-labelledby="headingbanner" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Banner:</h6>
                        <a class="collapse-item" href="banner.php">Banner</a>
                        <a class="collapse-item" href="manage_banner.php">Manage</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Categories Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#coupons"
                    aria-expanded="true" aria-controls="coupons">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Coupons</span>
                </a>
                <div id="coupons" class="collapse" aria-labelledby="headingcoupons" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Coupons:</h6>
                        <a class="collapse-item" href="coupons.php">List</a>
                        <a class="collapse-item" href="addCoupon.php">Add New</a>
                    </div>
                </div>
            </li>
            <?php } ?>
            <!-- Nav Item - Orders -->
            <li class="nav-item">
                <?php if($_SESSION['ADMIN_ROLE']==0){
                    echo('<a class="nav-link" href="orders.php"><i class="fas fa-fw fa-table"></i><span>Orders</span></a>');
                }elseif($_SESSION['ADMIN_ROLE']==1){
                    echo('<a class="nav-link" href="orders_vendor.php"><i class="fas fa-fw fa-table"></i><span>Orders</span></a>');
                }else{
                    // nothing
                }
                ?>
            </li>

            <?php if($_SESSION['ADMIN_ROLE']==2 || $_SESSION['ADMIN_ROLE']==0){ ?>
            <!-- Nav Item - Categories Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBlogcategory"
                    aria-expanded="true" aria-controls="collapseBlogcategory">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Blog Categories</span>
                </a>
                <div id="collapseBlogcategory" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Categories:</h6>
                        <a class="collapse-item" href="blog_categories.php">List Blog Categories</a>
                        <a class="collapse-item" href="addBlogCategory.php">Add New blog categories</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBlog"
                    aria-expanded="true" aria-controls="collapseBlog">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Blog</span>
                </a>
                <div id="collapseBlog" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Categories:</h6>
                        <a class="collapse-item" href="blog.php">List Blog</a>
                        <a class="collapse-item" href="addBlog.php">Add New blog</a>
                    </div>
                </div>
            </li>
            <?php } ?>
            <?php if($_SESSION['ADMIN_ROLE']==0){ ?>
            
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Admin
            </div>
            <!-- Nav Item - Users Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdminUsers"
                    aria-expanded="true" aria-controls="collapseAdminUsers">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Users</span>
                </a>
                <div id="collapseAdminUsers" class="collapse" aria-labelledby="headingAdminUsers"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Users:</h6>
                        <a class="collapse-item" href="adminUsers.php">User List</a>
                        <a class="collapse-item" href="manage_vendor.php">Add New</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Customers
            </div>
            <!-- Nav Item - Users Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCustomerusers"
                    aria-expanded="true" aria-controls="collapseCustomerusers">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Users</span>
                </a>
                <div id="collapseCustomerusers" class="collapse" aria-labelledby="headingCustomerusers"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Users:</h6>
                        <a class="collapse-item" href="customers.php">User List</a>
                        <a class="collapse-item" href="#">Add New</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Contact Responses -->
            <li class="nav-item">
                <a class="nav-link" href="get_in_touch.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Get in touch</span></a>
            </li>
            <!-- Nav Item - Contact Responses -->
            <li class="nav-item">
                <a class="nav-link" href="reviews.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Product Reviews</span></a>
            </li>
            <!-- Nav Item - Contact Responses -->
            <li class="nav-item">
                <a class="nav-link" href="contactResponses.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Contact Responses</span></a>
            </li>
            <?php } ?>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->
