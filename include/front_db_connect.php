<?php
// config.php

$servername = "localhost";
$username = "multistream6_capital_coin_user_2";
$password = "capital_coin_user_2";
$dbname = "multistream6_capital_coin_1";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

