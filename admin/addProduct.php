<?php
    require('connection.inc.php');
    require('functions.inc.php');
    isBlogEditor();
    if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN']!=''){
        
    }else{
        header('location:login.php');
        die();
    }
    $condition='';
    $condition1='';
    if($_SESSION['ADMIN_ROLE']==1){
        $condition=" and product.added_by='".$_SESSION['ADMIN_ID']."'";
        $condition1=" and added_by='".$_SESSION['ADMIN_ID']."'";
    }
    $categories_id='';
    $name='';
    $mrp='';
    $slug='';
    $price='';
    $qty='';
    $image='';
    $short_desc	='';
    $description	='';
    $meta_title	='';
    $meta_desc	='';
    $meta_keyword='';
    $best_seller='';
    $sub_categories_id='';
    $multipleImageArr=[];
    $msg='';
    $image_required='required';
    if(isset($_GET['pi'])&& $_GET['pi']>0 ){
        $pi=get_safe_value($con,$_GET['pi']);
        $delete_sql="delete from product_images where id='$pi'";
        mysqli_query($con,$delete_sql);
    }
    if(isset($_GET['id']) && $_GET['id']!=''){
        $msg='got id';
        $image_required='';
        $id=get_safe_value($con,$_GET['id']);
        $res=mysqli_query($con,"select * from product where id='$id' $condition1");
        $check=mysqli_num_rows($res);
        if($check>0){
            $row=mysqli_fetch_assoc($res);
            $categories_id=$row['categories_id'];
            $sub_categories_id=$row['sub_categories_id'];
            $name=$row['name'];
            $mrp=$row['mrp'];
            $price=$row['price'];
            $qty=$row['qty'];
            $short_desc=$row['short_desc'];
            $description=$row['description'];
            $meta_title=$row['meta_title'];
            $meta_desc=$row['meta_desc'];
            $meta_keyword=$row['meta_keyword'];
            $best_seller=$row['best_seller'];
            $image=$row['image'];

            $resMultipleImage=mysqli_query($con,"select id,product_images from product_images where product_id='$id'");
            if(mysqli_num_rows($resMultipleImage)>0){
                $jj=0;
                while($rowMultipleImage=mysqli_fetch_assoc($resMultipleImage)){
                    $multipleImageArr[$jj]['product_images']=$rowMultipleImage['product_images'];
                    $multipleImageArr[$jj]['id']=$rowMultipleImage['id'];
                    $jj++;
                }
            }

        }else{
            header('location:products.php');
            die();
        }
    }
    
    if(isset($_POST['submit'])){
        // pr($_FILES);
        // prx($_POST);
        $categories_id=get_safe_value($con,$_POST['categories_id']);
        $sub_categories_id=get_safe_value($con,$_POST['sub_categories_id']);
        $name=get_safe_value($con,$_POST['name']);
        $mrp=get_safe_value($con,$_POST['mrp']);
        $price=get_safe_value($con,$_POST['price']);
        $qty=get_safe_value($con,$_POST['qty']);
        $short_desc=get_safe_value($con,$_POST['short_desc']);
        $description=get_safe_value($con,$_POST['description']);
        $meta_title=get_safe_value($con,$_POST['meta_title']);
        $meta_desc=get_safe_value($con,$_POST['meta_desc']);
        $meta_keyword=get_safe_value($con,$_POST['meta_keyword']);
        $best_seller=get_safe_value($con,$_POST['best_seller']);
        $slug=preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '', $name));
        
	    $res=mysqli_query($con,"select * from product where name='$name' $condition1");
        $check=mysqli_num_rows($res);
        if($check>0){
            if(isset($_GET['id']) && $_GET['id']!=''){
                $getData=mysqli_fetch_assoc($res);
                if($id==$getData['id']){
                    $msg='';                
                }else{
                    $msg="Product already exist";
                }
            }else{
                $msg="Product already exist";
            }
        }
        
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
        if(isset($_FILES['product_images'])){
            foreach($_FILES['product_images']['type'] as $key=>$val){
                if($_FILES['product_images']['type'][$key]!=''){
                    if($_FILES['product_images']['type'][$key]!='image/png' && $_FILES['product_images']['type'][$key]!='image/jpg' && $_FILES['product_images']['type'][$key]!='image/jpeg'){
                        $msg="Please select only png,jpg and jpeg multiple  image formate";
                    }
                }
            }
        }
        if($msg==''){
            if(isset($_GET['id']) && $_GET['id']!=''){
                if($_FILES['image']['name']!=''){
                    $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
                    $update_sql="update product set categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword',image='$image',best_seller='$best_seller',sub_categories_id='$sub_categories_id',slug='$slug' where id='$id'";
                }else{
                    $update_sql="update product set categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword',best_seller='$best_seller',sub_categories_id='$sub_categories_id',slug='$slug' where id='$id'";
                }
                mysqli_query($con,$update_sql);
            }else{
                $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
                mysqli_query($con,"insert into product(categories_id,name,mrp,price,qty,short_desc,description,meta_title,meta_desc,meta_keyword,status,image,best_seller,sub_categories_id,added_by,slug) values('$categories_id','$name','$mrp','$price','$qty','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword',1,'$image','$best_seller','$sub_categories_id','".$_SESSION['ADMIN_ID']."','$slug')");
                $id=mysqli_insert_id($con);
            }

            if(isset($_GET['id']) && $_GET['id']!=''){
                foreach($_FILES['product_images']['name'] as $key=>$val){
                    if($_FILES['product_images']['name'][$key]!=''){
                        if(isset($_POST['product_images_id'][$key])){
                            $image=rand(111111111,999999999).'_'.$_FILES['product_images']['name'][$key];
                            move_uploaded_file($_FILES['product_images']['tmp_name'][$key],PRODUCT_MULTIPLE_IMAGE_SERVER_PATH.$image);
                            mysqli_query($con,"update product_images set product_images='$image' where id='".$_POST['product_images_id'][$key]."'");    
                        }else{
                            $image=rand(111111111,999999999).'_'.$_FILES['product_images']['name'][$key];
                            move_uploaded_file($_FILES['product_images']['tmp_name'][$key],PRODUCT_MULTIPLE_IMAGE_SERVER_PATH.$image);
                            mysqli_query($con,"insert into product_images(product_id,product_images) values('$id','$image')");
                        }
                    }
                }
            }else{
                if($_FILES['product_images']['name']){
                    foreach($_FILES['product_images']['name'] as $key=>$val){
                        $image=rand(111111111,999999999).'_'.$_FILES['product_images']['name'][$key];
                        move_uploaded_file($_FILES['product_images']['tmp_name'][$key],PRODUCT_MULTIPLE_IMAGE_SERVER_PATH.$image);
                        mysqli_query($con,"insert into product_images(product_id,product_images) values('$id','$image')");
                    }
                }
            }

            header('location:products.php');
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

    <title><?php echo SITE_NAME ?> - Manage Product</title>

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
                            <?php if($msg!=''){ ?>
                                <div class="py-3 alert alert-danger" role="alert">
                                    <?php echo $msg ?>
                                </div>
                            <?php } ?>
                            <form method="post" class="container" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="" class="form-label">Product Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="enter product name" required value="<?php echo $name ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                                <label for="categories" class=" form-control-label">Categories</label>
                                                <select class="form-control" name="categories_id" id="categories_id" onchange="get_sub_cat('')" required>
                                                    <option>Select Category</option>
                                                    <?php
                                                    $res=mysqli_query($con,"select id,categories from categories order by categories asc");
                                                    while($row=mysqli_fetch_assoc($res)){
                                                        if($row['id']==$categories_id){
                                                            echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
                                                        }else{
                                                            echo "<option value=".$row['id'].">".$row['categories']."</option>";
                                                        }
                                                        
                                                    }
                                                    ?>
                                                </select>
                                            </div>
								    </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="categories" class=" form-control-label">Sub Categories</label>
                                        <select class="form-control" name="sub_categories_id" id="sub_categories_id">
                                            <option>Select Sub Category</option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="" class="form-label">MRP</label>
                                            <input type="text" name="mrp" class="form-control" placeholder="enter mrp" required  value="<?php echo $mrp ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="categories" class=" form-control-label">Best Seller</label>
                                            <select class="form-control" name="best_seller" required>
                                                <option value=''>Select</option>
                                                <?php
                                                if($best_seller==1){
                                                    echo '<option value="1" selected>Yes</option>
                                                        <option value="0">No</option>';
                                                }elseif($best_seller==0){
                                                    echo '<option value="1">Yes</option>
                                                        <option value="0" selected>No</option>';
                                                }else{
                                                    echo '<option value="1">Yes</option>
                                                        <option value="0">No</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="" class="form-label">Sale Price</label>
                                            <input type="text" name="price" class="form-control" placeholder="enter sale price" required  value="<?php echo $price ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="" class="form-label">Qty</label>
                                            <input type="text" name="qty" class="form-control" placeholder="enter qty" required  value="<?php echo $qty ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" id="image_box">
                                            <label for="" class="form-label">Image</label>
                                            <input type="file" name="image" class="form-select"  <?php echo $image_required ?>>
                                            <?php if($image!=''){echo("<a target='_blank' href='".PRODUCT_IMAGE_SITE_PATH.$image."' ><img src='".PRODUCT_IMAGE_SITE_PATH.$image."' width='200px' /></a>");} ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" onclick="add_more_images()" class="btn btn-primary">Add image</button>
                                    </div>
                                    <?php
                                        if(isset($multipleImageArr[0])){
                                            foreach($multipleImageArr as $list){
                                                echo '<div id="add_image_box_'.$list['id'].'"><input type="file" name="product_images[]" class="form-select"><a href="addProduct.php?id='.$id.'&pi='.$list['id'].'">remove</a>';
                                                echo "<a target='_blank' href='".PRODUCT_IMAGE_SITE_PATH.$list['product_images']."' ><img src='".PRODUCT_MULTIPLE_IMAGE_SITE_PATH.$list['product_images']."' width='200px' /></a>";
                                                echo'<input type="hidden" name="product_images_id[]" value="'.$list['id'].'" /></div>';
                                            }
                                        }
                                    ?>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="" class="form-label">Short Description</label>
                                            <textarea type="text" name="short_desc" class="form-control" placeholder="enter category" required><?php echo $short_desc ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="" class="form-label">Description</label>
                                            <input type="text" name="description" class="form-control" placeholder="enter category" required  value="<?php echo $description ?>">
                                        </div>
                                        </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="" class="form-label">Meta title</label>
                                            <input type="text" name="meta_title" class="form-control" placeholder="enter category"   value="<?php echo $meta_title ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="categories" class=" form-control-label">Meta Keyword</label>
                                            <textarea name="meta_keyword" placeholder="Enter product meta keyword" class="form-control"><?php echo $meta_keyword?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="" class="form-label">Meta description</label>
                                            <input type="text" name="meta_desc" class="form-control" placeholder="enter category"   value="<?php echo $meta_desc ?>">
                                        </div>
                                    </div>
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
    
		 <script>
			function get_sub_cat(sub_cat_id){
				var categories_id=jQuery('#categories_id').val();
				jQuery.ajax({
					url:'get_sub_cat.php',
					type:'post',
					data:'categories_id='+categories_id+'&sub_cat_id='+sub_cat_id,
					success:function(result){
						jQuery('#sub_categories_id').html(result);
					}
				});
			}
		 </script>
         
<script>
<?php
if(isset($_GET['id'])){
?>
get_sub_cat('<?php echo $sub_categories_id?>');
<?php } ?>
</script>

</body>

</html>