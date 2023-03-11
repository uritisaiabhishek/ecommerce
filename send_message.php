<?php
    require('connection.inc.php');
    require('functions.inc.php');
    $name=get_safe_value($con,$_POST['name']);
    $email=get_safe_value($con,$_POST['email']);
    $mobile=get_safe_value($con,$_POST['mobile']);
    $subject=get_safe_value($con,$_POST['subject']);
    $message=get_safe_value($con,$_POST['message']);
    $added_on=date('Y-m-d h:i:s');
    mysqli_query($con,"insert into contact_us(name,email,mobile,subject,comment,added_on) values('$name','$email','$mobile','$subject','$message','$added_on')");
    echo "Thank You";
?>