<?php
$pagetitle = 'Reports';
require('../includes/Sellerheader.php');

$inventory = mysqli_query($conn, "SELECT product_name, category, price, stock, status FROM products ORDER BY stock ASC");
$logs = mysqli_query($conn, "SELECT * FROM audit_logs ORDER BY created_at DESC LIMIT 100");
?>

<main class="seller-main">
    <div class="seller-container">
        <div class="seller-page-header">
            <div>
                <h1>Reports</h1>
                <p>View remaining inventory and audit log activities.</p>
            </div>
        </div>

        <div class="seller-card mb-4 table-responsive">
            <h2 class="h4 mb-3">Inventory Report</h2>
            <table class="seller-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Remaining Stock</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($item = mysqli_fetch_assoc($inventory)): ?>
                        <tr>
                            <td><?= $item['product_name'] ?></td>
                            <td><?= $item['category'] ?></td>
                            <td>PHP <?= number_format($item['price'], 2) ?></td>
                            <td><?= $item['stock'] ?></td>
                            <td><?= $item['status'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div class="seller-card table-responsive">
            <h2 class="h4 mb-3">Audit Log Report</h2>
            <table class="seller-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>User</th>
                        <th>Role</th>
                        <th>Activity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($log = mysqli_fetch_assoc($logs)): ?>
                        <tr>
                            <td><?= $log['created_at'] ?></td>
                            <td><?= $log['user_name'] ?></td>
                            <td><?= $log['role'] ?></td>
                            <td><?= $log['activity'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
