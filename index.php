<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

$page_name = 'Stock Investment';
include_once __DIR__ . '/include/config.php';
include_once __DIR__ . '/investment_helper.php';
include_once __DIR__ . '/partials/header.php';
?>
    <h4 class="page-title"><?= htmlspecialchars($page_name) ?></h4>
    <div class="row">
        <div class="col-md-12">

            <!-- Begin Main Content -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <style>
                            .bg-success-light{
                                background-color: #eefdee;
                            }
                            .bg-danger-light{
                                background-color: #f8f0f0;
                            }
                        </style>
                        <?php
                        if(isset($message)) {
                            echo "<p class='text-success rounded p-2 bg-success-light success'>" . htmlspecialchars($message) . "</p>";
                        }
                        if(isset($error)) {
                            echo "<p class='text-danger rounded p-2 bg-danger-light error'>" . htmlspecialchars($error) . "</p>";
                        }
                        ?>
                        <p>Your Stock Withdrawable Balance: <strong>$<?= htmlspecialchars($user_balance) ?></strong>
                        </p>
                    </div>
                    <form method="POST" action="deposit.php">

                        <table cellspacing="1" cellpadding="2" border="0" width="100%" class="tab">
                            <tbody>
                                <tr>
                                    <td colspan="3">
                                        <?php
                                        if($packages_result && mysqli_num_rows($packages_result) > 0) {
                                            while($package = mysqli_fetch_assoc($packages_result)) {
                                        ?>
                                                <input type="radio" name="package_id" value="<?php echo htmlspecialchars($package['id']); ?>" required>
                                                <b><?php echo htmlspecialchars($package['name']); ?></b><br>
                                        <?php
                                            }
                                        } else {
                                            echo "No investment packages available at the moment.";
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr class="head">
                                    <th class="inheader">Plan</th>
                                    <th class="inheader" width="200">Spent Amount ($)</th>
                                    <th class="inheader" width="100" nowrap="">
                                        <nobr>Profit (%)</nobr>
                                    </th>
                                </tr>
                                <?php
                                // Reset result pointer and display packages in table
                                if($packages_result) {
                                    mysqli_data_seek($packages_result, 0);
                                    while($package = mysqli_fetch_assoc($packages_result)) {
                                ?>
                                        <tr>
                                            <td class="item"><?php echo htmlspecialchars($package['name']); ?></td>
                                            <td class="item" align="right">$<?php echo number_format($package['min_amount'], 2); ?> - $<?php echo number_format($package['max_amount'], 2); ?></td>
                                            <td class="item" align="right"><?php echo number_format($package['profit_percentage'], 2); ?></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                                <tr>
                                    <td colspan="3" align="right">
                                        <label for="investment_amount"><b>Investment Amount ($):</b></label><br>
                                        <input type="number" name="investment_amount" id="investment_amount" min="0" step="0.01" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="right">
                                        <input type="submit" value="Proceed to Deposit">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>

                    <br><br>

                    <h3>Your Investments</h3>
                    <p>Username: <?= htmlspecialchars($username) ?></p>
                    <table border="1">
                        <tr>
                            <th>Plan</th>
                            <th>Investment Amount ($)</th>
                            <th>Profit (%)</th>
                            <th>Profit Earned ($)</th>
                            <th>Status</th>
                            <th>Admin Comments</th>
                        </tr>
                        <?php
                        if($investments_result && mysqli_num_rows($investments_result) > 0) {
                            $total = 0;
                            while($invest = mysqli_fetch_assoc($investments_result)) {
                                $total += $invest['profit'];
                        ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($invest['name']); ?></td>
                                    <td align="right"><?php echo number_format($invest['amount'], 2); ?></td>
                                    <td align="right"><?php echo number_format($invest['profit_percentage'], 2); ?></td>
                                    <td align="right"><?php echo number_format($invest['profit'], 2); ?></td>
                                    <td><?= htmlspecialchars(ucfirst($invest['status'])) ?></td>
                                    <td><?= htmlspecialchars($invest['admin_comments']) ?></td>
                                </tr>
                        <?php
                            }
                        ?>
                                <tr>
                                    <td colspan="4" align="right"><strong>Total Profit Earned:</strong></td>
                                    <td align="right"><strong><?php echo number_format($total, 2); ?></strong></td>
                                    <td></td>
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
<?php
include_once __DIR__ . '/partials/footer.php';
?>
