<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

function dbConnect()
{
    $hostname = "localhost";
    $username = "multistream6_capital_coin_1";
    $password = "000000";
    $database = "multistream6_capital_coin_1";

    $mysqli = new mysqli($hostname, $username, $password, $database);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    return $mysqli;
}

$connection = dbConnect();
$user_id = null;

if (isset($_POST['login'])) {
    $username_email = $connection->real_escape_string($_POST['username_email']);

    $query = "SELECT * FROM hm2_users WHERE (username = '$username_email' OR email = '$username_email')";
    $result = $connection->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['id'] = $user_id; // Store the user's ID in the session
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Login failed. Please check your credentials.";
    }
}

if (!isset($_SESSION['id'])) {
    header('Location: login.php'); // Redirect to the login page if the user is not authenticated
    exit();
}

// Form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $connection->real_escape_string($_SESSION['id']);
    $amount = $connection->real_escape_string($_POST['deposit_amount']);
    $ec_type = $connection->real_escape_string($_POST['ec_type']);

    if ($amount <= 0) { ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var authError = document.getElementById('auth-error');
                if (authError) {
                    authError.classList.remove('d-none');
                }
            });
        </script>
    <?php } elseif (empty($ec_type)) { ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var authError = document.getElementById('addressSelectError');
                if (authError) {
                    authError.classList.remove('d-none');
                }
            });
        </script>
    <?php } elseif (!in_array($ec_type, ['1', '2', '3'])) { ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var authError = document.getElementById('addressSelectError');
                if (authError) {
                    authError.classList.remove('d-none');
                }
            });
        </script>
    <?php } else {
        // Replace this logic with your own to determine $type_id
        $type_id = 4;

        // Update $ec_type value based on user selection
        if ($ec_type == "1") {
            $ec_type = "1006";
        } elseif ($ec_type == "2") {
            $ec_type = "1007";
        } elseif ($ec_type == "3") {
            $ec_type = "1008";
        }
        $fields = "N;";
        $trans_status = "new";

        $query = "INSERT INTO hm2_pending_deposits (ec, fields, user_id, amount, type_id, date, status) 
                  VALUES ('$ec_type', '$fields', '$user_id', '$amount', '$type_id', NOW(), '$trans_status')";

        if ($connection->query($query) === TRUE) {
            header('Location: deposit-stat.php');
        } else {
            echo "Error: " . $query . "<br>" . $connection->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initially hide all wallet addresses
            $(".walletAddress1, .walletAddress2, .walletAddress3").addClass("d-none");

            // Handle the select change event
            $("#inlineFormCustomSelect").change(function() {
                var selectedValue = $(this).val();
                $(".walletAddress1, .walletAddress2, .walletAddress3").addClass("d-none"); // Hide all

                if (selectedValue === "1") {
                    $(".walletAddress1").removeClass("d-none");
                } else if (selectedValue === "2") {
                    $(".walletAddress2").removeClass("d-none");
                } else if (selectedValue === "3") {
                    $(".walletAddress3").removeClass("d-none");
                }
            });
        });
    </script>
</head>
<body>
