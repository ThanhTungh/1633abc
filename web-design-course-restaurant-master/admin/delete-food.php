<?php
    include('../config/constants.php');
    //Get the id of admin to delete
    echo $id =$_GET['id'];

    //Create SQL query to delete admin
    $sql="DELETE FROM tbl_food WHERE id=$id";

    //Exevute the query
    $res = mysqli_query($conn, $sql);

    //Check whether the query execute successfully or not
    if($res == true)
    {   //create session to display message
        $_SESSION['remove']= "<div class= 'success'>Food deleted success !</div>";
        header('location:'. SITEURL.'admin/manage-food.php');
    }
    else
    {
        $_SESSION['remove'] = "<div class='error'>False to delete food </div>";
        header('location:'. SITEURL.'admin/manage-food.php');
    }
?>