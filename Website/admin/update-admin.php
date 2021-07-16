<?php include('partials/menu.php'); ?>

        <div class="main-content">
            <div class="wrapper">
                <h1>Update Admin</h1>
                <br>

                <?php 
                
                    $id=$_GET['id'];

                    $sql = "SELECT * FROM admin WHERE id=$id";

                    $res = mysqli_query($conn, $sql);

                    if ($res == TRUE) {
                        $count = mysqli_num_rows($res);

                        if ($count == 1) {
                            $row = mysqli_fetch_assoc($res);


                            $full_name = $row['full_name'];
                            $username = $row['username'];
                        }
                        else {
                            header('location:'.SITEURL.'admin/admin.php');

                        }
                    }

                ?>
                <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full-name" placeholder="U Volledige Naam" value="<?php echo $full_name ?>"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" placeholder="U username" value="<?php echo $username ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
            </div>
        </div>
<?php include('partials/footer.php'); ?>

<?php
    if(isset($_POST['submit']))
    {
        $full_name = $_POST['full-name'];
        $username = $_POST['username'];

        $sql = "UPDATE admin SET
                full_name='$full_name',
                username='$username'
                WHERE id='$id'";
        
      
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        if($res ==TRUE){
            $_SESSION['update'] = "Admin Updated Successfully";

            header("location:".SITEURL.'admin/admin.php');
        }
        else {
            $_SESSION['update'] = "Failed To Update";

            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
  
?>