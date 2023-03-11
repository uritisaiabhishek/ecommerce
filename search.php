<?php 
    require('connection.inc.php');
    require('functions.inc.php');
    $str=mysqli_real_escape_string($con,$_GET['str']);

    
    $price_high_selected="";
    $price_low_selected="";
    $new_selected="";
    $old_selected="";
    $sort_order="";
    if(isset($_GET['sort'])){
        $sort=mysqli_real_escape_string($con,$_GET['sort']);
        if($sort=="price_high"){
            $sort_order=" order by product.price desc ";
            $price_high_selected="selected";	
        }if($sort=="price_low"){
            $sort_order=" order by product.price asc ";
            $price_low_selected="selected";
        }if($sort=="new"){
            $sort_order=" order by product.id desc ";
            $new_selected="selected";
        }if($sort=="old"){
            $sort_order=" order by product.id asc ";
            $old_selected="selected";
        }
    }

    if($str!=''){
        $get_product=get_product($con,'','','',$str,$sort_order);
    }else{
        ?>
        <script>
        window.location.href='index.php';
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
    <title>Search - ChronoPegasus</title>
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


    <section class="shop_grid_filter my-5">
        <div class="container-fluid product_grid">
            <div class="card product_grid_card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="home_card_heading m-0 p-0">Search  Results</div>
                    <div class="d-flex">
                        <a href="<?php echo SITE_PATH ?>">Home </a> / search
                    </div>
                </div>
                <div class="container-fluid mt-3">
                    <div class="row">
                        <div class="col-md-2 py-2 bg-theme-transperent filter-column">
                            <h4 class="filter_heading my-3">Categories</h4>
                            <?php 
                            $cat_res=mysqli_query($con,"select * from categories where status=1 order by categories asc");
                            $cat_arr=array();
                            while($row=mysqli_fetch_assoc($cat_res)){
                                $cat_arr[]=$row;
                            }
                            foreach($cat_arr as $list){
                            ?>
                            <div class="d-flex justify-content-between">
                                <h6><a href="category.php?id=<?php echo $list['id']?>"><?php echo $list['categories']?></a></h6>
                                <h6>34</h6>
                            </div>
                            <?php } ?>
                            <div class="border-bottom-theme py-2"></div>
                            <!-- <h4 class="filter_heading my-3">Price</h4>
                            <div class="d-flex justify-content-between">
                                <div class="price_filter_group">
                                    <label for="">Min</label>
                                    <select class="px-2 py-1 theme-form-select" name="" id="">
                                        <option class="theme-form-select-option" value="">200</option>
                                        <option class="theme-form-select-option" value="">200</option>
                                        <option class="theme-form-select-option" value="">200</option>
                                    </select>
                                </div>
                                <div class="price_filter_group">
                                    <label for="">Min</label>
                                    <select class="px-2 py-1 theme-form-select" name="" id="">
                                        <option class="theme-form-select-option" value="">200</option>
                                        <option class="theme-form-select-option" value="">200</option>
                                        <option class="theme-form-select-option" value="">200</option>
                                    </select>
                                </div>
                            </div>
                            <a class="btn btn-theme" href="#">Filter</a>
                            <div class="border-bottom-theme py-2"></div>
                            <h4 class="filter_heading my-3">Brand</h4>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="brand">
                                <label class="form-check-label" for="">
                                  Default checkbox
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="brand" checked>
                                <label class="form-check-label" for="">
                                  Checked checkbox
                                </label>
                            </div>
                            <div class="border-bottom-theme py-2"></div>
                            <h4 class="filter_heading my-3">Brand</h4>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="other">
                                <label class="form-check-label" for="flexCheckDefault">
                                  Default checkbox
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="other" checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                  Checked checkbox
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                  Checked checkbox
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                  Checked checkbox
                                </label>
                            </div>
                            <div class="border-bottom-theme py-2"></div> -->
                        </div>
                        <div class="col-md-10">
                            <div class="my-2 mx-3 d-flex justify-content-between">
                                <div class="sort_order">
                                    <label for="">Sort By: </label>                            
                                    <select class="form-select px-2 py-1 theme-form-select" onchange="sort_product_drop_search('<?php echo mysqli_real_escape_string($con,$_GET['str']) ?>','<?php echo SITE_PATH?>')" id="sort_product_id">
                                        <option class="theme-form-select-option" value="">Default softing</option>
                                        <option class="theme-form-select-option" value="price_low" <?php echo $price_low_selected?>>Sort by price low to hight</option>
                                        <option class="theme-form-select-option" value="price_high" <?php echo $price_high_selected?>>Sort by price high to low</option>
                                        <option class="theme-form-select-option" value="new" <?php echo $new_selected?>>Sort by new first</option>
                                        <option class="theme-form-select-option" value="old" <?php echo $old_selected?>>Sort by old first</option>
                                    </select>
                                </div>
                                <div class="sort_order">
                                    <label for="">Show: </label>
                                    <select class="px-2 py-1 theme-form-select" name="" id="">
                                        <option class="theme-form-select-option" value="">10</option>
                                        <option class="theme-form-select-option" value="">200</option>
                                        <option class="theme-form-select-option" value="">200</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php if(count($get_product)>0){?>
                                <div class="row">
                                    <?php 
                                        foreach($get_product as $list){
                                    ?>
                                    <!-- product card starts -->
                                    <div class="col-md-3 col-sm-6">
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
                                                <a href="javascript:void(0)" onclick="wishlist_manage('<?php echo $list['id']?>','add')" class="product_wishlist"><i class="fas fa-heart"></i></a>
                                                <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image'] ?>" alt="Product name" class="img-fluid">
                                                <div class="product_details">
                                                    <h5 class="category_name"><?php echo $list['categories'] ?></h5>
                                                    <h5 class="product_name"><a href="product.php?id=<?php echo $list['id'] ?>"><?php echo $list['name'] ?></a></h5>
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
                                                                <span aria-hidden="true">&times;</span>
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
                                    <!-- product card ends -->
                                    <?php } ?>
                                </div>
                                <?php }else{ echo "Data Not Found";} ?>
                            </div>
                        </div>
                    </div>
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
    <!-- Bootstrap -->
    <script src="assets/Vendor/bootstrap-4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- owlcarsel -->
    <script src="assets/Vendor/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    <!-- Custom -->
    <script src="assets/js/custom.js"></script>
</body>
</html>