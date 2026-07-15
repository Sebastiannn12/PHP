<?php
$basepath = '';
$pagetitle = 'Forgot Password';

require_once('includes/auth.php');
require_guest();

$sent = isset($_GET['sent']);
$error = $_GET['error'] ?? '';
$preview_link = $_SESSION['password_reset_preview'] ?? '';
unset($_SESSION['password_reset_preview']);

require('includes/Buyerheader.php');
?>

<main>
    <section class="auth-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8">
                    <div class="auth-card">
                        <p class="section-kicker">Account recovery</p>
                        <h1>Forgot your password?</h1>
                        <p class="auth-description">Enter your account email and we’ll send you a link that expires in one hour.</p>

                        <?php if ($sent): ?>
                            <div class="alert alert-success">If that email belongs to an account, a password reset link has been sent.</div>
                        <?php elseif ($error === 'email'): ?>
                            <div class="alert alert-warning">Please enter a valid email address.</div>
                        <?php endif; ?>

                        <?php if ($preview_link): ?>
                            <div class="alert alert-info reset-preview">
                                <strong>Local development link:</strong><br>
                                <a href="<?= htmlspecialchars($preview_link) ?>">Open password reset</a>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="process/forgot_password_process.php" class="auth-form">
                            <div>
                                <label class="form-label" for="reset_email">Email address</label>
                                <input class="form-control" id="reset_email" type="email" name="email" placeholder="you@example.com" required>
                            </div>
                            <button class="btn btn-register w-100" type="submit">Send Reset Link</button>
                        </form>

                        <p class="auth-switch"><a href="login.php">Back to login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require('includes/footer.php'); ?>
