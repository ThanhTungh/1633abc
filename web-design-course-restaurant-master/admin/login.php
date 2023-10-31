<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login -Food Order System</title>
        <!-- dau .. de thoat khoi folder admin -->
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php
                if (isset($_SESSION['login'])) {
                    echo $_SESSION['login']; //display session message
                    unset($_SESSION['login']); //removing session message
                }
                if (isset($_SESSION['no-login-message'])) {
                    echo $_SESSION['no-login-message']; //display session message
                    unset($_SESSION['no-login-message']); //removing session message
                }
            ?>
            <br><br>

            <form action="" method="post" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter username"><br><br>
                Password: <br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>

                <input type="submit" name="submit" value="login" class="btn-primary"><br><br>
            </form>
            <p class="text-center">Create by - <a href="https://www.facebook.com/tung.dam.311/">Thanh Tung</a></p>
        </div>
    </body>
</html>

<?php
    //check whether  ubmit button clicked or not
    if(isset($_POST['submit']))
    {
        //Get data from login form
        $username =$_POST['username'];
        $password = md5($_POST['password']);

        //sql to check whethe user name and password exist or not
        $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //count row to check whether user is exist or not
        $count = mysqli_num_rows($res);
        if($count ==1)
        {
            $_SESSION['login'] = "<div class= 'success'>Login Successfully</div>";
            $_SESSION['user'] = $username;// to check whether the user llogin or not and logout will  unset it
            //redirect to homepage
            header("location:".SITEURL.'admin/');
        }else
        {
            $_SESSION['login'] = "<div class= 'error'>Username or Password not match</div>";
            //redirect to loginpage
            header("location:".SITEURL.'admin/login.php');
        }
    }
?>