<?php
    require('connection.inc.php');
    require('functions.inc.php');
    if(isset($_POST['stripeToken'])){
        \Stripe\Stripe::setVerifySslCerts(false);

        $token=$_POST['stripeToken'];
        $amount=$_POST['amount'];
        $transaction_id=$_POST['transaction_id'];
        
        $data=\Stripe\Charge::create(array(
            "amount"=>$amount,
            "currency"=>"inr",
            "description"=>"Programming with Vishal Desc",
            "source"=>$token,
        ));
        
        $stripe_pay_status= $data->status;
        if($stripe_pay_status == 'succeeded'){
            $paymentstatus="success";
            mysqli_query($con,"update `orders` set payment_status='$paymentstatus' where tnxid='$transaction_id' ");
            header('location:thank_you.php');
        }else{
            $paymentstatus="failed";
            mysqli_query($con,"update `orders` set payment_status='$paymentstatus' where tnxid='$transaction_id' ");
            header('location:index.php');
        }
    }
?> 