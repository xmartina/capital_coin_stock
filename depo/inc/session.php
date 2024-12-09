<?php
// Start or resume a session
session_start();

// Check if the user is logged in (you can change this condition)
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or perform other actions as needed
    header('Location: login.php');
    exit();
}

// Store data in the session
$_SESSION['user_id'] = 123;
$_SESSION['username'] = 'john_doe';

// Retrieve data from the session
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Display user information
echo "User ID: $user_id<br>";
echo "Username: $username<br>";

// Destroy the session (for example, on logout)
session_destroy();
?>
