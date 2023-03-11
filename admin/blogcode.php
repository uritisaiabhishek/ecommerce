<?php
    include('connection.inc.php');
    include('functions.inc.php');

    if(isset($_POST['delete_blog_btn']))
    {
        $id = $_POST['delete_blog_id'];
        $delete_blog_image = $_POST['delete_blog_image'];
        
        $query = "SELECT * FROM blog WHERE id='$id' ";
        $query_run = mysqli_query($con, $query);
    
        if($query_run)
        {
            $file= BLOG_IMAGE_SERVER_PATH.$delete_blog_image;
            unlink($file);
            
            $query = "DELETE FROM blog WHERE id='$id' ";
            $query_run = mysqli_query($con, $query);
        
            if($query_run)
            {
                $_SESSION['status'] = "Your Data and image is Deleted";
                $_SESSION['status_code'] = "success";
                header('Location: blog.php'); 
            }
            else
            {
                $_SESSION['status'] = "Your Data is NOT DELETED";       
                $_SESSION['status_code'] = "error";
                header('Location: blog.php'); 
            }    
        }
        else
        {
            $_SESSION['status'] = "Your image is NOT DELETED";       
            $_SESSION['status_code'] = "error";
            header('Location: blog.php'); 
        }    
    
    }
    
?>