<?php 
    require('connection.inc.php');
    require('functions.inc.php');
    if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0){
        ?>
        <!-- <script>
            window.location.href='index.php';
        </script> -->
        <?php
    }
    
    $cart_total=0;
    
    if(isset($_POST['submit'])){
        $address=get_safe_value($con,$_POST['address']);
        $city=get_safe_value($con,$_POST['city']);
        $mobile=get_safe_value($con,$_POST['mobile']);
        $payment_type=get_safe_value($con,$_POST['payment_type']);
        $user_id=$_SESSION['USER_ID'];
        foreach($_SESSION['cart'] as $key=>$val){
            $productArr=get_product($con,'','',$key);
            $price=$productArr[0]['price'];
            $qty=$val['qty'];
            $cart_total=$cart_total+($price*$qty);
        }
        $total_price=$cart_total;
        $payment_status='pending';
        if($payment_type=='COD'){
            $payment_status='success';
        }
        $order_status='1';
        $added_on=date('Y-m-d h:i:s');
        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        if(isset($_SESSION['COUPON_ID'])){
            $coupon_id=$_SESSION['COUPON_ID'];
            $coupon_code=$_SESSION['COUPON_CODE'];
            $coupon_value=$_SESSION['COUPON_VALUE'];
            $total_price=$total_price-$coupon_value;
            unset($_SESSION['COUPON_ID']);
            unset($_SESSION['COUPON_CODE']);
            unset($_SESSION['COUPON_VALUE']);
        }else{
            $coupon_id='';
            $coupon_code='';
            $coupon_value='';	
        }	
        mysqli_query($con,"insert into `orders`(user_id,address,city,mobile,payment_type,payment_status,order_status,tnxid,added_on,total_price,coupon_id,coupon_code,coupon_value) values('$user_id','$address','$city','$mobile','$payment_type','$payment_status','$order_status','$txnid','$added_on','$total_price','$coupon_id','$coupon_code','$coupon_value')");
        
        $order_id=mysqli_insert_id($con);
        
        foreach($_SESSION['cart'] as $key=>$val){
            $productArr=get_product($con,'','',$key);
            $price=$productArr[0]['price'];
            $qty=$val['qty'];
            
            mysqli_query($con,"insert into `order_detail`(order_id,product_id,qty,price,added_on) values('$order_id','$key','$qty','$price','$added_on')");
        }
        
        unset($_SESSION['cart']);
        if($payment_type=='STRIPE'){
            //pay with stripe
            $pricein_paise=$total_price*100;
            echo '
            <form action="stripe_submit.php" method="post">
                <input type="hidden" name="amount" value="'.$pricein_paise.'" />
                <input type="hidden" name="transaction_id" value="'.$txnid.'" />
                <script
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="'.$publishableKey.'"
                    data-amount="'.$pricein_paise.'"
                    data-name="company name"
                    data-description="transaction id: '.$txnid.'"
                    data-image="https://chronopegasus.com/ecommerce/assets/images/favicon.png"
                    data-currency="inr"
                    data-email="'.$_SESSION['USER_EMAIL'].'"
                >
                </script>
            </form>';            
        }else{
            ?>
            <?php
                ini_set( 'display_errors', 1 );
                error_reporting( E_ALL );
                $template_file=SERVER_PATH."invoice.php";
                $from = "info@chronopegasus.com";
                $to = $_SESSION['USER_EMAIL'];
                $subject = "Order Update";

                $headers = "From: " . $from."\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                
                if(file_exists($template_file)){
                    $message1 = file_get_contents($template_file);
                    $message2 = str_replace("{{deliveryaddress}}",$address.',</br>'.$city.',</br>'.$mobile,$message1);
                    $message3 = str_replace("{{orderdate}}",date("d-M-Y"),$message2);
                    $message4 = str_replace("{{currency}}","Rs ",$message3);
                    $message5 = str_replace("{{chekoutprice}}",$total_price,$message4);
                    $message6 = str_replace("{{shippingcost}}","FREE",$message5);
                    $message7 = str_replace("{{totalcost}}",$total_price,$message6);
                    $message = str_replace("{{orderno}}",$order_id,$message7);
                }else{
                    die("unable to locate file");
                }

                if(mail($to,$subject,$message, $headers)) {
                    echo "The email sent.";
                } else {
                    echo "The email message was not sent.";
                }
            ?>
            <script>
                window.location.href='thank_you.php';
            </script>
            <?php 
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
    <title>Checkout - ChronoPegasus</title>
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
        <section class="cart_main my-5">
            <div class="container-fluid">
                <div class="main_heading_breadcrumb"></div>
                <div class="row">
                    <?php 
                        if(isset($_SESSION['cart'])){
                            if(!isset($_SESSION['USER_LOGIN'])){
                    ?>
                        <div class="col">
                            <div class="row">
                                <!-- Login Form -->
                                <div class="col-md">
                                    <div class="card">
                                        <div class="card-body">
                                            <form id="login-form" method="post">
                                                <h5 class="checkout-method__title">Login</h5>
                                                <div class="single-input">
                                                    <input type="text" id="login_name" name="login_name" placeholder="Your Email*" style="width:100%">
                                                    <span class="field_error" id="login_email_error"></span>
                                                </div>
                                                <div class="single-input">
                                                    <input type="password" name="login_password" id="login_password" placeholder="Your Password*" style="width:100%">
                                                    <span class="field_error" id="login_password_error"></span>
                                                </div>                                            
                                                <p class="require">* Required fields</p>
                                                <div class="dark-btn">
                                                    <button type="button" class="fv-btn" onclick="user_login()">Login</button>
                                                </div>
                                                <div class="form-output login_msg">
                                                    <p class="form-messege field_error"></p>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }else{ ?>
                        <div class="col">
                            <form method="post">
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <input type="text" name="address" placeholder="Street Address" required>
                                        <input type="text" name="city" placeholder="City/State" required>
                                        <input type="text" name="mobile" placeholder="Mobile number" required>
                                    </div>
                                </div>
                                <div class="card mb-2">
                                    <div class="card-body">
                                        COD <input type="radio" name="payment_type" value="COD" required/>
                                         &nbsp;&nbsp;Stripe <input type="radio" name="payment_type" value="STRIPE" required/> 
                                    </div>
                                </div>
                                <div class="border-bottom-theme my-3"></div>            
                                <ul class="list-unstyled row m-0 p-0">
                                    <li class="product_details_buttons col-md">
                                        <input type="submit" name="submit" class="btn btn-block" />
                                    </li>
                                </ul>
                            </form>
                        </div>
                    <?php }?> 
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header">Price Details</div>
                                <div class="card-body">
                                <?php
                                    $cart_total=0;
                                    foreach($_SESSION['cart'] as $key=>$val){
                                    $productArr=get_product($con,'','',$key);
                                    $pname=$productArr[0]['name'];
                                    $mrp=$productArr[0]['mrp'];
                                    $price=$productArr[0]['price'];
                                    $image=$productArr[0]['image'];
                                    $qty=$val['qty'];
                                    $cart_total=$cart_total+($price*$qty);
                                    ?>
                                    <div class="row">
                                        <div class="col-8"><?php echo $pname?>:(<?php echo $qty?> items)</div>
                                        <div class="col text-right"><?php echo $price*$qty?></div>
                                    </div>
                                    <?php } ?>
                                    <div class="border-bottom-theme my-3"></div>  
                                    <div class="row">
                                        <div class="col-8">Coupon Value</div>
                                        <div class="col text-right"><span class="price" id="coupon_price"></span></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">Delivery Charges</div>
                                        <div class="col text-right">Free</div>
                                    </div>
                                    <div class="border-bottom-theme my-3"></div> 
                                        <div class="order-details">
                                                <div class="ordre-details__total bilinfo">
                                                    <input type="textbox" id="coupon_str" class="coupon_style mr5"/> <input type="button" name="submit" class="fv-btn coupon_style" value="Apply Coupon" onclick="set_coupon()"/>
                                                </div>
                                                <div id="coupon_result"></div>
                                        </div>
                                    <div class="border-bottom-theme my-3"></div> 
                                    <div class="row">
                                        <div class="col">Total:</div>
                                        <div class="col text-right"><?php echo $cart_total?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } else{ ?>
                        <div class="col">
                            <div class="card mb-2 ">
                                <div class="card-body empty_cart d-flex flex-column align-items-center justify-content-center">
                                    <h1 class="text-center"><i class="fa fa-shopping-cart"></i></h1>
                                    <h1 class="text-center text-light">Your Cart is empty</h1>
                                    <ul class="list-unstyled row m-0 p-0">
                                        <li class="product_details_buttons col-md"><a class="btn" href="<?php echo SITE_PATH ?>"><i class="fa fa-shopping-cart">&nbsp;</i>Continue Shopping</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
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

    
    <script >
			function set_coupon(){
				var coupon_str=jQuery('#coupon_str').val();
				if(coupon_str!=''){
					jQuery('#coupon_result').html('');
					jQuery.ajax({
						url:'set_coupon.php',
						type:'post',
						data:'coupon_str='+coupon_str,
						success:function(result){
							var data=jQuery.parseJSON(result);
							if(data.is_error=='yes'){
								jQuery('#coupon_box').hide();
								jQuery('#coupon_result').html(data.dd);
								jQuery('#order_total_price').html(data.result);
							}
							if(data.is_error=='no'){
								jQuery('#coupon_box').show();
								jQuery('#coupon_price').html(data.dd);
								jQuery('#order_total_price').html(data.result);
							}
						}
					});
				}
			}
		</script>		
<?php 
if(isset($_SESSION['COUPON_ID'])){
	unset($_SESSION['COUPON_ID']);
	unset($_SESSION['COUPON_CODE']);
	unset($_SESSION['COUPON_VALUE']);
}
?>        
</body>
</html>