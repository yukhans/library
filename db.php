<?php
    // Enter your host name, database username, password, and database name.
    // If you have not set database password on localhost then set empty.
    $con = mysqli_connect("localhost", "root", "", "login");
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $mysql_hostname = "localhost";
    $mysql_username = "username";
    $mysql_title = "title";
    $mysql_author = "author";
    $mysql_password = "password";
    $mysql_database = "database";
?>
