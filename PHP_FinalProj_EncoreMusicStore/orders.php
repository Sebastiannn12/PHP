<?php
$basepath = '';
$pagetitle = "Orders";

require_once('includes/auth.php');
require_buyer();

$user_id = current_user_id();
$stmt = mysqli_prepare($conn, "SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$orders = mysqli_stmt_get_result($stmt);

require('includes/Buyerheader.php');
?>

<main>
    <section class="store-section">
        <div class="container">
            <div class="store-header">
                <p class="section-kicker">Orders</p>
                <h1 class="store-title">Your order history.</h1>
            </div>

            <div class="checkout-panel table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($order = mysqli_fetch_assoc($orders)): ?>
                            <tr>
                                <td>#<?= $order['order_id'] ?></td>
                                <td><?= $order['created_at'] ?></td>
                                <td>PHP <?= number_format($order['total_amount'], 2) ?></td>
                                <td><?= $order['payment_method'] ?></td>
                                <td><?= $order['status'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>

<?php require('includes/footer.php'); ?>
