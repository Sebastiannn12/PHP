<?php
require_once('../includes/auth.php');

if (!is_buyer()) {
    header('Location: ../cart.php?guest=1');
    exit;
}

$product_id = (int)($_POST['product_id'] ?? 0);

if ($product_id > 0) {
    $_SESSION['cart'][$product_id] = ($_SESSION['cart'][$product_id] ?? 0) + 1;
    log_activity($conn, 'Added product to cart');
}

header('Location: ../cart.php');
exit;
?>
