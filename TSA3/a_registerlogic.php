<?php

if (isset($_SESSION["username"])) {
    header("Location: a_home.php");
    exit();
}

if (isset($_SESSION["b_user_id"])) {
    header("Location: b_home.php");
    exit();
}

$result = "";
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstName = trim($_POST["first_name"]);
    $middleName = trim($_POST["middle_name"]);
    $lastName = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $birthday = trim($_POST["birthday"]);
    $contactNumber = trim($_POST["contact_number"]);
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    if ($password !== $confirmPassword) {
        $error = "Password and confirm password are not the same.";
    } else {
        $success = "Registration successful. You can now login.";
        $result = "
            <h3 class=\"fw-bold mb-3\">Registration Result</h3>
            <div class=\"row g-3 user-details\">
                <div class=\"col-md-6\">
                    <div class=\"detail-box\">
                        <span>First Name</span>
                        <strong>" . htmlspecialchars($firstName) . "</strong>
                    </div>
                </div>
                <div class=\"col-md-6\">
                    <div class=\"detail-box\">
                        <span>Middle Name</span>
                        <strong>" . htmlspecialchars($middleName) . "</strong>
                    </div>
                </div>
                <div class=\"col-md-6\">
                    <div class=\"detail-box\">
                        <span>Last Name</span>
                        <strong>" . htmlspecialchars($lastName) . "</strong>
                    </div>
                </div>
                <div class=\"col-md-6\">
                    <div class=\"detail-box\">
                        <span>Username</span>
                        <strong>" . htmlspecialchars($username) . "</strong>
                    </div>
                </div>
                <div class=\"col-md-6\">
                    <div class=\"detail-box\">
                        <span>Birthday</span>
                        <strong>" . htmlspecialchars($birthday) . "</strong>
                    </div>
                </div>
                <div class=\"col-md-6\">
                    <div class=\"detail-box\">
                        <span>Email</span>
                        <strong>" . htmlspecialchars($email) . "</strong>
                    </div>
                </div>
                <div class=\"col-md-6\">
                    <div class=\"detail-box\">
                        <span>Contact Number</span>
                        <strong>" . htmlspecialchars($contactNumber) . "</strong>
                    </div>
                </div>
            </div>
        ";
    }
}


?>
