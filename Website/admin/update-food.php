<?php include('partials/menu.php'); 
    #fix Image not Added bug when updating a food item and not changing the images
?>
        
        <div class="main-content">
            <div class="wrapper">
                <h1>Update food</h1>
                <br>

                <?php 

                    if (isset($_GET['id'])) {
                        $id=$_GET['id'];

                    $sql = "SELECT * FROM food WHERE id=$id";

                    $res = mysqli_query($conn, $sql);

                    if ($res == TRUE) {
                        $count = mysqli_num_rows($res);

                        if ($count == 1) {
                            $row = mysqli_fetch_assoc($res);
                            $name = $row['title'];
                            $description = $row['description'];
                            $price = $row['price'];
                            $category = $row['category_id'];
                            $current_image = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                        }
                        else {
                            $_SESSION['error'] = "Food not found.";
                            header("location:".SITEURL.'admin/food.php');

                        }
                    }
                    }else {
                        header("location:".SITEURL.'admin/food.php');

                    }

                    

                ?>
                <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                <tr>
                    <td>Name: </td>
                    <td><input type="text" name="name" value="<?php echo $name; ?>"></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols='30' rows='10'><?php echo $description; ?></textarea></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price" step=0.01 value="<?php echo $price; ?>"></td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                    <select name="category">

                        <?php
                        
                        $sql2 = "SELECT * FROM category WHERE active='Yes'";

                        $res2 = mysqli_query($conn, $sql2);

                        $count = mysqli_num_rows($res2);

                        if ($count>0) {
                            while ($row =mysqli_fetch_assoc($res2)) {
                                $id_category = $row['id'];
                                $name_category = $row['title'];
                                ?>
                                    <option <?php if($category==$id_category){echo "Selected";}?> value="<?php echo $id_category; ?>"><?php echo $name_category; ?></option>
                                    
                                <?php
                            }
                        }else {
                            ?>
                            <option value="0">No Category Found</option>
                            <?php
                        }

                        ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>" class="btn-secondary">

                        <?php 
                            if ($current_image !="") {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width = "200px">
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
                        <input type="hidden" name="id" value="<?php echo $id; ?>" class="btn-secondary">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
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
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $current_image = $_POST['current_image'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        if(isset($_FILES['image']['name']))
        {
            $image_name = $_FILES['image']['name'];

            if ($image_name != "") {
                $ext = end(explode('.', $image_name));
            
                $image_name = "Food_Category_".rand(000, 999).'_'.rand(000, 999).'.'.$ext;
    
                $source_name = $_FILES['image']['tmp_name'];
            
                $destination_path = "../images/food/".$image_name;
    
                $upload = move_uploaded_file($source_name, $destination_path);
    
                if ($upload == false) {
                    $_SESSION['upload'] = "Failed To Upload Image";
    
                    header("location:".SITEURL.'admin/food.php');
                    
                    die();
                }

                if ($current_image != "") {
                    $path= "../images/food/".$current_image;
            
                    $remove = unlink($path);
    
                    if ($remove == false) {
                        $_SESSION['delete'] = "Failed to delete image from directory";
    
                        header('location:'.SITEURL.'admin/food.php');
    
                        die();
                    }
                }
                
            }

        }else{
            $_SESSION['error'] = $current_image;

            $image_name = $current_image;
        }

        $sql3 = "UPDATE food SET
                title='$name',
                description='$description',
                price='$price',
                image_name='$image_name',
                category_id='$category',
                featured='$featured',
                active='$active'
                WHERE id='$id'";
        
      
        $res3 = mysqli_query($conn, $sql3);

        if($res3 == TRUE){
            $_SESSION['update'] = $id;

            header("location:".SITEURL.'admin/food.php');
        }
        else {
            $_SESSION['update'] = "Failed To Update";

            header("location:".SITEURL.'admin/food.php');
        }
    }
  
?>