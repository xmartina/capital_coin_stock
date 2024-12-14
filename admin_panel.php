<?php
// admin.php

session_start();
require 'include/config.php';

// Check if admin is logged in
// Ensure that admin authentication logic is active
// if (!isset($_SESSION['username']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
//     header("Location: admin_login.php"); // Redirect to admin login page
//     exit();
// }

// Initialize variables
$message = '';
$error = '';

// Handle Approval or Rejection
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize input
    if (isset($_POST['investment_id']) && isset($_POST['action'])) {
        $investment_id = intval($_POST['investment_id']);
        $action = $_POST['action'];
        $admin_comments = mysqli_real_escape_string($stock_conn, $_POST['admin_comments']);

        if ($action === 'approve') {
            // Approve the investment
            $update_sql = "UPDATE investments SET status='approved', admin_comments='$admin_comments' WHERE id='$investment_id' AND status='pending'";
            if (mysqli_query($stock_conn, $update_sql)) {
                if (mysqli_affected_rows($stock_conn) > 0) {
                    $message = "Investment ID $investment_id approved successfully.";

                    // Fetch investment details to update withdrawable_balance
                    $fetch_sql = "SELECT user_id, profit FROM investments WHERE id='$investment_id'";
                    $fetch_result = mysqli_query($stock_conn, $fetch_sql);
                    if ($fetch_result && mysqli_num_rows($fetch_result) == 1) {
                        $investment = mysqli_fetch_assoc($fetch_result);
                        $user_id = $investment['user_id'];
                        $profit = $investment['profit'];

                        // Check if user already has a balance record
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
                    $error = "No pending investment found with ID $investment_id.";
                }
            } else {
                $error = "Failed to approve investment: " . mysqli_error($stock_conn);
            }
        } elseif ($action === 'reject') {
            // Reject the investment
            $update_sql = "UPDATE investments SET status='rejected', admin_comments='$admin_comments' WHERE id='$investment_id' AND status='pending'";
            if (mysqli_query($stock_conn, $update_sql)) {
                if (mysqli_affected_rows($stock_conn) > 0) {
                    $message = "Investment ID $investment_id rejected successfully.";
                } else {
                    $error = "No pending investment found with ID $investment_id.";
                }
            } else {
                $error = "Failed to reject investment: " . mysqli_error($stock_conn);
            }
        } else {
            $error = "Invalid action specified.";
        }
    } else {
        $error = "Invalid form submission.";
    }
}

// Fetch all pending investments
$pending_sql = "SELECT id, user_id, package_id, amount, profit, deposit_method, deposit_address, deposit_txid, investment_date FROM investments WHERE status = 'pending'";
$pending_result = mysqli_query($stock_conn, $pending_sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Approve Investments</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optional: Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <?php include_once __DIR__ . '/partials/header.php'; ?> <!-- Ensure header includes Bootstrap JS if needed -->
    <div class="container my-5">
        <h2 class="mb-4">Admin Panel - Approve or Reject Investments</h2>

        <!-- Display Messages -->
        <?php if(isset($message)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($message) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if(isset($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($error) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Pending Investments Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
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
                </thead>
                <tbody>
                    <?php
                    if($pending_result && mysqli_num_rows($pending_result) > 0) {
                        while($investment = mysqli_fetch_assoc($pending_result)) {
                            // Fetch username from hm2_users using front_conn
                            $user_id = $investment['user_id'];
                            $user_sql = "SELECT username FROM hm2_users WHERE id='$user_id' LIMIT 1";
                            $user_result = mysqli_query($front_conn, $user_sql);
                            if($user_result && mysqli_num_rows($user_result) == 1) {
                                $user = mysqli_fetch_assoc($user_result);
                                $username = $user['username'];
                            } else {
                                $username = "Unknown";
                            }

                            // Fetch package name from packages table using stock_conn
                            $package_id = $investment['package_id'];
                            $package_sql = "SELECT name FROM packages WHERE id='$package_id' LIMIT 1";
                            $package_result = mysqli_query($stock_conn, $package_sql);
                            if($package_result && mysqli_num_rows($package_result) == 1) {
                                $package = mysqli_fetch_assoc($package_result);
                                $package_name = $package['name'];
                            } else {
                                $package_name = "Unknown";
                            }

                            ?>
                            <tr>
                                <td><?= htmlspecialchars($investment['id']) ?></td>
                                <td><?= htmlspecialchars($username) ?></td>
                                <td><?= htmlspecialchars($package_name) ?></td>
                                <td class="text-end"><?= number_format($investment['amount'], 2) ?></td>
                                <td class="text-end"><?= number_format($investment['profit'], 2) ?></td>
                                <td><?= htmlspecialchars($investment['deposit_method']) ?></td>
                                <td><?= htmlspecialchars($investment['deposit_address']) ?></td>
                                <td><?= htmlspecialchars($investment['deposit_txid']) ?></td>
                                <td><?= htmlspecialchars($investment['investment_date']) ?></td>
                                <td>
                                    <form method="POST" action="admin.php">
                                        <input type="hidden" name="investment_id" value="<?= htmlspecialchars($investment['id']) ?>">
                                        <div class="mb-2">
                                            <textarea name="admin_comments" class="form-control" placeholder="Comments (optional)" rows="2"></textarea>
                                        </div>
                                        <button type="submit" name="action" value="approve" class="btn btn-success btn-sm">Approve</button>
                                        <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm">Reject</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='10' class='text-center'>No pending investments.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include_once __DIR__ . '/partials/footer.php'; ?>
    <!-- Bootstrap JS Bundle (Includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
