<?php include('partials/menu.php'); ?>

        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1>
                <br>

                <?php 
                    if (isset($_SESSION['add'])) {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if (isset($_SESSION['update'])) {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if (isset($_SESSION['delete'])) {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                ?>
                <br><br>

                <a href="add-admin.php" class="btn-primary">Add</a>
                <br><br>
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                       $sql = "SELECT * FROM admin";

                       $res = mysqli_query($conn, $sql);

                       if ($res == TRUE) {
                           $count = mysqli_num_rows($res);

                           if ($count > 0) {
                                while ($rows=mysqli_fetch_assoc($res)) {
                                    $id = $rows['id'];
                                    $full_name = $rows['full_name'];
                                    $username = $rows['username'];
                                    ?>
                                     <tr>
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    <?php                                   
                                }   
                           }else {
                            
                           }
                       }
                    ?>
                </table>

                <div class="clearfix"></div>
            </div>
        </div>
<?php include('partials/footer.php'); ?>
