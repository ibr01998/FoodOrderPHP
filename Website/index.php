<?php include('partials-front/menu.php');?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                $sql = "SELECT * FROM category WHERE active='Yes' AND featured='Yes' LIMIT 3";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            ?>
                            <a href="category-foods.php?id=<?php echo $id;?>">
                            <div class="box-3 float-container">
                                <?php
                                    if ($image_name=="") {
                                        echo "No Image";
                                    }
                                    else {
                                        ?> 
                                        <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                 <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                            </a>
                            <?php
                        }
                }else {
                    echo "No Category's Found!";
                }
            ?>

            

            

            <div class="clearfix"></div>
        </div>
        <p class="text-center">
            <a href="categories.php">See All Categories</a>
        </p>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

           

            <?php
                $sql = "SELECT * FROM food WHERE active='Yes' AND featured='Yes' LIMIT 6";

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
                                        echo "No Image";
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
                                <p class="food-price"><?php echo $price; ?> €</p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="add-cart.php?id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
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

        <p class="text-center">
            <a href="foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->


<?php include('partials-front/footer.php');?>
