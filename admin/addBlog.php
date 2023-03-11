<?php
    require('connection.inc.php');
    require('functions.inc.php');
    isAdmin();
    if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN']!=''){
        
    }else{
        header('location:login.php');
        die();
    }
    $condition='';
    $condition1='';
    if($_SESSION['ADMIN_ROLE']==2){
        $condition=" and blog.author='".$_SESSION['ADMIN_ID']."'";
        $condition1=" and author='".$_SESSION['ADMIN_ID']."'";
    }
    
    $msg='';
    $title='';
    $blog_content='';
    $blog_image='';
    $is_published='';
    $blog_image_required='';
    $created_on=date('Y-m-d h:i:s');
    
    if(isset($_GET['id']) && $_GET['id']!=''){
        $msg='got id';
        $blog_image_required='';
        $id=get_safe_value($con,$_GET['id']);
        $res=mysqli_query($con,"select * from blog where id='$id' $condition1");
        $check=mysqli_num_rows($res);
        if($check>0){
            $row=mysqli_fetch_assoc($res);
            $title=$row['title'];
            $blog_content=$row['blog_content'];
            $blog_category_id=$row['blog_category_id'];
            $is_published=$row['is_published'];
            $blog_image=$row['blog_image'];
        }else{
            header('location:blog.php');
            die();
        }
    }
    
    if(isset($_POST['submit'])){
        // pr($_FILES);
        // prx($_POST);
        $title=get_safe_value($con,$_POST['title']);
        $blog_content=get_safe_value($con,$_POST['blog_content']);
        $is_published=get_safe_value($con,$_POST['is_published']);
        $blog_category_id=get_safe_value($con,$_POST['blog_category_id']);
        $blog_image_required='required';

        
	    $res=mysqli_query($con,"select * from blog where title='$title' $condition1");
        $check=mysqli_num_rows($res);
        if($check>0){
            if(isset($_GET['id']) && $_GET['id']!=''){
                $getData=mysqli_fetch_assoc($res);
                if($id==$getData['id']){
                    $msg='';                
                }else{
                    $msg="Similar Blog already exists";
                }
            }else{
                $msg="Similar Blog already exist";
            }
        }
        
        if(isset($_GET['id']) && $_GET['id']==0){
            if($_FILES['blog_image']['type']!='image/png' && $_FILES['blog_image']['type']!='image/jpg' && $_FILES['blog_image']['type']!='image/jpeg'){
                $msg="Please select only png,jpg and jpeg image formate";
            }
        }else{
            if($_FILES['blog_image']['type']!=''){
                    if($_FILES['blog_image']['type']!='image/png' && $_FILES['blog_image']['type']!='image/jpg' && $_FILES['blog_image']['type']!='image/jpeg'){
                    $msg="Please select only png,jpg and jpeg image formate";
                }
            }
        }

        if($msg==''){
            if(isset($_GET['id']) && $_GET['id']!=''){
                if($_FILES['blog_image']['name']!=''){
                    echo 'image not empty';
                    $blog_image=rand(111111111,999999999).'_'.$_FILES['blog_image']['name'];
                    move_uploaded_file($_FILES['blog_image']['tmp_name'],BLOG_IMAGE_SERVER_PATH.$blog_image);
                    $update_sql="update blog set blog_image='$blog_image',title='$title',blog_content='$blog_content',is_published='$is_published',created_on='$created_on',blog_category_id='$blog_category_id' where id='$id'";
                }else{
                    echo 'image empty';
                    $update_sql="update blog set blog_image='$blog_image',title='$title',blog_content='$blog_content',is_published='$is_published',created_on='$created_on',blog_category_id='$blog_category_id' where id='$id'";
                }
                mysqli_query($con,$update_sql);
            }else{
                $blog_image=rand(111111111,999999999).'_'.$_FILES['blog_image']['name'];
                move_uploaded_file($_FILES['blog_image']['tmp_name'],BLOG_IMAGE_SERVER_PATH.$blog_image);
                mysqli_query($con,"insert into blog(title,is_published,blog_content,blog_image,author,created_on,blog_category_id) values('$title','$is_published','$blog_content','$blog_image','".$_SESSION['ADMIN_ID']."','$created_on','$blog_category_id')");
                $id=mysqli_insert_id($con);
            }

            header('location:blog.php');
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

    <title>Add Blog - <?php echo SITE_NAME ?></title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="stylesheet" href="assets/vendor/summernote-0.8.18-dist/summernote-bs4.min.css">
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
                            <h6 class="m-0 font-weight-bold text-primary">Blog List</h6>
                        </div>
                        <div class="card-body">
                            <?php if($msg!=''){ ?>
                                <div class="py-3 alert alert-danger" role="alert">
                                    <?php echo $msg ?>
                                </div>
                            <?php } ?>
                            <form method="post" class="container" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="" class="form-label">Blog Tite</label>
                                            <input type="text" name="title" class="form-control" value="<?php echo $title ?>" placeholder="enter product name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                                <label for="categories" class=" form-control-label">Categories</label>
                                                <select class="form-control" name="blog_category_id" required>
                                                    <option>Select Category</option>
                                                    <?php
                                                    $blog_cat_res=mysqli_query($con,"select id,blog_category from blog_categories order by id asc");
                                                    while($blog_cat_row=mysqli_fetch_assoc($blog_cat_res)){
                                                        if($blog_cat_row['id']==$blog_category_id){
                                                            echo "<option selected value=".$blog_cat_row['id'].">".$blog_cat_row['blog_category']."</option>";
                                                        }else{
                                                            echo "<option value=".$blog_cat_row['id'].">".$blog_cat_row['blog_category']."</option>";
                                                        }
                                                        
                                                    }
                                                    ?>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="" class="form-label">Blog Image</label>
                                            <input type="file" name="blog_image" class="form-control" <?php echo $blog_image_required ?>>
                                            <?php if($blog_image!=''){echo("<a target='_blank' href='".BLOG_IMAGE_SITE_PATH.$blog_image."' ><img src='".BLOG_IMAGE_SITE_PATH.$blog_image."' width='200px' /></a>");} ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="" class="form-label">Publish</label>
                                            <select name="is_published" class='form-control'>
                                                <option value="1">Publish</option>
                                                <option value="0">Draft</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="" class="form-label">Blog Content</label>
                                            <textarea id="summernote" name="blog_content"><?php echo $blog_content ?></textarea>
                                       </div>
                                    </div>
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
    <script src="assets/vendor/summernote-0.8.18-dist/summernote-bs4.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>
    
	<script>
        $(document).ready(function() {
            $('#summernote').summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            });
        });
    </script>

</body>

</html>