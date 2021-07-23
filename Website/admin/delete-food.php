<?php 
    include('../config/constants.php');

    if (isset($_GET['id']) AND isset($_GET['image'])) {

        $id = $_GET['id'];

        $image = $_GET['image'];

        if ($image != "") {
            
            $path= "../images/food/".$image;
            
            $remove = unlink($path);

            if ($remove == false) {
                $_SESSION['delete'] = "Failed to delete image from directory";

                header('location:'.SITEURL.'admin/food.php');

                die();
            }
        }

        $sql = "DELETE FROM food WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        if ($res == TRUE) {
        
            $_SESSION['delete'] = "Food Deleted Successfully";

            header('location:'.SITEURL.'admin/food.php');
        }else {
            $_SESSION['delete'] = "Failed to Delete Food";

            header('location:'.SITEURL.'admin/food.php');
        }

    }
    else 
    {
        
        header('location:'.SITEURL.'admin/food.php');

    }
    
?>