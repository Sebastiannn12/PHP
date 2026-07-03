<?php
session_start();

if (isset($_SESSION["b_user_id"])) {
    header("Location: b_home.php");
    exit();
}

$error = $_GET["error"] ?? "";

$pageTitle = "Activity B Login";
$headerLabel = "Activity B";
$headerTitle = "Database Login";

require "includes/header.php";
?>

<main class="container my-5">
    <section class="card form-card narrow-panel mx-auto">
        <div class="card-body p-4 p-md-5">
            <div class="mb-4">
                <p class="section-tag mb-2">MySQL Account</p>
                <h2 class="fw-bold">Login to Your Account</h2>
                <p class="text-secondary mb-0">Use the username and password you saved during Activity B registration.</p>
            </div>

            <?php if ($error === "invalid"): ?>
                <p class="alert alert-danger fw-bold">Invalid username or password.</p>
            <?php elseif ($error === "empty"): ?>
                <p class="alert alert-danger fw-bold">Please enter your username and password.</p>
            <?php endif; ?>

            <form action="logic/b_loginLogic.php" method="POST">
                <div class="mb-3">
                    <label class="form-label fw-bold" for="username">Username</label>
                    <input class="form-control" type="text" id="username" name="username" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold" for="password">Password</label>
                    <input class="form-control" type="password" id="password" name="password" required>
                </div>

                <div class="d-flex justify-content-between gap-3 mt-4 form-actions">
                    <a class="btn custom-outline-btn" href="index.php">Back</a>
                    <button class="btn custom-primary-btn" type="submit">Login</button>
                </div>
            </form>
        </div>
    </section>
</main>

<?php require "includes/footer.php"; ?>