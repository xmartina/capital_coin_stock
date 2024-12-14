<?php
// admin.php

session_start();
require 'include/config.php';

// Check if admin is logged in
// Uncomment and modify the following lines based on your authentication logic
/*
if (!isset($_SESSION['username']) || $_SESSION['is_admin'] !== true) {
    header("Location: login.php");
    exit();
}
*/

// Initialize variables
$message = '';
$error = '';

// Handle Approval or Rejection
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['investment_id'], $_POST['action'])) {
        $investment_id = intval($_POST['investment_id']);
        $action = $_POST['action'];
        $admin_comments = mysqli_real_escape_string($stock_conn, $_POST['admin_comments']);

        if ($action == 'approve' || $action == 'reject') {
            $status = ($action == 'approve') ? 'approved' : 'rejected';

            // Prepare the UPDATE statement
            $stmt = $stock_conn->prepare("UPDATE investments SET status = ?, admin_comments = ? WHERE id = ?");
            if ($stmt) {
                $stmt->bind_param("ssi", $status, $admin_comments, $investment_id);
                if ($stmt->execute()) {
                    $message = "Investment ID $investment_id " . (($action == 'approve') ? "approved" : "rejected") . " successfully.";

                    if ($action == 'approve') {
                        // Fetch investment details
                        $fetch_stmt = $stock_conn->prepare("SELECT user_id, amount, profit FROM investments WHERE id = ?");
                        if ($fetch_stmt) {
                            $fetch_stmt->bind_param("i", $investment_id);
                            $fetch_stmt->execute();
                            $result = $fetch_stmt->get_result();
                            if ($result && $result->num_rows == 1) {
                                $investment = $result->fetch_assoc();
                                $user_id = $investment['user_id'];
                                $profit = $investment['profit'];

                                // Update withdrawable_balance table
                                $balance_stmt = $stock_conn->prepare("SELECT balance FROM withdrawable_balance WHERE user_id = ?");
                                if ($balance_stmt) {
                                    $balance_stmt->bind_param("i", $user_id);
                                    $balance_stmt->execute();
                                    $balance_result = $balance_stmt->get_result();
                                    if ($balance_result && $balance_result->num_rows == 1) {
                                        // Update existing balance
                                        $update_balance_stmt = $stock_conn->prepare("UPDATE withdrawable_balance SET balance = balance + ? WHERE user_id = ?");
                                        if ($update_balance_stmt) {
                                            $update_balance_stmt->bind_param("di", $profit, $user_id);
                                            $update_balance_stmt->execute();
                                            $update_balance_stmt->close();
                                        } else {
                                            $error .= " Failed to prepare balance update statement: " . $stock_conn->error;
                                        }
                                    } else {
                                        // Insert new balance record
                                        $insert_balance_stmt = $stock_conn->prepare("INSERT INTO withdrawable_balance (user_id, balance) VALUES (?, ?)");
                                        if ($insert_balance_stmt) {
                                            $insert_balance_stmt->bind_param("id", $user_id, $profit);
                                            $insert_balance_stmt->execute();
                                            $insert_balance_stmt->close();
                                        } else {
                                            $error .= " Failed to prepare balance insert statement: " . $stock_conn->error;
                                        }
                                    }
                                    $balance_stmt->close();
                                } else {
                                    $error .= " Failed to prepare balance selection statement: " . $stock_conn->error;
                                }
                            } else {
                                $error .= " Investment details not found for ID $investment_id.";
                            }
                            $fetch_stmt->close();
                        } else {
                            $error .= " Failed to prepare investment fetch statement: " . $stock_conn->error;
                        }
                    }
                } else {
                    $error = "Failed to " . (($action == 'approve') ? "approve" : "reject") . " investment: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $error = "Failed to prepare statement: " . $stock_conn->error;
            }
        } else {
            $error = "Invalid action.";
        }
    } else {
        $error = "Invalid form submission.";
    }
}

// Fetch all pending investments
$pending_sql = "
    SELECT 
        investments.id, 
        hm2_users.username, 
        packages.name AS package_name, 
        investments.amount, 
        investments.profit, 
        investments.deposit_method, 
        investments.deposit_address, 
        investments.deposit_txid, 
        investments.investment_date
    FROM investments
    LEFT JOIN hm2_users ON investments.user_id = hm2_users.id
    LEFT JOIN packages ON investments.package_id = packages.id
    WHERE LOWER(investments.status) = 'pending'
";

$pending_result = mysqli_query($stock_conn, $pending_sql);

if (!$pending_result) {
    die("Error fetching pending investments: " . mysqli_error($stock_conn));
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Approve Investments</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Basic styling for demonstration */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
        textarea {
            resize: vertical;
        }
    </style>
</head>
<body>
    <h2>Admin Panel - Approve or Reject Investments</h2>
    <?php
    if (!empty($message)) {
        echo "<p class='success'>" . htmlspecialchars($message) . "</p>";
    }
    if (!empty($error)) {
        echo "<p class='error'>" . htmlspecialchars($error) . "</p>";
    }
    ?>
    <table>
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
        if ($pending_result && mysqli_num_rows($pending_result) > 0) {
            while ($investment = mysqli_fetch_assoc($pending_result)) {
                ?>
                <tr>
                    <td><?= htmlspecialchars($investment['id']) ?></td>
                    <td><?= htmlspecialchars($investment['username'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($investment['package_name'] ?? 'N/A') ?></td>
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
