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
    if(isset($_GET['str1'])&& isset($_GET['str2'])){
        $str_url1=mysqli_real_escape_string($con,$_GET['str1']);
        $str_url2=mysqli_real_escape_string($con,$_GET['str2']);
        
        if(isset($_POST['submit'])){
            $forget_password = get_safe_value($con,$_POST['forget_password']);
            $forget_password_confirm = get_safe_value($con,$_POST['forget_password_confirm']);
            echo $encryp_pswd=sha1($forget_password_confirm);
            echo $str_url1;
            if($forget_password==$forget_password_confirm){
                mysqli_query($con,"update users set password='$encryp_pswd',user_otp='' where email='$str_url1' ");
                echo "password changed";
            }else{
                //password do not match error
                echo "do not match";
            }
        }
    }else{
        if(isset($_POST['submit'])){
            $forget_email = get_safe_value($con,$_POST['forget_email']);
            $forget_email_otp_str = sha1(uniqid());
            mysqli_query($con,"update users set user_otp='$forget_email_otp_str' where email='$forget_email' ");
            // send mail with email and otp
            
            ini_set( 'display_errors', 1 );
            error_reporting( E_ALL );
            $template_file=SERVER_PATH."forget_password_template.php";
            $from = "info@chronopegasus.com";
            $to = $forget_email;
            $subject = "Forgot Your password!";

            $headers = "From: " . $from."\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            
            if(file_exists($template_file)){
                $message1 = file_get_contents($template_file);
                $message2 = str_replace("{{useremail}}",$forget_email,$message1);
                $message = str_replace("{{useractive_code}}",$forget_email_otp_str,$message2);
            }else{
                die("unable to locate file");
            }

            // echo $message;
            if(mail($to,$subject,$message, $headers)) {
                // echo "The email sent.";
            } else {
                echo "The email message was not sent.";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Forget Password - ChronoPegasus</title>
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
        <?php include('navbar.php'); ?>

        <section class="forget_password my-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <?php
                            if(isset($_GET['str1'])&& isset($_GET['str2'])){
                                $str_url1=mysqli_real_escape_string($con,$_GET['str1']);
                                $str_url2=mysqli_real_escape_string($con,$_GET['str2']);
                                
                                $forgot_pswd_query=mysqli_query($con,"select * from users where email='$str_url1' and user_status='1'");
                                if($row=mysqli_fetch_assoc($forgot_pswd_query)){
                                    if($row['user_otp']==$str_url2){
                                        // otp equal
                                    ?>
                                        <form method="post">
                                            <div class="form-group my-2">
                                                <input type="text" class="form-control" name="forget_password" placeholder="forget_password">
                                            </div>
                                            <div class="form-group my-2">
                                                <input type="text" class="form-control" name="forget_password_confirm" placeholder="forget_password_confirm">
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-theme btn-block">submit</button>
                                        </form>    
                                    <?php
                                    }
                                }else{
                                    // user not found
                                    echo "There is an error please try again by clicking here";
                                }
                            }else{
                        ?>        
                            <form method="post">
                                <div class="form-group my-2">
                                    <input type="text" class="form-control" name="forget_email" placeholder="Please Enter Your email">
                                </div>
                                <button type="submit" name="submit" class="btn btn-theme btn-block">submit</button>
                            </form>   
                        <?php
                            }
                        ?>               
                    </div>
                </div>
            </div>
        </section>
        
    <?php include('footer.php');  ?>

<!-- Javascript files -->
<!-- JQuery -->
<script src="assets/Vendor/jquery-master/dist/jquery-3.2.1.min.js"></script>
<!-- Bootstrap -->
<script src="assets/Vendor/bootstrap-4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- owlcarsel -->
<script src="assets/Vendor/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
<!-- Custom -->
<script src="assets/js/custom.js"></script>
</body>
</html>