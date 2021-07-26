<?php include('partials-front/menu.php');?>

    <table class="tbl-full">
        <tr>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
<?php

if (!empty($_SESSION['shopping_cart'])) {
    $total = 0;

    foreach ($_SESSION['shopping_cart'] as $key => $product) {
        ?>
            <tr>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['quantity']; ?></td>
                <td><?php echo $product['price']; ?></td>
                <td><?php echo number_format($product['quantity'] * $product['price'], 2); ?></td>
                <td>
                    <a href="delete-cart.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">X</a>
                </td>
            </tr>
        <?php
    }   
        $total = $total + ($product['quantity'] * $product['price']);
        
        ?>
        <tr>
            <td colspan="3" align="right">Total</td>
            <td align="right"><?php echo number_format($total, 2); ?></td>
            <td></td>
        </tr>
        <?php

    
}

?>
<?php include('partials-front/footer.php');?>
