<?php
// admin.php

session_start();
require 'include/config.php';

// Check if admin is logged in
// Assume you have a way to verify admin status, e.g., $_SESSION['is_admin']
// Replace with your actual admin authentication logic

// if (!isset($_SESSION['username']) || $_SESSION['is_admin'] !== true) {
//     header("Location: login.php");
//     exit();
// }

// Initialize variables
$message = '';
$error = '';

// Handle Approval or Rejection
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $investment_id = intval($_POST['investment_id']);
    $action = $_POST['action'];
    $admin_comments = mysqli_real_escape_string($stock_conn, $_POST['admin_comments']);

    if ($action == 'approve') {
        $update_sql = "UPDATE investments SET status='approved', admin_comments='$admin_comments' WHERE id='$investment_id'";
        if (mysqli_query($stock_conn, $update_sql)) {
            $message = "Investment ID $investment_id approved successfully.";

            // Optionally, update user's withdrawable balance
            // Fetch investment details
            $fetch_sql = "SELECT user_id, amount, profit FROM investments WHERE id='$investment_id'";
            $fetch_result = mysqli_query($stock_conn, $fetch_sql);
            if ($fetch_result && mysqli_num_rows($fetch_result) == 1) {
                $investment = mysqli_fetch_assoc($fetch_result);
                $user_id = $investment['user_id'];
                $profit = $investment['profit'];

                // Update withdrawable_balance table
                $balance_check_sql = "SELECT balance FROM withdrawable_balance WHERE user_id='$user_id'";
                $balance_check_result = mysqli_query($stock_conn, $balance_check_sql);
                if (mysqli_num_rows($balance_check_result) == 1) {
                    // Update existing balance
                    $update_balance_sql = "UPDATE withdrawable_balance SET balance = balance + '$profit' WHERE user_id='$user_id'";
                    mysqli_query($stock_conn, $update_balance_sql);
                } else {
                    // Insert new balance record
                    $insert_balance_sql = "INSERT INTO withdrawable_balance (user_id, balance) VALUES ('$user_id', '$profit')";
                    mysqli_query($stock_conn, $insert_balance_sql);
                }
            }
        } else {
            $error = "Failed to approve investment: " . mysqli_error($stock_conn);
        }
    } elseif ($action == 'reject') {
        $update_sql = "UPDATE investments SET status='rejected', admin_comments='$admin_comments' WHERE id='$investment_id'";
        if (mysqli_query($stock_conn, $update_sql)) {
            $message = "Investment ID $investment_id rejected successfully.";
        } else {
            $error = "Failed to reject investment: " . mysqli_error($stock_conn);
        }
    }
}

// Fetch all pending investments
$pending_sql = "SELECT investments.id, hm2_users.username, packages.name AS package_name, investments.amount, investments.profit, investments.deposit_method, investments.deposit_address, investments.deposit_txid, investments.investment_date
FROM investments
JOIN hm2_users ON investments.user_id = hm2_users.id
JOIN packages ON investments.package_id = packages.id
WHERE investments.status = 'pending'";
$pending_result = mysqli_query($stock_conn, $pending_sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Approve Investments</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h2>Admin Panel - Approve or Reject Investments</h2>
<?php
if(isset($message)) {
    echo "<p class='success'>$message</p>";
}
if(isset($error)) {
    echo "<p class='error'>$error</p>";
}
?>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Package</th>
        <th>Amount ($)</th>
        <th>Profit ($)</th>
        <th>Deposit Method</th>
        <th>Deposit Address</th>
        <th>Deposit TXID</th>
        <th>Investment Date</th>
        <th>Actions</th>
    </tr>
    <?php
    if($pending_result && mysqli_num_rows($pending_result) > 0) {
        while($investment = mysqli_fetch_assoc($pending_result)) {
            ?>
            <tr>
                <td><?= htmlspecialchars($investment['id']) ?></td>
                <td><?= htmlspecialchars($investment['username']) ?></td>
                <td><?= htmlspecialchars($investment['package_name']) ?></td>
                <td align="right"><?= number_format($investment['amount'], 2) ?></td>
                <td align="right"><?= number_format($investment['profit'], 2) ?></td>
                <td><?= htmlspecialchars($investment['deposit_method']) ?></td>
                <td><?= htmlspecialchars($investment['deposit_address']) ?></td>
                <td><?= htmlspecialchars($investment['deposit_txid']) ?></td>
                <td><?= htmlspecialchars($investment['investment_date']) ?></td>
                <td>
                    <form method="POST" action="admin.php">
                        <input type="hidden" name="investment_id" value="<?= htmlspecialchars($investment['id']) ?>">
                        <textarea name="admin_comments" placeholder="Comments (optional)" rows="2" cols="20"></textarea><br>
                        <button type="submit" name="action" value="approve">Approve</button>
                        <button type="submit" name="action" value="reject">Reject</button>
                    </form>
                </td>
            </tr>
            <?php
        }
    } else {
        echo "<tr><td colspan='10'>No pending investments.</td></tr>";
    }
    ?>
</table>
</body>
</html>
