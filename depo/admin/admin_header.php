<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define your database connection here
    $servername = "localhost";
    $username = "multistream6_capital_coin_1";
    $password = "000000";
    $dbname = "multistream6_capital_coin_1";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user input and use prepared statements to prevent SQL injection
    $username = $_POST['username'];
    $sq = $_POST['sq'];
    $sa = $_POST['sa'];

    // Query to check user credentials (use prepared statements to enhance security)
    $sql = "SELECT * FROM hm2_users WHERE username = ? AND sq = ? AND sa = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $sq, $sa);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a matching user is found
    if ($result->num_rows == 1) {
        // User is authenticated; create a session
        $_SESSION['username'] = $username;
        header('Location: dashboard.php'); // Redirect to a dashboard page
        exit();
    } else {
        // Authentication failed; display an error message
        echo "Invalid username or Secret Question or Secret Answer";
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
}
?>
