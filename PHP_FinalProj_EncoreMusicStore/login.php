<?php
$basepath = '';
$pagetitle = "Login";

require_once('includes/auth.php');
require_guest();

$error = $_GET['error'] ?? '';

require('includes/Buyerheader.php');
?>

<main>
    <section class="auth-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8">
                    <div class="auth-card">
                        <p class="section-kicker">Welcome back</p>
                        <h1>Log in to Encore</h1>
                        <p class="auth-description">Buyers continue shopping. Sellers go directly to the dashboard.</p>

                        <?php if (isset($_GET['reset'])): ?>
                            <div class="alert alert-success" role="alert">Your password has been reset. You can now log in.</div>
                        <?php endif; ?>

                        <?php if ($error === 'empty'): ?>
                            <div class="alert alert-warning" role="alert">
                                Please enter your email and password.
                            </div>
                        <?php elseif ($error === 'invalid'): ?>
                            <div class="alert alert-warning" role="alert">
                                Invalid email or password.
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="process/login_process.php" class="auth-form">
                            <div>
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
                            </div>

                            <div>
                                <div class="auth-label-row">
                                    <label for="password" class="form-label">Password</label>
                                    <a href="forgot-password.php">Forgot password?</a>
                                </div>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            </div>

                            <button type="submit" class="btn btn-register w-100">Log In</button>
                        </form>

                        <p class="auth-switch">
                            New buyer? <a href="signup.php">Create an account</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require('includes/footer.php');
?>
