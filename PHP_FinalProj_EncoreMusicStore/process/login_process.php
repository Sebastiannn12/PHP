<?php
require_once('../includes/auth.php');
require_guest();

$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

if ($email === '' || $password === '') {
    header('Location: ../login.php?error=empty');
    exit;
}

$stmt = mysqli_prepare($conn, "SELECT user_id, full_name, email, password, role FROM users WHERE email = ? LIMIT 1");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if (!$user || !verify_user_password($password, $user['password'])) {
    header('Location: ../login.php?error=invalid');
    exit;
}

// Transparently upgrade legacy plain-text passwords after a valid login.
if (empty(password_get_info($user['password'])['algo'])) {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $upgrade = mysqli_prepare($conn, "UPDATE users SET password = ? WHERE user_id = ?");
    mysqli_stmt_bind_param($upgrade, "si", $password_hash, $user['user_id']);
    mysqli_stmt_execute($upgrade);
}

$_SESSION['user_id'] = $user['user_id'];
$_SESSION['user_name'] = $user['full_name'];
$_SESSION['user_role'] = $user['role'];

log_activity($conn, 'Logged in');

if ($user['role'] === 'seller') {
    header('Location: ../seller/dashboard.php');
    exit;
}

header('Location: ../buyer/store.php');
exit;
?>
