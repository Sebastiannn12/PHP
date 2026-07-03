<?php
if (isset($_SESSION["username"])) {
    header("Location: a_home.php");
    exit();
}

if (isset($_SESSION["b_user_id"])) {
    header("Location: b_home.php");
    exit();
}

$savedUsername = $_COOKIE["saved_username"] ?? "";
$savedPassword = $_COOKIE["saved_password"] ?? "";
$loginError = $_GET["error"] ?? "";
?>
