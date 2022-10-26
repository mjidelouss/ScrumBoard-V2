<?php 
    //CONNECT TO MYSQL DATABASE USING MYSQLI
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $dbName = "youcodescrumboard";

    // Create Connection
    $con = mysqli_connect($serverName, $userName, $password, $dbName);

    if (mysqli_connect_errno()){
        echo "Failed to connect!!";
        exit();
    }
    echo "Connection success!!";
?>