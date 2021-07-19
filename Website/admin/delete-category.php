<?php 
    include('../config/constants.php');

    if (isset($_GET['id']) AND isset($_GET['image'])) {

        $id = $_GET['id'];

        $image = $_GET['image'];

        if ($image != "") {
            
            $path= "../images/category/".$image;
            
            $remove = unlink($path);

            if ($remove == false) {
                $_SESSION['delete'] = "Failed to delete image from directory";

                header('location:'.SITEURL.'admin/category.php');

                die();
            }
        }

        $sql = "DELETE FROM category WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        if ($res == TRUE) {
        
            $_SESSION['delete'] = "Category Deleted Successfully";

            header('location:'.SITEURL.'admin/category.php');
        }else {
            $_SESSION['delete'] = "Failed to Delete Admin";

            header('location:'.SITEURL.'admin/category.php');
        }

    }
    else 
    {
        
        header('location:'.SITEURL.'admin/category.php');

    }


    
?>