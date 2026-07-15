<?php
$basepath = '';
$pagetitle = "Cart";

require_once('includes/auth.php');

if (!is_buyer()) {
    require('includes/Buyerheader.php');
    ?>
    <main>
        <section class="cart-section">
            <div class="container">
                <div class="guest-cart-card text-center">
                    <i class="bi bi-lock"></i>
                    <p class="section-kicker">Guest access limited</p>
                    <h1>Please log in before using the cart.</h1>
                    <p>Guests can browse the store, but cart and checkout are reserved for registered buyers.</p>
                    <div class="cart-actions">
                        <a href="login.php" class="btn btn-register">Log In</a>
                        <a href="signup.php" class="btn btn-outline-premium">Sign Up</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php require('includes/footer.php'); exit;
}

$cart = $_SESSION['cart'] ?? [];
$items = [];
$total = 0;

if ($cart) {
    $ids = implode(',', array_map('intval', array_keys($cart)));
    $result = mysqli_query($conn, "SELECT * FROM products WHERE product_id IN ($ids)");

    while ($product = mysqli_fetch_assoc($result)) {
        $quantity = $cart[$product['product_id']];
        $subtotal = $product['price'] * $quantity;
        $total += $subtotal;
        $items[] = ['product' => $product, 'quantity' => $quantity, 'subtotal' => $subtotal];
    }
}

require('includes/Buyerheader.php');
?>

<main>
    <section class="store-section">
        <div class="container">
            <div class="store-header">
                <p class="section-kicker">Your Cart</p>
                <h1 class="store-title">Review your selected instruments.</h1>
            </div>

            <div class="checkout-panel table-responsive">
                <?php if (!$items): ?>
                    <p>Your cart is empty.</p>
                    <a href="buyer/store.php" class="btn btn-register">Continue Shopping</a>
                <?php else: ?>
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item): ?>
                                <tr>
                                    <td><?= $item['product']['product_name'] ?></td>
                                    <td>PHP <?= number_format($item['product']['price'], 2) ?></td>
                                    <td><?= $item['quantity'] ?></td>
                                    <td>PHP <?= number_format($item['subtotal'], 2) ?></td>
                                    <td><a href="process/remove_cart_item.php?remove=<?= $item['product']['product_id'] ?>" class="btn btn-sm btn-outline-dark">Remove</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="text-end mt-4">
                        <h3>Total: PHP <?= number_format($total, 2) ?></h3>
                        <a href="checkout.php" class="btn btn-register">Proceed to Checkout</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php require('includes/footer.php'); ?>
