<?php 
    $resProductCat=mysqli_query($con,"select * from categories where status='1'");
    $resBlogCat=mysqli_query($con,"select * from blog_categories where status='1'");
?>

<footer class="mt-3">
    <div class="border-bottom-theme my-3"></div>
    <div class="container">
        <div class="row">
            <?php if(mysqli_num_rows($resProductCat)>0){ ?>
                <div class="col-md-3">
                    <ul class="list-unstyled m-0">
                        <h4 class="footer-col-heading">Product Categories</h4>
                        <?php while($rowProductCat=mysqli_fetch_assoc($resProductCat)){ ?>
                            <li><a href="category.php?id=<?php echo $rowProductCat['id'] ?>"><?php echo $rowProductCat['categories']?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
            <div class="col-md-3">
                <ul class="list-unstyled m-0">
                    <h4 class="footer-col-heading">Important Links</h4>
                    <li><a href="profile.php">My Account</a></li>
                    <li><a href="wishlist.php">Wishlist</a></li>
                    <li><a href="my_order.php">Orders</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <ul class="list-unstyled m-0">
                    <h4 class="footer-col-heading">Site Links</h4>
                    <li><a href="forget-password.php">Forget Password</a></li>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </div>
            <?php if(mysqli_num_rows($resBlogCat)>0){ ?>
                <div class="col-md-3">
                    <ul class="list-unstyled m-0">
                        <h4 class="footer-col-heading">Blog Categories</h4>
                        <?php while($rowBlogCat=mysqli_fetch_assoc($rowBlogCat)){ ?>
                            <li><a href="blog.php?id=<?php echo $rowBlogCat['id'] ?>"><?php echo $rowBlogCat['blog_category']?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="border-bottom-theme my-3"></div>
    <div class="container text-center">
        <p class="text-center text-light">Designed and developed by <u><a href="https://www.chronopegasus.com">chronopegasus</a></u></p>
    </div>
</footer>