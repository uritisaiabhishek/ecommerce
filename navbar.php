<?php
    require('add_to_cart.inc.php');
    
    $cat_res=mysqli_query($con,"select * from categories where status=1 order by categories asc");
    $cat_arr=array();
    while($row=mysqli_fetch_assoc($cat_res)){
        $cat_arr[]=$row;
    }
    if(isset($_SESSION['USER_LOGIN'])){
        $cart_total=0;
        if(isset($_SESSION['cart'])){
            foreach($_SESSION['cart'] as $key=>$val){
                $productArr=get_product($con,'','',$key);
                $price=$productArr[0]['price'];
                $qty=$val['qty'];
                $cart_total=$cart_total+($price*$qty);
            }
        }
    }
    $obj=new add_to_cart();
    $totalProduct=$obj->totalProduct();
?>
<header>
        <!-- Alert -->
        <div id="get_in_touch_alert"></div>
        <!-- Topbar -->
        <div class="topbar pl-3 d-flex justify-content-between align-items-center">
            <p class="p-0 m-0 d-none d-lg-block">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere, incidunt!</p>
            <!-- <ul class="ml-auto mb-0 mt-0 p-0">hi</ul> -->
            <ul class="nav ml-auto mb-0 mt-0 p-0">
                <li class="nav-item d-none d-lg-block">
                  <a class="nav-link" href="mailto:<?php echo SITE_EMAIL ?>"><i class="fa fa-envelope">&nbsp;&nbsp;<?php echo SITE_EMAIL ?></i></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="tel:<?php echo SITE_PHONE ?>"><i class="fa fa-phone-alt">&nbsp;&nbsp;<?php echo SITE_PHONE ?></i></a>
                </li>
                <li class="nav-item d-none d-lg-block">
                  <a class="nav-link" href="#">Track Order</a>
                </li>
                <li class="nav-item d-none d-lg-block">
                  <a class="nav-link" href="Storelocator.php">Our Stores</a>
                </li>
                <li class="nav-item d-none d-lg-block">
                  <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"><i class="fab fa-facebook"></i></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"><i class="fab fa-instagram"></i></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"><i class="fab fa-twitter"></i></a>
                </li>
              </ul>
        </div>
        <!-- Navbar -->
        <div class="navigation_search">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand d-none d-lg-block" href="<?php echo SITE_PATH ?>"><img src="assets/images/Logo.png" height="50" alt="<?php echo SITE_NAME ?>"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_fullscreen" aria-controls="navbar_fullscreen" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                    <div class="d-block d-lg-none">
                        <ul class="d-flex m-0 p-0 list-unstyled align-items-center">
                            <li class="px-2">
                                <a href="profile.php"><i class="fa fa-user"></i></a>
                            </li>
                            <li class="px-2">
                                <a href="wishlist.php"><i class="fa fa-heart"></i></a>
                            </li>
                            <li class="px-2">
                            <a  href="cart.php"><i class="fa fa-shopping-cart"><span class="navbar_cart_indicator"><?php echo $totalProduct ?></span></i></a>
                            </li>
                        </ul>
                    </div>
                    <form action="search.php" method="get" class="form-inline my-2 my-lg-0 w-100">
                        <div class="input-group w-100">
                            <input type="text" class="form-control w-70" placeholder="Search here... " name="str" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            <div class="input-group-prepend">
                                <button type="submit" class="input-group-text" id="btnGroupAddon"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                    <div class="collapse navbar-collapse" id="">
                        <ul class="navbar-nav mr-auto">
                            <?php 
                                if(isset($_SESSION['USER_LOGIN'])){
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="profile.php">Hi&nbsp;<?php echo $_SESSION['USER_NAME']?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="modal" data-target="#logoutModal" href="#logoutModal">Logout</a>
                                </li>
                                <!-- Logout Modal -->
                                <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="logoutModalLabel">Log out?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>are you sure you want to logout?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a class="btn btn-theme btn-block" href="logout.php">Yes</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }else{ ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="login.php">login</a>
                                </li>
                            <?php } ?>
                            <li class="nav-item">
                                <a class="nav-link" href="profile.php"><i class="fa fa-user"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="wishlist.php"><i class="fa fa-heart"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart"><span class="navbar_cart_indicator"><?php echo $totalProduct ?></span></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Category Bar -->
        <div class="nav_category_bar">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php"><i class="fa fa-user"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="wishlist.php"><i class="fa fa-heart"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart"></i></a>
                        </li>
                    </ul>
                </div>
                <!-- <div class="nav-scroller">
                    <nav class="nav d-flex justify-content-between align-items-center">
                        <?php
                            foreach($cat_arr as $list){
                        ?>
                        <a  class="p-2 text-light"  href="category.php?id=<?php echo $list['id']?>"><?php echo $list['categories']?></a>
                        <?php
                            $cat_id=$list['id'];
                            $sub_cat_res=mysqli_query($con,"select * from sub_categories where status='1' and categories_id='$cat_id'");
                            if(mysqli_num_rows($sub_cat_res)>0){
                        ?>
                            <ul class="dropdown">
                            <?php
                                while($sub_cat_rows=mysqli_fetch_assoc($sub_cat_res)){
                                    echo '<li><a href="category.php?id='.$list['id'].'&sub_categories='.$sub_cat_rows['id'].'">'.$sub_cat_rows['sub_categories'].'</a></li>';
                                }
                            ?>
                            </ul>
                        <?php } ?>
                        <?php } ?>
                    </nav>
                </div> -->
                <div class="navbar_categories_subcat_listing">
                    
                </div>
            </div>
        </div>
        <div class="nav_category_sidebar collapse" id="navbar_fullscreen">
            <nav class="navbar navbar-expand-sm navbar-light bg-light">
                <a class="navbar-brand" href="<?php echo SITE_PATH ?>"><img src="assets/images/Logo.png" height="50" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_fullscreen" aria-controls="navbar_fullscreen" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-times"></i>
                </button>

                <div class=" navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo SITE_PATH?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">contact</a>
                        </li>
                        <?php foreach($cat_arr as $list){ ?>
                        <?php
                            $cat_id=$list['id'];
                            $sub_cat_res=mysqli_query($con,"select * from sub_categories where status='1' and categories_id='$cat_id'");
                            if(mysqli_num_rows($sub_cat_res)>0){
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo $list['categories']?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php
                                    while($sub_cat_rows=mysqli_fetch_assoc($sub_cat_res)){
                                        echo '<a class="dropdown-item" href="category.php?id='.$list['id'].'&sub_categories='.$sub_cat_rows['id'].'">'.$sub_cat_rows['sub_categories'].'</a>';
                                    }
                                ?>
                            </div>
                        </li>
                        <?php }else{ ?>
                        <li class="nav-item">
                            <a class="nav-link" href="category.php?id=<?php echo $list['id']?>"><?php echo $list['categories']?></a>
                        </li>
                        <?php } } ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                My Account
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="profile.php">Profile</a>
                                <a class="dropdown-item" href="my_order.php">orders</a>
                                <a class="dropdown-item" href="wishlist.php">wishlist</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"  data-toggle="modal" data-target="#logoutModal" href="#logoutModal">logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>