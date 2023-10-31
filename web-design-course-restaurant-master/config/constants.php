<?php
    //Session start
    session_start();

    define('SITEURL','http://localhost/web-design-course-restaurant-master/');
    define('LOCALHOST', 'localhost:3307');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food-order');
    $port=3307;
    
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //database connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
    
//selection database
    
?> 