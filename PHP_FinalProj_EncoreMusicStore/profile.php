<?php
$basepath = '';
$pagetitle = "Profile";

require_once('includes/auth.php');
require_buyer();

$user_id = current_user_id();
$message = isset($_GET['updated']) ? 'Profile updated.' : '';
$upload_errors = [
    'upload' => 'The photo could not be uploaded. Please try again.',
    'size' => 'The profile photo must be 5 MB or smaller.',
    'type' => 'Please upload a JPG, PNG, or WebP image.',
];
$error_message = $upload_errors[$_GET['error'] ?? ''] ?? '';
$password_messages = [
    'current' => 'Your current password is incorrect.',
    'match' => 'The new passwords do not match.',
    'short' => 'Your new password must contain at least 8 characters.',
];
$password_error = $password_messages[$_GET['password_error'] ?? ''] ?? '';
$password_updated = isset($_GET['password_updated']);

$stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE user_id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$user = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

$order_summary_stmt = mysqli_prepare($conn, "SELECT COUNT(*) AS order_count, COALESCE(SUM(total_amount), 0) AS total_spent, SUM(status = 'Pending') AS pending_count FROM orders WHERE user_id = ?");
mysqli_stmt_bind_param($order_summary_stmt, "i", $user_id);
mysqli_stmt_execute($order_summary_stmt);
$order_summary = mysqli_fetch_assoc(mysqli_stmt_get_result($order_summary_stmt));

$recent_orders_stmt = mysqli_prepare($conn, "SELECT order_id, total_amount, status, created_at FROM orders WHERE user_id = ? ORDER BY created_at DESC LIMIT 3");
mysqli_stmt_bind_param($recent_orders_stmt, "i", $user_id);
mysqli_stmt_execute($recent_orders_stmt);
$recent_orders = mysqli_stmt_get_result($recent_orders_stmt);

$cart = $_SESSION['cart'] ?? [];
$cart_quantity = array_sum(array_map('intval', $cart));
$cart_total = 0;

if ($cart) {
    $product_ids = implode(',', array_map('intval', array_keys($cart)));
    $cart_products = mysqli_query($conn, "SELECT product_id, price FROM products WHERE product_id IN ($product_ids)");
    while ($cart_product = mysqli_fetch_assoc($cart_products)) {
        $cart_total += (float)$cart_product['price'] * (int)($cart[$cart_product['product_id']] ?? 0);
    }
}

$name_parts = preg_split('/\s+/', trim($user['full_name']));
$initials = '';
foreach (array_slice($name_parts, 0, 2) as $name_part) {
    $initials .= strtoupper(substr($name_part, 0, 1));
}

require('includes/Buyerheader.php');
?>

