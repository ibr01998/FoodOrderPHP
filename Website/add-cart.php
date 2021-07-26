<?php
include('config/constants.php');

    $product_ids = array();
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM food WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);

            $id = $row['id'];
            $name = $row['title'];
            $price = $row['price'];

        }

        if (isset($_SESSION['shopping_cart'])) {

            $countcart = count($_SESSION['shopping_cart']);

            $product_ids = array_column($_SESSION['shopping_cart'], 'id');

            if (!in_array($id, $product_ids)) {
                $_SESSION['shopping_cart'][$countcart] = array(
                    'id' => $id,
                    'name' => $name,
                    'price' => $price,
                    'quantity' => 1
                );
            }else {
                for ($i=0; $i < count($product_ids); $i++) { 
                    if ($product_ids[$i] == $id) {
                        $_SESSION['shopping_cart'][$i]['quantity'] += 1;
                    }
                }
            }
        }else {
            $_SESSION['shopping_cart'][0] = array(
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'quantity' => 1

            );
        }

    }else {
        header("location:".SITEURL);
    }

    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }


?>