<?php include('partials/menu.php') ?>

<div class="main-content"> 
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php 
            //get the id of selected  admin
            $id=$_GET['id'];
            //create SQL queryto get detail
            $sql="SELECT * FROM tbl_admin WHERE id = $id";
            //execute the query
            $res=mysqli_query($conn, $sql);
            //check whether the query is executed or not
            if($res==true){
                $count = mysqli_num_rows($res);
                if($count == 1){
                    $row=mysqli_fetch_assoc($res);
                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }else{
                    header('location:'. SITEURL.'admin/manage-admin.php');
                }
            }
        ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td>
                        <input type="text" name="full_name" value="">
                    </td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" name="username" value="">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>
<?php
    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        $sql = "UPDATE tbl_admin SET full_name = '$full_name', username = '$username' WHERE id = '$id'";
        
        //Execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the query execute or not
        if($res == true){
            $_SESSION['update'] = "Admin update succesfully";
            header("location:".SITEURL.'admin/manage-admin.php');
        }else{
            $_SESSION['error'] = "Something went wrong. Please try again later.";
            header("location:".SITEURL.'admin/manage-admin.php');
        }
    }
?>

<?php include('partials/footer.php') ?> 
