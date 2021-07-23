<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br>

        <?php 
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            } elseif (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Name: </td>
                    <td><input type="text" name="name" placeholder="Category Name"></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols='30' rows='10' placeholder="Food Description"></textarea></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price" step=0.01></td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                    <select name="category">

                        <?php
                        
                        $sql = "SELECT * FROM category WHERE active='Yes'";

                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);

                        if ($count>0) {
                            while ($row =mysqli_fetch_assoc($res)) {
                                $id = $row['id'];
                                $name = $row['title'];
                                ?>
                                    <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
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
                    <td>Featured: </td>
                    <td>
                    <input type="radio" name="featured" value="Yes">Yes
                    <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                    <input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food " class="btn-secondary">
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
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];


        if(isset($_POST['featured']))
        {
            $featured = $_POST['featured'];
        }else{
            $featured = "No";
        }

        if(isset($_POST['active']))
        {
            $active = $_POST['active'];
        }else{
            $active = "No";
        }

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
            }

        }else{
            $image_name = "";
        }

        $sql2 = "INSERT INTO food SET
                title='$name',
                description='$description',
                price='$price',
                image_name='$image_name',
                category_id='$category',
                featured='$featured',
                active='$active'";
        
      
        $res2 = mysqli_query($conn, $sql2) or die(mysqli_error());

        if($res2 ==TRUE){
            $_SESSION['add'] = "Food Added Successfully";

            header("location:".SITEURL.'admin/food.php');
        }
        else {
            $_SESSION['add'] = "Failed To Add Food";

            header("location:".SITEURL.'admin/food.php');
        }
    }
  
?>