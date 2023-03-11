<?php 
    require('connection.inc.php');
    require('functions.inc.php');
    
if(!isset($_GET['id']) && $_GET['id']!=''){
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
}

$cat_id=mysqli_real_escape_string($con,$_GET['id']);
// echo($cat_id);
$sub_categories='';

if(isset($_GET['sub_categories'])){
	$sub_categories=mysqli_real_escape_string($con,$_GET['sub_categories']);
}

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

if($cat_id>0){
	$get_product=get_product($con,'',$cat_id,'','',$sort_order,'',$sub_categories);
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
    <!-- main content starts -->

    <section class="shop_grid_filter my-5">
        <div class="container-fluid product_grid">
            <div class="card product_grid_card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="home_card_heading m-0 p-0">Featured</div>
                    <div class="d-flex">
                        <a href="<?php echo SITE_PATH ?>">Home</a> /
                        <?php
                            $get_product_category_res=mysqli_query($con,"select categories.id as category_id,categories.categories from categories where categories.id='".mysqli_real_escape_string($con,$_GET['id'])."'");
                            while($get_product_category_row=mysqli_fetch_assoc($get_product_category_res)){ ?>
                                <a href="category.php?id=<?php echo $get_product_category_row['category_id'] ?>"><?php echo $get_product_category_row['categories'] ?></a> /
                        <?php
                            if($sub_categories>0){
                            $get_sub_cat_res=mysqli_query($con,"select sub_categories.id as sub_cat_id,sub_categories.sub_categories from sub_categories where sub_categories.id='".mysqli_real_escape_string($con,$_GET['sub_categories'])."'");
                            while($get_sub_cat_row=mysqli_fetch_assoc($get_sub_cat_res)){ ?>
                            <a href=""><a href="category.php?id=<?php echo $get_product_category_row['category_id'] ?>&sub_categories=<?php echo $get_sub_cat_row['sub_cat_id'] ?>"><?php echo $get_sub_cat_row['sub_categories'] ?></a></a>
                        <?php }
                                }
                            }
                        ?>
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
                                    <?php if(isset($_GET['sub_categories'])){ ?>
                                            <select class="form-select px-2 py-1 theme-form-select" onchange="sort_product_drop_with_subcat('<?php echo mysqli_real_escape_string($con,$_GET['id']) ?>','<?php echo mysqli_real_escape_string($con,$_GET['sub_categories']) ?>','<?php echo SITE_PATH?>')" id="sort_product_id">
                                                <option class="theme-form-select-option" value="">Default softing</option>
                                                <option class="theme-form-select-option" value="price_low" <?php echo $price_low_selected?>>Sort by price low to hight</option>
                                                <option class="theme-form-select-option" value="price_high" <?php echo $price_high_selected?>>Sort by price high to low</option>
                                                <option class="theme-form-select-option" value="new" <?php echo $new_selected?>>Sort by new first</option>
                                                <option class="theme-form-select-option" value="old" <?php echo $old_selected?>>Sort by old first</option>
                                            </select>
                                    <?php }else{ ?>
                                            <select class="form-select px-2 py-1 theme-form-select" onchange="sort_product_drop('<?php echo mysqli_real_escape_string($con,$_GET['id']) ?>','<?php echo SITE_PATH?>')" id="sort_product_id">
                                                <option class="theme-form-select-option" value="">Default softing</option>
                                                <option class="theme-form-select-option" value="price_low" <?php echo $price_low_selected?>>Sort by price low to hight</option>
                                                <option class="theme-form-select-option" value="price_high" <?php echo $price_high_selected?>>Sort by price high to low</option>
                                                <option class="theme-form-select-option" value="new" <?php echo $new_selected?>>Sort by new first</option>
                                                <option class="theme-form-select-option" value="old" <?php echo $old_selected?>>Sort by old first</option>
                                            </select>
                                    <?php }?>
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
                                                    <div class="featured_badge">Featured</div>
                                                </div>
                                                <a href="javascript:void(0)" onclick="wishlist_manage('<?php echo $list['id']?>','add')" class="product_wishlist"><i class="fas fa-heart"></i></a>
                                                <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image'] ?>" alt="Product name" class="img-fluid">
                                                <div class="product_details">
                                                    <h5 class="category_name"><?php echo $list['categories'] ?></h5>
                                                    <h5 class="product_name"><a href="product.php?id=<?php echo $list['id'] ?>"><?php echo $list['name'] ?></a></h5>
                                                    <h5 class="product_pricing"><span><?php echo $list['mrp'] ?></span><?php echo $list['price'] ?></h5>
                                                    <h5 class="product_rating">4.9 <i class="fas fa-star"></i></h5>
                                                </div>
                                                <input type="hidden" id="qty" name="qty" value="1">
                                                <a href="javascript:void(0)" onclick="manage_cart('<?php echo $list['id'] ?>','add')" class="btn add_to_cart_btn mt-2 p-2">Add to Cart</a>
                                                <a href="#" class="btn btn_tranperent mt-2">Get In Touch</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- product card ends -->
                                    <?php } ?>
                                </div>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                      <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                      </li>
                                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                                      <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                                      <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                      </li>
                                    </ul>
                                </nav>
                                <?php }else{ echo "Data Not Found";} ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php require('footer.php'); ?>
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