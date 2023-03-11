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
    isAdmin();
    isBlogEditor();
    $username='';
    $password='';
    $email='';
    $mobile='';
    $admin_role='';
    
    $msg='';
    if(isset($_GET['id']) && $_GET['id']!=''){
        $image_required='';
        $id=get_safe_value($con,$_GET['id']);
        $res=mysqli_query($con,"select * from admin where id='$id'");
        $check=mysqli_num_rows($res);
        if($check>0){
            $row=mysqli_fetch_assoc($res);
            $username=$row['username'];
            $email=$row['email'];
            $mobile=$row['mobile'];
            $password=$row['password'];
            $admin_role=$row['role'];
        }else{
            header('location:adminUsers.php');
            die();
        }
    }
    
    if(isset($_POST['submit'])){
        $username=get_safe_value($con,$_POST['username']);
        $email=get_safe_value($con,$_POST['email']);
        $mobile=get_safe_value($con,$_POST['mobile']);
        $password=get_safe_value($con,$_POST['password']);
        $admin_role=get_safe_value($con,$_POST['admin_role']);
        
        $res=mysqli_query($con,"select * from admin where username='$username'");
        $check=mysqli_num_rows($res);
        if($check>0){
            if(isset($_GET['id']) && $_GET['id']!=''){
                $getData=mysqli_fetch_assoc($res);
                if($id==$getData['id']){
                
                }else{
                    $msg="Username already exist";
                }
            }else{
                $msg="Username already exist";
            }
        }
        
        
        if($msg==''){
            if(isset($_GET['id']) && $_GET['id']!=''){
                $update_sql="update admin set username='$username',password='$password',email='$email',mobile='$mobile'.role='$admin_role' where id='$id'";
                mysqli_query($con,$update_sql);
            }else{
                mysqli_query($con,"insert into admin(username,password,email,mobile,role,status) values('$username','$password','$email','$mobile','$admin_role',1)");
            }
            header('location:adminUsers.php');
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
									<label for="username" class=" form-control-label">Username</label>
									<input type="text" name="username" placeholder="Enter username" class="form-control" required value="<?php echo $username?>">
								</div>
								<div class="form-group">
									<label for="password" class=" form-control-label">Password</label>
									<input type="text" name="password" placeholder="Enter password" class="form-control" required value="<?php echo $password?>">
								</div>
								
								<div class="form-group">
									<label for="password" class=" form-control-label">Email</label>
									<input type="email" name="email" placeholder="Enter email" class="form-control" required value="<?php echo $email?>">
								</div>
								<div class="form-group">
									<label for="admin_role" class=" form-control-label">admin role</label>
									<select name="admin_role">
                                        <option value="0">Admin</option>
                                        <option value="1">Product Vendor</option>
                                        <option value="2">Blog Editor</option>
                                    </select>
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">Mobile</label>
									<input type="text" name="mobile" placeholder="Enter mobile" class="form-control" required value="<?php echo $mobile?>">
								</div>
								
								
							   <!-- <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button> -->
                               
                                <?php if(isset($_GET['id']) && $_GET['id']!=''){ ?>
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                <?php }else{ ?>
                                    <button type="submit" name="submit" class="btn btn-primary">Add</button>
                                <?php } ?>
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