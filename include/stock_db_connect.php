<?php
// config.php

$servername = "localhost";
$username = "multistream6_capital_coin_stock_investment";
$password = "capital_coin_stock_investment";
$dbname = "multistream6_capital_coin_stock_investment";

// Create connection
$stock_conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$stock_conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
