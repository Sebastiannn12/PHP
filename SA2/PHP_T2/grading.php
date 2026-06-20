<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Grade Ranking Program</title>
    <link rel="stylesheet" href="grading.css">
</head>

<body>
    <div class="nav-bar">
        <a href="index.php" class="home-btn">Home</a>
    </div>


    <?php

    $name = "Francis";
    $grade = 99;


    if ($grade >= 93) {
        $rank = "A";
    } elseif ($grade >= 90) {
        $rank = "A-";
    } elseif ($grade >= 87) {
        $rank = "B+";
    } elseif ($grade >= 83) {
        $rank = "B";
    } elseif ($grade >= 80) {
        $rank = "B-";
    } elseif ($grade >= 77) {
        $rank = "C+";
    } elseif ($grade >= 73) {
        $rank = "C";
    } elseif ($grade >= 70) {
        $rank = "C-";
    } elseif ($grade >= 67) {
        $rank = "D+";
    } elseif ($grade >= 63) {
        $rank = "D";
    } elseif ($grade >= 60) {
        $rank = "D-";
    } else {
        $rank = "F";
    }

    $image = ($grade >= 75) ? "happy.png" : "sad.png";
    ?>

    <div class="outer">

        <div class="name-box">
            Name: <?= $name ?>
        </div>

        <div class="middle">

            <div class="small-box">
                Rank<br><br>
                <strong><?= $rank ?></strong>
            </div>

            <div class="small-box">
                Grade<br><br>
                <strong><?= $grade ?></strong>
            </div>

            <div class="picture-box">
                <img src="<?= $image ?>" class="result-img" alt="Result Image">
            </div>

        </div>

    </div>

</body>

</html>