<?php 
    require('connection.inc.php');
    require('functions.inc.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>contact - ChronoPegasus</title>
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
    <section class="contact_form my-5">
        <div class="container">
            <div class="main-page-title">
                <h1>Contact Us</h1>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <h2>Address</h2>
                    <address><?php echo SITE_Address ?></address>
                    <h2>Phone number</h2>
                    <p class="m-0 p-0"><?php echo SITE_PHONE?></p>
                </div>  
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="contact-form" action="#" method="post">
                                <div class="form-group">
                                    <input class="form-control" type="text" id="name" name="name" placeholder="Your Name*">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="email"  id="email" name="email" placeholder="Mail*">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text"  id="mobile" name="mobile" placeholder="Mobile*">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" id="subject" name="subject" placeholder="Subject*">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="message" id="message" placeholder="Your Message"></textarea>
                                </div>
                                <button type="button" onclick="send_message()" class="btn btn-block btn-theme">Send MESSAGE</button>
                            </form>
                        </div>
                    </div>
                    <div class="form-output">
                        <p class="form-messege"></p>
                    </div>
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
    <!-- Bootstrap -->
    <script src="assets/Vendor/bootstrap-4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- owlcarsel -->
    <script src="assets/Vendor/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    <!-- Custom -->
    <script src="assets/js/custom.js"></script>
</body>
</html>