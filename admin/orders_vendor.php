<?php 
    require('connection.inc.php');
    require('functions.inc.php');
    isBlogEditor();
    if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN']!=''){
        
    }else{
        header('location:login.php');
        die();
    }
    
    $created_on=date('Y-m-d h:i:s');
    if(isset($_POST['update_Product_order_status_submit'])){
        $order_id=get_safe_value($con,$_POST['update_order_id']);
        $update_Product_order_id=get_safe_value($con,$_POST['update_Product_order_status_id']);
        $update_Product_order_status=get_safe_value($con,$_POST['update_Product_order_status']);
        
        mysqli_query($con,"update `order_detail` set product_delivery_status='$update_Product_order_status',product_delivery_date='$created_on' where id='$order_id' and product_id='$update_Product_order_id' ");
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

    <title>SB Admin 2 - Tables</title>

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
                                            <th>Order Date</th>
                                            <th>Product name</th>
                                            <th>Product Quntity</th>
                                            <th>Address</th>
                                            <th>Payment Type </th>
                                            <th>Payment Status </th>
                                            <th>Order Status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Order Date</th>
                                            <th>Product name</th>
                                            <th>Product Quntity</th>
                                            <th>Address</th>
                                            <th>Payment Type </th>
                                            <th>Payment Status </th>
                                            <th>Order Status</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            $res=mysqli_query($con,"select order_detail.product_delivery_status,order_detail.product_id,order_detail.qty,product.name,`orders`.*,order_status.name as order_status_str from order_detail,product,`orders`,order_status where order_status.id=`orders`.order_status and product.id=order_detail.product_id and `orders`.id=order_detail.order_id and product.added_by='".$_SESSION['ADMIN_ID']."' order by `orders`.id desc");
                                            while($row=mysqli_fetch_assoc($res)){
                                        ?>
                                            <tr>
                                                <td><?php echo date("d-M-Y",strtotime($row['added_on']))?></td>
                                                <td><?php echo $row['name']?></td>
                                                <td><?php echo $row['qty']?></td>
                                                <td class="product-name">
                                                    <?php echo $row['address']?>,
                                                    <?php echo $row['city']?>,
                                                    <?php echo $row['mobile']?>
                                                </td>
                                                <td class="product-name"><?php echo $row['payment_type']?></td>
                                                <td class="product-name"><?php echo $row['payment_status']?></td>
                                                <td>
                                                    <form method="post">
                                                        <input type="hidden" name="update_order_id" value="<?php echo $row['id']?>">
                                                        <input type="hidden" name="update_Product_order_status_id" value="<?php echo $row['product_id']?>">
                                                        <select class="form-control mt-2" name="update_Product_order_status" required>
                                                            <option value="">Change Status</option>
                                                            <?php
                                                                $res=mysqli_query($con,"select * from product_delivery_status");
                                                                while($product_delivery_row=mysqli_fetch_assoc($res)){
                                                                    if($product_delivery_row['id']==$row['product_delivery_status']){
                                                                        echo "<option selected value=".$product_delivery_row['id'].">".$product_delivery_row['name']."</option>";
                                                                    }else{
                                                                        echo "<option value=".$product_delivery_row['id'].">".$product_delivery_row['name']."</option>";
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                        <input type="submit" name="update_Product_order_status_submit" class="form-control my-2 btn btn-primary" />
                                                    </form> 
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