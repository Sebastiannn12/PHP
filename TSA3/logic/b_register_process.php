<?php
session_start();

require "../db.php";
/**
 * @var mysqli $conn Database connection
 */

$firstName = trim($_POST["first_name"] ?? "");
$lastName = trim($_POST["last_name"] ?? "");
$email = trim($_POST["email"] ?? "");
$username = trim($_POST["username"] ?? "");
$password = $_POST["password"] ?? "";
$confirmPassword = $_POST["confirm_password"] ?? "";

if ($password !== $confirmPassword) {
    header("Location: ../b_register.php?error=password");
    exit();
}

$checkSql = "SELECT id FROM users WHERE email = ? OR username = ?";
$checkStatement = mysqli_prepare($conn, $checkSql);
mysqli_stmt_bind_param($checkStatement, "ss", $email, $username);
mysqli_stmt_execute($checkStatement);
mysqli_stmt_store_result($checkStatement);

if (mysqli_stmt_num_rows($checkStatement) > 0) {
    header("Location: ../b_register.php?error=duplicate");
    exit();
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$insertSql = "INSERT INTO users (first_name, last_name, email, username, password) VALUES (?, ?, ?, ?, ?)";
$insertStatement = mysqli_prepare($conn, $insertSql);
mysqli_stmt_bind_param($insertStatement, "sssss", $firstName, $lastName, $email, $username, $hashedPassword);

if (mysqli_stmt_execute($insertStatement)) {
    header("Location: ../b_register.php?success=registered");
    exit();
}

header("Location: ../b_register.php?error=database");
exit();
?>