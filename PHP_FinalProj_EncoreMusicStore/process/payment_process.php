<?php
require_once('../includes/auth.php');
require_buyer();

if (!isset($_SESSION['checkout']) || empty($_SESSION['cart'])) {
    header('Location: ../cart.php');
    exit;
}

$checkout = $_SESSION['checkout'];
$payment_method = $_POST['payment_method'] ?? 'Cash on Delivery';
$user_id = current_user_id();

$stmt = mysqli_prepare($conn, "INSERT INTO orders (user_id, full_name, address, contact_number, total_amount, payment_method) VALUES (?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "isssds", $user_id, $checkout['full_name'], $checkout['address'], $checkout['contact_number'], $checkout['total'], $payment_method);
mysqli_stmt_execute($stmt);
$order_id = mysqli_insert_id($conn);

$ids = implode(',', array_map('intval', array_keys($_SESSION['cart'])));
$products = mysqli_query($conn, "SELECT * FROM products WHERE product_id IN ($ids)");

while ($product = mysqli_fetch_assoc($products)) {
    $quantity = $_SESSION['cart'][$product['product_id']];
    $item = mysqli_prepare($conn, "INSERT INTO order_items (order_id, product_id, product_name, price, quantity) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($item, "iisdi", $order_id, $product['product_id'], $product['product_name'], $product['price'], $quantity);
    mysqli_stmt_execute($item);

    $new_stock = max(0, $product['stock'] - $quantity);
    $stock_stmt = mysqli_prepare($conn, "UPDATE products SET stock = ? WHERE product_id = ?");
    mysqli_stmt_bind_param($stock_stmt, "ii", $new_stock, $product['product_id']);
    mysqli_stmt_execute($stock_stmt);
}

unset($_SESSION['cart']);
unset($_SESSION['checkout']);
log_activity($conn, 'Placed order #' . $order_id);
header('Location: ../orders.php');
exit;
?>
