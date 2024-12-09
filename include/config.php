<?php
include_once 'front_db_connect.php';
include_once 'stock_db_connect.php';
//session_start();
$site_url = 'https://capitalcoin.online/';
$stock_url = $site_url.'stock_investment/';


// dashboard.php

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch user ID
$username = $_SESSION['username'];
$user_sql = "SELECT id FROM hm2_users WHERE username='$username'";
$user_result = mysqli_query($conn, $user_sql);
$user = mysqli_fetch_assoc($user_result);
$user_id = $user['id'];

// Handle Package Investment
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['package_id'])) {
    $package_id = intval($_POST['package_id']);
    $investment_amount = floatval($_POST['investment_amount']);

    // Fetch package details
    $package_sql = "SELECT * FROM packages WHERE id='$package_id'";
    $package_result = mysqli_query($conn, $package_sql);
    if (mysqli_num_rows($package_result) == 1) {
        $package = mysqli_fetch_assoc($package_result);
        // Validate investment amount
        if ($investment_amount >= $package['min_amount'] && $investment_amount <= $package['max_amount']) {
            // Calculate profit
            $profit = ($investment_amount * $package['profit_percentage']) / 100;

            // Insert into investments table (assuming investments table can handle package investments)
            $insert = "INSERT INTO investments (user_id, package_id, amount, profit) VALUES ('$user_id', '$package_id', '$investment_amount', '$profit')";
            if (mysqli_query($conn, $insert)) {
                $message = "Investment successful! You will earn $$profit profit.";
            } else {
                $error = "Investment failed. Please try again.";
            }
        } else {
            $error = "Investment amount must be between $" . number_format($package['min_amount'], 2) . " and $" . number_format($package['max_amount'], 2) . ".";
        }
    } else {
        $error = "Invalid package selected.";
    }
}

// Fetch all packages
$packages_sql = "SELECT * FROM packages";
$packages_result = mysqli_query($conn, $packages_sql);

// Fetch user's investments
$investments_sql = "SELECT packages.name, packages.profit_percentage, investments.amount, investments.profit 
                    FROM investments 
                    JOIN packages ON investments.package_id = packages.id 
                    WHERE investments.user_id = '$user_id'";
$investments_result = mysqli_query($conn, $investments_sql);

