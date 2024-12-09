<?php
// Start or resume a session
session_start();

// Check if the user is logged in (you can change this condition)
if (!isset($_SESSION['username'])) {
    // Redirect to the login page or perform other actions as needed
    header('Location: login.php');
    exit();
}
