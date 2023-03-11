<?php
    require('connection.inc.php');
    require('functions.inc.php');
    isAdmin();
    isBlogEditor();
    if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN']!=''){
        
    }else{
        header('location:login.php');
        die();
    }
    $categories='';
    $msg='';
    $categories_image='';
    $product_category_image_required='required';

    if(isset($_GET['id'])&& $_GET['id']!=''){
        $msg='got id';
        $product_category_image_required='';
        $id=get_safe_value($con,$_GET['id']);
        $res=mysqli_query($con,"select * from categories where id='$id'");
        $check=mysqli_num_rows($res);
        if($check>0){
            $row=mysqli_fetch_assoc($res);
            $categories=$row['categories'];
            $categories_image=$row['categories_image'];
        }else{
            header('location:categories.php');
            die();
        }
    }

    if(isset($_POST['submit'])){
        // pr($_FILES);
        // prx($_POST);
        $categories=get_safe_value($con,$_POST['categories']);
        $res=mysqli_query($con,"select * from categories where categories='$categories'");
        $check=mysqli_num_rows($res);

        if($check>0){
            if(isset($_GET['id'])&& $_GET['id']!=''){
                $getData=mysqli_fetch_assoc($res);
                if($id==$getData['id']){
                    $msg='';             
                }else{
                    $msg="Category already Exist";
                }
            }else{
                $msg="Category already Exist";
            }
        }

        if(isset($_GET['id']) && $_GET['id']==0){
            if($_FILES['categories_image']['type']!='image/png' && $_FILES['categories_image']['type']!='image/jpg' && $_FILES['categories_image']['type']!='image/jpeg'){
                $msg="Please select only png,jpg and jpeg image formate";
            }
        }else{
            if($_FILES['categories_image']['type']!=''){
                if($_FILES['categories_image']['type']!='image/png' && $_FILES['categories_image']['type']!='image/jpg' && $_FILES['categories_image']['type']!='image/jpeg'){
                    $msg="Please select only png,jpg and jpeg image formate";
                }
            }
        }

        if($msg==''){
            if(isset($_GET['id']) && $_GET['id']!=''){
                if($_FILES['categories_image']['name']!=''){
                    $categories_image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'],CATEGORY_IMAGE_SERVER_PATH.$image);
                    $update_sql="update product set categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword',image='$image',best_seller='$best_seller',sub_categories_id='$sub_categories_id' where id='$id'";
                    mysqli_query($con,"update categories set categories='$categories' where id='$id'");
                }else{
                    mysqli_query($con,"update categories set categories='$categories' where id='$id'");
                    $update_sql="update product set categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword',best_seller='$best_seller',sub_categories_id='$sub_categories_id' where id='$id'";
                }
                mysqli_query($con,$update_sql);
            }else{
                $categories_image=rand(111111111,999999999).'_'.$_FILES['categories_image']['name'];
                if(move_uploaded_file($_FILES['categories_image']['tmp_name'],CATEGORY_IMAGE_SERVER_PATH.$categories_image)){
                    mysqli_query($con,"insert into categories(categories,cat_image,status) values('$categories','$categories_image',1)");
                    $id=mysqli_insert_id($con);
                }
            }
            
            header('location:categories.php');
            die();
        }
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Blank</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include('sidebar.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            <?php include('header.php'); ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Add New Category</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <?php if($msg!=''){ ?>
                                <div class="py-3 alert alert-danger" role="alert">
                                    <?php echo $msg ?>
                                </div>
                            <?php } ?>
                            <form method="post"  enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="" class="form-label">New Category</label>
                                    <input type="text" name="categories" class="form-control" placeholder="enter category" required value="<?php echo $categories; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Blog Image</label>
                                    <input type="file" name="categories_image" id="categories_image" class="form-control" <?php echo $product_category_image_required ?>>
                                    <?php if($categories_image!=''){echo("<img src='".CATEGORY_IMAGE_SITE_PATH.$categories_image."' width='200px' />");} ?>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include('footer.php'); ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>