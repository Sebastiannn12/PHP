<?php
$basepath = '';
$pagetitle = "Sign Up";

require_once('includes/auth.php');
require_guest();

$error = $_GET['error'] ?? '';

require('includes/Buyerheader.php');
?>

<main>
    <section class="auth-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-9">
                    <div class="auth-card">
                        <p class="section-kicker">Buyer registration</p>
                        <h1>Create your account</h1>
                        <p class="auth-description">Only buyers can sign up. Seller accounts are created by the administrator.</p>

                        <?php if ($error === 'empty'): ?>
                            <div class="alert alert-warning" role="alert">
                                Please complete all required fields.
                            </div>
                        <?php elseif ($error === 'email'): ?>
                            <div class="alert alert-warning" role="alert">
                                Please enter a valid email address.
                            </div>
                        <?php elseif ($error === 'password'): ?>
                            <div class="alert alert-warning" role="alert">
                                Passwords do not match.
                            </div>
                        <?php elseif ($error === 'exists'): ?>
                            <div class="alert alert-warning" role="alert">
                                This email is already registered.
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="process/signup_process.php" class="auth-form">
                            <div>
                                <label for="name" class="form-label">Complete name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div>
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="confirm_password" class="form-label">Confirm password</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                </div>
                            </div>

                            <div>
                                <label for="address" class="form-label">Complete address</label>
                                <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                            </div>

                            <div>
                                <label for="contact_number" class="form-label">Contact number</label>
                                <input type="text" class="form-control" id="contact_number" name="contact_number" required>
                            </div>

                            <button type="submit" class="btn btn-register w-100">Sign Up</button>
                        </form>

                        <p class="auth-switch">
                            Already have an account? <a href="login.php">Log in</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require('includes/footer.php');
?>
