<?php
session_start();
require 'include/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];

    // Simple validation
    if (empty($username) || empty($password)) {
        $error = "Please enter all fields.";
    } else {
        // Fetch user
        $sql = "SELECT * FROM hm2_users WHERE username='$username'";
        $result = mysqli_query($front_conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $username;
            header("Location: /stock_investment/");
            exit();
        } else {
            $error = "Invalid credentials.";
        }
    }
}
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
    <label>Username:</label><br>
    <input type="text" name="username"><br><br>
    <input type="submit" value="Login">
</form>
</body>
</html>
