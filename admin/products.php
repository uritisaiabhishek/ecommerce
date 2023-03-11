<?php 
    require('connection.inc.php');
    require('functions.inc.php');
    isBlogEditor();
    if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN']!=''){
        
    }else{
        header('location:login.php');
        die();
    }

    $condition='';
    $condition1='';
    if($_SESSION['ADMIN_ROLE']==1){
        $condition=" and product.added_by='".$_SESSION['ADMIN_ID']."'";
        $condition1=" and added_by='".$_SESSION['ADMIN_ID']."'";
    }

    if(isset($_GET['type']) && $_GET['type']!=''){
        $type=get_safe_value($con,$_GET['type']);
        if($type=='status'){
            $operation=get_safe_value($con,$_GET['operation']);
            $id=get_safe_value($con,$_GET['id']);
            if($operation=='active'){
                $status='1';
            }else{
                $status='0';
            }
		    $update_status_sql="update product set status='$status' $condition1 where id='$id'";
            // $update_status_sql="update product set status='$status' where id='$id' ";
            mysqli_query($con,$update_status_sql);
        }
        if($type=='best_seller'){
            $operation=get_safe_value($con,$_GET['operation']);
            $id=get_safe_value($con,$_GET['id']);
            if($operation=='active'){
                $best_seller='1';
            }else{
                $best_seller='0';
            }
            $update_status_sql="update product set best_seller='$best_seller' where id='$id' ";
            mysqli_query($con,$update_status_sql);
        }
        if($type=='is_featured'){
            $operation=get_safe_value($con,$_GET['operation']);
            $id=get_safe_value($con,$_GET['id']);
            if($operation=='active'){
                $is_featured='1';
            }else{
                $is_featured='0';
            }
            $update_status_sql="update product set is_featured='$is_featured' where id='$id' ";
            mysqli_query($con,$update_status_sql);
        }
        if($type=='delete'){
            $id=get_safe_value($con,$_GET['id']);            
            $query = "SELECT * FROM product WHERE id='$id'  $condition1";
            $query_run = mysqli_query($con, $query);
        
            if($query_run)
            {
                while($row=mysqli_fetch_assoc($query_run)){
                    $delete_product_image=$row['image'];
                    $file= PRODUCT_IMAGE_SERVER_PATH.$delete_product_image;
                    unlink($file);
                             
                    // $resMultipleImages=mysqli_query($con,"select * from product_images where product_id='$id'");
                    // $multipleImages=[];
                    // if(mysqli_num_rows($resMultipleImages)>0){
                    //     while($rowMultipleImages=mysqli_fetch_assoc($resMultipleImages)){
                    //         $multipleImages[]=$rowMultipleImages['product_images'];
                    //     }
                    // }
                    // if(isset($multipleImages[0])){
                    //     foreach($multipleImages as $list){
                    //         $delete_product_image=$row['product_images'];
                    //         $file= PRODUCT_MULTIPLE_IMAGE_SERVER_PATH.$delete_product_image;
                    //         unlink($file);
                            
                    //         $delete_multi_sql="delete from product_images where id='$id' ";
                    //         mysqli_query($con,$delete_multi_sql);
                    //     }
                    // } 

                    $delete_sql="delete from product where id='$id' ";
                    mysqli_query($con,$delete_sql);
                } 
            }
        }
    }
    $sql="select product.*,categories.categories from product,categories where product.categories_id=categories.id $condition order by product.id desc";
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

    <title>Products</title>

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
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Products</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Category</th>
                                            <th>subcategory</th>
                                            <th>Product name</th>
                                            <th>Mrp</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Image</th>
                                            <th>Short_desc</th>
                                            <th>description</th>
                                            <th>status</th>
                                            <th>best seller</th>
                                            <th>Featured</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Category</th>
                                            <th>subcategory</th>
                                            <th>Product name</th>
                                            <th>Mrp</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Image</th>
                                            <th>Short_desc</th>
                                            <th>description</th>
                                            <th>status</th>
                                            <th>best seller</th>
                                            <th>Featured</th>
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
                                                    <td><?php echo $row['categories'] ?></td>
                                                    <td><?php echo $row['categories'] ?></td>
                                                    <td><?php echo $row['name'] ?></td>
                                                    <td><?php echo $row['mrp'] ?></td>
                                                    <td><?php echo $row['price'] ?></td>
                                                    <td><?php echo $row['qty'] ?>
							   <?php
							   $productSoldQtyByProductId=productSoldQtyByProductId($con,$row['id']);
							   $pneding_qty=$row['qty']-$productSoldQtyByProductId;
							   
							   ?>
							   Pending Qty <?php echo $pneding_qty?></td>
                                                    <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'] ?>" height="100" /></td>
                                                    <td><?php echo $row['short_desc'] ?></td>
                                                    <td><?php echo $row['description'] ?></td>
                                                    <td>
                                                        <?php 
                                                            if($row['status']==1){
                                                                echo "<a class='btn btn-sm btn-success'  href='?type=status&operation=deactive&id=".$row['id']."'>Active</a>";
                                                            }else{
                                                                echo "<a class='btn btn-sm btn-warning'  href='?type=status&operation=active&id=".$row['id']."'>In-Active</a>";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if($row['best_seller']==1){
                                                                echo "<a href='?type=best_seller&operation=deactive&id=".$row['id']."'>Yes</a>";
                                                            }else{
                                                                echo "<a href='?type=best_seller&operation=active&id=".$row['id']."'>No</a>";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if($row['is_featured']==1){
                                                                echo "<a href='?type=is_featured&operation=deactive&id=".$row['id']."'>Yes</a>";
                                                            }else{
                                                                echo "<a href='?type=is_featured&operation=active&id=".$row['id']."'>No</a>";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            echo "<a class='btn btn-sm btn-primary' href='addProduct.php?id=".$row['id']."'>Edit</a>";
                                                        ?> 
                                                    </td>
                                                    <td>
                                                        <?php
                                                            echo "<a class='btn btn-sm btn-danger' href='?type=delete&id=".$row['id']."'>Delete</a>";
                                                        ?> 
                                                    </td>
                                                </tr>                                                
                                                <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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