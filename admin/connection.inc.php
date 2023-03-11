<?php
    session_start();

    define('DB_HOST',"localhost");
    define('DB_USER',"u707028877_admin");
    define('DB_PASSWORD',"o5Q!mj^?N+");
    define('DB_NAME',"u707028877_ecommerce");
    $con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

    define('SITE_NAME',"chronopegasus");
    define('SITE_EMAIL',"info@chronopegasus.com");
    define('SITE_PHONE',"917287969166");
    define('SITE_CURRENCY',"₹");
    define('SITE_Address',"Street Name,</br>City name,</br>State name,</br>county");


    define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/ecommerce/');
    define('SITE_PATH','https://chronopegasus.com/ecommerce/');

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

?>