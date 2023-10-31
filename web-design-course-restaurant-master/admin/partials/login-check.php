<?php
    //check the user is logged in or not
    if(!isset($_SESSION['user']))// !isset nghia la user session is NOT set
    {
        //user is not loged in
        //redirect to page with message
        $_SESSION['no-login-message'] = "<div class='error'> Please Login </div>";
        //redirect to loginpage
        header("location:".SITEURL.'admin/login.php');
    }
?>