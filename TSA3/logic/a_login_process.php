<?php
session_start();

$staticUsername = "Francis";
$staticPassword = "password123";

$username = $_POST["username"] ?? "";
$password = $_POST["password"] ?? "";

if ($username === $staticUsername && $password === $staticPassword) {
    $_SESSION["username"] = $username;

    if (isset($_POST["remember"])) {
        setcookie("saved_username", $username, time() + 86400, "/");
        setcookie("saved_password", $password, time() + 86400, "/");
    } else {
        setcookie("saved_username", "", time() - 3600, "/");
        setcookie("saved_password", "", time() - 3600, "/");
    }

    header("Location: ../home.php");
    exit();
}

header("Location: ../a_login.php?error=invalid");
exit();
?>
