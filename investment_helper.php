<?php
// investment_helper.php

session_start();

// Include the database configuration file
require 'include/config.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Initialize variables
$message = '';
$error = '';

// Fetch user ID from $front_conn
$username = $_SESSION['username'];
$user_sql = "SELECT id FROM hm2_users WHERE username='$username'";
$user_result = mysqli_query($front_conn, $user_sql);

if ($user_result && mysqli_num_rows($user_result) == 1) {
    $user = mysqli_fetch_assoc($user_result);
    $user_id = $user['id'];
} else {
    // Handle case where user is not found
    $error = "User not found.";
    // Optionally, you can log out the user
    session_destroy();
    header("Location: login.php");
    exit();
}

// Handle Package Investment
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['package_id'])) {
    $package_id = intval($_POST['package_id']);
    $investment_amount = floatval($_POST['investment_amount']);

    // Fetch package details from $stock_conn
    $package_sql = "SELECT * FROM packages WHERE id='$package_id'";
    $package_result = mysqli_query($stock_conn, $package_sql);

    if ($package_result && mysqli_num_rows($package_result) == 1) {
        $package = mysqli_fetch_assoc($package_result);

        // Validate investment amount
        if ($investment_amount >= $package['min_amount'] && $investment_amount <= $package['max_amount']) {
            // Calculate profit
            $profit = ($investment_amount * $package['profit_percentage']) / 100;

            // Insert into investments table using $stock_conn
            // Now including 'status' and 'admin_comments'
            $insert = "INSERT INTO investments (user_id, package_id, amount, profit, status, admin_comments) VALUES ('$user_id', '$package_id', '$investment_amount', '$profit', 'pending', '')";
            if (mysqli_query($stock_conn, $insert)) {
                $message = "Investment successful! You will earn $$profit profit. Your investment is pending approval.";
            } else {
                // Display detailed MySQL error
                $error = "Investment failed: " . mysqli_error($stock_conn);
            }
        } else {
            $error = "Investment amount must be between $" . number_format($package['min_amount'], 2) . " and $" . number_format($package['max_amount'], 2) . ".";
        }
    } else {
        $error = "Invalid package selected.";
    }
}

// Fetch all packages from $stock_conn
$packages_sql = "SELECT * FROM packages";
$packages_result = mysqli_query($stock_conn, $packages_sql);

// Fetch user's investments including status and admin comments
$investments_sql = "SELECT packages.name, packages.profit_percentage, investments.amount, investments.profit, investments.status, investments.admin_comments
FROM investments
JOIN packages ON investments.package_id = packages.id
WHERE investments.user_id = '$user_id'";
$investments_result = mysqli_query($stock_conn, $investments_sql);

// Fetch user balance from withdrawable_balance table
$balance_sql = "SELECT balance FROM withdrawable_balance WHERE user_id='$user_id'";
$balance_result = mysqli_query($stock_conn, $balance_sql);

if ($balance_result && mysqli_num_rows($balance_result) > 0) {
    $balance_row = mysqli_fetch_assoc($balance_result);
    $user_balance = $balance_row['balance'];
} else {
    // If no balance record exists, set balance to 0.00
    $user_balance = "0.00";
}
?>
