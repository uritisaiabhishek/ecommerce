<?php 
    require('connection.inc.php');
    require('functions.inc.php');
    if(!isset($_SESSION['USER_LOGIN'])){
        ?>
        <script>
        window.location.href='index.php';
        </script>
        <?php
    }
?>

<!DOCTYPE html>
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
    
    <!-- profile section -->
    <section class="profile_page my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="row">
								<div class="col-3"><img src="https://image.flaticon.com/icons/png/512/0/93.png" alt="" class="img-fluid"></div>
								<div class="col"><?php echo $_SESSION['USER_NAME']?></div>
							</div>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card mb-2">
                        <div class="card-header">Personal Information</div>
                        <div class="card-body">	
							<div class="row">
								<div class="col-md-2 col-5">User Name</div>
								<div class="col-md col">
									<?php echo $_SESSION['USER_NAME']?>
									<a class="" data-toggle="collapse" href="#collapseupdateusername" role="button" aria-expanded="false" aria-controls="collapseupdateusername">&nbsp;<i class="fa fa-edit"></i></a>
								</div>
							</div>			
							<div class="row">
								<div class="col-md-2 col-5">Your Email</div>
								<div class="col-md  col"><?php echo $_SESSION['USER_EMAIL']?></div>
							</div>
							<div class="row">
								<div class="col-md-2 col-5">Your Mobile</div>
								<div class="col-md col">999999999</div>
							</div>
							<div class="row">
								<div class="col-md-2 col-5">Password</div>
								<div class="col-md col">*************<a class="" data-toggle="collapse" href="#collapseupdatepassword" role="button" aria-expanded="false" aria-controls="collapseupdatepassword">&nbsp;<i class="fa fa-edit"></i></a></div>
							</div>
                        </div>
                    </div>

					<div class="collapse" id="collapseupdateusername">
						<div class="card mb-2">
							<div class="card-header">Update User Name</div>
							<div class="card-body">
								<form method="post">
									<div class="form-group">
										<label for="username">User Name</label>
										<div class="input-group">
											<input type="text" class="form-control" name="name" id="name"  placeholder="Name" aria-label="username" aria-describedby="usernameupdate" value="<?php echo $_SESSION['USER_NAME']?>">
											<div class="input-group-prepend">
												<button type="button" class="input-group-text" onclick="update_profile()" id="btn_submit usernameupdate">Update</button>
											</div>
										</div>
										<small class="form-text text-muted field_error"></small>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="collapse" id="collapseupdatepassword">
						<div class="card mb-2">
							<div class="card-header">Update Password</div>
							<div class="card-body">
								<form method="post" id="frmPassword">
									<div class="form-group">
										<label for="username">Current Password</label>	
										<input type="password" class="form-control" placeholder="Current Password" name="current_password" id="current_password">	
										<span class="field_error" id="current_password_error"></span>						
									</div>
									<div class="form-group">
										<label for="passwordupdate">New Password</label>
										<div class="input-group">
											<input type="text" class="form-control" name="new_password" id="new_password"  placeholder="New Password" aria-label="passwordupdate" aria-describedby="passwordupdate">
											<input type="text" class="form-control" name="confirm_new_password" id="confirm_new_password"  placeholder="Confirm New password" aria-label="passwordupdate" aria-describedby="passwordupdate">
											<div class="input-group-prepend">
												<button type="button" class="input-group-text" onclick="update_password()" id="btn_update_password">Update</button>
											</div>
										</div>
										<span class="field_error" id="new_password_error"></span><span class="field_error" id="confirm_new_password_error"></span>
									</div>
								</form>

							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- profile section ends -->
    
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