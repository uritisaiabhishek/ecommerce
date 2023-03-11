<!-- Featured Products Starts -->
<section class="featured_products my-5">
        <div class="container-fluid product_grid">
            <div class="card product_grid_card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="home_card_heading m-0 p-0">Featured</div><a href="#" class="btn btn-theme">View All</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php 
                            $get_product=get_product($con,4);
                            foreach($get_product as $list){
                            ?>
                        <div class="col-md-3 col-sm-6">
                            <div class="card product_home_card">
                                <div class="card-body">
                                    <div class="product_sale_banner d-flex">
                                        <?php
                                            if($list['price']!=0){
                                                echo '<div class="sale_badge">Sale</div>';
                                            }
                                            if($list['is_featured']==1) {
                                                echo '<div class="featured_badge">Featured</div>';
                                            }
                                        ?>
                                    </div>
                                    
                                    <a class="product_wishlist" href="javascript:void(0)" onclick="wishlist_manage('<?php echo $list['id']?>','add')"><i class="fas fa-heart"></i></a>
                                    <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image'] ?>" alt="Product name" class="img-fluid">
                                    
                                    <div class="product_details">
                                        <h5 class="category_name"><?php echo $list['categories']?></h5>
                                        <a href="product.php?id=<?php echo $list['id'] ?>" class="product_name"><?php echo $list['name'] ?></a>
                                        <?php  if($list['price']!=0){ ?>
                                            <h5 class="product_pricing"><span><?php echo SITE_CURRENCY.'&nbsp;'.$list['mrp']?></span>&nbsp;<?php echo SITE_CURRENCY.'&nbsp;'.$list['price']?></h5>
                                        <?php }else{ ?>
                                            <h5 class="product_pricing"><?php echo SITE_CURRENCY.'&nbsp;'.$list['mrp']?></h5>
                                        <?php } ?>
                                        <?php 
                                            $product_rating_sql="select * from product_review where product_id='".$list['id']."' and status=1";
                                            $product_rating_res=mysqli_query($con,$product_rating_sql);
                                            $product_rating_count=0;
                                            if($product_rating_count_rows=mysqli_num_rows($product_rating_res)>0){
                                                while($product_rating_row=mysqli_fetch_assoc($product_rating_res)){
                                                    $product_rating_count_addition=$product_rating_count+$product_rating_row['rating'];
                                                    $product_rating_count_average=round($product_rating_count_addition / $product_rating_count_rows);
                                                }
                                                ?><h5 class="product_rating"><?php echo $product_rating_count_average ?> <i class="fas fa-star"></i></h5><?php
                                            }
                                        ?>
                                    </div>
                                    
                                    <input type="hidden" id="qty" name="qty" value="1">
                                    <a href="javascript:void(0)" onclick="manage_cart('<?php echo $list['id'] ?>','add')" class="btn add_to_cart_btn mt-2 p-2">Add to Cart</a>
                                    <button type="button" class="btn btn_tranperent mt-2" data-toggle="modal" data-target="#<?php echo $list['slug'] ?><?php echo $list['id'] ?>">
                                        Get in touch
                                    </button>
                                        <!-- get in touch Modal -->
                                        <div class="modal  fade" id="<?php echo $list['slug'] ?><?php echo $list['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="<?php echo $list['slug'] ?><?php echo $list['id'] ?>Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content get_in_touch_modal">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="<?php echo $list['slug'] ?><?php echo $list['id'] ?>Label">
                                                            Get in Touch
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                    <form id="get-in-touch-form" action="#" method="post">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="get_in_touch_product_id" id="get_in_touch_product_id" value="<?php echo $list['id'] ?>">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="get_in_touch_name" id="get_in_touch_name" placeholder="Your Name" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="get_in_touch_mobile" id="get_in_touch_mobile" placeholder="Your mobile Number" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="email" class="form-control" name="get_in_touch_email" id="get_in_touch_email" placeholder="Your Email" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="get_in_touch_location" id="get_in_touch_location" placeholder="Your Location"  required>
                                                            </div>
                                                            <div class="form-group">
                                                                <select name="get_in_touch_contact_via" id="get_in_touch_contact_via" class="form-control" required>
                                                                    <option value="Mobile">Contact Via Mobile</option>
                                                                    <option value="email">Contact Via Email</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <textarea name="get_in_touch_message" id="get_in_touch_message" cols="30" rows="5" class="form-control" placeholder="Enter Your Message"  required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button onclick="get_in_touch()" type="button" name="get_in_touch_submit" class="btn btn-block btn-theme">Send Message</button>
                                                            <a href="https://api.whatsapp.com/send?phone=<?php echo SITE_PHONE ?>&text=<?php echo SITE_PATH ?>product.php?id=<?php echo $list['id'] ?>" class="btn btn-block btn-theme">Send in Whatsapp <i class="fab fa-whatsapp"></i></a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- get in youch modal ends -->
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Featured Products Ends -->