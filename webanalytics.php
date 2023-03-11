<?php
    include('connection.inc.php');
    include('Mobile_Detect.php');
    include('BrowserDetection.php');
    
    $browser=new Wolfcast\BrowserDetection;
    $ipaddress = getenv("REMOTE_ADDR") ;
    $browser_name=$browser->getName();
    $browser_version=$browser->getVersion();
    
    $detect=new Mobile_Detect();
    
    if($detect->isMobile()){
    	$type='Mobile';
    }elseif($detect->isTablet()){
    	$type='Tablet';
    }else{
    	$type='PC';
    }
    
    if($detect->isiOS()){
    	$os='IOS';
    }elseif($detect->isAndroidOS()){
    	$os='Android';
    }else{
    	$os='Window';
    }
    
    $url=(isset($_SERVER['HTTPS'])) ? "https":"http";
    $url.="//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $ref='';
    if(isset($_SERVER['HTTP_REFERER'])){
    	$ref=$_SERVER['HTTP_REFERER'];
    }
    if(!isset($_COOKIE['visit'])){
    	setCookie('visit','yes',time()+(60*60*24*30));
        $check_web_analytics=mysqli_query($con,"select * from web_user_analytics where ip_address='$ipaddress' and browser='$browser_name' and device='$type' and device_os='$os'");
        if(!mysqli_num_rows($check_web_analytics)>0){
            mysqli_query($con,"INSERT INTO web_user_analytics(ip_address,browser,device,device_os) VALUES('$ipaddress','$browser_name','$type','$os')");
        }
    }
?>