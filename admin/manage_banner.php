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
    $heading1='';
    $heading2='';
    $btn_txt='';
    $btn_link='';
    $image='';
    $msg='';
    $image_required='required';
    
    if(isset($_GET['id'])&& $_GET['id']!=''){
        $image_required='';
        $id=get_safe_value($con,$_GET['id']);
        $res=mysqli_query($con,"select * from banner where id='$id'");
        $check=mysqli_num_rows($res);
        if($check>0){
            $row=mysqli_fetch_assoc($res);
            $heading1=$row['heading1'];
            $heading2=$row['heading2'];
            $btn_txt=$row['btn_txt'];
            $btn_link=$row['btn_link'];
            $image=$row['image'];
        }else{
            header('location:banner.php');
            die();
        }
    }

    if(isset($_POST['submit'])){
        $heading1=get_safe_value($con,$_POST['heading1']);
        $heading2=get_safe_value($con,$_POST['heading2']);
        $btn_txt=get_safe_value($con,$_POST['btn_txt']);
        $btn_link=get_safe_value($con,$_POST['btn_link']);
        $image=get_safe_value($con,$_POST['image']);

        if(isset($_GET['id']) && $_GET['id']==0){
            if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
                $msg="Please select only png,jpg and jpeg image formate";
            }
        }else{
            if($_FILES['image']['type']!=''){
                    if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
                    $msg="Please select only png,jpg and jpeg image formate";
                }
            }
        }

        if($msg==''){
            if(isset($_GET['id']) && $_GET['id']!=''){
                if($_FILES['image']['name']!=''){
                    $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'],BANNER_IMAGE_SERVER_PATH.$image);
                    $update_sql="update banner set heading1='$heading1',heading2='$heading2',btn_txt='$btn_txt',btn_link='$btn_link',image='$image' where id='$id'";
                }else{
                    $update_sql="update banner set heading1='$heading1',heading2='$heading2',btn_txt='$btn_txt',btn_link='$btn_link' where id='$id'";
                }
                mysqli_query($con,$update_sql);
            }else{
                $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'],BANNER_IMAGE_SERVER_PATH.$image);
                mysqli_query($con,"insert into banner(heading1,heading2,btn_txt,btn_link,image,status) values('$heading1','$heading2','$btn_txt','$btn_link','$image','1')");
            }
            
            header('location:banner.php');
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
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="" class="form-label">Heading 1</label>
                                    <input type="text" name="heading1" class="form-control" placeholder="enter heading 1" required value="<?php echo $heading1; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">heading 2</label>
                                    <input type="text" name="heading2" class="form-control" placeholder="enter heading 2" required value="<?php echo $heading2; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">button text</label>
                                    <input type="text" name="btn_txt" class="form-control" placeholder="enter category" value="<?php echo $btn_txt; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">button link</label>
                                    <input type="text" name="btn_link" class="form-control" placeholder="enter category" value="<?php echo $btn_link; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">image</label>
                                    <input type="file" name="image" class="form-select"  <?php echo $image_required ?>>
                                </div>
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