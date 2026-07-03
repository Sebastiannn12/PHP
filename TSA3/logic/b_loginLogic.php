<?php
session_start();
/**
 * @var mysqli $conn Database connection

 */


require "../db.php";

$username = trim($_POST["username"] ?? "");
$password = $_POST["password"] ?? "";

if ($username === "" || $password === "") {
    header("Location: ../b_login.php?error=empty");
    exit();
}

$sql = "SELECT id, first_name, middle_name, last_name, username, password FROM users WHERE username = ?";
$statement = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($statement, "s", $username);
mysqli_stmt_execute($statement);
mysqli_stmt_store_result($statement);

if (mysqli_stmt_num_rows($statement) === 1) {
    mysqli_stmt_bind_result($statement, $id, $firstName, $middleName, $lastName, $dbUsername, $hashedPassword);
    mysqli_stmt_fetch($statement);

    if (password_verify($password, $hashedPassword)) {
        $_SESSION["b_user_id"] = $id;
        $_SESSION["b_username"] = $dbUsername;
        $_SESSION["b_full_name"] = trim($firstName . " " . $middleName . " " . $lastName);

        if (isset($_POST["remember"])) {
            setcookie("b_saved_username", $username, time() + 86400, "/");
            setcookie("b_saved_password", $password, time() + 86400, "/");
        } else {
            setcookie("b_saved_username", "", time() - 3600, "/");
            setcookie("b_saved_password", "", time() - 3600, "/");
        }

        header("Location: ../b_home.php");
        exit();
    }
}

header("Location: ../b_login.php?error=invalid");
exit();
?>
