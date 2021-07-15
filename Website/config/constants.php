<?php

    session_start();
    define('SITEURL', 'http://localhost/FoodOrderPHP/Website/');

    $conn = mysqli_connect('localhost', 'root', '')or die(mysqli_error());
    $db_select = mysqli_select_db($conn, 'food_order') or die(mysqli_error());
?>