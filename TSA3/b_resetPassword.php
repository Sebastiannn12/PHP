<?php
session_start();

if (!isset($_SESSION["b_user_id"])) {
    header("Location: b_login.php");
    exit();
}

$error = $_GET["error"] ?? "";
$success = $_GET["success"] ?? "";

$pageTitle = "Reset Password";
$headerLabel = "Activity B";
$headerTitle = "Reset Password";

require "includes/header.php";
?>

<main class="container my-5">
    <section class="card form-card narrow-panel mx-auto">
        <div class="card-body p-4 p-md-5">
            <div class="mb-4">
                <p class="section-tag mb-2">Account Security</p>
                <h2 class="fw-bold">Change Password</h2>
                <p class="text-secondary mb-0">Update the password for <?php echo htmlspecialchars($_SESSION["b_username"]); ?>.</p>
            </div>

            <?php if ($success === "updated"): ?>
                <p class="alert alert-success fw-bold">Password updated successfully.</p>
            <?php endif; ?>

            <?php if ($error === "current"): ?>
                <p class="alert alert-danger fw-bold">Current password is incorrect.</p>
            <?php elseif ($error === "match"): ?>
                <p class="alert alert-danger fw-bold">New password and confirm password are not the same.</p>
            <?php elseif ($error === "empty"): ?>
                <p class="alert alert-danger fw-bold">Please complete all password fields.</p>
            <?php elseif ($error === "database"): ?>
                <p class="alert alert-danger fw-bold">Database error. Please try again.</p>
            <?php endif; ?>

            <form action="logic/b_resetPassword_process.php" method="POST">
                <div class="mb-3">
                    <label class="form-label fw-bold" for="current_password">Current Password</label>
                    <input class="form-control" type="password" id="current_password" name="current_password" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold" for="new_password">New Password</label>
                    <input class="form-control" type="password" id="new_password" name="new_password" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold" for="confirm_password">Confirm New Password</label>
                    <input class="form-control" type="password" id="confirm_password" name="confirm_password" required>
                </div>

                <div class="d-flex justify-content-between gap-3 mt-4 form-actions">
                    <a class="btn custom-outline-btn" href="b_home.php">Back</a>
                    <button class="btn custom-primary-btn" type="submit">Update Password</button>
                </div>
            </form>
        </div>
    </section>
</main>

<?php require "includes/footer.php"; ?>