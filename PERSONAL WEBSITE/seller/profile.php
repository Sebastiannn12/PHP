<?php
$pagetitle = 'Profile';
require('../includes/Sellerheader.php');

$user_id = current_user_id();
$stmt = mysqli_prepare($conn, "SELECT full_name, email, profile_image, created_at FROM users WHERE user_id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$user = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

$password_messages = [
    'current' => 'Your current password is incorrect.',
    'match' => 'The new passwords do not match.',
    'short' => 'Your new password must contain at least 8 characters.',
];
$password_error = $password_messages[$_GET['password_error'] ?? ''] ?? '';
$upload_errors = [
    'upload' => 'The profile photo could not be uploaded. Please try again.',
    'size' => 'The profile photo must be 5 MB or smaller.',
    'type' => 'Please upload a JPG, PNG, or WebP image.',
];
$upload_error = $upload_errors[$_GET['image_error'] ?? ''] ?? '';
?>

<main class="seller-main">
    <div class="seller-container seller-profile-container">
        <div class="seller-page-header">
            <div>
                <h1>Seller Profile</h1>
                <p>Review your account and manage your password.</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="seller-card seller-profile-card">
                    <div class="seller-profile-avatar">
                        <?php if (!empty($user['profile_image'])): ?>
                            <img src="../uploads/profile/<?= rawurlencode($user['profile_image']) ?>" alt="<?= htmlspecialchars($user['full_name']) ?> profile photo">
                        <?php else: ?>
                            <i class="bi bi-person"></i>
                        <?php endif; ?>
                    </div>
                    <h2><?= htmlspecialchars($user['full_name']) ?></h2>
                    <p><?= htmlspecialchars($user['email']) ?></p>
                    <span>Seller since <?= date('F Y', strtotime($user['created_at'])) ?></span>
                    <?php if (isset($_GET['image_updated'])): ?><div class="alert alert-success mt-3">Profile photo updated.</div><?php endif; ?>
                    <?php if ($upload_error): ?><div class="alert alert-danger mt-3"><?= htmlspecialchars($upload_error) ?></div><?php endif; ?>
                    <form class="seller-profile-upload" method="POST" action="../process/seller_profile_process.php" enctype="multipart/form-data">
                        <label class="btn seller-photo-button" for="seller_profile_image"><i class="bi bi-camera"></i> Choose Photo</label>
                        <input id="seller_profile_image" type="file" name="profile_image" accept="image/jpeg,image/png,image/webp" required>
                        <small>JPG, PNG, or WebP · max 5 MB</small>
                        <button class="btn btn-dark" type="submit">Upload Photo</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="seller-card">
                    <p class="seller-security-label">Account security</p>
                    <h2>Change password</h2>
                    <p class="text-secondary">Enter your current password, then choose a new password with at least 8 characters.</p>
                    <?php if (isset($_GET['password_updated'])): ?><div class="alert alert-success">Password changed successfully.</div><?php endif; ?>
                    <?php if ($password_error): ?><div class="alert alert-danger"><?= htmlspecialchars($password_error) ?></div><?php endif; ?>
                    <form method="POST" action="../process/change_password.php" class="seller-form mt-4">
                        <div><label class="form-label">Current password</label><input class="form-control" type="password" name="current_password" autocomplete="current-password" required></div>
                        <div><label class="form-label">New password</label><input class="form-control" type="password" name="new_password" minlength="8" autocomplete="new-password" required></div>
                        <div><label class="form-label">Confirm new password</label><input class="form-control" type="password" name="confirm_password" minlength="8" autocomplete="new-password" required></div>
                        <button class="btn btn-dark" type="submit">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
