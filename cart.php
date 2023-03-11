<?php 
    require('connection.inc.php');
    require('functions.inc.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>ChronoPegasus</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png">
    <!-- StyleSheets -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/Vendor/bootstrap-4.5.3/dist/css/bootstrap.min.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="assets/Vendor/fontawesome-free-5.15.1-web/css/all.min.css">
    <!-- Owl Carosel -->
    <link rel="stylesheet" href="assets/Vendor/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
    <!-- Custom -->
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <?php require('navbar.php'); ?>
        <section class="cart_main my-5">
            <div class="container-fluid">
                <div class="main_heading_breadcrumb"></div>
                <div class="row">
                    <?php 
                        if($totalProduct!=0){
                            ?>
                            
                    <div class="col">
                    
                    <?php if(isset($_SESSION['cart'])){ ?>
                                <?php
                                    foreach($_SESSION['cart'] as $key=>$val){
                                        $productArr=get_product($con,'','',$key);
                                        $pname=$productArr[0]['name'];
                                        $mrp=$productArr[0]['mrp'];
                                        $price=$productArr[0]['price'];
                                        $image=$productArr[0]['image'];
                                        $qty=$val['qty'];
                                ?>
                        <!-- product in cart to loop -->
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image?>" alt="<?php echo $pname?>" class="img-fluid">
                                    </div>
                                    <div class="col-md">
                                        <div class="cart_product_title"><a href="#"><?php echo $pname?></a></div>
                                        <div class="cart_product_price"><span>Product Cost : </span>$ <?php echo $price?></div>
                                        <div class="cart_product_Quantity"><span>Quantity : </span><?php echo $qty ?></div>
                                        <div class="cart_product_Quantity"><span>Total Cost : </span><?php echo $qty ?> x <?php echo $price ?> = <?php echo $qty*$price?></div>
                                        <div class="cart_product_Quantity_input my-2 input-group">
                                            <input type="number" aria-describedby="cartquantityupdate" id="<?php echo $key?>qty" value="<?php echo $qty?>" />
                                            <div class="input-group-prepend"><a href="javascript:void(0)" class="product_details_buttons btn" onclick="manage_cart('<?php echo $key?>','update')">update</a></div>
                                        </div>
                                        <ul class="list-unstyled row m-0 p-0">
                                            <li class="product_details_buttons col-md"><a class="btn btn-block" href="javascript:void(0)"  onclick="manage_cart('<?php echo $key?>','remove')"><i class="fa fa-shopping-cart">&nbsp;</i>Remove from Cart</a></li>
                                            <li class="product_details_buttons col-md"><a class="btn btn-block" href=""><i class="fa fa-heart">&nbsp;</i>Add To Wishlist</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- product in cart to loop -->
                                <?php } ?>
                    <?php } ?>
                        <div class="border-bottom-theme my-3"></div>            
                        <ul class="list-unstyled row m-0 p-0">
                            <li class="product_details_buttons col-md"><a class="btn btn-block" href="<?php echo SITE_PATH ?>"><i class="fa fa-shopping-cart">&nbsp;</i>Continue Shopping</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">Price Details</div>
                            <div class="card-body">
                            <?php
								$cart_total=0;
								foreach($_SESSION['cart'] as $key=>$val){
								$productArr=get_product($con,'','',$key);
								$pname=$productArr[0]['name'];
								$mrp=$productArr[0]['mrp'];
								$price=$productArr[0]['price'];
								$image=$productArr[0]['image'];
								$qty=$val['qty'];
								$cart_total=$cart_total+($price*$qty);
								?>
                                <div class="row">
                                    <div class="col"><?php echo $pname?>:(<?php echo $qty?> items)</div>
                                    <div class="col text-right"><?php echo $price*$qty?></div>
                                </div>
								<?php } ?>
                                <div class="row">
                                    <div class="col">Delivery Charges</div>
                                    <div class="col text-right">Free</div>
                                </div>
                                <div class="border-bottom-theme my-3"></div> 
                                <div class="row">
                                    <div class="col">Total:</div>
                                    <div class="col text-right"><?php echo $cart_total?></div>
                                </div>
                            </div>
                            <div class="card-footer d-flex flex-column text-center">
                                <a href="checkout.php" class="btn">checkout</a>
                            </div>
                        </div>
                    </div>
                            <?php
                        }else{
                            ?>
                    <div class="col">
                        <div class="card mb-2 ">
                            <div class="card-body empty_cart d-flex flex-column align-items-center justify-content-center">
                                <h1 class="text-center"><i class="fa fa-shopping-cart"></i></h1>
                                <h1 class="text-center text-light">Your Cart is empty</h1>
                                <ul class="list-unstyled row m-0 p-0">
                                    <li class="product_details_buttons col-md"><a class="btn" href="<?php echo SITE_PATH ?>"><i class="fa fa-shopping-cart">&nbsp;</i>Continue Shopping</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </section>

    <!-- Footer starts -->
    <?php require('footer.php'); ?>
    <!-- Footer Ends -->



    <!-- Javascript files -->
    <!-- JQuery -->
    <script src="assets/Vendor/jquery-master/dist/jquery-3.2.1.min.js"></script>
    <!-- <script src="assets/Vendor/jquery-master/dist/jquery-3.5.1.slim.min.js"></script> -->
    <!-- Bootstrap -->
    <script src="assets/Vendor/bootstrap-4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- owlcarsel -->
    <script src="assets/Vendor/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    <!-- Custom -->
    <script src="assets/js/custom.js"></script>
</body>
</html>