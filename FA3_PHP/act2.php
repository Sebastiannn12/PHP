<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="act2.css">
    <title>Activity 2 - Array Operations</title>

</head>

<body>

    <div class="header-container">
        <h2>Activity 2: Array Operations Calculator</h2>
        <a href="index.php" class="home-btn">← Home</a>
    </div>

    <?php
    $numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

    $sum = array_sum($numbers);

    $difference = $numbers[0];
    for ($i = 1; $i < count($numbers); $i++) {
        $difference -= $numbers[$i];
    }

    $product = array_product($numbers);

    $quotient = $numbers[0];
    for ($i = 1; $i < count($numbers); $i++) {
        if ($numbers[$i] != 0) {
            $quotient /= $numbers[$i];
        }
    }
    ?>

    <p><strong>Array list:</strong> <?php echo implode(', ', $numbers); ?></p>

    <table>
        <tr>
            <th>Operation</th>
            <th>Result</th>
        </tr>
        <tr>
            <td><strong>Addition</strong></td>
            <td><?php echo $sum; ?></td>
        </tr>
        <tr>
            <td><strong>Subtraction</strong></td>
            <td><?php echo $difference; ?></td>
        </tr>
        <tr>
            <td><strong>Multiplication</strong></td>
            <td><?php echo $product; ?></td>
        </tr>
        <tr>
            <td><strong>Division</strong></td>
            <td><?php echo $quotient; ?></td>
        </tr>
    </table>

</body>

</html>