<?php
$basepath = '../';
$pagetitle = "Store";

require_once('../includes/auth.php');

$category = trim($_GET['category'] ?? 'All');

// Category navigation is managed by the categories table.
$categories = mysqli_query($conn, "SELECT category_name FROM categories ORDER BY category_name ASC");

if ($category !== 'All') {
    $stmt = mysqli_prepare($conn, "SELECT * FROM products WHERE status = 'active' AND category = ? ORDER BY product_name ASC");
    mysqli_stmt_bind_param($stmt, "s", $category);
    mysqli_stmt_execute($stmt);
    $products = mysqli_stmt_get_result($stmt);
} else {
    $products = mysqli_query($conn, "SELECT * FROM products WHERE status = 'active' ORDER BY product_name ASC");
}

require('../includes/Buyerheader.php');
?>

<main>
    <section class="store-section">
        <div class="container">
            <div class="store-header">
                <p class="section-kicker">Encore Collection</p>

                <div class="store-header-grid">
                    <div>
                        <h1 class="store-title">Shop premium instruments with confidence.</h1>
                        <p class="store-description">Browse categorized guitars, keyboards, drums, and audio essentials from the Encore catalog.</p>
                    </div>
                </div>
            </div>

            <div class="category-list">
                <a class="category-btn <?= $category === 'All' ? 'active' : '' ?>" href="store.php">All</a>
                <?php while ($cat = mysqli_fetch_assoc($categories)): ?>
                    <a class="category-btn <?= $category === $cat['category_name'] ? 'active' : '' ?>" href="store.php?category=<?= urlencode($cat['category_name']) ?>">
                        <?= htmlspecialchars($cat['category_name']) ?>
                    </a>
                <?php endwhile; ?>
            </div>

            <div class="row g-4 products-grid">
                <?php while ($product = mysqli_fetch_assoc($products)): ?>
                    <?php
                    $productImage = $product['image'] ?: 'landing-image.png';
                    $productImageSrc = is_file(__DIR__ . '/../uploads/products/' . $productImage)
                        ? $basepath . 'uploads/products/' . rawurlencode($productImage)
                        : $basepath . 'assets/images/' . rawurlencode($productImage);
                    ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="product-card">
                            <img src="<?= htmlspecialchars($productImageSrc) ?>"
                                class="product-image"
                                alt="<?= htmlspecialchars($product['product_name']) ?>">

                            <div class="product-content">
                                <p class="product-category"><?= htmlspecialchars($product['category']) ?></p>
                                <h5><?= htmlspecialchars($product['product_name']) ?></h5>
                                <h4 class="product-price">PHP <?= number_format($product['price'], 2) ?></h4>

                                <form method="POST" action="../process/add_to_cart.php">
                                    <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                                    <button type="submit" class="btn btn-register w-100">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
</main>

<?php require("../includes/footer.php"); ?>
