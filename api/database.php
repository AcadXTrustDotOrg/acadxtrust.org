<?php
    $con = mysqli_connect("sql133.main-hosting.eu", "u738288828_admin", "acadtrust7102", "u738288828_acadx");
    /*$query = "CREATE DATABASE IF NOT EXISTS u738288828_acadx";
    mysqli_query( $con, $query);
    mysqli_select_db($con, "u738288828_acadx") or die(mysqli_error($con));*/
    $query = "CREATE TABLE IF NOT EXISTS comments(
        custId INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        fullName VARCHAR(30) NOT NULL,
        email VARCHAR(30) NOT NULL,
        phone INT(10) NOT NULL,
        comment VARCHAR(500) NOT NULL
    )
    ENGINE=MyISAM";
    mysqli_query($con, $query);
?>