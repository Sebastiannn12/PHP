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
    <section class="text-center mx-auto intro-section">
        <p class="section-tag mb-2">Active Session</p>
        <h2 class="display-5 fw-bold">Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h2>
        <a class="btn custom-primary-btn mt-5" href="logout.php">Logout</a>
    </section>
</main>

<?php require "includes/footer.php"; ?>