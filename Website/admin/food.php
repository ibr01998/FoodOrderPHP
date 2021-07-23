<?php include('partials/menu.php'); ?>

        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Food</h1>
                <?php 
                    if (isset($_SESSION['add'])) {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if (isset($_SESSION['delete'])) {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if (isset($_SESSION['error'])) {
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                    if (isset($_SESSION['update'])) {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if (isset($_SESSION['upload'])) {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                ?>
                <br><br>
                <a href="add-food.php" class="btn-primary">Add</a>
                <br><br>
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                       $sql = "SELECT c.title as category, f.id, f.title, f.description, f.price, f.image_name, f.featured, f.active FROM food f, category c WHERE f.category_id = c.id ";

                       $res = mysqli_query($conn, $sql);

                       if ($res == TRUE) {
                           $count = mysqli_num_rows($res);

                           if ($count > 0) {
                                while ($rows=mysqli_fetch_assoc($res)) {
                                    $id = $rows['id'];
                                    $name = $rows['title'];
                                    $category = $rows['category'];
                                    $description = $rows['description'];
                                    $price = $rows['price'];
                                    $Image = $rows['image_name'];
                                    $featured = $rows['featured'];
                                    $active = $rows['active'];

                                    ?>
                                     <tr>
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo $name; ?></td>
                                        <td><?php echo $category; ?></td>
                                        <td><?php echo $description; ?></td>
                                        <td>€<?php echo $price; ?></td>

                                        <td>
                                        
                                            <?php 
                                                if ($Image!= "") 
                                                {
                                                    ?>
                                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $Image; ?>" width="100px" >
                                                    <?php
                                                }else {
                                                    echo "Image Not Added.";
                                                }
                                            ?>
                                        
                                        </td>
                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image=<?php echo $Image; ?>" class="btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    <?php                                   
                                }   
                           }else {
                            ?>
                            <tr>
                               <td colspan="6"><div class="error">No Food Added.</div> </td>
                           </tr>
                           <?php  
                           }
                       }
                    ?>
                </table>


                <div class="clearfix"></div>
            </div>
        </div>
<?php include('partials/footer.php'); ?>
