<?php
require_once('../includes/auth.php');
require_seller();

$user_id = (int)($_POST['user_id'] ?? 0);
$full_name = trim($_POST['full_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');
$address = trim($_POST['address'] ?? '');
$contact_number = trim($_POST['contact_number'] ?? '');
$role = $_POST['role'] ?? 'buyer';
$is_verified = (int)($_POST['is_verified'] ?? 1);

if ($user_id > 0) {
    if ($password !== '') {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($conn, "UPDATE users SET full_name=?, email=?, password=?, address=?, contact_number=?, role=?, is_verified=? WHERE user_id=?");
        mysqli_stmt_bind_param($stmt, "ssssssii", $full_name, $email, $password, $address, $contact_number, $role, $is_verified, $user_id);
    } else {
        $stmt = mysqli_prepare($conn, "UPDATE users SET full_name=?, email=?, address=?, contact_number=?, role=?, is_verified=? WHERE user_id=?");
        mysqli_stmt_bind_param($stmt, "sssssii", $full_name, $email, $address, $contact_number, $role, $is_verified, $user_id);
    }
    mysqli_stmt_execute($stmt);
    log_activity($conn, 'Modified user: ' . $full_name);
} else {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = mysqli_prepare($conn, "INSERT INTO users (full_name, email, password, address, contact_number, role, is_verified) VALUES (?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssssssi", $full_name, $email, $password, $address, $contact_number, $role, $is_verified);
    mysqli_stmt_execute($stmt);
    log_activity($conn, 'Added user: ' . $full_name);
}

header('Location: ../seller/users.php');
exit;
?>
