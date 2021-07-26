<?php
include('config/constants.php');

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        foreach ($_SESSION['shopping_cart'] as $key => $product) {
            if ($product['id'] == $id ) {
                unset($_SESSION['shopping_cart'][$key]);
            }
        }

        $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
    }

    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
?>