<?php include('../config/constants.php');  ?>


<html>
    <head>
        <title>Login - kwizin Admin Pannel</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">login
            </h1>
            <br>
            <?php
                if (isset($_SESSION['login'])) {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                };
            ?>
            <form action="" method="POST">
            <br>
            <input type="text" name="username" placeholder="Username"><br> <br>
            
            <input type="password" name="password" placeholder="Password"> <br> <br>
            <input type="submit" name="submit" value="login" class="btn-primary">

            </form>
            <br>
            <p class="text-center"> Powered By <a href="#">Exelyus</a></p>
        </div>
    </body>
</html>

<?php 
    if (isset($_POST['submit'])) {

        $_SESSION['login'] = 'hey';
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM admin WHERE username='$username' AND password= '$password'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if ($count == 1) {
            
            $_SESSION['login'] = "Login Successful";
            $_SESSION['user'] = "$username";

            header('location:'.SITEURL.'admin/index.php');

        }else{
            $_SESSION['login'] = "<div class='text-center'>Incorrect Username And/Or Password</div>";
            header('location:'.SITEURL.'admin/login.php');

        }
    }

?>
