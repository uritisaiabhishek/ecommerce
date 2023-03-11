<?php 
    require('connection.inc.php');
    require('functions.inc.php');
    if(isset($_POST['submit'])){
        // $txnid=get_safe_value($con,$_POST['txnid']);
        $txnid=$_POST['txnid'];
        echo 'got txnid';
    }
    else{
        echo 'did not get txnid';
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
    
    <section class="thank_you my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-7 mx-auto">
                    <div class="card">
                        <div class="card-header">Thank you</div>
                        <div class="card-body">
                            <h1 class="invoice_greeting">hi <?php echo $_SESSION['USER_NAME']?></h1>
                            <h1>your order has been placed</h1>
                            <h2>Invoice id : asdf</h2>
                            <h2>transaction id : <?php echo $txnid ?></h2>
                            <h2>payment type : cash on delivery</h2>
                        </div>
                        <div class="card-footer">
                            <h2>Amount Payed : 2999</h2>                
                        </div>
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
    <!-- <script src="assets/Vendor/jquery-master/dist/jquery-3.5.1.slim.min.js"></script> -->
    <!-- Bootstrap -->
    <script src="assets/Vendor/bootstrap-4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- owlcarsel -->
    <script src="assets/Vendor/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    <!-- Custom -->
    <script src="assets/js/custom.js"></script>

    
</body>

</html>