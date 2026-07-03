<?php
session_start();

if (isset($_SESSION["username"])) {
    header("Location: home.php");
    exit();
}

$pageTitle = "PHP TSA3 - Activities";
$headerLabel = "PHP TSA3";
$headerTitle = "Technical Summative Assessment 3";

require "includes/header.php";
?>

    <main class="container my-5">
        <section class="text-center mx-auto mb-4 intro-section">
            <p class="section-tag mb-2">Activity Selection</p>
            <h2 class="display-5 fw-bold">Choose the activity you want to open</h2>
        </section>

        <section class="row g-4 mx-auto activity-list" aria-label="Activity links">
            <div class="col-md-6">
                <div class="card activity-card h-100">
                    <div class="card-body d-flex flex-column gap-4 p-4">
                        <div class="d-flex align-items-center gap-3">
                            <span class="activity-letter d-flex align-items-center justify-content-center">A</span>
                            <div>
                                <h3 class="h4 fw-bold mb-2">Activity A</h3>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center gap-3 mt-auto">
                            <a class="btn custom-primary-btn" href="a_register.php">Register</a>
                            <a class="btn custom-outline-btn" href="a_login.php">Login</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card activity-card h-100">
                    <div class="card-body d-flex flex-column gap-4 p-4">
                        <div class="d-flex align-items-center gap-3">
                            <span class="activity-letter d-flex align-items-center justify-content-center">B</span>
                            <div>
                                <h3 class="h4 fw-bold mb-2">Activity B</h3>

                            </div>
                        </div>

                        <div class="d-flex justify-content-center gap-3 mt-auto">
                            <a class="btn custom-primary-btn" href="b_register.php">Register</a>
                            <a class="btn custom-outline-btn" href="b_login.php">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php require "includes/footer.php"; ?>
