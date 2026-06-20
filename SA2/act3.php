<?php require('header.php'); ?>

<div class="container">
    <div class="header-container">
        <h2>    Student Resume</h2>
        <a href="index.php" class="home-btn">← Back to Dashboard</a>
    </div>

    <div class="resume-container">


        <div class="top-section">
            <div class="avatar-box">
                <img src="https://a.espncdn.com/i/headshots/nba/players/full/1966.png" alt="Profile Headshot"
                    class="avatar-img">
            </div>


            <div class="info-box">
                <?php

                $page = isset($_GET['page']) ? $_GET['page'] : 'personal';


                $allowed_pages = ['personal', 'objective', 'education', 'skills', 'affiliation', 'experience'];

                if (in_array($page, $allowed_pages)) {

                    $file_to_load = 'resume_' . $page . '.php';

                    if (file_exists($file_to_load)) {
                        include($file_to_load);
                    } else {
                        echo "<p style='color:red;'>Error: Fragment file missing.</p>";
                    }
                } else {
                    echo "<p style='color:red;'>Invalid section requested.</p>";
                }
                ?>
            </div>
        </div>


        <a href="act3.php?page=personal" class="nav-drop-btn <?php echo ($page == 'personal') ? 'active-btn' : ''; ?>">
            • Personal Information Page
        </a>

        <a href="act3.php?page=objective"
            class="nav-drop-btn <?php echo ($page == 'objective') ? 'active-btn' : ''; ?>">
            • Career Objective
        </a>

        <a href="act3.php?page=education"
            class="nav-drop-btn <?php echo ($page == 'education') ? 'active-btn' : ''; ?>">
            • Educational Attainment page
        </a>

        <a href="act3.php?page=skills" class="nav-drop-btn <?php echo ($page == 'skills') ? 'active-btn' : ''; ?>">
            • Skills page
        </a>

        <a href="act3.php?page=affiliation"
            class="nav-drop-btn <?php echo ($page == 'affiliation') ? 'active-btn' : ''; ?>">
            • Affiliation page
        </a>

        <a href="act3.php?page=experience"
            class="nav-drop-btn <?php echo ($page == 'experience') ? 'active-btn' : ''; ?>">
            • Work Experience Page
        </a>

    </div>
</div>

<?php require('footer.php'); ?>