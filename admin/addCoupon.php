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
    $coupon_code='';
    $coupon_type='';
    $coupon_value='';
    $cart_min_value='';
    
    $msg='';
    if(isset($_GET['id']) && $_GET['id']!=''){
        $image_required='';
        $id=get_safe_value($con,$_GET['id']);
        $res=mysqli_query($con,"select * from coupon_master where id='$id'");
        $check=mysqli_num_rows($res);
        if($check>0){
            $row=mysqli_fetch_assoc($res);
            $coupon_code=$row['coupon_code'];
            $coupon_type=$row['coupon_type'];
            $coupon_value=$row['coupon_value'];
            $cart_min_value=$row['cart_min_value'];
        }else{
            header('location:coupons.php');
            die();
        }
    }
    
    if(isset($_POST['submit'])){
        $coupon_code=get_safe_value($con,$_POST['coupon_code']);
        $coupon_type=get_safe_value($con,$_POST['coupon_type']);
        $coupon_value=get_safe_value($con,$_POST['coupon_value']);
        $cart_min_value=get_safe_value($con,$_POST['cart_min_value']);
        
        $res=mysqli_query($con,"select * from coupon_master where name='$coupon_code'");
        $check=mysqli_num_rows($res);
        if($check>0){
            if(isset($_GET['id']) && $_GET['id']!=''){
                $getData=mysqli_fetch_assoc($res);
                if($id==$getData['id']){
                
                }else{
                    $msg="Coupon code already exist";
                }
            }else{
                $msg="Coupon code already exist";
            }
        }
        
        
        if($msg==''){
            if(isset($_GET['id']) && $_GET['id']!=''){
                $update_sql="update coupon_master set coupon_code='$coupon_code',coupon_value='$coupon_value',coupon_type='$coupon_type',cart_min_value='$cart_min_value' where id='$id'";
                mysqli_query($con,$update_sql);
            }else{
                mysqli_query($con,"insert into coupon_master(coupon_code,coupon_value,coupon_type,cart_min_value,status) values('$coupon_code','$coupon_value','$coupon_type','$cart_min_value',1)");
            }
            header('location:coupons.php');
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
                                    <?php
                                    if($msg!=''){
                                        ?>
                                    <div class="py-3 alert alert-danger" role="alert">
                                        <?php echo $msg ?>
                                    </div>
                                    <?php
                                    } ?>
                            <form method="post">
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Coupon Code</label>
									<input type="text" name="coupon_code" placeholder="Enter coupon code" class="form-control" required value="<?php echo $coupon_code?>">
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">Coupon Value</label>
									<input type="text" name="coupon_value" placeholder="Enter coupon value" class="form-control" required value="<?php echo $coupon_value?>">
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">Coupon Type</label>
									<select class="form-control" name="coupon_type" required>
										<option value=''>Select</option>
										<?php
										if($coupon_type=='Percentage'){
											echo '<option value="Percentage" selected>Percentage</option>
												<option value="Rupee">Rupee</option>';
										}elseif($coupon_type=='Rupee'){
											echo '<option value="Percentage">Percentage</option>
												<option value="Rupee" selected>Rupee</option>';
										}else{
											echo '<option value="Percentage">Percentage</option>
												<option value="Rupee">Rupee</option>';
										}
										?>
									</select>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Cart Min Value</label>
									<input type="text" name="cart_min_value" placeholder="Enter cart min value" class="form-control" required value="<?php echo $cart_min_value?>">
								</div>
								
								
							   <!-- <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button> -->
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