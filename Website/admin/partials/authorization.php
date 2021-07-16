<?php
    if (!isset($_SESSION['user'])) {
        $_SESSION['no-login-message'] = "Please login";

        header('location:'.SITEURL.'admin/login.php');
    }
?>