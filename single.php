<?php 
    require('connection.inc.php');
    require('functions.inc.php');
    $meta_url = ''.SITE_PATH.'single.php?id='.$_GET['id'].'';
    if(isset($_GET['id'])){
        $blog_id=mysqli_real_escape_string($con,$_GET['id']);
        if($blog_id>0||$blog_id!=''){
            $single_blog_sql="select blog.*,blog_categories.blog_category from blog,blog_categories where blog.blog_category_id=blog_categories.id and blog.is_published='1' and blog.id='$blog_id'";
            $single_blog_res=mysqli_query($con,$single_blog_sql);
            while($blog_single_row=mysqli_fetch_assoc($single_blog_res)){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->    
    <title><?php echo $blog_single_row['title'] ?></title>
    <meta name="description" content="<?php echo $blog_single_row['content'] ?>">
	<meta name="keywords" content="<?php echo $blog_single_row['title'] ?>">
    <meta property="og:title" content="<?php echo $blog_single_row['title'] ?>" />
    <meta property="og:image" content="<?php echo PRODUCT_IMAGE_SITE_PATH.$get_product['0']['image'] ?>" />
    <meta property="og:url" content="<?php echo $blog_single_row['title'] ?>" />
    <meta property="og:site_name" content="<?php echo SITE_PATH ?>" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo SITE_PATH ?>assets/images/favicon.png" type="image/png">
    <!-- StyleSheets -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo SITE_PATH ?>assets/Vendor/bootstrap-4.5.3/dist/css/bootstrap.min.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="<?php echo SITE_PATH ?>assets/Vendor/fontawesome-free-5.15.1-web/css/all.min.css">
    <!-- Owl Carosel -->
    <link rel="stylesheet" href="<?php echo SITE_PATH ?>assets/Vendor/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
    <!-- Custom -->
    <link rel="stylesheet" href="<?php echo SITE_PATH ?>assets/css/styles.css">
</head>
<body>
    
    <?php include('navbar.php'); ?>

    <!-- product_details section starts -->
    <section class="product_details my-5">
        <div class="container-fluid product_grid">
            <div class="card product_grid_card">
                <div class="card-header row">
                    <div class="col-md home_card_heading"><?php echo $blog_single_row['title'] ?></div>
                </div>
                <div class="container-fluid mt-3">
                    <div class="row">
                        <div class="col-md-9">
                            <img src="<?php echo BLOG_IMAGE_SITE_PATH.$blog_single_row['blog_image']?>" class="img-fluid" alt="">
                            <div class="border-bottom-theme my-3"></div>
                            <div class="d-flex my-3">
                                <p class="m-0 pr-3 single_blog_username"><i class="fa fa-user">&nbsp;by&nbsp;username</i></p>
                                <p class="m-0 pr-3 single_blog_date"><i class="fa fa-calendar">&nbsp;<?php echo date("d-m-Y",strtotime($blog_single_row['created_on'])) ?></i></p>
                            </div>
                            <div class="single_blog_title"><?php echo $blog_single_row['title'] ?>&nbsp;-&nbsp;<?php echo $blog_single_row['blog_category'] ?></div>
                            <div class="single_blog_content mt-3"><?php echo $blog_single_row['blog_content'] ?></div>
                        </div>
                        <div class="col-md-3">hihi</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product_details section ends -->
    
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
<?php
            }
}
}else{
    ?>
    <script>
        window.location.href='blog.php';
    </script>
    <?php
}
?>