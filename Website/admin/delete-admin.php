<?php 
    
    include('../config/constants.php');

    $id = $_GET['id'];

    $sql = "DELETE FROM admin WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        
        $_SESSION['delete'] = "Admin Deleted Successfully";

        header('location:'.SITEURL.'admin/admin.php');
    }else {
        $_SESSION['delete'] = "Failed to Delete Admin";

        header('location:'.SITEURL.'admin/admin.php');
    }

?>