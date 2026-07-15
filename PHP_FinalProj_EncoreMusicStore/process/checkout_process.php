<?php
require_once('../includes/auth.php');
require_buyer();

$cart = $_SESSION['cart'] ?? [];

if (!$cart) {
    header('Location: ../cart.php');
    exit;
}

$ids = implode(',', array_map('intval', array_keys($cart)));
$products = mysqli_query($conn, "SELECT * FROM products WHERE product_id IN ($ids)");
$total = 0;

while ($product = mysqli_fetch_assoc($products)) {
    $quantity = $cart[$product['product_id']];
    $total += $product['price'] * $quantity;
}

$_SESSION['checkout'] = [
    'full_name' => trim($_POST['full_name'] ?? ''),
    'address' => trim($_POST['address'] ?? ''),
    'contact_number' => trim($_POST['contact_number'] ?? ''),
    'total' => $total
];

header('Location: ../payment.php');
exit;
?>
