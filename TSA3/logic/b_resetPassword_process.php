<?php
session_start();

if (!isset($_SESSION["b_user_id"])) {
    header("Location: ../b_login.php");
    exit();
}

require "../db.php";
/**
 * @var mysqli $conn Database connection
 */

$userId = $_SESSION["b_user_id"];
$currentPassword = $_POST["current_password"] ?? "";
$newPassword = $_POST["new_password"] ?? "";
$confirmPassword = $_POST["confirm_password"] ?? "";

if ($currentPassword === "" || $newPassword === "" || $confirmPassword === "") {
    header("Location: ../b_resetPassword.php?error=empty");
    exit();
}

if ($newPassword !== $confirmPassword) {
    header("Location: ../b_resetPassword.php?error=match");
    exit();
}

$selectSql = "SELECT password FROM users WHERE id = ?";
$selectStatement = mysqli_prepare($conn, $selectSql);
mysqli_stmt_bind_param($selectStatement, "i", $userId);
mysqli_stmt_execute($selectStatement);
mysqli_stmt_bind_result($selectStatement, $hashedPassword);

if (!mysqli_stmt_fetch($selectStatement) || !password_verify($currentPassword, $hashedPassword)) {
    header("Location: ../b_resetPassword.php?error=current");
    exit();
}

mysqli_stmt_close($selectStatement);

$newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
$updateSql = "UPDATE users SET password = ? WHERE id = ?";
$updateStatement = mysqli_prepare($conn, $updateSql);
mysqli_stmt_bind_param($updateStatement, "si", $newHashedPassword, $userId);

if (mysqli_stmt_execute($updateStatement)) {
    header("Location: ../b_resetPassword.php?success=updated");
    exit();
}

header("Location: ../b_resetPassword.php?error=database");
exit();
?>