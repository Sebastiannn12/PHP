<?php 
if (isset($_SESSION["b_username"])) {
    header("Location: b_home.php");
    exit();
}

$success = $_GET["success"] ?? "";
$error = $_GET["error"] ?? "";


?>