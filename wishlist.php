<?php 
    require('connection.inc.php');
    require('functions.inc.php');
    if(!isset($_SESSION['USER_LOGIN'])){
        ?>
        <script>
        window.location.href='index.php';
        </script>
        <?php
    }
    $uid=$_SESSION['USER_ID'];
    if(isset($_GET['wishlist_id'])){
        $wid=$_GET['wishlist_id'];
        mysqli_query($con,"delete from wishlist where id='$wid' and user_id='$uid'");
    }
    $res=mysqli_query($con,"select product.name,product.image,product.price,product.mrp,wishlist.product_id,wishlist.id from product,wishlist where wishlist.product_id=product.id and wishlist.user_id='$uid'");
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Wishlist | ChronoPegasus</title>
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
            <div class="container">
                <div class="main_heading_breadcrumb"></div>
                <div class="row">
                    <div class="col">
                        <?php
							while($row=mysqli_fetch_assoc($res)){
						?>
								
                        <!-- product in cart to loop -->
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>" alt="<?php echo $row['name']?>" class="img-fluid">
                                    </div>
                                    <div class="col-md">
                                        <div class="cart_product_title"><a href="product.php?id=<?php echo $row['product_id']?>"><?php echo $row['name']?></a></div>
                                        <div class="cart_product_price"><span>Product Cost : </span>$ <?php echo $row['price']?></div>
                               
										<input type="hidden" id="qty" value="1"/>	
                                        <ul class="list-unstyled row m-0 p-0">
                                            <li class="product_details_buttons col-md"><a class="btn" href="javascript:void(0)" onclick="manage_cart('<?php echo $row['product_id']?>','add')"><i class="fa fa-shopping-cart">&nbsp;</i>Add to Cart</a></li>
                                            <li class="product_details_buttons col-md"><a class="btn" href="wishlist.php?wishlist_id=<?php echo $row['id']?>"><i class="fa fa-heart">&nbsp;</i>Remove from Wishlist</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- product in cart to loop -->
						<?php } ?>
                        <div class="border-bottom-theme my-3"></div>            
                        <ul class="list-unstyled row m-0 p-0">
                            <li class="product_details_buttons col-md"><a class="btn" href="<?php echo SITE_PATH ?>"><i class="fa fa-shopping-cart">&nbsp;</i>Continue Shopping</a></li>
                        </ul>
                    </div>
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