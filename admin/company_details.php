<?php 
    require('connection.inc.php');
    require('functions.inc.php');    
    $sql="select * from site_details";
    $res=mysqli_query($con,$sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Company Details-<?php echo SITE_NAME ?></title>

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
                    <?php while($row=mysqli_fetch_assoc($res)){ ?>
                    <div class="row">
                        <!-- Company name, email, phone number -->
                        <div class="col-md-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Company Details</h6>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-group">
                                            <label for="">Company Name</label>
                                            <input type="text" class="form-control" id="" value="<?php echo $row['site_title'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" class="form-control" id="" value="<?php echo $row['site_email'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Mobile</label>
                                            <input type="text" class="form-control" id="" value="<?php echo $row['site_mobile'] ?>">
                                        </div>
                                        <button class="btn btn-primary btn-block">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Favicon -->
                        <div class="col-md-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Company Favicon</h6>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-group">
                                            <label for="">Favicon</label>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="inputGroupFile02">
                                                    <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                </div>
                                            </div>
                                            <img src="http://localhost/store/assets/images/favicon.png" class="img-fluid" alt="">
                                        </div>
                                        <button class="btn btn-primary btn-block">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Company Logo -->
                        <div class="col-md-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Company Details</h6>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-group">
                                            <label for="">Logo</label>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="inputGroupFile02">
                                                    <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                </div>
                                            </div>
                                            <img src="http://localhost/store/assets/images/Logo.png" class="img-fluid" alt="">
                                        </div>
                                        <button class="btn btn-primary btn-block">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
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