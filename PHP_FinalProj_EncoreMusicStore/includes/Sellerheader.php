<?php
require_once(__DIR__ . '/auth.php');
require_seller();

$sellerName = current_user_name();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pagetitle ?> | Encore Seller</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300..800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/seller.css">
</head>

<body>
    <nav class="seller-navbar">
        <a href="dashboard.php" class="seller-brand">
            <img src="../assets/images/LOGOS.png" class="seller-logo" alt="Encore Music Store logo">
            <span>Encore Seller</span>
        </a>

        <div class="seller-nav-links">
            <a href="dashboard.php" class="<?= $pagetitle === 'Dashboard' ? 'active' : '' ?>">Dashboard</a>
            <a href="users.php" class="<?= $pagetitle === 'Users' ? 'active' : '' ?>">Users</a>
            <a href="stocks.php" class="<?= $pagetitle === 'Stocks' ? 'active' : '' ?>">Stocks</a>
            <a href="reports.php" class="<?= $pagetitle === 'Reports' ? 'active' : '' ?>">Reports</a>
            <a href="profile.php" class="<?= $pagetitle === 'Profile' ? 'active' : '' ?>">Profile</a>
            <span class="seller-name">Hi, <?= $sellerName ?></span>
            <a href="../logout.php">Logout</a>
        </div>
    </nav>
