<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: a_login.php");
    exit();
}

$pageTitle = "Activity A Home";
$headerLabel = "Activity A";
$headerTitle = "Home Page";

require "includes/header.php";
?>

<main class="container my-5">
    <section class="card form-card mx-auto">
        <div class="card-body p-4 p-md-5 text-center">
            <p class="section-tag mb-2">Active Session</p>
            <h2 class="display-5 fw-bold">Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h2>
            <p class="text-secondary mb-0">You are logged in temporary.</p>

            <div class="mt-4">
                <a class="btn custom-primary-btn" href="a_logout.php">Logout</a>
            </div>
        </div>
    </section>
</main>

<?php require "includes/footer.php"; ?>