<main>
    <section class="profile-section">
        <div class="container">
            <div class="profile-grid">
                <div class="profile-main-card">
                    <div class="profile-identity">
                        <div class="profile-avatar">
                            <?php if (!empty($user['profile_image'])): ?>
                                <img src="uploads/profile/<?= rawurlencode($user['profile_image']) ?>" alt="<?= htmlspecialchars($user['full_name']) ?> profile photo">
                            <?php else: ?>
                                <span aria-hidden="true"><?= htmlspecialchars($initials ?: 'U') ?></span>
                            <?php endif; ?>
                        </div>
                        <p class="section-kicker">Encore member</p>
                        <h1><?= htmlspecialchars($user['full_name']) ?></h1>
                        <p><?= htmlspecialchars($user['email']) ?></p>
                        <span class="member-since">Member since <?= date('F Y', strtotime($user['created_at'])) ?></span>
                    </div>

                    <div class="profile-totals">
                        <a href="cart.php" class="profile-total">
                            <strong><?= $cart_quantity ?></strong>
                            <span>Cart items</span>
                        </a>
                        <a href="orders.php" class="profile-total">
                            <strong><?= (int)$order_summary['order_count'] ?></strong>
                            <span>Total orders</span>
                        </a>
                        <div class="profile-total">
                            <strong>PHP <?= number_format((float)$order_summary['total_spent'], 0) ?></strong>
                            <span>Total spent</span>
                        </div>
                    </div>

                    <div class="profile-form-wrap">
                        <div class="profile-form-heading">
                            <div>
                                <p class="section-kicker">Account details</p>
                                <h2>Keep your information current.</h2>
                            </div>
                        </div>
                        <?php if ($message): ?><div class="alert alert-success"><?= $message ?></div><?php endif; ?>
                        <?php if ($error_message): ?><div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div><?php endif; ?>
                        <form method="POST" action="process/profile_process.php" class="profile-form" enctype="multipart/form-data">
                            <div class="profile-form-full profile-upload-field">
                                <label class="form-label" for="profile_image">Profile photo</label>
                                <input class="form-control" id="profile_image" type="file" name="profile_image" accept="image/jpeg,image/png,image/webp">
                                <small>JPG, PNG, or WebP. Maximum file size: 5 MB.</small>
                            </div>
                            <div>
                                <label class="form-label">Complete name</label>
                                <input class="form-control" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" required>
                            </div>
                            <div>
                                <label class="form-label">Email</label>
                                <input class="form-control" value="<?= htmlspecialchars($user['email']) ?>" disabled>
                            </div>
                            <div class="profile-form-full">
                                <label class="form-label">Complete address</label>
                                <textarea class="form-control" name="address" rows="3"><?= htmlspecialchars($user['address']) ?></textarea>
                            </div>
                            <div>
                                <label class="form-label">Contact number</label>
                                <input class="form-control" name="contact_number" value="<?= htmlspecialchars($user['contact_number']) ?>">
                            </div>
                            <div class="profile-form-action"><button class="btn btn-register" type="submit">Update Profile</button></div>
                        </form>
                    </div>

                    <div class="password-panel">
                        <div>
                            <p class="section-kicker">Security</p>
                            <h2>Change password</h2>
                            <p>Use at least 8 characters for your new password.</p>
                        </div>
                        <?php if ($password_updated): ?><div class="alert alert-success">Password changed successfully.</div><?php endif; ?>
                        <?php if ($password_error): ?><div class="alert alert-danger"><?= htmlspecialchars($password_error) ?></div><?php endif; ?>
                        <form method="POST" action="process/change_password.php" class="password-form">
                            <input class="form-control" type="password" name="current_password" placeholder="Current password" autocomplete="current-password" required>
                            <input class="form-control" type="password" name="new_password" placeholder="New password" minlength="8" autocomplete="new-password" required>
                            <input class="form-control" type="password" name="confirm_password" placeholder="Confirm new password" minlength="8" autocomplete="new-password" required>
                            <button class="btn btn-dark" type="submit">Change Password</button>
                        </form>
                    </div>
                </div>

                <aside class="profile-summary-card">
                    <p class="section-kicker">Shopping summary</p>
                    <h2>Your Encore activity</h2>
                    <p class="summary-intro">A quick view of your current cart and recent purchases.</p>

                    <a class="summary-highlight cart-highlight" href="cart.php">
                        <span class="summary-icon"><i class="bi bi-bag"></i></span>
                        <span><strong>PHP <?= number_format($cart_total, 2) ?></strong><small>Current cart · <?= $cart_quantity ?> item<?= $cart_quantity === 1 ? '' : 's' ?></small></span>
                    </a>
                    <a class="summary-highlight order-highlight" href="orders.php">
                        <span class="summary-icon"><i class="bi bi-receipt"></i></span>
                        <span><strong><?= (int)($order_summary['pending_count'] ?? 0) ?></strong><small>Pending order<?= (int)($order_summary['pending_count'] ?? 0) === 1 ? '' : 's' ?></small></span>
                    </a>

                    <div class="recent-orders">
                        <div class="recent-heading"><h3>Recent orders</h3><a href="orders.php">View all</a></div>
                        <?php if (mysqli_num_rows($recent_orders) === 0): ?>
                            <div class="empty-orders"><i class="bi bi-music-note-beamed"></i><p>No orders yet.</p><a href="buyer/store.php">Start shopping</a></div>
                        <?php else: ?>
                            <?php while ($order = mysqli_fetch_assoc($recent_orders)): ?>
                                <a class="recent-order" href="orders.php">
                                    <span><strong>Order #<?= (int)$order['order_id'] ?></strong><small><?= date('M j, Y', strtotime($order['created_at'])) ?></small></span>
                                    <span><strong>PHP <?= number_format((float)$order['total_amount'], 2) ?></strong><small><?= htmlspecialchars($order['status']) ?></small></span>
                                </a>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </aside>
            </div>
        </div>
    </section>
</main>

<?php require('includes/footer.php'); ?>
