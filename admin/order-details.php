<?php 
    require('connection.inc.php');
    require('functions.inc.php');
    isAdmin();
    isBlogEditor();
    
    $order_id=get_safe_value($con,$_GET['id']);

    $coupon_details=mysqli_fetch_assoc(mysqli_query($con,"select coupon_value,coupon_code from `orders` where id='$order_id'"));
    $coupon_value=$coupon_details['coupon_value'];
    $coupon_code=$coupon_details['coupon_code'];

    if(isset($_POST['update_order_status'])){
        $update_order_status=$_POST['update_order_status'];
        if($update_order_status=='5'){
            mysqli_query($con,"update `orders` set order_status='$update_order_status',payment_status='Success' where id='$order_id'");
        }else{
            mysqli_query($con,"update `orders` set order_status='$update_order_status' where id='$order_id'");
        }
        
    }

    $created_on=date('Y-m-d h:i:s');
    if(isset($_POST['update_Product_order_status_submit'])){
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

    <title>order details</title>

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
                            <h6 class="m-0 font-weight-bold text-primary">Order Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Product name</th>
                                            <th>Image</th>
                                            <th>Order Quantity</th>
                                            <th>Price of Product</th>
                                            <th>Total cost of product</th>
                                            <th>delivery status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Product name</th>
                                            <th>Image</th>
                                            <th>Order Quantity</th>
                                            <th>Price of Product</th>
                                            <th>Total cost of product</th>
                                            <th>delivery status</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            $res=mysqli_query($con,"select order_detail.*,product.name,product.image,`orders`.address,`orders`.city,`orders`.mobile from order_detail,product ,`orders` where order_detail.order_id='$order_id' and  order_detail.product_id=product.id");
                                            $total_price=0;
                                            $userInfo=mysqli_fetch_assoc(mysqli_query($con,"select * from `orders` where id='$order_id'"));
                                            $address=$userInfo['address'];
                                            $city=$userInfo['city'];
                                            $pincode=$userInfo['mobile'];
                                            
                                            while($row=mysqli_fetch_assoc($res)){
                                            $total_price=$total_price+($row['qty']*$row['price']);
                                        ?>
                                        <tr>
                                            <td class="product-name"><?php echo $row['name']?></td>
                                            <td class="product-name text-center"> <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>" height="150"></td>
                                            <td class="product-name"><?php echo $row['qty']?></td>
                                            <td class="product-name"><?php echo $row['price']?></td>
                                            <td class="product-name"><?php echo $row['qty']*$row['price']?></td>
                                            <td class="product-name">
                                                <form method="post">
                                                    <input type="hidden" name="update_Product_order_status_id" value="<?php echo $row['id']?>">
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
                                        <?php 
                                            }
                                            if($coupon_value!=''){
                                        ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="product-name">Coupon Value</td>
                                            <td class="product-name">
                                                <?php echo $coupon_value." ($coupon_code)"; ?>
                                            </td>                                            
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="product-name">Total Price</td>
                                            <td class="product-name">
                                                <?php echo $total_price-$coupon_value; ?>
                                            </td>										
                                            <td></td>
                                        </tr>
                                        <?php } else{?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="product-name">Total Price</td>
                                            <td class="product-name">
                                                <?php echo $total_price; ?>
                                            </td>											
                                            <td></td>								
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                
						<div id="address_details">
							<strong>Address</strong>
							<?php echo $address?>, <?php echo $city?>, <?php echo $pincode?><br/><br/>
							<strong>Order Status</strong>
							<?php 
							$order_status_arr=mysqli_fetch_assoc(mysqli_query($con,"select order_status.name from order_status,`orders` where `orders`.id='$order_id' and `orders`.order_status=order_status.id"));
							echo $order_status_arr['name'];
							?>
							
							<div>
								<form method="post">
									<select class="form-control mt-2" name="update_order_status" required>
										<option value="">Change Status</option>
										<?php
										$res=mysqli_query($con,"select * from order_status");
										while($row=mysqli_fetch_assoc($res)){
											if($row['id']==$categories_id){
												echo "<option selected value=".$row['id'].">".$row['name']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['name']."</option>";
											}
										}
										?>
									</select>
									<input type="submit" class="form-control my-2 btn btn-primary" />
								</form>
							</div>
						</div>
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