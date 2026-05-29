<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Looping</title>
    <link rel="stylesheet" href="looping.css">
</head>

<body>

    <div class="nav-bar">
        <a href="index.php" class="home-btn">Home</a>
    </div>


    <div class="container">
        <h1>Two-Digit Decimal Combinations</h1>

        <div class="output">
            <?php

            for ($i = 0; $i <= 9; $i++) {
                for ($j = 0; $j <= 9; $j++) {
                    echo $i . $j . ", ";
                }
            }
            ?>
        </div>
    </div>

</body>

</html>