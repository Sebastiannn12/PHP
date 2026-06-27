<?php
session_start();

if (isset($_POST['submit'])) {
    $_SESSION['colors'] = [
        $_POST['color1'],
        $_POST['color2'],
        $_POST['color3'],
        $_POST['color4'],
        $_POST['color5']
    ];
}

function isValidColor($color) {
    $validColors = [
        "red","blue","green","yellow","orange",
        "violet","purple","black","white","gray","pink","brown"
    ];

    return in_array(strtolower($color), $validColors);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Result Colors</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="activity3.css" rel="stylesheet">
</head>

<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-body">

                    <h4 class="text-center mb-4">My Favorite Colors</h4>

                    <?php if (isset($_SESSION['colors'])): ?>

                        <?php foreach ($_SESSION['colors'] as $index => $color): ?>

                            <p class="color-text">
                                My Favorite Color <?php echo $index + 1; ?>:
                                <?php if (!empty($color)):
                                    $safe = htmlspecialchars($color);
                                    if (isValidColor($color)):
                                      
                                        echo ' <span style="color:'. $safe .'; font-weight:700;">'. $safe .'</span>';
                                    else:
                                        
                                        echo ' <span class="text-danger">'. $safe .'</span>';
                                    endif;
                                else:
                                    echo ' <span class="text-muted">(no input)</span>';
                                endif; ?>
                            </p>

                        <?php endforeach; ?>

                    <?php endif; ?>

                    <div class="text-center mt-4">
                        <a href="activity3_colors.php" class="btn btn-dark">Back</a>
                        <a href="index.php" class="btn btn-secondary ms-2">Home</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
