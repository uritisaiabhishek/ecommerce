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
    }

    if(isset($_GET['type']) && $_GET['type']!=''){
        $type=get_safe_value($con,$_GET['type']);
        
        if($type=='published'){
            $operation=get_safe_value($con,$_GET['operation']);
            $id=get_safe_value($con,$_GET['id']);
            if($operation=='active'){
                $is_published='1';
            }else{
                $is_published='0';
            }
            $update_status_sql="update blog set is_published='$is_published' where id='$id' $condition1";
            mysqli_query($con,$update_status_sql);
        }
    }


    $sql="select blog.*,blog_categories.blog_category from blog,blog_categories where blog.blog_category_id=blog_categories.id $condition";
    $res=mysqli_query($con,$sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog-<?php echo SITE_NAME ?></title>

    <!-- Custom fonts for this template -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Blog Listing</h6>
                        </div>
                        <div class="card-body">
                            <?php 
                                if(isset($_SESSION['status']) && $_SESSION['status'] !=''){
                                    echo '<div class="alert alert-'.$_SESSION['status_code'].'" role="alert">'.$_SESSION['status'].' </div>';           
                                    unset($_SESSION['status']);
                                }
                            ?>
                            <?php if(mysqli_num_rows($res)>0){ ?>
                            <div class="table-responsive">
                                <table class="display table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>image</th>
                                            <th>category</th>
                                            <th>content</th>
                                            <th>is published</th>
                                            <th>date of publication</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>image</th>
                                            <th>category</th>
                                            <th>content</th>
                                            <th>is published</th>
                                            <th>date of publication</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            while($row=mysqli_fetch_assoc($res)){
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['id'] ?></td>
                                                    <td><?php echo $row['title'] ?></td>
                                                    <td>
                                                        <?php
                                                            $blog_author_sql="select * from admin where id='".$row['author']."'";                                                                               
                                                            $blog_author_res=mysqli_query($con,$blog_author_sql);
                                                            while($blog_author_row=mysqli_fetch_assoc($blog_author_res)){
                                                                echo $blog_author_row['username'];
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><img src="<?php echo BLOG_IMAGE_SITE_PATH.$row['blog_image'] ?>" height="100" alt="<?php echo $row['title'] ?>" /></td>
                                                    <td><?php echo $row['blog_category'] ?></td>
                                                    <td><?php echo $row['blog_content'] ?></td>
                                                    <td>
                                                        <?php 
                                                            if($row['is_published']==1){
                                                                echo "<a class='btn btn-sm btn-success'  href='?type=published&operation=deactive&id=".$row['id']."'>Published</a>";
                                                            }else{
                                                                echo "<a class='btn btn-sm btn-warning'  href='?type=published&operation=active&id=".$row['id']."'>Draft</a>";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $row['created_on'] ?></td>
                                                    <td>
                                                        <?php
                                                            echo "<a class='btn btn-sm btn-primary' href='addBlog.php?id=".$row['id']."'>Edit</a>";
                                                        ?> 
                                                    </td>
                                                    <td>
                                                        <form action="blogcode.php" method="post">
                                                            <input type="hidden" name="delete_blog_id"
                                                                value="<?php echo $row['id']; ?>">
                                                            <input type="hidden" name="delete_blog_image"
                                                                value="<?php echo $row['blog_image']; ?>">
                                                            <button type="submit" name="delete_blog_btn"
                                                                class="btn btn-sm btn-danger">
                                                                DELETE</button>
                                                        </form>
                                                    </td>
                                                </tr>                                                
                                                <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php }else{echo 'No Records Found';} ?>
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

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/datatables-demo.js"></script>

</body>

</html>