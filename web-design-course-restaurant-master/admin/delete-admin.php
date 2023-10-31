<?php
    include('../config/constants.php');
    //Get the id of admin to delete
    echo $id =$_GET['id'];

    //Create SQL query to delete admin
    $sql="DELETE FROM tbl_admin WHERE id=$id";

    //Exevute the query
    $res = mysqli_query($conn, $sql);

    //Check whether the query execute successfully or not
    if($res == true)
    {   //create session to display message
        $_SESSION['delete']= "<div class= 'success'>Admin deleted success !</div>";
        header('location:'. SITEURL.'admin/manage-admin.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='error'>False to delete admin </div>";
        header('location:'. SITEURL.'admin/manage-admin.php');
    }
?>