<?php
// index.php

// Temporarily enable error reporting for debugging
// Remove or comment out these lines in production
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$page_name = 'Stock Investment';
include_once __DIR__ . '/include/config.php';
include_once __DIR__ . '/investment_helper.php';
include_once __DIR__ . '/partials/header.php';
?>
<div class="container my-5">
    <h4 class="page-title"><?= htmlspecialchars($page_name) ?></h4>
    <div class="row">
        <div class="col-md-12">

            <!-- Begin Main Content -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <?php
                            if(isset($message)) {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>" . htmlspecialchars($message) . "
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
                            }
                            if(isset($error)) {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>" . htmlspecialchars($error) . "
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
                            }
                            ?>
                        </div>
                        <div>
                            <p>Your Stock Withdrawable Balance: <strong>$<?= htmlspecialchars($user_balance) ?></strong></p>
                        </div>
                    </div>
                    <form method="POST" action="deposit.php">
                        <div class="mb-3">
                            <label for="package_id" class="form-label"><strong>Select Investment Package:</strong></label>
                            <div class="d-flex flex-wrap">
                                <?php
                                if($packages_result && mysqli_num_rows($packages_result) > 0) {
                                    while($package = mysqli_fetch_assoc($packages_result)) {
                                ?>
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="radio" name="package_id" id="package<?= htmlspecialchars($package['id']) ?>" value="<?= htmlspecialchars($package['id']) ?>" required>
                                            <label class="form-check-label" for="package<?= htmlspecialchars($package['id']) ?>">
                                                <?= htmlspecialchars($package['name']) ?> - $<?= number_format($package['min_amount'], 2) ?> to $<?= number_format($package['max_amount'], 2) ?>
                                            </label>
                                        </div>
                                <?php
                                    }
                                } else {
                                    echo "<p>No investment packages available at the moment.</p>";
                                }
                                ?>
                            </div>
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
                                if($investments_result && mysqli_num_rows($investments_result) > 0) {
                                    $total = 0;
                                    while($invest = mysqli_fetch_assoc($investments_result)) {
                                        $total += $invest['profit'];
                                ?>
                                        <tr>
                                            <td><?= htmlspecialchars($invest['name']) ?></td>
                                            <td class="text-end">$<?= number_format($invest['amount'], 2) ?></td>
                                            <td class="text-end"><?= number_format($invest['profit_percentage'], 2) ?>%</td>
                                            <td class="text-end">$<?= number_format($invest['profit'], 2) ?></td>
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
                                            <td class="text-end"><strong>$<?= number_format($total, 2) ?></strong></td>
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

                <!-- Example JavaScript Function (openCalculator) -->
                <script>
                    function openCalculator(packageId) {
                        // Implement your calculator functionality here
                        alert('Calculator for package ID: ' + packageId);
                    }

                    // Example: Initialize cps array
                    var cps = [];
                    // Add your package-specific data if needed
                </script>
                <!-- End Main Content -->

            </div>
        </div>
</div>
<?php
include_once __DIR__ . '/partials/footer.php';
?>
