<?php 
    require('connection.inc.php');
    require('functions.inc.php');

    $resBanner=mysqli_query($con,"select * from banner where status='1'");
    $resBlog=mysqli_query($con,"select blog.*,blog_categories.blog_category from blog,blog_categories where blog.blog_category_id=blog_categories.id and blog.is_published='1'");
    $resProductCat=mysqli_query($con,"select * from categories where status='1'");
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
    <!-- Header -->
    <?php if(mysqli_num_rows($resBanner)>0){ ?>
    <!-- main content starts -->
    <section class="home_carosel">
        <div class="container-fluid">
            <div class="owl-slider pb-3">
                <div id="main_carosel" class="owl-carousel">
                    <?php while($rowBanner=mysqli_fetch_assoc($resBanner)){ ?>    
                    <!-- item to loop start -->
                    <div class="item main_carosel_item">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 main_carosel_item_content">
                                    <h3 class="home_main_carsel_tagline"><?php echo $rowBanner['heading2'] ?></h3>
                                    <h3 class="home_main_carsel_heading "><?php echo $rowBanner['heading1'] ?></h3>
                                    <?php if($rowBanner['btn_link']&&$rowBanner['btn_txt']){ ?>
                                        <a href="<?php echo $rowBanner['btn_link'] ?>" class="btn btn-theme home_main_carsel_button"><?php echo $rowBanner['btn_txt'] ?></a>
                                    <?php } ?>
                                </div>
                                <div class="col-lg-6 d-flex flex-column justify-content-center">
                                    <img src="<?php echo BANNER_IMAGE_SITE_PATH.$rowBanner['image'] ?>" class="img-fluid" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- item to loop ends -->
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Main Carosel Ends -->
    <?php } ?>

    <?php if(mysqli_num_rows($resProductCat)>0){ ?>
    <!-- Advertisements starts -->
    <section class="advertisements_home my-5">              
        <div class="container-fluid product_grid">
            <div class="card product_grid_card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="home_card_heading m-0 p-0">Categories</div>
                </div>
                <div class="owl-slider pt-3">
                    <div id="categories" class="owl-carousel">
                        <?php while($rowProductCat=mysqli_fetch_assoc($resProductCat)){ ?> 
                        <!-- to loop -->
                        <div class="row advertisement_column py-5">
                            <div class="col-lg">
                                <img src="<?php echo CATEGORY_IMAGE_SITE_PATH.$rowProductCat['cat_image']?>" alt="<?php echo $rowProductCat['categories']?>" class="img-fluid">
                            </div>
                            <div class="col-lg advertisement_details">
                                <h4 class="advertisement_title"><?php echo $rowProductCat['categories']?></h4>
                                <!-- <h4 class="advertisement_description">Starts at 49</h4> -->
                                <a href="category.php?id=<?php echo $rowProductCat['id'] ?>" class="btn btn-theme advertisement_btn">View All</a>
                            </div>
                        </div>
                        <!-- to loop -->
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Advertisements Ends -->
    <?php } ?>

    <?php include('newArrivals.php'); ?>
    
    <!-- New Arrivals starts -->
    <section class="new_arrivals">               
        <div class="container-fluid product_grid">
            <div class="card product_grid_card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="home_card_heading m-0 p-0">Best Sellers</div>
                </div>
                <div class="owl-slider">
                    <div id="new_Arrivals" class="owl-carousel">
                        <?php
                            $get_product=get_product($con,4,'','','','','yes');
                            foreach($get_product as $list){
                        ?>
                            <!-- item to loop start -->
                            <div class="item">
                                <div class="card product_home_card">
                                    <div class="card-body">
                                        <div class="product_sale_banner d-flex">
                                            <?php
                                                if($list['price']!=0){
                                                    echo '<div class="sale_badge">Sale</div>';
                                                }
                                                if($list['is_featured']==1) {
                                                    echo '<div class="featured_badge">Featured</div>';
                                                }
                                            ?>
                                        </div>
                                        <a class="product_wishlist" href="javascript:void(0)" onclick="wishlist_manage('<?php echo $list['id']?>','add')"><i class="far fa-heart"></i></a>
                                        <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image']?>" alt="<?php echo $list['name']?>" class="img-fluid">
                                        <div class="product_details">
                                            <h5 class="category_name"><?php echo $list['categories']?></h5>
                                            <a href="product.php?id=<?php echo $list['id'] ?>"><h5 class="product_name"><?php echo $list['name']?></h5></a>
                                            <?php  if($list['price']!=0){ ?>
                                                <h5 class="product_pricing"><span><?php echo SITE_CURRENCY.'&nbsp;'.$list['mrp']?></span>&nbsp;<?php echo SITE_CURRENCY.'&nbsp;'.$list['price']?></h5>
                                            <?php }else{ ?>
                                                <h5 class="product_pricing"><?php echo SITE_CURRENCY.'&nbsp;'.$list['mrp']?></h5>
                                            <?php } ?>
                                            <?php 
                                                $product_rating_sql="select * from product_review where product_id='".$list['id']."' and status=1";
                                                $product_rating_res=mysqli_query($con,$product_rating_sql);
                                                $product_rating_count=0;
                                                if($product_rating_count_rows=mysqli_num_rows($product_rating_res)>0){
                                                    while($product_rating_row=mysqli_fetch_assoc($product_rating_res)){
                                                        $product_rating_count_addition=$product_rating_count+$product_rating_row['rating'];
                                                        $product_rating_count_average=round($product_rating_count_addition / $product_rating_count_rows);
                                                    }
                                                    ?><h5 class="product_rating"><?php echo $product_rating_count_average ?> <i class="fas fa-star"></i></h5><?php
                                                }
                                            ?>
                                        </div>
                                        <input type="hidden" id="qty" name="qty" value="1">
                                        <a href="javascript:void(0)" onclick="manage_cart('<?php echo $list['id'] ?>','add')" class="btn add_to_cart_btn mt-2 p-2">Add to Cart</a>
                                        <button type="button" class="btn btn_tranperent mt-2" data-toggle="modal" data-target="#<?php echo $list['slug'] ?><?php echo $list['id'] ?>">
                                            Get in touch
                                        </button>
                                        <!-- get in touch Modal -->
                                        <div class="modal  fade" id="<?php echo $list['slug'] ?><?php echo $list['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="<?php echo $list['slug'] ?><?php echo $list['id'] ?>Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content get_in_touch_modal">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="<?php echo $list['slug'] ?><?php echo $list['id'] ?>Label">
                                                            Get in Touch
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                    <form id="get-in-touch-form" action="#" method="post">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="get_in_touch_product_id" id="get_in_touch_product_id" value="<?php echo $list['id'] ?>">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="get_in_touch_name" id="get_in_touch_name" placeholder="Your Name" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="get_in_touch_mobile" id="get_in_touch_mobile" placeholder="Your mobile Number" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="email" class="form-control" name="get_in_touch_email" id="get_in_touch_email" placeholder="Your Email" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="get_in_touch_location" id="get_in_touch_location" placeholder="Your Location"  required>
                                                            </div>
                                                            <div class="form-group">
                                                                <select name="get_in_touch_contact_via" id="get_in_touch_contact_via" class="form-control" required>
                                                                    <option value="Mobile">Contact Via Mobile</option>
                                                                    <option value="email">Contact Via Email</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <textarea name="get_in_touch_message" id="get_in_touch_message" cols="30" rows="5" class="form-control" placeholder="Enter Your Message"  required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button onclick="get_in_touch()" type="button" name="get_in_touch_submit" class="btn btn-block btn-theme">Send Message</button>
                                                            <a href="https://api.whatsapp.com/send?phone=<?php echo SITE_PHONE ?>&text=<?php echo SITE_PATH ?>product.php?id=<?php echo $list['id'] ?>" class="btn btn-block btn-theme">Send in Whatsapp <i class="fab fa-whatsapp"></i></a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- get in youch modal ends -->
                                    </div>
                                </div>
                            </div>
                            <!-- item to loop ends -->
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- New Arrivals ends -->
    
    <!-- Blog section starts -->
    <section class="blog_grid_section my-5">              
        <div class="container-fluid product_grid">
            <div class="card product_grid_card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="home_card_heading m-0 p-0">Our Blog</div>
                </div>
                <div class="owl-slider pt-3">
                    <div id="blog_carosel" class="owl-carousel">
                        <?php while($rowBlog=mysqli_fetch_assoc($resBlog)){ ?>  
                        <!-- to loop -->
                        <div class="blog_card card">
                            <img src="<?php echo BLOG_IMAGE_SITE_PATH.$rowBlog['blog_image']?>" alt="" class="card-img-top">
                            <div class="card-body">
                                <h4 class="blog_card_category"><?php echo $rowBlog['blog_category']?></h4>
                                <a href="single.php?id=<?php echo $rowBlog['id']?>" class="blog_card_title">title</a>
                                <div class="border-bottom-theme my-2"></div>
                                <p class="blog_card_content m-0">
                                    <?php 
                                        echo substr($rowBlog['blog_content'],0,260).'...';
                                    ?>
                                </p>
                            </div>
                            <div class="card-footer">
                                <p class="blog_card_date p-0 m-0">
                                    <strong>Posted on :</strong> 
                                    <?php
                                        $blog_posted=date("d-m-Y",strtotime($rowBlog['created_on']));
                                        echo $blog_posted
                                    ?>
                                </p>
                            </div>
                        </div>
                        <!-- to loop -->
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog section ends -->

    <div class="border-bottom-theme my-3"></div>
    <!-- Our Clients Starts -->
    <?php include('our_clients.php');?>
    <!-- Our Clients Ends -->

    <!-- Main content ends -->

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