<?php
    session_start();
    
    define('DB_HOST',"localhost");
    define('DB_USER',"root");
    define('DB_PASSWORD',"");
    define('DB_NAME',"ecommerce");
    $con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

    define('SITE_NAME',"chronopegasus");
    define('SITE_EMAIL',"info@chronopegasus.com");
    define('SITE_PHONE',"917287969166");
    define('SITE_CURRENCY',"₹");
    define('SITE_Address',"Street Name,</br>City name,</br>State name,</br>county");
    
    define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/ecom/');
    define('SITE_PATH','http://localhost/ecom/');

    define('FAVICON_SERVER_PATH',SERVER_PATH.'assets/images/');
    define('FAVICON_SITE_PATH',SITE_PATH.'assets/images/');

    define('LOGO_SERVER_PATH',SERVER_PATH.'assets/images/');
    define('LOGO_SITE_PATH',SITE_PATH.'assets/images/');

    define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'assets/images/product/');
    define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'assets/images/product/');

    define('CATEGORY_IMAGE_SERVER_PATH',SERVER_PATH.'assets/images/categories/');
    define('CATEGORY_IMAGE_SITE_PATH',SITE_PATH.'assets/images/categories/');
    
    define('BLOG_IMAGE_SERVER_PATH',SERVER_PATH.'assets/images/blogs/');
    define('BLOG_IMAGE_SITE_PATH',SITE_PATH.'assets/images/blogs/');

    define('PRODUCT_MULTIPLE_IMAGE_SERVER_PATH',SERVER_PATH.'assets/images/product_images/');
    define('PRODUCT_MULTIPLE_IMAGE_SITE_PATH',SITE_PATH.'assets/images/product_images/');

    define('BANNER_IMAGE_SERVER_PATH',SERVER_PATH.'assets/images/banner/');
    define('BANNER_IMAGE_SITE_PATH',SITE_PATH.'assets/images/banner/');

    // Stripe details
    $stripe_mode='DEMO';
    if($stripe_mode=='LIVE'){
        require('includes/stripe-php-master/init.php');
        $publishableKey="pk_live_51IB1pWLZoyBcAnTIKf40DCxxzgUXl91U1Tpo60NQhXEo6jvB7KMkE6NlfMaOv0eV0iwBzfmi0TaGhY9zNmWK9SWT00NFYzaXPZ";
        $secretKey="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";
        \Stripe\Stripe::setApiKey($secretKey);
    }else{
        require('includes/stripe-php-master/init.php');
        $publishableKey="pk_test_51IB1pWLZoyBcAnTI2qi0EB0zjghxjyCxBfDUERVixqA6K8Ofgz6XlgW2D4HEVwxZykYuoGXBbYQzQM3RHeWzGMxG00tbyCbvRE";
        $secretKey="sk_test_51IB1pWLZoyBcAnTI0LHvIesh3B8x0rScC29UxMXRg9x7KKR0evso3N9h4xRvRwq1MsZaYtpTkpfiihOczrzoNTsC00TXrMK2Ep";
        \Stripe\Stripe::setApiKey($secretKey);
    }

?>