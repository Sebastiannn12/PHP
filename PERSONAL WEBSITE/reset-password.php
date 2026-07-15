<?php
$basepath = '';
$pagetitle = 'Reset Password';

require_once('includes/auth.php');
require_guest();

$token = $_GET['token'] ?? '';
$valid_token = false;

if (preg_match('/^[a-f0-9]{64}$/', $token)) {
    $token_hash = hash('sha256', $token);
    $stmt = mysqli_prepare($conn, "SELECT reset_id FROM password_resets WHERE token_hash = ? AND expires_at > NOW() LIMIT 1");
    mysqli_stmt_bind_param($stmt, "s", $token_hash);
    mysqli_stmt_execute($stmt);
    $valid_token = (bool)mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
}

$error = $_GET['error'] ?? '';
require('includes/Buyerheader.php');
?>

<main>
    <section class="auth-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8">
                    <div class="auth-card">
                        <p class="section-kicker">Account recovery</p>
                        <h1>Create a new password</h1>

                        <?php if (!$valid_token): ?>
                            <div class="alert alert-warning">This reset link is invalid or has expired.</div>
                            <a class="btn btn-register w-100" href="forgot-password.php">Request Another Link</a>
                        <?php else: ?>
                            <p class="auth-description">Choose a password containing at least 8 characters.</p>
                            <?php if ($error === 'match'): ?><div class="alert alert-warning">The passwords do not match.</div><?php endif; ?>
                            <?php if ($error === 'short'): ?><div class="alert alert-warning">The password must contain at least 8 characters.</div><?php endif; ?>
                            <form method="POST" action="process/reset_password_process.php" class="auth-form">
                                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                                <div><label class="form-label" for="new_password">New password</label><input class="form-control" id="new_password" type="password" name="new_password" minlength="8" autocomplete="new-password" required></div>
                                <div><label class="form-label" for="confirm_password">Confirm password</label><input class="form-control" id="confirm_password" type="password" name="confirm_password" minlength="8" autocomplete="new-password" required></div>
                                <button class="btn btn-register w-100" type="submit">Reset Password</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require('includes/footer.php'); ?>
