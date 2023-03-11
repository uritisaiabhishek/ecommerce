<?php
    require('connection.inc.php');
    require('functions.inc.php');

    if(isset($_SESSION['USER_LOGIN'])){
        ?>
        	<script>
        	    window.location.href='index.php';
        	</script>
        <?php
    }

    $user_email=mysqli_real_escape_string($con,$_GET['email']);
    $user_generate_rand_str=mysqli_real_escape_string($con,$_GET['active']);

    $user_activate_sql="select * from users where email='$user_email'";
    $res=mysqli_query($con,$user_activate_sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Activate account - ChronoPegasus</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png">
    <!-- StyleSheets -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/Vendor/bootstrap-4.5.3/dist/css/bootstrap.min.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="assets/Vendor/fontawesome-free-5.15.1-web/css/all.min.css">
    <!-- Owl Carosel -->
    <link rel="stylesheet" href="assets/Vendor/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
    <!-- Custom -->
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <?php require('navbar.php'); ?>
        
        <section class="account-active my-5">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <?php
                            if($row=mysqli_fetch_assoc($res)){
                                if($row['user_status']!=1){
                                    if($row['email']==$user_email){
                                        if($row['user_otp']==$user_generate_rand_str){
                                            mysqli_query($con,"update users set user_status='1',user_otp='' where email='$user_email' ");
                                            echo "account activated";
                                            $_SESSION['USER_LOGIN']='yes';
                                            $_SESSION['USER_ID']=$row['id'];
                                            $_SESSION['USER_NAME']=$row['name'];
                                            $_SESSION['USER_EMAIL']=$row['email'];
                                        }
                                    }
                                    else{
                                        // email id not matched
                                        echo "there is an error in the link click below to send a new link";
                                    }
                                }else{
                                    echo "account already active";
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </section>

    <!-- Footer starts -->
    <?php require('footer.php'); ?>
    <!-- Footer Ends -->



    <!-- Javascript files -->
    <!-- JQuery -->
    <script src="assets/Vendor/jquery-master/dist/jquery-3.2.1.min.js"></script>
    <!-- <script src="assets/Vendor/jquery-master/dist/jquery-3.5.1.slim.min.js"></script> -->
    <!-- Bootstrap -->
    <script src="assets/Vendor/bootstrap-4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- owlcarsel -->
    <script src="assets/Vendor/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    <!-- Custom -->
    <script src="assets/js/custom.js"></script>
</body>
</html>