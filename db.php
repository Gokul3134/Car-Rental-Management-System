<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "rental_car_db";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong;");
}

?>

