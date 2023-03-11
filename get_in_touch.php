<?php
    require('connection.inc.php');
    require('functions.inc.php');
    
    $get_in_touch_product_id=get_safe_value($con,$_POST['get_in_touch_product_id']);
    $get_in_touch_name=get_safe_value($con,$_POST['get_in_touch_name']);
    $get_in_touch_mobile=get_safe_value($con,$_POST['get_in_touch_mobile']);
    $get_in_touch_email=get_safe_value($con,$_POST['get_in_touch_email']);
    $get_in_touch_location=get_safe_value($con,$_POST['get_in_touch_location']);
    $get_in_touch_contact_via=get_safe_value($con,$_POST['get_in_touch_contact_via']);
    $get_in_touch_message=get_safe_value($con,$_POST['get_in_touch_message']);
    $added_on=date('Y-m-d h:i:s');

    mysqli_query($con,"insert into get_in_touch(get_in_touch_product_id,get_in_touch_name,get_in_touch_mobile,get_in_touch_email,get_in_touch_location,get_in_touch_contact_via,get_in_touch_message,added_on,get_in_touch_satus) values('$get_in_touch_product_id','$get_in_touch_name','$get_in_touch_mobile','$get_in_touch_email','$get_in_touch_location','$get_in_touch_contact_via','$get_in_touch_message','$added_on','0')");
    echo 'getintouchalert';
?>