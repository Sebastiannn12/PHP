<?php
$pagetitle = 'Users';
require('../includes/Sellerheader.php');

$editing_user = null;

if (isset($_GET['edit'])) {
    $edit_id = (int)$_GET['edit'];
    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $edit_id);
    mysqli_stmt_execute($stmt);
    $editing_user = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
}

$users = mysqli_query($conn, "SELECT * FROM users ORDER BY created_at DESC");
?>

<main class="seller-main">
    <div class="seller-container">
        <div class="seller-page-header">
            <div>
                <h1>User Administration</h1>
                <p>Add or modify buyers and seller administrators.</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="seller-card seller-side-form-card">
                    <form method="POST" action="../process/seller_user_process.php" class="seller-form">
                        <input type="hidden" name="user_id" value="<?= $editing_user['user_id'] ?? 0 ?>">

                        <input class="form-control" name="full_name" placeholder="Complete name" value="<?= $editing_user['full_name'] ?? '' ?>" required>
                        <input class="form-control" type="email" name="email" placeholder="Email" value="<?= $editing_user['email'] ?? '' ?>" required>
                        <input class="form-control" name="password" placeholder="<?= $editing_user ? 'New password (optional)' : 'Password' ?>" <?= $editing_user ? '' : 'required' ?>>
                        <textarea class="form-control" name="address" placeholder="Complete address" rows="3"><?= $editing_user['address'] ?? '' ?></textarea>
                        <input class="form-control" name="contact_number" placeholder="Contact number" value="<?= $editing_user['contact_number'] ?? '' ?>">

                        <select class="form-select" name="role">
                            <option value="buyer" <?= (($editing_user['role'] ?? '') === 'buyer') ? 'selected' : '' ?>>Buyer</option>
                            <option value="seller" <?= (($editing_user['role'] ?? '') === 'seller') ? 'selected' : '' ?>>Seller</option>
                        </select>

                        <select class="form-select" name="is_verified">
                            <option value="1" <?= (($editing_user['is_verified'] ?? 1) == 1) ? 'selected' : '' ?>>Verified</option>
                            <option value="0" <?= (($editing_user['is_verified'] ?? 1) == 0) ? 'selected' : '' ?>>Not Verified</option>
                        </select>

                        <button class="btn btn-dark" type="submit"><?= $editing_user ? 'Update User' : 'Add User' ?></button>
                    </form>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="seller-card table-responsive">
                    <table class="seller-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Verified</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($user = mysqli_fetch_assoc($users)): ?>
                                <tr>
                                    <td><?= $user['full_name'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td><?= $user['role'] ?></td>
                                    <td><?= $user['is_verified'] ? 'Yes' : 'No' ?></td>
                                    <td><a class="btn btn-sm seller-edit-btn" href="users.php?edit=<?= $user['user_id'] ?>">Edit</a></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
