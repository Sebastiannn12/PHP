<?php
require_once('../includes/auth.php');

if (!is_buyer() && !is_seller()) {
    header('Location: ../login.php');
    exit;
}

$user_id = current_user_id();
$current_password = $_POST['current_password'] ?? '';
$new_password = $_POST['new_password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';
$redirect = is_seller() ? '../seller/profile.php' : '../profile.php';

if (strlen($new_password) < 8) {
    header('Location: ' . $redirect . '?password_error=short');
    exit;
}

if ($new_password !== $confirm_password) {
    header('Location: ' . $redirect . '?password_error=match');
    exit;
}

$stmt = mysqli_prepare($conn, "SELECT password FROM users WHERE user_id = ? LIMIT 1");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$user = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$user || !verify_user_password($current_password, $user['password'])) {
    header('Location: ' . $redirect . '?password_error=current');
    exit;
}

$password_hash = password_hash($new_password, PASSWORD_DEFAULT);
$update = mysqli_prepare($conn, "UPDATE users SET password = ? WHERE user_id = ?");
mysqli_stmt_bind_param($update, "si", $password_hash, $user_id);
mysqli_stmt_execute($update);

log_activity($conn, 'Changed account password');
header('Location: ' . $redirect . '?password_updated=1');
exit;
?>
