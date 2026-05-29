<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume - <?php echo $name; ?></title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
<?php
$name = "PERTUDO, FRANCIS SEBASTIAN, A";
$address = "Sta. Martha ST, B-1 L-9, Burgos, Rodriguez Rizal";
$phone = "09473767307";
$email = "francissebastianpertudo12@gmail.com";

$objectives = "Dedicated IT professional seeking to enhance my technical expertise and operational efficiency within a fast-paced development team. Committed to developing competent, positive values and delivering high-quality technical work that supports the standard of excellence in the IT field.";

$educationCollege = "Far Eastern University - Alabang";
$educationSHS = "Sta. Cecilia Parochial School";

$skills = ["Time Management", "Creativity", "Good Communication", "Hardworking", "Teamwork", "Collaboration"];

$certifications = [
    ["title" => "Python", "year" => "2026 - 2031"],
    ["title" => "Java", "year" => "2025 - 2031"],
    ["title" => "HTML and CSS", "year" => "2025 - 2030"],
    ["title" => "JavaScript", "year" => "2026 - 2030"],
    ["title" => "Databases", "year" => "2025 - 2030"]
];
?>
<div class="resume-container">
    <header class="resume-header">
        <h1><?php echo $name; ?></h>
        <div class="contact-info">
            <p>📍 <?php echo $address; ?></p>
            <p>📞 <?php echo $phone; ?></p>
            <p>✉️ <?php echo $email; ?></p>
        </div>
    </header>

    <hr class="main-divider">

    <section class="section">
        <h2 class="section-title">OBJECTIVES</h2>
        <p class="objective-text"><?php echo $objectives; ?></p>
    </section>

    

<div class="two-column">
            <div class="column">
                <section class="section">
                    <h2 class="section-title">EDUCATION</h2>
                    <div class="entry">
                        <strong><?php echo $educationCollege; ?></strong>
                        <ul class="skills-list">
                            <li>Bachelor of Science in Information Technology with Specialization in Web and App Development</li>
                            <li><em>CCSMA's Consistent Dean's Lister</em></li>
                        </ul>
                        <div style="margin-top:15px;"></div>
                        <strong><?php echo $educationSHS; ?></strong>
                        <ul class="skills-list">
                            <li>Senior High School - STEM Strand (Consistent High Honor)</li>
                            <li>High School - (Consistent Honor Student)</li>
                        </ul>
                    </div>
                </section>
            </div>

            <div class="column">
                <section class="section">
                    <h2 class="section-title">CERTIFICATIONS</h2>
                    <?php foreach ($certifications as $cert): ?>
                        <div class="entry">
                            <strong><?php echo $cert['title']; ?></strong>
                            <p><b>Certiport:</b> <?php echo $cert['year']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </section>
            </div>
        </div> 

        <section class="section">
            <h2 class="section-title">WORK EXPERIENCE</h2>
            <div class="entry">
                <div class="entry-header" style="display: flex; justify-content: space-between;">
                    <strong>Local Government Unit - Pedicab Licensing Office under the City</strong>
                    
                </div>
                <ul class="skills-list">
                    <li>Managed and organized digital databases for licensing records to ensure efficient retrieval and data integrity.</li>
                    <li>Assisted in the systematic processing of applications, improving the speed of administrative workflows through technical support.</li>
                     <li>Collaborated with office staff to generate accurate reports and maintain high standards of public service documentation.</li>
                </ul>
            </div>
        </section>

        <section class="section">
            <h2 class="section-title">SKILLS</h2>
            <ul class="skills-list">
                <?php foreach ($skills as $skill) echo "<li>$skill</li>"; ?>
            </ul>
        </section>

                    

</body>
</html>