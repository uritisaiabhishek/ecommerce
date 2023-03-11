<?php
    require('connection.inc.php');
    require('functions.inc.php');
    
    $name=get_safe_value($con,$_POST['name']);
    $email=get_safe_value($con,$_POST['email']);
    $mobile=get_safe_value($con,$_POST['mobile']);
    $password=sha1(get_safe_value($con,$_POST['password']));
    
    $res=mysqli_query($con,"select * from users where email='$email' and password='$password'");
    $check_user=mysqli_num_rows(mysqli_query($con,"select * from users where email='$email'"));


    if($check_user>0){
        echo "email_present";
    }else{
        $added_on=date('y-m-d h:i:s');
        $user_generate_rand_str=sha1(uniqid());
        mysqli_query($con,"insert into users(name,email,mobile,password,added_on,user_otp) values('$name','$email','$mobile','$password','$added_on','$user_generate_rand_str')");
        echo "insert";
        $_SESSION['USER_LOGIN']='yes';
        $_SESSION['USER_NAME']=$name;
        $_SESSION['USER_EMAIL']=$email;

        ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );
        $template_file=SERVER_PATH."activate_account.php";
        $from = "info@chronopegasus.com";
        $to = $email;
        $subject = "Activate your account";

        $headers = "From: " . $from."\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
        if(file_exists($template_file)){
            $message1 = file_get_contents($template_file);
            $message2 = str_replace("{{useremail}}",$email,$message1);
            $message = str_replace("{{useractive_code}}",$user_generate_rand_str,$message2);
        }else{
            die("unable to locate file");
        }

        // echo $message;
        if(mail($to,$subject,$message, $headers)) {
            // echo "The email sent.";
        } else {
            echo "The email message was not sent.";
        }
    }
?>