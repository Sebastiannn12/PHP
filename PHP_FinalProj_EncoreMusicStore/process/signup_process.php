<?php
require_once('../includes/auth.php');
require_guest();

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');
$confirm_password = trim($_POST['confirm_password'] ?? '');
$address = trim($_POST['address'] ?? '');
$contact_number = trim($_POST['contact_number'] ?? '');
$verification_code = rand(100000, 999999);

if ($name === '' || $email === '' || $password === '' || $confirm_password === '' || $address === '' || $contact_number === '') {
    header('Location: ../signup.php?error=empty');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../signup.php?error=email');
    exit;
}

if ($password !== $confirm_password) {
    header('Location: ../signup.php?error=password');
    exit;
}

$check = mysqli_prepare($conn, "SELECT user_id FROM users WHERE email = ? LIMIT 1");
mysqli_stmt_bind_param($check, "s", $email);
mysqli_stmt_execute($check);
$check_result = mysqli_stmt_get_result($check);

if (mysqli_fetch_assoc($check_result)) {
    header('Location: ../signup.php?error=exists');
    exit;
}

$role = 'buyer';
$is_verified = 0;
$password = password_hash($password, PASSWORD_DEFAULT);
$stmt = mysqli_prepare($conn, "INSERT INTO users (full_name, email, password, address, contact_number, role, is_verified, verification_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssssssis", $name, $email, $password, $address, $contact_number, $role, $is_verified, $verification_code);
mysqli_stmt_execute($stmt);

$new_user_id = mysqli_insert_id($conn);
$_SESSION['user_id'] = $new_user_id;
$_SESSION['user_name'] = $name;
$_SESSION['user_role'] = 'buyer';

$subject = 'Encore Music Store Email Verification';
$message = "Welcome to Encore Music Store. Your verification code is: " . $verification_code;
@mail($email, $subject, $message);

log_activity($conn, 'Buyer account registered');
header('Location: ../buyer/store.php');
exit;
?>
