<?php
// config.php

$servername = "localhost";
$username = "your_db_username";
$password = "your_db_password";
$dbname = "stock_investment";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
