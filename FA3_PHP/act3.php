<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="act3.css">
    <title>Activity 3 - User Defined Function</title>

</head>

<body>

    <div class="header-container">
        <h2>Activity 3: User Defined Function</h2>
        <a href="index.php" class="home-btn">← Home</a>
    </div>

    <?php
    function calculate_three_parameters($p1, $p2, $p3)
    {
        $add = $p1 + $p2 + $p3;
        $sub = $p1 - $p2 - $p3;
        $mult = $p1 * $p2 * $p3;
        $div = ($p2 != 0 && $p3 != 0) ? ($p1 / $p2 / $p3) : "Undefined (Division by Zero)";

        echo "<p><strong>My Parameter values:</strong> $p1, $p2, $p3</p>";
        echo "<table>";
        echo "<tr><th>Operation</th><th>Result</th></tr>";
        echo "<tr><td><strong>Addition</strong></td><td>$add</td></tr>";
        echo "<tr><td><strong>Subtraction</strong></td><td>$sub</td></tr>";
        echo "<tr><td><strong>Multiplication</strong></td><td>$mult</td></tr>";
        echo "<tr><td><strong>Division</strong></td><td>$div</td></tr>";
        echo "</table>";
    }

    calculate_three_parameters(25, 13, 6);
    ?>

</body>

</html>