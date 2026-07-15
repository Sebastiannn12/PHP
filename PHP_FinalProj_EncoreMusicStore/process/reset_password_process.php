<?php
require_once('../includes/auth.php');
require_guest();

$token = $_POST['token'] ?? '';
$new_password = $_POST['new_password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';
$token_query = urlencode($token);

if (strlen($new_password) < 8) {
    header('Location: ../reset-password.php?token=' . $token_query . '&error=short');
    exit;
}

if ($new_password !== $confirm_password) {
    header('Location: ../reset-password.php?token=' . $token_query . '&error=match');
    exit;
}

if (!preg_match('/^[a-f0-9]{64}$/', $token)) {
    header('Location: ../reset-password.php?token=' . $token_query);
    exit;
}

$token_hash = hash('sha256', $token);
$stmt = mysqli_prepare($conn, "SELECT reset_id, user_id FROM password_resets WHERE token_hash = ? AND expires_at > NOW() LIMIT 1");
mysqli_stmt_bind_param($stmt, "s", $token_hash);
mysqli_stmt_execute($stmt);
$reset = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$reset) {
    header('Location: ../reset-password.php?token=' . $token_query);
    exit;
}

$password_hash = password_hash($new_password, PASSWORD_DEFAULT);
mysqli_begin_transaction($conn);

$update = mysqli_prepare($conn, "UPDATE users SET password = ? WHERE user_id = ?");
mysqli_stmt_bind_param($update, "si", $password_hash, $reset['user_id']);
$updated = mysqli_stmt_execute($update);

$delete = mysqli_prepare($conn, "DELETE FROM password_resets WHERE user_id = ?");
mysqli_stmt_bind_param($delete, "i", $reset['user_id']);
$deleted = mysqli_stmt_execute($delete);

if ($updated && $deleted) {
    mysqli_commit($conn);
    header('Location: ../login.php?reset=1');
    exit;
}

mysqli_rollback($conn);
header('Location: ../reset-password.php?token=' . $token_query);
exit;
?>
