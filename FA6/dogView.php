<?php
include "dogdb.php";

$sql = "SELECT * FROM dogs";
$result = mysqli_query($conn, $sql);

$count = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dog Information</title>

    <link rel="stylesheet" href="dogView.css">
</head>

<body>

<div class="container">

    <div class="button-row top-row">
        <a href="#" class="btn secondary-btn" onclick="history.back(); return false;">Go Back</a>
    </div>

    <h2>Dog Information</h2>

    <div class="dog-grid">

    <?php while($row = mysqli_fetch_assoc($result)){ ?>

        <div class="dog-card">

            <h3>Dog <?php echo $count++; ?></h3>

            <p><strong>Name</strong><br><?php echo $row['name']; ?></p>

            <p><strong>Breed</strong><br><?php echo $row['breed']; ?></p>

            <p><strong>Age</strong><br><?php echo $row['age']; ?></p>

            <p><strong>Address</strong><br><?php echo $row['address']; ?></p>

            <p><strong>Color</strong><br><?php echo $row['color']; ?></p>

            <p><strong>Height</strong><br><?php echo $row['height']; ?></p>

            <p><strong>Weight</strong><br><?php echo $row['weight']; ?></p>

        </div>

    <?php } ?>

    </div>

    <div class="button-row">
        <a href="DogRegister.php" class="btn">Add New Dog</a>
    </div>

</div>

</body>
</html>