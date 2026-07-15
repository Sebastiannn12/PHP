<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['user_id']);
$userName = $_SESSION['user_name'] ?? 'Customer';
$userRole = $_SESSION['user_role'] ?? 'guest';
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encore Music Store</title>

    <!-- Links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300..800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="<?= $basepath ?>assets/css/components.css">
    <link rel="stylesheet" href="<?= $basepath ?>assets/css/index.css">
    <link rel="stylesheet" href="<?= $basepath ?>assets/css/store.css">
    <?php if ($pagetitle === 'Profile'): ?>
        <link rel="stylesheet" href="<?= $basepath ?>assets/css/profile.css">
    <?php endif; ?>
</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a href="<?= $basepath ?>index.php" class="navbar-brand">
                <img src="<?= $basepath ?>assets/images/LOGOS.png" class="brand-logo" alt="Encore Music Store logo">
                <span>Encore</span>
            </a>

            <button class="navbar-toggler"
                type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon">

                </span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a href="<?= $basepath ?>index.php" class="nav-link <?= $pagetitle === 'Home' ? 'active' : '' ?>"> Home </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= $basepath ?>buyer/store.php" class="nav-link <?= $pagetitle === 'Store' ? 'active' : '' ?>"> Store </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= $basepath ?>about.php" class="nav-link <?= $pagetitle === 'About' ? 'active' : '' ?>"> About </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= $basepath ?>cart.php" class="nav-link <?= $pagetitle === 'Cart' ? 'active' : '' ?>">
                            <i class="bi bi-bag"></i> Cart
                        </a>
                    </li>

                    <?php if ($isLoggedIn && $userRole === 'buyer'): ?>
                        <li class="nav-item">
                            <a href="<?= $basepath ?>orders.php" class="nav-link <?= $pagetitle === 'Orders' ? 'active' : '' ?>">Orders</a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= $basepath ?>profile.php" class="nav-link <?= $pagetitle === 'Profile' ? 'active' : '' ?>">Profile</a>
                        </li>

                        <li class="nav-item">
                            <span class="nav-link nav-user">Hi, <?= $userName ?></span>
                        </li>

                        <li class="nav-item">
                            <a href="<?= $basepath ?>logout.php" class="nav-link">Logout</a>
                        </li>
                    <?php elseif ($isLoggedIn && $userRole === 'seller'): ?>
                        <li class="nav-item">
                            <a href="<?= $basepath ?>seller/dashboard.php" class="nav-link">Seller Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= $basepath ?>logout.php" class="nav-link">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="<?= $basepath ?>login.php" class="nav-link <?= $pagetitle === 'Login' ? 'active' : '' ?>">Login</a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= $basepath ?>signup.php" class="btn btn-register ms-lg-2 px-3">Sign Up</a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>
