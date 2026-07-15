<?php
$basepath = '';
$pagetitle = "Checkout";

require_once('includes/auth.php');
require_buyer();

$cart = $_SESSION['cart'] ?? [];

if (!$cart) {
    header('Location: cart.php');
    exit;
}

$items = [];
$total = 0;
$ids = implode(',', array_map('intval', array_keys($cart)));
$products = mysqli_query($conn, "SELECT * FROM products WHERE product_id IN ($ids)");

while ($product = mysqli_fetch_assoc($products)) {
    $quantity = $cart[$product['product_id']];
    $subtotal = $product['price'] * $quantity;
    $total += $subtotal;
    $items[] = ['product' => $product, 'quantity' => $quantity, 'subtotal' => $subtotal];
}

$user_stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE user_id = ?");
$user_id = current_user_id();
mysqli_stmt_bind_param($user_stmt, "i", $user_id);
mysqli_stmt_execute($user_stmt);
$user = mysqli_fetch_assoc(mysqli_stmt_get_result($user_stmt));

require('includes/Buyerheader.php');
?>

<main>
    <section class="store-section">
        <div class="container">
            <div class="store-header">
                <p class="section-kicker">Checkout</p>
                <h1 class="store-title">Confirm delivery details.</h1>
            </div>

            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="checkout-panel">
                        <form method="POST" action="process/checkout_process.php" class="auth-form">
                            <div>
                                <label class="form-label">Complete name</label>
                                <input class="form-control" name="full_name" value="<?= $user['full_name'] ?>" required>
                            </div>
                            <div>
                                <label class="form-label">Complete address</label>
                                <textarea class="form-control" name="address" rows="4" required><?= $user['address'] ?></textarea>
                            </div>
                            <div>
                                <label class="form-label">Contact number</label>
                                <input class="form-control" name="contact_number" value="<?= $user['contact_number'] ?>" required>
                            </div>
                            <button class="btn btn-register" type="submit">Continue to Payment</button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="checkout-panel">
                        <h3>Order Summary</h3>
                        <?php foreach ($items as $item): ?>
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <span><?= $item['product']['product_name'] ?> x <?= $item['quantity'] ?></span>
                                <strong>PHP <?= number_format($item['subtotal'], 2) ?></strong>
                            </div>
                        <?php endforeach; ?>
                        <div class="d-flex justify-content-between pt-3">
                            <h4>Total</h4>
                            <h4>PHP <?= number_format($total, 2) ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require('includes/footer.php'); ?>
