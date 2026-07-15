<?php
$pagetitle = 'Dashboard';
require('../includes/Sellerheader.php');

$users_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users"))['total'];
$products_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM products"))['total'];
$orders_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders"))['total'];
$low_stock = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM products WHERE stock <= 5"))['total'];
$sales_total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COALESCE(SUM(total_amount), 0) AS total FROM orders"))['total'];
$pending_orders = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders WHERE status = 'Pending'"))['total'];
$low_stock_products = mysqli_query($conn, "SELECT product_id, product_name, category, stock FROM products WHERE stock <= 5 ORDER BY stock ASC, product_name ASC LIMIT 5");
$recent_orders = mysqli_query($conn, "SELECT order_id, full_name, total_amount, status, created_at FROM orders ORDER BY created_at DESC LIMIT 5");
$seller_first_name = explode(' ', trim($sellerName))[0] ?: 'Seller';
?>

<main class="seller-main seller-dashboard-main">
    <div class="seller-container dashboard-container">
        <div class="seller-page-header dashboard-header">
            <div>
                <p class="dashboard-eyebrow"><?= date('l, F j, Y') ?></p>
                <h1>Welcome back, <?= htmlspecialchars($seller_first_name) ?>!</h1>
                <p>Here’s a quick look at your Encore Music Store today.</p>
            </div>
            <a class="dashboard-primary-action" href="stocks.php"><i class="bi bi-plus-lg"></i> Add product</a>
        </div>

        <div class="dashboard-stats">
            <div class="dashboard-stat dashboard-stat-featured">
                <div class="dashboard-stat-top"><span class="dashboard-stat-icon"><i class="bi bi-graph-up-arrow"></i></span><span>Total sales</span></div>
                <strong>PHP <?= number_format((float)$sales_total, 2) ?></strong>
                <small>Revenue from <?= (int)$orders_count ?> order<?= (int)$orders_count === 1 ? '' : 's' ?></small>
            </div>
            <div class="dashboard-stat">
                <div class="dashboard-stat-top"><span class="dashboard-stat-icon"><i class="bi bi-box-seam"></i></span><span>Products</span></div>
                <strong><?= (int)$products_count ?></strong>
                <small><?= (int)$low_stock ?> low-stock item<?= (int)$low_stock === 1 ? '' : 's' ?></small>
            </div>
            <div class="dashboard-stat">
                <div class="dashboard-stat-top"><span class="dashboard-stat-icon"><i class="bi bi-receipt"></i></span><span>Orders</span></div>
                <strong><?= (int)$orders_count ?></strong>
                <small><?= (int)$pending_orders ?> awaiting action</small>
            </div>
            <div class="dashboard-stat">
                <div class="dashboard-stat-top"><span class="dashboard-stat-icon"><i class="bi bi-people"></i></span><span>Users</span></div>
                <strong><?= (int)$users_count ?></strong>
                <small>Registered accounts</small>
            </div>
        </div>

        <div class="dashboard-content-grid">
            <section class="dashboard-panel recent-orders-panel">
                <div class="dashboard-panel-heading">
                    <div><p class="dashboard-eyebrow">Latest activity</p><h2>Recent orders</h2></div>
                    <a href="reports.php">View reports <i class="bi bi-arrow-right"></i></a>
                </div>

                <?php if (mysqli_num_rows($recent_orders) === 0): ?>
                    <div class="dashboard-empty"><i class="bi bi-receipt-cutoff"></i><p>No orders have been placed yet.</p></div>
                <?php else: ?>
                    <div class="dashboard-orders-list">
                        <?php while ($order = mysqli_fetch_assoc($recent_orders)): ?>
                            <div class="dashboard-order-row">
                                <span class="order-avatar"><?= htmlspecialchars(strtoupper(substr($order['full_name'], 0, 1))) ?></span>
                                <span class="order-customer"><strong><?= htmlspecialchars($order['full_name']) ?></strong><small>Order #<?= (int)$order['order_id'] ?> · <?= date('M j, Y', strtotime($order['created_at'])) ?></small></span>
                                <span class="order-status status-<?= strtolower(preg_replace('/[^a-z]/i', '', $order['status'])) ?>"><?= htmlspecialchars($order['status']) ?></span>
                                <strong class="order-amount">PHP <?= number_format((float)$order['total_amount'], 2) ?></strong>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </section>

            <aside class="dashboard-panel stock-alert-panel">
                <div class="dashboard-panel-heading">
                    <div><p class="dashboard-eyebrow">Inventory</p><h2>Low stock</h2></div>
                    <span class="stock-alert-count"><?= (int)$low_stock ?></span>
                </div>

                <?php if (mysqli_num_rows($low_stock_products) === 0): ?>
                    <div class="dashboard-empty"><i class="bi bi-check-circle"></i><p>Inventory levels look healthy.</p></div>
                <?php else: ?>
                    <div class="low-stock-list">
                        <?php while ($product = mysqli_fetch_assoc($low_stock_products)): ?>
                            <a href="stocks.php?edit=<?= (int)$product['product_id'] ?>" class="low-stock-row">
                                <span><strong><?= htmlspecialchars($product['product_name']) ?></strong><small><?= htmlspecialchars($product['category']) ?></small></span>
                                <span class="stock-units"><?= (int)$product['stock'] ?> left</span>
                            </a>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
                <a class="manage-stock-link" href="stocks.php">Manage inventory <i class="bi bi-arrow-right"></i></a>
            </aside>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
