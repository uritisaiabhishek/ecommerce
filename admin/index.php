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

    $current_time_date=time();
    $this_month=date("M",$current_time_date);
    $this_year=date("Y",$current_time_date);
    
    if(isset($_POST['submit'])){
        $year_to_check=get_safe_value($con,$_POST['year_to_check']);
        $monthly_total_price='0';
        $yearly_total_price='0';
        $jan_month_total=0;
        $feb_month_total=0;
        $march_month_total=0;
        $apr_month_total=0;
        $may_month_total=0;
        $jun_month_total=0;
        $july_month_total=0;
        $aug_month_total=0;
        $sept_month_total=0;
        $oct_month_total=0;
        $nov_month_total=0;
        $dec_month_total=0;
        $refresh_income_query=mysqli_query($con,"select * from orders where order_status='5' order by added_on");
        
        if(mysqli_num_rows($refresh_income_query)>0){
            while($row=mysqli_fetch_assoc($refresh_income_query)){
                $month_from_order_refresh=date("M",strtotime($row['added_on']));
                $year_from_order_refresh=date("Y",strtotime($row['added_on']));
                if($year_to_check==$year_from_order_refresh){
                    $monthly_income_exist_check=mysqli_query($con,"select * from monthlyincome where year='$year_to_check' and month='$month_from_order_refresh'");
                    if($month_from_order_refresh=='Jan' && $year_to_check==$year_from_order_refresh){
                        $jan_month_total=$jan_month_total+$row['total_price'];
                        if(mysqli_num_rows($monthly_income_exist_check)>0){
                            mysqli_query($con,"update monthlyincome set totalamount='$jan_month_total' where year='$year_to_check' and month='$month_from_order_refresh'");
                        }else{
                            mysqli_query($con,"insert into monthlyincome(month,year,totalamount) values('$month_from_order_refresh','$year_to_check','$jan_month_total')");
                        }
                    }else if($month_from_order_refresh=='Feb' && $year_to_check==$year_from_order_refresh){
                        $feb_month_total=$feb_month_total+$row['total_price'];
                        if(mysqli_num_rows($monthly_income_exist_check)>0){
                            mysqli_query($con,"update monthlyincome set totalamount='$feb_month_total' where year='$year_to_check' and month='$month_from_order_refresh'");
                        }else{
                            mysqli_query($con,"insert into monthlyincome(month,year,totalamount) values('$month_from_order_refresh','$year_to_check','$feb_month_total')");
                        }
                    }else if($month_from_order_refresh=='Mar' && $year_to_check==$year_from_order_refresh){
                        $march_month_total=$march_month_total+$row['total_price'];
                        if(mysqli_num_rows($monthly_income_exist_check)>0){
                            mysqli_query($con,"update monthlyincome set totalamount='$march_month_total' where year='$year_to_check' and month='$month_from_order_refresh'");
                        }else{
                            mysqli_query($con,"insert into monthlyincome(month,year,totalamount) values('$month_from_order_refresh','$year_to_check','$march_month_total')");
                        }
                    }else if($month_from_order_refresh=='Apr' && $year_to_check==$year_from_order_refresh){
                        $apr_month_total=$apr_month_total+$row['total_price'];
                        if(mysqli_num_rows($monthly_income_exist_check)>0){
                            mysqli_query($con,"update monthlyincome set totalamount='$apr_month_total' where year='$year_to_check' and month='$month_from_order_refresh'");
                        }else{
                            mysqli_query($con,"insert into monthlyincome(month,year,totalamount) values('$month_from_order_refresh','$year_to_check','$apr_month_total')");
                        }
                    }else if($month_from_order_refresh=='May' && $year_to_check==$year_from_order_refresh){
                        $may_month_total=$may_month_total+$row['total_price'];
                        if(mysqli_num_rows($monthly_income_exist_check)>0){
                            mysqli_query($con,"update monthlyincome set totalamount='$may_month_total' where year='$year_to_check' and month='$month_from_order_refresh'");
                        }else{
                            mysqli_query($con,"insert into monthlyincome(month,year,totalamount) values('$month_from_order_refresh','$year_to_check','$may_month_total')");
                        }
                    }else if($month_from_order_refresh=='Jun' && $year_to_check==$year_from_order_refresh){
                        if(mysqli_num_rows($monthly_income_exist_check)>0){
                            mysqli_query($con,"update monthlyincome set totalamount='$jun_month_total' where year='$year_to_check' and month='$month_from_order_refresh'");
                        }else{
                            mysqli_query($con,"insert into monthlyincome(month,year,totalamount) values('$month_from_order_refresh','$year_to_check','$jun_month_total')");
                        }
                    }else if($month_from_order_refresh=='Jul' && $year_to_check==$year_from_order_refresh){
                        $july_month_total=$july_month_total+$row['total_price'];
                        if(mysqli_num_rows($monthly_income_exist_check)>0){
                            mysqli_query($con,"update monthlyincome set totalamount='$july_month_total' where year='$year_to_check' and month='$month_from_order_refresh'");
                        }else{
                            mysqli_query($con,"insert into monthlyincome(month,year,totalamount) values('$month_from_order_refresh','$year_to_check','$july_month_total')");
                        }
                    }else if($month_from_order_refresh=='Aug' && $year_to_check==$year_from_order_refresh){
                        $aug_month_total=$aug_month_total+$row['total_price'];
                        if(mysqli_num_rows($monthly_income_exist_check)>0){
                            mysqli_query($con,"update monthlyincome set totalamount='$aug_month_total' where year='$year_to_check' and month='$month_from_order_refresh'");
                        }else{
                            mysqli_query($con,"insert into monthlyincome(month,year,totalamount) values('$month_from_order_refresh','$year_to_check','$aug_month_total')");
                        }
                    }else if($month_from_order_refresh=='Sep' && $year_to_check==$year_from_order_refresh){
                        $sept_month_total=$sept_month_total+$row['total_price'];
                        if(mysqli_num_rows($monthly_income_exist_check)>0){
                            mysqli_query($con,"update monthlyincome set totalamount='$sept_month_total' where year='$year_to_check' and month='$month_from_order_refresh'");
                        }else{
                            mysqli_query($con,"insert into monthlyincome(month,year,totalamount) values('$month_from_order_refresh','$year_to_check','$sept_month_total')");
                        }
                    }else if($month_from_order_refresh=='Oct' && $year_to_check==$year_from_order_refresh){
                        $oct_month_total=$oct_month_total+$row['total_price'];
                        if(mysqli_num_rows($monthly_income_exist_check)>0){
                            mysqli_query($con,"update monthlyincome set totalamount='$oct_month_total' where year='$year_to_check' and month='$month_from_order_refresh'");
                        }else{
                            mysqli_query($con,"insert into monthlyincome(month,year,totalamount) values('$month_from_order_refresh','$year_to_check','$oct_month_total')");
                        }
                    }else if($month_from_order_refresh=='Nov' && $year_to_check==$year_from_order_refresh){
                        $nov_month_total=$nov_month_total+$row['total_price'];
                        if(mysqli_num_rows($monthly_income_exist_check)>0){
                            mysqli_query($con,"update monthlyincome set totalamount='$nov_month_total' where year='$year_to_check' and month='$month_from_order_refresh'");
                        }else{
                            mysqli_query($con,"insert into monthlyincome(month,year,totalamount) values('$month_from_order_refresh','$year_to_check','$nov_month_total')");
                        }
                    }else if($month_from_order_refresh=='Dec' && $year_to_check==$year_from_order_refresh){
                        $dec_month_total=$dec_month_total+$row['total_price'];
                        if(mysqli_num_rows($monthly_income_exist_check)>0){
                            mysqli_query($con,"update monthlyincome set totalamount='$dec_month_total' where year='$year_to_check' and month='$month_from_order_refresh'");
                        }else{
                            mysqli_query($con,"insert into monthlyincome(month,year,totalamount) values('$month_from_order_refresh','$year_to_check','$dec_month_total')");
                        }
                    }else{
                        echo 'No records Found';
                    }

                    $yearly_total_price=$yearly_total_price+$row['total_price'];
                    $yearly_income_exist_check=mysqli_query($con,"select * from yearlyincome where year='$year_to_check'");
                    if(mysqli_num_rows($yearly_income_exist_check)>0){
                        mysqli_query($con,"update yearlyincome set total_income='$yearly_total_price' where year='$year_to_check'");
                    }else{
                        mysqli_query($con,"insert into yearlyincome(year,total_income) values('$year_to_check','$yearly_total_price')");
                    }
                }
            }
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

    <title>Dashboard - <?php echo SITE_NAME ?></title>
    <link rel="shortcut icon" href="<?php echo SITE_PATH?>assets/images/favicon.png" type="image/png">

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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <form method="post" class="d-flex">
                            <select name="year_to_check" class="form-control" id="year_to_check">
                                <?php 
                                    $data_refresh_query=mysqli_query($con,"SELECT DISTINCT(EXTRACT(YEAR FROM added_on)) as datarefreshyear from orders");
                                    while($data_refresh_query_row=mysqli_fetch_assoc($data_refresh_query)){
                                        ?>
                                        <option class="form-control"  value="<?php echo $data_refresh_query_row['datarefreshyear'] ?>"><?php echo $data_refresh_query_row['datarefreshyear'] ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                            <!-- <input type="text" value="2021" name="year_to_check" value="year_to_check"> -->
                            <button type="submit" name="submit" class="ml-2 btn btn-primary shadow-sm" >Refresh</button>
                        </form>
                    </div>

                    <!-- Dashboard count Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                               Earnings (Monthly-<?php echo $this_month ?>-<?php echo $this_year?>)
                                            </div>
                                            <?php                    
                                                $res=mysqli_query($con,"select `orders`.*,order_status.name as order_status_str from `orders`,order_status where order_status.id=`orders`.order_status and  `orders`.order_status='5'  order by `orders`.id desc");
                                                $total_price='0';
                                                while($row=mysqli_fetch_assoc($res)){
                                                    $month_from_order=date("M",strtotime($row['added_on']));
                                                    $year_from_order=date("Y",strtotime($row['added_on']));
                                                    if($year_from_order==$this_year){
                                                        if($month_from_order==$this_month){
                                                            $total_price=$total_price+$row['total_price'];
                                                        }
                                                    }
                                                }
                                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800">'.SITE_CURRENCY.'&nbsp;'.$total_price.'</div>';
                                            ?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Annually) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Earnings (Annual-<?php echo $this_year?>)
                                            </div>
                                            <?php                    
                                                $res=mysqli_query($con,"select `orders`.*,order_status.name as order_status_str from `orders`,order_status where order_status.id=`orders`.order_status and  `orders`.order_status='5' order by `orders`.id desc");
                                                $total_price='0';
                                                while($row=mysqli_fetch_assoc($res)){
                                                    $year_from_order=date("Y",strtotime($row['added_on']));
                                                    if($year_from_order==$this_year){
                                                        $total_price=$total_price+$row['total_price'];
                                                    }
                                                }
                                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800">'.SITE_CURRENCY.'&nbsp;'.$total_price.'</div>';
                                            ?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Categories Count Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Categories
                                            </div>
                                            <?php                    
                                                $query = "SELECT id FROM categories ORDER BY id";  
                                                $query_run = mysqli_query($con, $query);
                                                $row = mysqli_num_rows($query_run);
                                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800">Total: '.$row.'</div>';
                                            ?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Products Count Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Products
                                            </div>
                                            <?php                    
                                                $query = "SELECT id FROM product ORDER BY id";  
                                                $query_run = mysqli_query($con, $query);
                                                $row = mysqli_num_rows($query_run);
                                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800">Total: '.$row.'</div>';
                                            ?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Orders Count Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Orders
                                            </div>
                                            <?php                    
                                                $query = "SELECT id FROM orders ORDER BY id";  
                                                $query_run = mysqli_query($con, $query);
                                                $row = mysqli_num_rows($query_run);
                                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800">Total: '.$row.'</div>';
                                            ?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Reviews Count Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Reviews
                                            </div>
                                            <?php                    
                                                $query = "SELECT id FROM product_review ORDER BY id";  
                                                $query_run = mysqli_query($con, $query);
                                                $row = mysqli_num_rows($query_run);
                                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800">Total: '.$row.'&nbsp;';
                                            ?>
                                            <?php                    
                                                $query = "SELECT id FROM product_review where status='1' ORDER BY id";  
                                                $query_run = mysqli_query($con, $query);
                                                $row = mysqli_num_rows($query_run);
                                                echo 'Active: '.$row.'</div>';
                                            ?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Vendors Count Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Vendors
                                            </div>
                                            <?php                    
                                                $query = "SELECT id FROM admin where role=1 ORDER BY id";  
                                                $query_run = mysqli_query($con, $query);
                                                $row = mysqli_num_rows($query_run);
                                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800">Total: '.$row.'</div>';
                                            ?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Customers Count Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Customers
                                            </div>
                                            <?php                    
                                                $query = "SELECT id FROM users ORDER BY id";  
                                                $query_run = mysqli_query($con, $query);
                                                $row = mysqli_num_rows($query_run);
                                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800">Total: '.$row.'</div>';
                                            ?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- dashboard graphs -->
                    <div class="row">
                        <!--User Analytics Browser-->
                        <div class="col-md-4">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Web Analytics Browser</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="webanalyticsbrowser"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Web Analytics Device</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="webanalyticsDevice"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Web Analytics OS</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="webanalyticsOS"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview (<?php echo $this_year ?>)</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myIncomeChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Yearly Earnings Overview</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myYearlyIncomeChart"></canvas>
                                    </div>
                                </div>
                            </div>
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
    <script src="assets/vendor/chart.js/Chart.min.js"></script>

    <!-- <script src="assets/js/demo/chart-pie-demo.js"></script> -->
    <script>
        $(document).ready(function(){
            $.ajax({
                url:"<?php echo SITE_PATH ?>admin/monthlyincomedata.php",
                method:"GET",
                success:function(data){
                    console.log(data);
                    var month =[];
                    var totalamount=[];

                    for (var i in data){
                        month.push(data[i].month);
                        totalamount.push(data[i].totalamount);
                    }
                    var chartdata = {
                        labels:month,
                        datasets:[
                            {
                                label : 'month totalamount',
                                lineTension: 0.3,
                                backgroundColor: "rgba(78, 115, 223, 0.05)",
                                borderColor: "rgba(78, 115, 223, 1)",
                                pointRadius: 3,
                                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                                pointBorderColor: "rgba(78, 115, 223, 1)",
                                pointHoverRadius: 3,
                                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                                pointHitRadius: 10,
                                pointBorderWidth: 2,
                                data: totalamount
                            }
                        ]
                    };

                    (Chart.defaults.global.defaultFontFamily = "Nunito"),
                        '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                    Chart.defaults.global.defaultFontColor = "#858796";

                    function number_format(number, decimals, dec_point, thousands_sep) {
                        // *     example: number_format(1234.56, 2, ',', ' ');
                        // *     return: '1 234,56'
                        number = (number + "").replace(",", "").replace(" ", "");
                        var n = !isFinite(+number) ? 0 : +number,
                            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                            sep = typeof thousands_sep === "undefined" ? "," : thousands_sep,
                            dec = typeof dec_point === "undefined" ? "." : dec_point,
                            s = "",
                            toFixedFix = function (n, prec) {
                                var k = Math.pow(10, prec);
                                return "" + Math.round(n * k) / k;
                            };
                        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                        s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
                        if (s[0].length > 3) {
                            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                        }
                        if ((s[1] || "").length < prec) {
                            s[1] = s[1] || "";
                            s[1] += new Array(prec - s[1].length + 1).join("0");
                        }
                        return s.join(dec);
                    }

                    var ctx = $("#myIncomeChart");
                    var myLineChart = new Chart(ctx, {
                        type: "line",
                        data: chartdata,
                        options: {
                            maintainAspectRatio: false,
                            layout: {
                                padding: {
                                    left: 10,
                                    right: 25,
                                    top: 25,
                                    bottom: 0,
                                },
                            },
                            scales: {
                                xAxes: [
                                    {
                                        time: {
                                            unit: "date",
                                        },
                                        gridLines: {
                                            display: false,
                                            drawBorder: false,
                                        },
                                        ticks: {
                                            maxTicksLimit: 7,
                                        },
                                    },
                                ],
                                yAxes: [
                                    {
                                        ticks: {
                                            maxTicksLimit: 5,
                                            padding: 10,
                                            // Include a dollar sign in the ticks
                                            callback: function (value, index, values) {
                                                return "<?php echo SITE_CURRENCY?>" + number_format(value);
                                            },
                                        },
                                        gridLines: {
                                            color: "rgb(234, 236, 244)",
                                            zeroLineColor: "rgb(234, 236, 244)",
                                            drawBorder: false,
                                            borderDash: [2],
                                            zeroLineBorderDash: [2],
                                        },
                                    },
                                ],
                            },
                            legend: {
                                display: false,
                            },
                            tooltips: {
                                backgroundColor: "rgb(255,255,255)",
                                bodyFontColor: "#858796",
                                titleMarginBottom: 10,
                                titleFontColor: "#6e707e",
                                titleFontSize: 14,
                                borderColor: "#dddfeb",
                                borderWidth: 1,
                                xPadding: 15,
                                yPadding: 15,
                                displayColors: false,
                                intersect: false,
                                mode: "index",
                                caretPadding: 10,
                                callbacks: {
                                    label: function (tooltipItem, chart) {
                                        var datasetLabel =
                                            chart.datasets[tooltipItem.datasetIndex].label || "";
                                        return datasetLabel + ": <?php echo SITE_CURRENCY?>" + number_format(tooltipItem.yLabel);
                                    },
                                },
                            },
                        },
                    });
                },
                error:function(data){
                    console.log(data);
                }
            });
        });
        $(document).ready(function(){
            $.ajax({
                url:"<?php echo SITE_PATH ?>admin/yearlyincome.php",
                method:"GET",
                success:function(data){
                    console.log(data);
                    var year =[];
                    var total_income=[];

                    for (var i in data){
                        year.push(data[i].year);
                        total_income.push(data[i].total_income);
                    }
                    var chartdata = {
                        labels:year,
                        datasets:[
                            {
                                label : 'year total_income',
                                backgroundColor: "#4e73df",
                                hoverBackgroundColor: "#2e59d9",
                                borderColor: "#4e73df",
                                data: total_income
                            }
                        ]
                    };
                    // Set new default font family and font color to mimic Bootstrap's default styling
                    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                    Chart.defaults.global.defaultFontColor = '#858796';

                    function number_format(number, decimals, dec_point, thousands_sep) {
                        // *     example: number_format(1234.56, 2, ',', ' ');
                        // *     return: '1 234,56'
                        number = (number + '').replace(',', '').replace(' ', '');
                        var n = !isFinite(+number) ? 0 : +number,
                        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                        s = '',
                        toFixedFix = function(n, prec) {
                        var k = Math.pow(10, prec);
                        return '' + Math.round(n * k) / k;
                        };
                        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                        if (s[0].length > 3) {
                            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                        }
                        if ((s[1] || '').length < prec) {
                            s[1] = s[1] || '';
                            s[1] += new Array(prec - s[1].length + 1).join('0');
                        }
                        return s.join(dec);
                    }

                    var ctx = $("#myYearlyIncomeChart");
                    var myLineChart = new Chart(ctx, {
                        type: "bar",
                        data: chartdata,
                        options: {
                            maintainAspectRatio: false,
                            layout: {
                            padding: {
                                left: 10,
                                right: 25,
                                top: 25,
                                bottom: 0
                            }
                            },
                            scales: {
                            xAxes: [{
                                time: {
                                unit: 'Year'
                                },
                                gridLines: {
                                display: false,
                                drawBorder: false
                                },
                                ticks: {
                                maxTicksLimit: 6
                                },
                                maxBarThickness: 25,
                            }],
                            yAxes: [{
                                ticks: {
                                min: 0,
                                maxTicksLimit: 5,
                                padding: 10,
                                // Include a dollar sign in the ticks
                                callback: function(value, index, values) {
                                    return '<?php echo SITE_CURRENCY ?>' + number_format(value);
                                }
                                },
                                gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                                }
                            }],
                            },
                            legend: {
                            display: false
                            },
                            tooltips: {
                            titleMarginBottom: 10,
                            titleFontColor: '#6e707e',
                            titleFontSize: 14,
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            caretPadding: 10,
                            callbacks: {
                                label: function(tooltipItem, chart) {
                                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                return datasetLabel + ': <?php echo SITE_CURRENCY ?>' + number_format(tooltipItem.yLabel);
                                }
                            }
                            },
                        }
                    });
                },
                error:function(data){
                    console.log(data);
                }
            });
        });
    </script>
</body>

</html>