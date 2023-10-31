<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
            if(isset($_GET['id']))
            {
                $id =$_GET['id'];
            }
        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Current password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current password">
                    </td>
                </tr>
                <tr>
                    <td>New password</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm password: </td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>

</div>
<?php
    //check whether submnit button clicked or not
    if(isset($_POST['submit'])){
        //get the data from form
        $id=$_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);
        //check whether id and password exist or not
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
        //execute the query
        $res= mysqli_query($conn, $sql);
        if($res == true){
            //check whether data is available or not
            $count = mysqli_num_rows($res);
            if($count == 1)
            {
                //user exist and password can be changed
                //check whether the  new pasword 

                if($new_password==$confirm_password)
                {
                    $sql2= "UPDATE tbl_admin SET password = '$new_password' WHERE id = '$id'";
                    $res2 = mysqli_query($conn, $sql2);
                    if ($res2 == TRUE ) {
                        $_SESSION['change-pwd'] = "<div class ='success'>Password changed successfully</div>";
                        //redirect the user
                        header("location:".SITEURL.'admin/manage-admin.php');
                        
                    }else
                    {
                        $_SESSION['change-pwd'] = "<div class ='error'>Failed to change Password</div>";
                        //redirect the user
                        header("location:".SITEURL.'admin/manage-admin.php');
                    }
                }
                else
                {
                    $_SESSION['pwd-not-match'] = "<div class ='error'>Password not match</div>";
                //redirect the user
                    header("location:".SITEURL.'admin/manage-admin.php');
                }
            }else
            {
                //user not exist , set message and redirect
                $_SESSION['user-not-found'] = "<div class ='error'>User not found</div>";
                //redirect the user
                header("location:".SITEURL.'admin/manage-admin.php');
            }
        }
        //check whether new pass and confirm pass match or not

    }
?>

<?php include('partials/footer.php') ?>