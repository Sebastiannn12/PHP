<?php 
if (isset($_SESSION["b_user_id"])) {
    header("Location: b_home.php");
    exit();
}

if (isset($_SESSION["username"])) {
    header("Location: a_home.php");
    exit();
}

$success = $_GET["success"] ?? "";
$error = $_GET["error"] ?? "";


?>
