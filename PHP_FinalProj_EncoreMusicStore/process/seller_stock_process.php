<?php
require_once('../includes/auth.php');
require_seller();

$product_id = (int)($_POST['product_id'] ?? 0);
$product_name = trim($_POST['product_name'] ?? '');
$category = trim($_POST['category'] ?? '');
$price = (float)($_POST['price'] ?? 0);
$stock = (int)($_POST['stock'] ?? 0);
$image = '';
$status = $_POST['status'] ?? 'active';

if ($product_id > 0) {
    $current_image_stmt = mysqli_prepare($conn, "SELECT image FROM products WHERE product_id = ?");
    mysqli_stmt_bind_param($current_image_stmt, "i", $product_id);
    mysqli_stmt_execute($current_image_stmt);
    $current_product = mysqli_fetch_assoc(mysqli_stmt_get_result($current_image_stmt));
    $image = $current_product['image'] ?? '';
}

if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] !== UPLOAD_ERR_NO_FILE) {
    $uploaded_file = $_FILES['product_image'];

    if ($uploaded_file['error'] !== UPLOAD_ERR_OK) {
        header('Location: ../seller/stocks.php?error=upload');
        exit;
    }

    if ($uploaded_file['size'] > 5 * 1024 * 1024) {
        header('Location: ../seller/stocks.php?error=size');
        exit;
    }

    $allowed_types = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
    ];
    $file_info = new finfo(FILEINFO_MIME_TYPE);
    $mime_type = $file_info->file($uploaded_file['tmp_name']);

    if (!isset($allowed_types[$mime_type])) {
        header('Location: ../seller/stocks.php?error=type');
        exit;
    }

    $upload_directory = __DIR__ . '/../uploads/products';
    if (!is_dir($upload_directory) && !mkdir($upload_directory, 0755, true)) {
        header('Location: ../seller/stocks.php?error=upload');
        exit;
    }

    $image = 'product-' . bin2hex(random_bytes(10)) . '.' . $allowed_types[$mime_type];
    if (!move_uploaded_file($uploaded_file['tmp_name'], $upload_directory . DIRECTORY_SEPARATOR . $image)) {
        header('Location: ../seller/stocks.php?error=upload');
        exit;
    }
}

if ($product_id === 0 && $image === '') {
    header('Location: ../seller/stocks.php?error=upload');
    exit;
}

if ($product_id > 0) {
    $stmt = mysqli_prepare($conn, "UPDATE products SET product_name=?, category=?, price=?, stock=?, image=?, status=? WHERE product_id=?");
    mysqli_stmt_bind_param($stmt, "ssdissi", $product_name, $category, $price, $stock, $image, $status, $product_id);
    mysqli_stmt_execute($stmt);
    log_activity($conn, 'Modified stock item: ' . $product_name);
} else {
    $stmt = mysqli_prepare($conn, "INSERT INTO products (product_name, category, price, stock, image, status) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssdiss", $product_name, $category, $price, $stock, $image, $status);
    mysqli_stmt_execute($stmt);
    log_activity($conn, 'Added stock item: ' . $product_name);
}

header('Location: ../seller/stocks.php');
exit;
?>
