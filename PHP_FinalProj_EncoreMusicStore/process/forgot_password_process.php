<?php
require_once('../includes/auth.php');
require_guest();

$email = trim($_POST['email'] ?? '');

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../forgot-password.php?error=email');
    exit;
}

$stmt = mysqli_prepare($conn, "SELECT user_id, full_name FROM users WHERE email = ? LIMIT 1");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$user = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if ($user) {
    mysqli_query($conn, "DELETE FROM password_resets WHERE expires_at <= NOW()");
    $delete = mysqli_prepare($conn, "DELETE FROM password_resets WHERE user_id = ?");
    mysqli_stmt_bind_param($delete, "i", $user['user_id']);
    mysqli_stmt_execute($delete);

    $token = bin2hex(random_bytes(32));
    $token_hash = hash('sha256', $token);
    $insert = mysqli_prepare($conn, "INSERT INTO password_resets (user_id, token_hash, expires_at) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 1 HOUR))");
    mysqli_stmt_bind_param($insert, "is", $user['user_id'], $token_hash);
    mysqli_stmt_execute($insert);

    $is_https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
    $scheme = $is_https ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $app_path = str_replace('\\', '/', dirname(dirname($_SERVER['SCRIPT_NAME'] ?? '')));
    $reset_link = $scheme . '://' . $host . rtrim($app_path, '/') . '/reset-password.php?token=' . urlencode($token);

    $subject = 'Reset your Encore Music Store password';
    $message = "Hello " . $user['full_name'] . ",\n\nReset your password using this link:\n" . $reset_link . "\n\nThis link expires in one hour. If you did not request it, ignore this email.";
    @mail($email, $subject, $message);

    if (in_array(strtolower(preg_replace('/:\\d+$/', '', $host)), ['localhost', '127.0.0.1'], true)) {
        $_SESSION['password_reset_preview'] = $reset_link;
    }

    log_activity($conn, 'Requested password reset');
}

header('Location: ../forgot-password.php?sent=1');
exit;
?>
