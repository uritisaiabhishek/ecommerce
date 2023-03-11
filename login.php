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
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>ChronoPegasus</title>
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

        <section class="authentication my-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <ul class="nav nav-tabs  nav-justified" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Login</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Register</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <form id="login-form" method="post">
									<div class="form-group my-2">
										<input class="form-control"  type="text" id="login_name" name="login_name" placeholder="Your Email*">
                                        <span class="field_error" id="login_name_error"></span>
                                    </div>
									<div class="form-group my-2">
										<input class="form-control" type="password" id="login_password" name="login_password" placeholder="Your Password*">
                                        <span class="field_error" id="login_paassword_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <a href="forget-password.php">Forgot password</a>
                                    </div>
									<button type="button" class="btn btn-theme btn-block" onclick="user_login()">Login</button>
								</form>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <form id="register-form" method="post">
                                    <div class="form-group my-2">
										<input class="form-control"  type="text" id="name" name="name" placeholder="Your Name*">
                                        <span class="field_error" id="name_error"></span>
                                    </div>
                                    <div class="form-group my-2">
										<input class="form-control"  type="text" id="email" name="email"placeholder="Your Email*">
                                        <span class="field_error" id="email_error"></span>
                                    </div>
                                    <div class="form-group my-2">
										<input  class="form-control" type="text" id="mobile" name="mobile" placeholder="Your Mobile*">
                                        <span class="field_error" id="mobile_error"></span>
                                    </div>
                                    <div class="form-group my-2">
										<input  class="form-control" type="password" id="password" name="password" placeholder="Your Password*" >
                                        <span class="field_error" id="password_error"></span>
                                    </div>
									<button type="button" class="btn btn-theme btn-block" onclick="user_register()">Register</button>
								</form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-output login_msg">
					<p class="form-messege field_error"></p>
				</div>
				<div class="form-output register_msg">
					<p class="form-messege field_error"></p>
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