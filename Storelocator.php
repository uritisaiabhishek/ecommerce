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
    <title>Store Locations - ChronoPegasus</title>
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

    <section class="stores_list my-3">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h1>Store Name</h1>
                    <p>Location details</p>
                    <iframe 
                        width="100%" 
                        height="250" 
                        frameborder="0"
                        scrolling="no" 
                        marginheight="0" 
                        marginwidth="0" 
                        src="https://maps.google.com/maps?width=100%25&amp;height=400&amp;hl=en&amp;q=17.803937996159632,83.35211277008058+(hi wll do)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                    </iframe>
                </div>
                <div class="col-md-4">
                    <h1>Store Name</h1>
                    <p>Location details</p>
                    <iframe 
                        width="100%" 
                        height="250" 
                        frameborder="0"
                        scrolling="no" 
                        marginheight="0" 
                        marginwidth="0" 
                        src="https://maps.google.com/maps?width=100%25&amp;height=400&amp;hl=en&amp;q=17.803937996159632,83.35211277008058+(hi wll do)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                    </iframe>
                </div>
                <div class="col-md-4">
                    <h1>Store Name</h1>
                    <p>Location details</p>
                    <iframe 
                        width="100%" 
                        height="250" 
                        frameborder="0"
                        scrolling="no" 
                        marginheight="0" 
                        marginwidth="0" 
                        src="https://maps.google.com/maps?width=100%25&amp;height=400&amp;hl=en&amp;q=17.803937996159632,83.35211277008058+(hi wll do)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                    </iframe>
                </div>
                <div class="col-md-4">
                    <h1>Store Name</h1>
                    <p>Location details</p>
                    <iframe 
                        width="100%" 
                        height="250" 
                        frameborder="0"
                        scrolling="no" 
                        marginheight="0" 
                        marginwidth="0" 
                        src="https://maps.google.com/maps?width=100%25&amp;height=400&amp;hl=en&amp;q=17.803937996159632,83.35211277008058+(hi wll do)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                    </iframe>
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