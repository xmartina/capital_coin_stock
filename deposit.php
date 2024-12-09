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
                    'BTC' => 'bc1qldk0yfuj66hs6406murakdewqs9e6drjezzdd0',
                    'ETH' => '0x164D7861b0d36cf6fD895eb5A3603A01B35B1CD1',
                    'USDT' => 'TNmGnAYTctsEH44o1GDquwjpXxBhREKiGP'
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
$page_name = 'Make Stock Deposit';
?>
<?php include_once __DIR__ . '/partials/header.php'; ?>
<div class="container my-5">
    <h2 class="mb-4">Make a Deposit</h2>

    <?php if(isset($message)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $message ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if(isset($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $error ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <form method="POST" action="deposit.php">
        <div class="mb-3">
            <label for="package_id" class="form-label"><strong>Select Investment Package:</strong></label>
            <select name="package_id" id="package_id" class="form-select" required>
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
        </div>

        <div class="mb-3">
            <label for="deposit_method" class="form-label"><strong>Select Cryptocurrency:</strong></label>
            <select name="deposit_method" id="deposit_method" class="form-select" required>
                <option value="">--Select Crypto--</option>
                <option value="BTC">Bitcoin (BTC)</option>
                <option value="ETH">Ethereum (ETH)</option>
                <option value="USDT">Tether (USDT)</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="investment_amount" class="form-label"><strong>Investment Amount ($):</strong></label>
            <input type="number" name="investment_amount" id="investment_amount" class="form-control" min="0" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="deposit_txid" class="form-label"><strong>Transaction ID (TXID):</strong></label>
            <input type="text" name="deposit_txid" id="deposit_txid" class="form-control" required>
            <div class="form-text">Please enter the transaction ID provided by your cryptocurrency wallet after completing the transfer.</div>
        </div>

        <button type="submit" class="btn btn-primary">Submit Deposit</button>
    </form>

    <hr class="my-5">

    <h3>Your Investments</h3>
    <p><strong>Username:</strong> <?= htmlspecialchars($username) ?></p>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
            <tr>
                <th>Plan</th>
                <th>Investment Amount ($)</th>
                <th>Profit (%)</th>
                <th>Profit Earned ($)</th>
                <th>Status</th>
                <th>Admin Comments</th>
            </tr>
            </thead>
            <tbody>
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
                        <td class="text-end"><?= number_format($invest['amount'], 2) ?></td>
                        <td class="text-end"><?= number_format($invest['profit_percentage'], 2) ?></td>
                        <td class="text-end"><?= number_format($invest['profit'], 2) ?></td>
                        <td>
                            <?php
                            // Assign Bootstrap badge classes based on status
                            $status = ucfirst(htmlspecialchars($invest['status']));
                            $badge_class = '';
                            switch($invest['status']) {
                                case 'approved':
                                    $badge_class = 'bg-success';
                                    break;
                                case 'pending':
                                    $badge_class = 'bg-warning text-dark';
                                    break;
                                case 'rejected':
                                    $badge_class = 'bg-danger';
                                    break;
                                default:
                                    $badge_class = 'bg-secondary';
                            }
                            ?>
                            <span class="badge <?= $badge_class ?>"><?= $status ?></span>
                        </td>
                        <td><?= htmlspecialchars($invest['admin_comments']) ?></td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td colspan="3" class="text-end"><strong>Total Profit Earned:</strong></td>
                    <td class="text-end"><strong><?= number_format($total, 2) ?></strong></td>
                    <td colspan="2"></td>
                </tr>
                <?php
            } else {
                ?>
                <tr>
                    <td colspan="6" class="text-center">No investments found.</td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<?php include_once __DIR__ . '/partials/footer.php'; ?>
