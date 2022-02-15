<?php
    $dbservername = 'localhost';
    $dbusername = 'root';
    $dbpassword = 'Java&7890';
    $dbname = 'php-boilerplate';
    $conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die("Connection failed : " . $conn->connect_error);
    }
?>