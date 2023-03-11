<?php 
    require('connection.inc.php');
    require('functions.inc.php');
    isAdmin();
    if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN']!=''){
        
    }else{
        header('location:login.php');
        die();
    }

    if(isset($_GET['type']) && $_GET['type']!=''){
        $type=get_safe_value($con,$_GET['type']);
        if($type=='delete'){
            $id=get_safe_value($con,$_GET['id']);
            $delete_sql="delete from orders where id='$id' ";
            mysqli_query($con,$delete_sql);
        }
    }
    // $sql="select * from orders order by id asc";
    // $res=mysqli_query($con,$sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Orders</title>

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
                            <h6 class="m-0 font-weight-bold text-primary">Orders</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Order Date</th>
                                            <th>Address</th>
                                            <th>Payment Type </th>
                                            <th>Payment Status </th>
                                            <th>Order Status</th>
                                            <th>Details</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Order Date</th>
                                            <th>Address</th>
                                            <th>Payment Type </th>
                                            <th>Payment Status </th>
                                            <th>Order Status</th>
                                            <th>Details</th>
                                            <th>Delete</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                                <?php
								                // $res=mysqli_query($con,"select `order`.*,order_status.name as order_status_str from `order`,order_status where order_status.id=`order`.order_status order by `order`.id desc");
                                                $res=mysqli_query($con,"select `orders`.*,order_status.name as order_status_str from `orders`,order_status where order_status.id=`orders`.order_status order by `orders`.id desc");
                                                while($row=mysqli_fetch_assoc($res)){
                                                ?>
                                                <tr>
                                                    <td>
                                                        <a href="order-details.php?id=<?php echo $row['id']?>"> <?php echo $row['id']?></a><br/>
                                                    </td>
                                                    <td><?php echo $row['added_on']?></td>
                                                    <td>
                                                        <?php echo $row['address']?><br/>
                                                        <?php echo $row['city']?><br/>
                                                        <?php echo $row['mobile']?>
                                                    </td>
                                                    <td><?php echo $row['payment_type']?></td>
                                                    <td class="product-name"><?php echo $row['payment_status']?></td>
                                                    <td class="product-name"><?php echo $row['order_status_str']?></td>
                                                    <td>
                                                        <a href="order-details.php?id=<?php echo $row['id'] ?>"  class='btn btn-sm btn-success'>
                                                            Details
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            echo "<a class='btn btn-sm btn-danger' href='?type=delete&id=".$row['id']."'>Delete</a>";
                                                        ?> 
                                                    </td>
                                                </tr> 
								            <?php } ?>
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