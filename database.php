<?php 
    //CONNECT TO MYSQL DATABASE USING MYSQLI
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $dbName = "youcodescrumboard";

    // Create Connection
    global $con;
    $con = mysqli_connect($serverName, $userName, $password, $dbName);

    if (mysqli_connect_errno()){
        echo "Failed to connect!!";
        exit();
    }
?>