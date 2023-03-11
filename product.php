<?php 
    require('connection.inc.php');
    require('functions.inc.php');
    $meta_url = ''.SITE_PATH.'product.php?id='.$_GET['id'].'';
    if(isset($_GET['id'])){
        $product_id=mysqli_real_escape_string($con,$_GET['id']);
        if($product_id>0){
            $get_product=get_product($con,'','',$product_id);
        }else{
            ?>
            <script>
            window.location.href='index.php';
            </script>
            <?php
        }
    }else{
        ?>
        <script>
        window.location.href='index.php';
        </script>
        <?php
    }
    $resMultipleImages=mysqli_query($con,"select * from product_images where product_id='$product_id'");
    $multipleImages=[];
    if(mysqli_num_rows($resMultipleImages)>0){
        while($rowMultipleImages=mysqli_fetch_assoc($resMultipleImages)){
            $multipleImages[]=$rowMultipleImages['product_images'];
        }
    }
    if(isset($_POST['review_btn'])){
        $rating=get_safe_value($con,$_POST['rating']);
        $review=get_safe_value($con,$_POST['review']);
        $added_on=date('Y-m-d h:i:s');
        mysqli_query($con,"insert into product_review(product_id,user_id,rating,review,status,added_on) values('$product_id','".$_SESSION['USER_ID']."','$rating','$review','0','$added_on')");
        header('location:product.php?id='.$product_id);
        die();        
    }
    $product_review_res=mysqli_query($con,"select users.name,product_review.id,product_review.rating,product_review.review,product_review.added_on from users,product_review where product_review.status=1 and product_review.user_id=users.id and product_review.product_id='$product_id' order by product_review.added_on");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->    
    <title><?php echo $get_product['0']['meta_title'] ?></title>
    <meta name="description" content="<?php echo $get_product['0']['meta_desc'] ?>">
	<meta name="keywords" content="<?php echo $get_product['0']['meta_keyword'] ?>">
    <meta property="og:title" content="<?php echo $get_product['0']['meta_title'] ?>" />
    <meta property="og:image" content="<?php echo PRODUCT_IMAGE_SITE_PATH.$get_product['0']['image'] ?>" />
    <meta property="og:url" content="<?php echo $get_product['0']['meta_title'] ?>" />
    <meta property="og:site_name" content="<?php echo SITE_PATH ?>" />
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

    <!-- product_details section starts -->
    <section class="product_details my-5">
        <div class="container-fluid product_grid">
            <div class="card product_grid_card">
                <div class="card-header row">
                    <div class="col-md home_card_heading"><?php echo $get_product['0']['name'] ?></div>
                    <div class="col-md text-md-right">
                        <a href="<?php echo SITE_PATH ?>">Home</a> /
                        <a href="category.php?id=<?php echo $get_product['0']['categories_id'] ?>"><?php echo $get_product['0']['categories'] ?></a> /
                        <?php
                            if($get_product['0']['sub_categories_id']!=0){
                                $get_sub_cat_res=mysqli_query($con,"select sub_categories.id as sub_cat_id,sub_categories.sub_categories from sub_categories where sub_categories.id='".$get_product['0']['sub_categories_id']."'");
                                while($get_sub_cat_row=mysqli_fetch_assoc($get_sub_cat_res)){ ?>
                                    <a href="category.php?id=<?php echo $get_product['0']['categories_id'] ?>&sub_categories=<?php echo $get_sub_cat_row['sub_cat_id'] ?>"><?php echo $get_sub_cat_row['sub_categories'] ?></a>
                                <?php }
                            }
                        ?>
                    </div>
                </div>
                <div class="container-fluid mt-3">
                    <div class="row">
                        <div class="col-md-4 py-5 text-center">
                            <div id="main_product_image text-center">
                                <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$get_product['0']['image'] ?>" alt="<?php echo $get_product['0']['name'] ?>" class="img-fluid">
                            </div>
                            <div class="border-bottom-theme my-3"></div>
                            <div class="owl-slider">
                                <div id="product_images_carosel" class="owl-carousel product_images_carosel">
                                    <?php 
                                        if(isset($multipleImages[0])){
                                            foreach($multipleImages as $list){
                                                echo "<div class='item product_item_image'><img src='".PRODUCT_MULTIPLE_IMAGE_SITE_PATH.$list."' alt='".$get_product['0']['name']."' /></div>";
                                            }
                                        } 
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 py-5">
                            <h1 class="product_details_category"><?php echo $get_product['0']['categories'] ?></h1>
                            <h2 class="product_details_title"><?php echo $get_product['0']['name'] ?></h2>
                            <?php 
                                $product_rating_sql="select * from product_review where product_id='".$product_id."' and status=1";
                                $product_rating_res=mysqli_query($con,$product_rating_sql);
                                $product_rating_count=0;
                                if($product_rating_count_rows=mysqli_num_rows($product_rating_res)>0){
                                    while($product_rating_row=mysqli_fetch_assoc($product_rating_res)){
                                        $product_rating_count_addition=$product_rating_count+$product_rating_row['rating'];
                                        $product_rating_count_average=round($product_rating_count_addition / $product_rating_count_rows);
                                    }
                            ?>
                            <h3 class="product_details_rating mt-3"><span><?php echo $product_rating_count_average ?></span></h3>
                            <?php
                                }
                            ?>
                            <h4 class="product_details_price my-3"><span><?php echo SITE_CURRENCY ?> <?php echo $get_product['0']['mrp'] ?></span> <?php echo SITE_CURRENCY ?><?php echo $get_product['0']['price'] ?></h4>
                            <h5 class="product_details_short_description"><span>Availability : </span><?php if($get_product['0']['qty']>0){echo "In Stock";}else{echo "Out of Stock";} ?></h5>
                            <h5 class="product_details_short_description"><span>Description : <br/></span><?php echo $get_product['0']['short_desc'] ?></h5>
                            <h5 class="product_details_short_description"><span>Qty:</span> <input type="number" id="qty" name="qty" value="1" min="1" max="<?php echo $get_product['0']['qty']; ?>"></h5>
                            <ul class="list-unstyled row m-0 p-0">
                                <li class="product_details_buttons col-md"><a class="btn" href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product['0']['id']?>','add')"><i class="fa fa-shopping-cart">&nbsp;</i>Add To Cart</a></li>
                                <li class="product_details_buttons col-md"><a class="btn" href=""><i class="fa fa-heart">&nbsp;</i>Add To Wishlist</a></li>
                                <li class="product_details_buttons col-md"><a class="btn" href="">Get in touch</a></li>
                            </ul>
                            <div class="border-bottom-theme my-3"></div>
                            <h6 class="product_details_share_icons mb-3">Share This</h6>
                            <ul class="list-unstyled m-0 p-0 d-flex">
                                <!-- <li class="social_share_li"><a href="#"><i class="fab fa-facebook"></i></a></li> -->
                                <!-- <li class="social_share_li"><a href="#"><i class="fab fa-linkedin"></i></a></li> -->
                                <li class="social_share_li"><a href="https://api.whatsapp.com/send?text=<?php echo urlencode($get_product['0']['name']) ?> <?php echo $meta_url ?>"><i class="fab fa-whatsapp"></i></a></li>
                                <!-- <li class="social_share_li"><a href="#"><i class="fab fa-instagram"></i></a></li> -->
                                <li class="social_share_li"><a href="https://twitter.com/share?url=<?php echo $meta_url ?>&text=<?php echo $get_product['0']['name'] ?>"><i class="fab fa-twitter"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-bottom-theme my-3"></div>
            <div class="row">
                <div class="col">
                    <div class="card mb-2">
                        <div class="card-header">Description :</div>
                        <div class="card-body">
                            <?php echo $get_product['0']['description'] ?>
                        </div>
                    </div>
                    <div class="card product_review_card">
                        <div class="card-header">Reviews</div>
                        <div class="card-body">                            
                            <?php 
                            if(mysqli_num_rows($product_review_res)>0){
                                while($product_review_row=mysqli_fetch_assoc($product_review_res)){
                            ?>
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <h4><?php echo($product_review_row['name']); ?></h4>
                                        <h4><?php echo($product_review_row['rating']); ?></h4>
                                        <h4>
                                            <?php
                                                $review_date=strtotime($product_review_row['added_on']);
                                                echo date('d M Y',$review_date);
                                            ?>
                                        </h4>
                                    </div>
                                </div>
                            <?php
                                }
                            }else{
                                echo('<div class="card my-2"><div class="card-body">No Revies Added</div></div>'); 
                            } 
                            ?>
                        </div>
                    </div>
                </div>
                
                <?php if(isset($_SESSION['USER_LOGIN'])){ ?>
                    <?php 
                        $product_bought_res=mysqli_query($con,"select order_detail.order_id,orders.user_id,order_detail.product_id from order_detail,orders where order_detail.product_id='$product_id'");
                        $product_review_status_res=mysqli_query($con,"select product_review.user_id,product_review.product_id from product_review where product_review.product_id='$product_id' and product_review.user_id='".$_SESSION['USER_ID']."'");
                        if(mysqli_num_rows($product_bought_res)>0){
                            if(mysqli_num_rows($product_review_status_res)>0){
                            }else{
                                ?>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">Rate This Product</div>
                                    <div class="card-body">
                                        <form action="" method="post">
                                            <select name="rating" id="" class="form-control">
                                                <option>Select</option>
                                                <option>5</option>
                                                <option>4</option>
                                                <option>3</option>
                                                <option>2</option>
                                                <option>1</option>
                                            </select>
                                            <textarea name="review" class="form-control" placeholder="write review" id="" cols="30" rows="5"></textarea>
                                            <button type="submit" name="review_btn">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                                <?php
                            }
                        }else{
                            // echo('did not buy this product');
                        }
                    ?>
                    <?php } ?>
                        
                                    
            </div>
        </div>
    </section>
    <!-- product_details section ends -->

    <?php include('newArrivals.php'); ?>
    
    <?php include('footer.php');  ?>

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