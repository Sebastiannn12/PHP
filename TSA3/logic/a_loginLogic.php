<?php
if (isset($_SESSION["username"])) {
    header("Location: home.php");
    exit();
}

$savedUsername = $_COOKIE["saved_username"] ?? "";
$savedPassword = $_COOKIE["saved_password"] ?? "";
$loginError = $_GET["error"] ?? "";
?>