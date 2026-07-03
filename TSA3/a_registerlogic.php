<?php

if (isset($_SESSION["username"])) {
    header("Location: home.php");
    exit();
}

$result = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstName = trim($_POST["first_name"]);
    $lastName = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    if ($password !== $confirmPassword) {
        $error = "Password and confirm password are not the same.";
    } else {
        $result = "
            <h3>Registration Result</h3>
            <p><strong>First Name:</strong> " . htmlspecialchars($firstName) . "</p>
            <p><strong>Last Name:</strong> " . htmlspecialchars($lastName) . "</p>
            <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
            <p><strong>Username:</strong> " . htmlspecialchars($username) . "</p>
        ";
    }
}


?>