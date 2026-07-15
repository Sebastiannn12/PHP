<?php
$basepath = '';
$pagetitle = "Payment";

require_once('includes/auth.php');
require_buyer();

if (!isset($_SESSION['checkout']) || empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

require('includes/Buyerheader.php');
?>

<main>
    <section class="cart-section">
        <div class="container">
            <div class="guest-cart-card text-center">
                <i class="bi bi-credit-card"></i>
                <p class="section-kicker">Payment</p>
                <h1>Select payment method.</h1>
                <p>No payment API is required yet. This records the selected method for the order.</p>
                <form method="POST" action="process/payment_process.php" class="auth-form mt-4">
                    <select class="form-select" name="payment_method">
                        <option>Cash on Delivery</option>
                        <option>Bank Transfer</option>
                        <option>Over-the-counter Payment</option>
                    </select>
                    <button class="btn btn-register" type="submit">Place Order</button>
                </form>
            </div>
        </div>
    </section>
</main>

<?php require('includes/footer.php'); ?>
