<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
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
                    <td>Select Image: </td>
                    <td><input type="file" name="image"></td>
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
                        <input type="submit" name="submit" value="Add Category " class="btn-secondary">
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

        }else{
            $image_name = "";
        }

        $sql = "INSERT INTO category SET
                title='$name',
                image_name='$image_name',
                featured='$featured',
                active='$active'";
        
      
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        if($res ==TRUE){
            $_SESSION['add'] = "Category Added Successfully";

            header("location:".SITEURL.'admin/category.php');
        }
        else {
            $_SESSION['add'] = "Failed To Add Category";

            header("location:".SITEURL.'admin/add-category.php');
        }
    }
  
?>