<?php
session_start();

if (!isset($_SESSION["b_user_id"])) {
    header("Location: b_login.php");
    exit();
}

require "db.php";
/**
 * @var mysqli $conn Database connection
 */

$userId = $_SESSION["b_user_id"];
$error = $_GET["error"] ?? "";
$success = $_GET["success"] ?? "";
$showResetPassword = isset($_GET["reset"]) || $error !== "" || $success !== "";
$resetLink = $showResetPassword ? "b_home.php" : "b_home.php?reset=1#reset-password";
$resetLabel = $showResetPassword ? "Hide Reset Password" : "Reset Password";

$sql = "SELECT first_name, middle_name, last_name, username, email, birthday, contact_number FROM users WHERE id = ?";
$statement = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($statement, "i", $userId);
mysqli_stmt_execute($statement);
mysqli_stmt_bind_result($statement, $firstName, $middleName, $lastName, $username, $email, $birthday, $contactNumber);
mysqli_stmt_fetch($statement);
mysqli_stmt_close($statement);

$fullName = trim($firstName . " " . $middleName . " " . $lastName);

$pageTitle = "Activity B Home";
$headerLabel = "Activity B";
$headerTitle = "User Information Form";

require "includes/header.php";
?>

<main class="container my-5">
    <section class="card form-card mx-auto">
        <div class="card-body p-4 p-md-5">
            <p class="section-tag mb-2">Logged In User</p>
            <h2 class="fw-bold">Welcome, <?php echo htmlspecialchars($fullName); ?>!</h2>

            <p class="text-secondary">
                You are logged in using an account registered.
            </p>

            <div class="row g-3 mt-4 user-details">
                <div class="col-md-6">
                    <div class="detail-box">
                        <span>User ID</span>
                        <strong><?php echo htmlspecialchars($_SESSION["b_user_id"]); ?></strong>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-box">
                        <span>Username</span>
                        <strong><?php echo ($username); ?></strong>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-box">
                        <span>Birthday</span>
                        <strong><?php echo htmlspecialchars($birthday !== "" ? $birthday : "Not provided"); ?></strong>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-box">
                        <span>Email</span>
                        <strong><?php echo($email); ?></strong>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-box">
                        <span>Contact Number</span>
                        <strong><?php echo htmlspecialchars($contactNumber !== "" ? $contactNumber : "Not provided"); ?></strong>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between gap-3 mt-4 form-actions">
                <a class="btn custom-outline-btn" href="<?php echo $resetLink; ?>"><?php echo $resetLabel; ?></a>
                <a class="btn custom-primary-btn" href="b_logout.php">Logout</a>
            </div>
        </div>
    </section>

    <?php if ($showResetPassword): ?>
        <section class="card form-card mx-auto mt-4" id="reset-password">
            <div class="card-body p-4 p-md-5">
                <p class="section-tag mb-2">Account Security</p>
                <h2 class="fw-bold">Reset Password</h2>
                <p class="text-secondary">Enter your old password before saving a new one.</p>

                <?php if ($success === "updated"): ?>
                    <p class="alert alert-success fw-bold">Password reset successfully.</p>
                <?php endif; ?>

                <?php if ($error === "current"): ?>
                    <p class="alert alert-danger fw-bold">Current password is not the same with the old password.</p>
                <?php elseif ($error === "match"): ?>
                    <p class="alert alert-danger fw-bold">New password and Re-Enter new password should be the same.</p>
                <?php elseif ($error === "empty"): ?>
                    <p class="alert alert-danger fw-bold">Please complete all password fields.</p>
                <?php elseif ($error === "database"): ?>
                    <p class="alert alert-danger fw-bold">Database error. Please try again.</p>
                <?php endif; ?>

                <form action="logic/b_resetPassword_process.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold" for="current_password">Enter Current Password</label>
                        <input class="form-control" type="password" id="current_password" name="current_password" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" for="new_password">Enter New Password</label>
                        <input class="form-control" type="password" id="new_password" name="new_password" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" for="confirm_password">Re-Enter New Password</label>
                        <input class="form-control" type="password" id="confirm_password" name="confirm_password" required>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button class="btn custom-primary-btn reset-btn" type="submit">Reset Password</button>
                    </div>
                </form>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php require "includes/footer.php"; ?>