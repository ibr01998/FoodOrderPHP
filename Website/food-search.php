
<?php include('partials-front/menu.php');
    // bug when pressing add to cart and 
    // return back from the search page 
    // a warning appiers and we get redirected to 
    // set page without and search paramaters
?>
    
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php
            
            $search = $_POST['search'];
            ?>
            <h2>Foods on Your Search <a href="#" class="text-white"><?php echo $search;?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            
                $sql = "SELECT * FROM food WHERE title like '%$search%' OR description LIKE '%$search%'";
            
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            $price = $row['price'];
                            $description = $row['description'];


                            ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                <?php
                                    if ($image_name=="") {
                                        echo "No Images";
                                    }
                                    else {
                                        ?> 
                                        <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                </div>
                                <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price"><?php echo $price; ?> ???</p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="add-cart.php?id=<?php echo $id;?>" class="btn btn-primary">Add to Cart</a>
                              </div>
                            </div>
                            <?php
                        }
                }else {
                    echo "No Food's Found!";
                }
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
    <?php include('partials-front/footer.php');?>
