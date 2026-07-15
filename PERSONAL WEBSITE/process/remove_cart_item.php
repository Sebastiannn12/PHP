<?php
require_once('../includes/auth.php');
require_buyer();

$remove_id = (int)($_GET['remove'] ?? 0);

if ($remove_id > 0) {
    unset($_SESSION['cart'][$remove_id]);
    log_activity($conn, 'Removed product from cart');
}

header('Location: ../cart.php');
exit;
?>
