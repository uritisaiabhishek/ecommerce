<?php 
    require('connection.inc.php');
    require('functions.inc.php');
    if(!isset($_SESSION['USER_LOGIN'])){
        ?>
        <script>
        window.location.href='login.php';
        </script>
        <?php
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>My Orders - ChronoPegasus</title>
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
    
    <?php include('navbar.php'); ?>
        
        <!-- profile section -->
        <section class="profile_page my-5">
            <div class="container">
                <div class="row">
                    <div class="col-md mx-auto">
                        <?php
							$uid=$_SESSION['USER_ID'];
							$res=mysqli_query($con,"select distinct(order_detail.id) ,order_detail.*,product.name,product.image from order_detail,product ,orders where orders.user_id='$uid' and order_detail.product_id=product.id");
                            if(mysqli_num_rows($res)>0){
                        ?>
                        <?php while($row=mysqli_fetch_assoc($res)){ ?>
                        <div class="card mb-2">
                            <div class="card-body">	
                                <?php
                                    $get_product=get_product($con,'','',$row['product_id']);
                                ?>
                                <div class="row">
                                    <div class="col-md-3"><img class="img-fluid" src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'] ?>" alt="<?php echo $get_product['0']['name'] ?>"></div>
                                    <div class="col-md-9">
                                        <h1 class="product_my_order_title"><a href="product.php?id=<?php echo $row['product_id'] ?>"><?php echo $get_product['0']['name'] ?></a></h1>
                                        <h1 class="product_my_order_cost"><?php echo $row['price'] ?></h1>
                                        <h1 class="product_my_order_quntity"><?php echo $row['qty'] ?></h1>
                                        <h1 class="product_my_order_delivery_status">
                                            <?php
                                                $product_sql_res=mysqli_query($con,"select * from product_delivery_status");
                                                while($product_delivery_row=mysqli_fetch_assoc($product_sql_res)){
                                                    if($product_delivery_row['id']==$row['product_delivery_status']){
                                                        echo $product_delivery_row['name'];
                                                    }
                                                }
                                            ?>    
                                        </h1>
                                        <h1 class="product_my_order_delivery_date"><?php echo date("d-M-Y",strtotime($row['product_delivery_date'])) ?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php }else{ echo('No Orders Yet');} ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- profile section ends -->

    <!-- Footer starts -->
    <?php require('footer.php'); ?>
    <!-- Footer Ends -->

    <!-- Javascript files -->
    <!-- JQuery -->
    <script src="assets/Vendor/jquery-master/dist/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/Vendor/bootstrap-4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- owlcarsel -->
    <script src="assets/Vendor/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    <!-- Custom -->
    <script src="assets/js/custom.js"></script>
</body>
</html>