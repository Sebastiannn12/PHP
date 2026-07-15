<?php
$pagetitle = 'Stocks';
require('../includes/Sellerheader.php');

$editing_product = null;

if (isset($_GET['edit'])) {
    $edit_id = (int)$_GET['edit'];
    $stmt = mysqli_prepare($conn, "SELECT * FROM products WHERE product_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $edit_id);
    mysqli_stmt_execute($stmt);
    $editing_product = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
}

$products = mysqli_query($conn, "SELECT * FROM products ORDER BY product_name ASC");
$categories = mysqli_query($conn, "SELECT * FROM categories ORDER BY category_name ASC");
$upload_errors = [
    'upload' => 'The product image could not be uploaded. Please try again.',
    'size' => 'The product image must be 5 MB or smaller.',
    'type' => 'Please upload a JPG, PNG, or WebP image.',
];
$error_message = $upload_errors[$_GET['error'] ?? ''] ?? '';
?>

<main class="seller-main">
    <div class="seller-container">
        <div class="seller-page-header">
            <div>
                <h1>Stock Management</h1>
                <p>Add products, update stocks, and change prices.</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="seller-card seller-side-form-card">
                    <?php if ($error_message): ?><div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div><?php endif; ?>
                    <form method="POST" action="../process/seller_stock_process.php" class="seller-form" enctype="multipart/form-data">
                        <input type="hidden" name="product_id" value="<?= $editing_product['product_id'] ?? 0 ?>">
                        <input type="hidden" name="existing_image" value="<?= htmlspecialchars($editing_product['image'] ?? '') ?>">
                        <input class="form-control" name="product_name" placeholder="Product name" value="<?= $editing_product['product_name'] ?? '' ?>" required>
                        <select class="form-select" name="category" required>
                            <option value="" disabled <?= empty($editing_product['category']) ? 'selected' : '' ?>>Select Category</option>
                            <?php
                            mysqli_data_seek($categories, 0);
                            while ($cat = mysqli_fetch_assoc($categories)):
                                $selected = (($editing_product['category'] ?? '') === $cat['category_name']) ? 'selected' : '';
                            ?>
                                <option value="<?= htmlspecialchars($cat['category_name']) ?>" <?= $selected ?>><?= htmlspecialchars($cat['category_name']) ?></option>
                            <?php endwhile; ?>
                        </select>
                        <input class="form-control" type="number" step="0.01" name="price" placeholder="Price" value="<?= $editing_product['price'] ?? '' ?>" required>
                        <input class="form-control" type="number" name="stock" placeholder="Stock" value="<?= $editing_product['stock'] ?? '' ?>" required>
                        <?php if (!empty($editing_product['image'])): ?>
                            <?php
                            $editing_image = $editing_product['image'];
                            $editing_image_src = is_file(__DIR__ . '/../uploads/products/' . $editing_image)
                                ? '../uploads/products/' . rawurlencode($editing_image)
                                : '../assets/images/' . rawurlencode($editing_image);
                            ?>
                            <div class="stock-image-preview">
                                <img src="<?= $editing_image_src ?>" alt="Current product image">
                                <span>Current image</span>
                            </div>
                        <?php endif; ?>
                        <div>
                            <label class="form-label" for="product_image"><?= $editing_product ? 'Replace product image' : 'Product image' ?></label>
                            <input class="form-control" id="product_image" type="file" name="product_image" accept="image/jpeg,image/png,image/webp" <?= $editing_product ? '' : 'required' ?>>
                            <small class="seller-field-help">JPG, PNG, or WebP. Maximum file size: 5 MB.</small>
                        </div>
                        <select class="form-select" name="status">
                            <option value="active" <?= (($editing_product['status'] ?? '') === 'active') ? 'selected' : '' ?>>Active</option>
                            <option value="inactive" <?= (($editing_product['status'] ?? '') === 'inactive') ? 'selected' : '' ?>>Inactive</option>
                        </select>
                        <button class="btn btn-dark" type="submit"><?= $editing_product ? 'Update Stock' : 'Add Stock' ?></button>
                    </form>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="seller-card table-responsive">
                    <table class="seller-table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($product = mysqli_fetch_assoc($products)): ?>
                                <tr>
                                    <?php
                                    $table_image = $product['image'] ?: 'landing-image.png';
                                    $table_image_src = is_file(__DIR__ . '/../uploads/products/' . $table_image)
                                        ? '../uploads/products/' . rawurlencode($table_image)
                                        : '../assets/images/' . rawurlencode($table_image);
                                    ?>
                                    <td><img class="stock-table-image" src="<?= $table_image_src ?>" alt=""></td>
                                    <td><?= htmlspecialchars($product['product_name']) ?></td>
                                    <td><?= htmlspecialchars($product['category']) ?></td>
                                    <td>PHP <?= number_format($product['price'], 2) ?></td>
                                    <td><?= $product['stock'] ?></td>
                                    <td><?= $product['status'] ?></td>
                                    <td><a class="btn btn-sm seller-edit-btn" href="stocks.php?edit=<?= $product['product_id'] ?>">Edit</a></td>
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
