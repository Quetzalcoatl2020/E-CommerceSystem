<?php

$servername = "localhost";
$username = "root";
$password = "";
$databasename = "shopprdb";

// Creating connection
$conn = mysqli_connect($servername, $username, $password, $databasename);

// Checking connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else {
    return $conn;
}
?>

