<?php include('partials/menu.php'); ?>

        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Category</h1>
                <?php 
                    if (isset($_SESSION['add'])) {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                ?>
                <br><br>
                <a href="add-category.php" class="btn-primary">Add</a>
                <br><br>
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                       $sql = "SELECT * FROM category";

                       $res = mysqli_query($conn, $sql);

                       if ($res == TRUE) {
                           $count = mysqli_num_rows($res);

                           if ($count > 0) {
                                while ($rows=mysqli_fetch_assoc($res)) {
                                    $id = $rows['id'];
                                    $name = $rows['title'];
                                    $Image = $rows['image_name'];
                                    $featured = $rows['featured'];
                                    $active = $rows['active'];

                                    ?>
                                     <tr>
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo $name; ?></td>
                                        <td>
                                        
                                            <?php 
                                                if ($Image!= "") 
                                                {
                                                    ?>
                                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $Image; ?>" width="150px" >
                                                    <?php
                                                }else {
                                                    echo "Image Not Added.";
                                                }
                                            ?>
                                        
                                        </td>
                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image=<?php echo $Image; ?>" class="btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    <?php                                   
                                }   
                           }else {
                            ?>
                            <tr>
                               <td colspan="6"><div class="error">No Category Added.</div> </td>
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
