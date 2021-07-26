<?php include('partials/menu.php'); ?>

        <div class="main-content">
            <div class="wrapper">
                <h1>Update Category</h1>
                <br>

                <?php 

                    if (isset($_GET['id'])) {
                        $id=$_GET['id'];

                    $sql = "SELECT * FROM category WHERE id=$id";

                    $res = mysqli_query($conn, $sql);

                    if ($res == TRUE) {
                        $count = mysqli_num_rows($res);

                        if ($count == 1) {
                            $row = mysqli_fetch_assoc($res);
                            $name = $row['title'];
                            $current_image = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                        }
                        else {
                            $_SESSION['error'] = "Category not found.";
                            header("location:".SITEURL.'admin/category.php');

                        }
                    }
                    }else {
                        header("location:".SITEURL.'admin/category.php');

                    }

                    

                ?>
                <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                <tr>
                    <td>Name: </td>
                    <td><input type="text" name="name" value="<?php echo $name; ?>"></td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            if ($current_image !="") {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width = "200px">
                                <?php
                            } else {
                                echo "No Image";
                            }
                        
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                    <input <?php if($featured == "Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                    <input <?php if($featured == "No"){echo "checked";}?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                    <input <?php if($active == "Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($active == "No"){echo "checked";}?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Category " class="btn-secondary">
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
        $name = $_POST['name'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        if(isset($_FILES['image']['name']))
        {
            $image_name = $_FILES['image']['name'];

            if ($image_name != "") {
                $ext = end(explode('.', $image_name));
            
                $image_name = "Food_Category_".rand(000, 999).'_'.rand(000, 999).'.'.$ext;
    
                $source_name = $_FILES['image']['tmp_name'];
            
                $destination_path = "../images/category/".$image_name;
    
                $upload = move_uploaded_file($source_name, $destination_path);
    
                if ($upload == false) {
                    $_SESSION['upload'] = "Failed To Upload Image";
    
                    header("location:".SITEURL.'admin/add-category.php');
                    
                    die();
                }

                if ($current_image != "") {
                    $path= "../images/category/".$current_image;
            
                    $remove = unlink($path);
    
                    if ($remove == false) {
                        $_SESSION['delete'] = "Failed to delete image from directory";
    
                        header('location:'.SITEURL.'admin/category.php');
    
                        die();
                    }
                }
                
            }else{
                $image_name = $current_image;
            }

        }

        $sql2 = "UPDATE category SET
                title='$name',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                WHERE id='$id'";
        
      
        $res2 = mysqli_query($conn, $sql2) or die(mysqli_error());

        if($res2 ==TRUE){
            $_SESSION['update'] = "Category Updated Successfully";

            header("location:".SITEURL.'admin/category.php');
        }
        else {
            $_SESSION['update'] = "Failed To Update";

            header("location:".SITEURL.'admin/category.php');
        }
    }
  
?>