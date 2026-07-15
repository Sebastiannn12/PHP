<?php
require_once(__DIR__ . '/../config/database.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function ensure_schema($conn)
{
    $profile_image_column = mysqli_query($conn, "SHOW COLUMNS FROM users LIKE 'profile_image'");
    if ($profile_image_column && mysqli_num_rows($profile_image_column) === 0) {
        mysqli_query($conn, "ALTER TABLE users ADD profile_image VARCHAR(255) DEFAULT NULL AFTER contact_number");
    }

    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS categories (
        category_id INT AUTO_INCREMENT PRIMARY KEY,
        category_name VARCHAR(100) NOT NULL UNIQUE,
        category_description TEXT DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    mysqli_query($conn, "INSERT IGNORE INTO categories (category_name, category_description) VALUES
        ('Audio Equipment', 'Microphones, speakers, headphones and accessories'),
        ('Bass Guitar', 'Electric and acoustic bass guitars for rhythm and performance'),
        ('Drums', 'Acoustic and electronic drum sets'),
        ('Guitar', 'Acoustic and electric guitars'),
        ('Keyboards', 'Digital pianos and keyboards')");

    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS products (
        product_id INT AUTO_INCREMENT PRIMARY KEY,
        product_name VARCHAR(150) NOT NULL,
        category VARCHAR(100) NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        stock INT NOT NULL DEFAULT 0,
        image VARCHAR(255) DEFAULT NULL,
        status VARCHAR(30) NOT NULL DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS audit_logs (
        log_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NULL,
        user_name VARCHAR(150) NOT NULL,
        role VARCHAR(50) NOT NULL,
        activity VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS orders (
        order_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        full_name VARCHAR(150) NOT NULL,
        address TEXT NOT NULL,
        contact_number VARCHAR(50) NOT NULL,
        total_amount DECIMAL(10,2) NOT NULL,
        payment_method VARCHAR(100) DEFAULT NULL,
        status VARCHAR(50) NOT NULL DEFAULT 'Pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS order_items (
        item_id INT AUTO_INCREMENT PRIMARY KEY,
        order_id INT NOT NULL,
        product_id INT NOT NULL,
        product_name VARCHAR(150) NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        quantity INT NOT NULL
    )");

    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS password_resets (
        reset_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        token_hash CHAR(64) NOT NULL UNIQUE,
        expires_at DATETIME NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX (user_id),
        INDEX (expires_at)
    )");

    $count_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM products");
    $count_row = mysqli_fetch_assoc($count_result);

    if ((int)$count_row['total'] === 0) {
        mysqli_query($conn, "INSERT INTO products (product_name, category, price, stock, image) VALUES
            ('Yamaha F310', 'Guitar', 9990.00, 12, 'yamaha310.jpg'),
            ('Roland FP Series', 'Keyboards', 34990.00, 7, 'roland.jpg'),
            ('Encore Studio Electric', 'Guitar', 18490.00, 10, 'electricG.jpg'),
            ('Classic Stage Guitar', 'Guitar', 15750.00, 8, 'guitar1.jpg')");
    }
}

function current_user_id()
{
    return $_SESSION['user_id'] ?? null;
}

function current_user_role()
{
    return $_SESSION['user_role'] ?? 'guest';
}

function current_user_name()
{
    return $_SESSION['user_name'] ?? 'Guest';
}

function is_logged_in()
{
    return isset($_SESSION['user_id']);
}

function is_buyer()
{
    return is_logged_in() && current_user_role() === 'buyer';
}

function is_seller()
{
    return is_logged_in() && current_user_role() === 'seller';
}

function verify_user_password($plain_password, $stored_password)
{
    $password_info = password_get_info($stored_password);

    if (!empty($password_info['algo'])) {
        return password_verify($plain_password, $stored_password);
    }

    // Supports accounts created before password hashing was introduced.
    return hash_equals((string)$stored_password, (string)$plain_password);
}

function require_guest()
{
    if (is_seller()) {
        header('Location: seller/dashboard.php');
        exit;
    }

    if (is_buyer()) {
        header('Location: buyer/store.php');
        exit;
    }
}

function require_buyer()
{
    if (!is_buyer()) {
        header('Location: login.php');
        exit;
    }
}

function require_seller()
{
    if (!is_seller()) {
        header('Location: ../login.php');
        exit;
    }
}

function log_activity($conn, $activity)
{
    $user_id = current_user_id();
    $user_name = current_user_name();
    $role = current_user_role();

    $stmt = mysqli_prepare($conn, "INSERT INTO audit_logs (user_id, user_name, role, activity) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "isss", $user_id, $user_name, $role, $activity);
    mysqli_stmt_execute($stmt);
}

ensure_schema($conn);
?>
