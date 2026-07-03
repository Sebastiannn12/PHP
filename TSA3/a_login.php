<?php
session_start();

require "logic/a_loginLogic.php";

$pageTitle = "Activity A Login";
$headerLabel = "Activity A";
$headerTitle = "Login";

require "includes/header.php";
?>

    <main class="container my-5">
        <section class="card form-card narrow-panel mx-auto">
            <div class="card-body p-4 p-md-5">
                <div class="mb-4">
                    <h2 class="fw-bold">Login</h2>
                </div>

                <?php if ($loginError === "invalid"): ?>
                    <p class="alert alert-danger fw-bold">Invalid username or password.</p>
                <?php endif; ?>

                <form action="logic/a_login_process.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold" for="username">Username</label>
                        <input
                            class="form-control"
                            type="text"
                            id="username"
                            name="username"
                            value="<?php echo htmlspecialchars($savedUsername); ?>"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" for="password">Password</label>
                        <input
                            class="form-control"
                            type="password"
                            id="password"
                            name="password"
                            value="<?php echo htmlspecialchars($savedPassword); ?>"
                            required
                        >
                    </div>

                    <div class="form-check mb-4">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="remember"
                            name="remember"
                            value="yes"
                            <?php if ($savedUsername !== "" && $savedPassword !== "") echo "checked"; ?>
                        >
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>

                    <div class="d-flex justify-content-between gap-3 mt-3 form-actions">
                        <a class="btn custom-outline-btn" href="index.php">Back</a>
                        <button class="btn custom-primary-btn" type="submit">Login</button>
                    </div>
                </form>
            </div>
        </section>
    </main>

<?php require "includes/footer.php"; ?>
