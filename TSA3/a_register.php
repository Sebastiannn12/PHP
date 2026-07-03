<?php
session_start();

require "a_registerlogic.php";

$pageTitle = "Activity A Registration";
$headerLabel = "Activity A";
$headerTitle = "Registration";

require "includes/header.php";
?>


    <main class="container my-5">
        <section class="card form-card mx-auto">
            <div class="card-body p-4 p-md-5">
                <div class="mb-4">
                    <h2 class="fw-bold">Create an Account</h2>
                    <p class="text-secondary mb-0">Fill out the form.</p>
                </div>

                <?php if ($error !== ""): ?>
                    <p class="alert alert-danger fw-bold"><?php echo $error; ?></p>
                <?php endif; ?>

                <?php if ($success !== ""): ?>
                    <p class="alert alert-success fw-bold"><?php echo $success; ?></p>
                <?php endif; ?>

                <form action="a_register.php" method="POST">
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
                        <button class="btn custom-primary-btn" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </section>

        <?php if ($result !== ""): ?>
            <section class="card result-card mx-auto mt-4">
                <div class="card-body p-4">
                    <?php echo $result; ?>
                </div>
            </section>
        <?php endif; ?>
    </main>

<?php require "includes/footer.php"; ?>
