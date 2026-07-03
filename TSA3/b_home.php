<?php
session_start();

if (!isset($_SESSION["b_user_id"])) {
    header("Location: b_login.php");
    exit();
}

$pageTitle = "Activity B Home";
$headerLabel = "Activity B";
$headerTitle = "User Home";

require "includes/header.php";
?>

<main class="container my-5">
    <section class="card form-card mx-auto">
        <div class="card-body p-4 p-md-5">
            <p class="section-tag mb-2">Logged In User</p>
            <h2 class="fw-bold">Welcome, <?php echo htmlspecialchars($_SESSION["b_full_name"]); ?>!</h2>

            <p class="text-secondary">
                You are logged in using an account saved from the MySQL database.
            </p>

            <div class="mt-4">
                <p><strong>User ID:</strong> <?php echo htmlspecialchars($_SESSION["b_user_id"]); ?></p>
                <p><strong>Username:</strong> <?php echo htmlspecialchars($_SESSION["b_username"]); ?></p>
            </div>

            <div class="d-flex justify-content-between gap-3 mt-4 form-actions">
                <a class="btn custom-outline-btn" href="b_resetPassword.php">Reset Password</a>
                <a class="btn custom-primary-btn" href="b_logout.php">Logout</a>
            </div>
        </div>
    </section>
</main>

<?php require "includes/footer.php"; ?>