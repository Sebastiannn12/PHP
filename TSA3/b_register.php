<?php
session_start();

require "b_registerlogic.php";

$pageTitle = "Activity B Registration";
$headerLabel = "Activity B";
$headerTitle = "MySQL Registration";

require("includes/header.php");
?>

<main class="container my-5">
    <section class="card form-card mx-auto">
        <div class="card-body p-4 p-md-5">
            <div class="mb-4">
                <p class="section-tag mb-2">PHP with MySQL</p>
                <h2 class="fw-bold">Create a Database Account</h2>
                <p class="text-secondary mb-0">This registration saves the user information into the MySQL database.</p>
            </div>

            <?php if ($success === "registered"): ?>
                <p class="alert alert-success fw-bold">Registration successful. You can now login.</p>
            <?php endif; ?>

            <?php if ($error === "password"): ?>
                <p class="alert alert-danger fw-bold">Password and confirm password are not the same.</p>
            <?php elseif ($error === "duplicate"): ?>
                <p class="alert alert-danger fw-bold">Email or username already exists.</p>
            <?php elseif ($error === "database"): ?>
                <p class="alert alert-danger fw-bold">Database error. Please check your database setup.</p>
            <?php endif; ?>

            <form action="logic/b_register_process.php" method="POST">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold" for="first_name">First Name</label>
                        <input class="form-control" type="text" id="first_name" name="first_name" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold" for="middle_name">Middle Name</label>
                        <input class="form-control" type="text" id="middle_name" name="middle_name" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold" for="last_name">Last Name</label>
                        <input class="form-control" type="text" id="last_name" name="last_name" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold" for="email">Email</label>
                        <input class="form-control" type="email" id="email" name="email" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold" for="username">Username</label>
                        <input class="form-control" type="text" id="username" name="username" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold" for="birthday">Birthday</label>
                        <input class="form-control" type="text" id="birthday" name="birthday" placeholder="January 30 1993" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold" for="contact_number">Contact Number</label>
                        <input class="form-control" type="text" id="contact_number" name="contact_number" required>
                    </div>

                    <div class="col-12"></div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold" for="password">Password</label>
                        <input class="form-control" type="password" id="password" name="password" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold" for="confirm_password">Confirm Password</label>
                        <input class="form-control" type="password" id="confirm_password" name="confirm_password" required>
                    </div>

                </div>

                <div class="d-flex justify-content-between gap-3 mt-4 form-actions">
                    <a class="btn custom-outline-btn" href="index.php">Back</a>
                    <button class="btn custom-primary-btn" type="submit">Register</button>
                </div>
            </form>
        </div>
    </section>
</main>

<?php require "includes/footer.php"; ?>
