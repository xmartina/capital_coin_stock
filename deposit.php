<?php
// deposit.php

session_start();
require 'include/config.php';
require 'investment_helper.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Initialize variables
$message = '';
$error = '';

// Fetch user ID from front_conn
$username = $_SESSION['username'];
$user_sql = "SELECT id FROM hm2_users WHERE username='$username'";
$user_result = mysqli_query($front_conn, $user_sql);

if ($user_result && mysqli_num_rows($user_result) == 1) {
    $user = mysqli_fetch_assoc($user_result);
    $user_id = $user['id'];
} else {
    $error = "User not found.";
    session_destroy();
    header("Location: login.php");
    exit();
}

// Handle Deposit Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['package_id'])) {
    $package_id = intval($_POST['package_id']);
    $deposit_method = $_POST['deposit_method'];
    $deposit_txid = mysqli_real_escape_string($stock_conn, $_POST['deposit_txid']);

    // Validate deposit method
    $allowed_methods = ['BTC', 'ETH', 'USDT'];
    if (!in_array($deposit_method, $allowed_methods)) {
        $error = "Invalid deposit method selected.";
    } else {
        // Fetch package details
        $package_sql = "SELECT * FROM packages WHERE id='$package_id'";
        $package_result = mysqli_query($stock_conn, $package_sql);

        if ($package_result && mysqli_num_rows($package_result) == 1) {
            $package = mysqli_fetch_assoc($package_result);

            // Validate deposit amount
            $investment_amount = floatval($_POST['investment_amount']);
            if ($investment_amount < $package['min_amount'] || $investment_amount > $package['max_amount']) {
                $error = "Investment amount must be between $" . number_format($package['min_amount'], 2) . " and $" . number_format($package['max_amount'], 2) . ".";
            } else {
                // Generate or Assign Deposit Address
                // For simplicity, we'll use predefined deposit addresses. In a real-world scenario, integrate with crypto APIs to generate unique addresses.
                $deposit_addresses = [
                    'BTC' => 'your_btc_deposit_address_here',
                    'ETH' => 'your_eth_deposit_address_here',
                    'USDT' => 'your_usdt_deposit_address_here'
                ];

                $deposit_address = $deposit_addresses[$deposit_method];

                // Insert Pending Investment
                $profit = ($investment_amount * $package['profit_percentage']) / 100;
                $insert = "INSERT INTO investments (user_id, package_id, amount, profit, status, deposit_method, deposit_address, deposit_txid) VALUES ('$user_id', '$package_id', '$investment_amount', '$profit', 'pending', '$deposit_method', '$deposit_address', '$deposit_txid')";

                if (mysqli_query($stock_conn, $insert)) {
                    $message = "Deposit initiated successfully! Please send your deposit to the following address:<br>";
                    $message .= "<strong>" . htmlspecialchars($deposit_address) . "</strong><br>";
                    $message .= "Transaction ID: " . htmlspecialchars($deposit_txid) . "<br>";
                    $message .= "Your investment is pending approval by the admin.";
                } else {
                    $error = "Failed to initiate deposit: " . mysqli_error($stock_conn);
                }
            }
        } else {
            $error = "Invalid investment package selected.";
        }
    }
}

// Fetch available investment packages for selection
$packages_sql = "SELECT * FROM packages";
$packages_result = mysqli_query($stock_conn, $packages_sql);
?>
<?php include_once __DIR__ . '/partials/header.php'; ?>
<h4 class="page-title">Make a Deposit</h4>
<div class="row">
    <div class="col-md-12">

        <!-- Begin Main Content -->
        <div class="card">
            <div class="card-body">
                <?php
                if(isset($message)) {
                    echo "<p class='success'>" . $message . "</p>";
                }
                if(isset($error)) {
                    echo "<p class='error'>" . $error . "</p>";
                }
                ?>

                <form method="POST" action="deposit.php">

                    <table cellspacing="1" cellpadding="2" border="0" width="100%" class="tab">
                        <tbody>
                        <tr>
                            <td colspan="3">
                                <label for="package_id"><b>Select Investment Package:</b></label><br>
                                <select name="package_id" id="package_id" required>
                                    <option value="">--Select Package--</option>
                                    <?php
                                    if($packages_result && mysqli_num_rows($packages_result) > 0) {
                                        while($package = mysqli_fetch_assoc($packages_result)) {
                                            echo "<option value='" . htmlspecialchars($package['id']) . "'>" . htmlspecialchars($package['name']) . " - $" . number_format($package['min_amount'], 2) . " to $" . number_format($package['max_amount'], 2) . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No packages available</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <label for="deposit_method"><b>Select Cryptocurrency:</b></label><br>
                                <select name="deposit_method" id="deposit_method" required>
                                    <option value="">--Select Crypto--</option>
                                    <option value="BTC">Bitcoin (BTC)</option>
                                    <option value="ETH">Ethereum (ETH)</option>
                                    <option value="USDT">Tether (USDT)</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <label for="investment_amount"><b>Investment Amount ($):</b></label><br>
                                <input type="number" name="investment_amount" id="investment_amount" min="0" step="0.01" required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <label for="deposit_txid"><b>Transaction ID (TXID):</b></label><br>
                                <input type="text" name="deposit_txid" id="deposit_txid" required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right">
                                <input type="submit" value="Submit Deposit" class="btn btn-primary">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>

        <br><br>

        <h3>Your Investments</h3>
        <p>Username: <?= htmlspecialchars($username) ?></p>
        <table border="1" cellpadding="10">
            <tr>
                <th>Plan</th>
                <th>Investment Amount ($)</th>
                <th>Profit (%)</th>
                <th>Profit Earned ($)</th>
                <th>Status</th>
                <th>Admin Comments</th>
            </tr>
            <?php
            // Fetch user's investments including status and admin comments
            $investments_sql = "SELECT packages.name, packages.profit_percentage, investments.amount, investments.profit, investments.status, investments.admin_comments
                FROM investments
                JOIN packages ON investments.package_id = packages.id
                WHERE investments.user_id = '$user_id'";
            $investments_result = mysqli_query($stock_conn, $investments_sql);

            if($investments_result && mysqli_num_rows($investments_result) > 0) {
                $total = 0;
                while($invest = mysqli_fetch_assoc($investments_result)) {
                    $total += $invest['profit'];
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($invest['name']) ?></td>
                        <td align="right"><?= number_format($invest['amount'], 2) ?></td>
                        <td align="right"><?= number_format($invest['profit_percentage'], 2) ?></td>
                        <td align="right"><?= number_format($invest['profit'], 2) ?></td>
                        <td><?= ucfirst(htmlspecialchars($invest['status'])) ?></td>
                        <td><?= htmlspecialchars($invest['admin_comments']) ?></td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td colspan="3" align="right"><strong>Total Profit Earned:</strong></td>
                    <td align="right"><strong><?= number_format($total, 2) ?></strong></td>
                    <td colspan="2"></td>
                </tr>
                <?php
            } else {
                ?>
                <tr>
                    <td colspan="6" align="center">No investments found.</td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>
<?php include_once __DIR__ . '/partials/footer.php'; ?>
