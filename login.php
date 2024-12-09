<?php
// Start the session
session_start();

// Include the database configuration file
require 'include/config.php';

// Initialize variables
$error = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize the username
    $username = trim($_POST['username']);

    // Simple validation to check if username is not empty
    if (empty($username)) {
        $error = "Please enter your username.";
    } else {
        // Prepare the SQL statement to prevent SQL injection
        $stmt = mysqli_prepare($front_conn, "SELECT * FROM hm2_users WHERE username = ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Check if the user exists
        if (mysqli_num_rows($result) == 1) {
            // User exists, set session and redirect
            $_SESSION['username'] = $username;
            header("Location: /stock_investment/");
            exit();
        } else {
            // User does not exist
            $error = "Invalid username.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    }
}

// Close the database connection
mysqli_close($front_conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Stock Investment</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h2>Login</h2>
<?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
<form method="POST" action="">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br><br>
    <input type="submit" value="Login">
</form>
</body>
</html>
