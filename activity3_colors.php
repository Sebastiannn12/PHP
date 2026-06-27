<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Favorite Colors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }

        .card {
            border-radius: 12px;
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow">
                    <div class="card-body">

                        <h4 class="text-center mb-3">Enter Your Favorite Colors</h4>

                        <form action="resultColors.php" method="post">

                            <input type="text" name="color1" class="form-control mb-2" placeholder="Favorite Color 1">
                            <input type="text" name="color2" class="form-control mb-2" placeholder="Favorite Color 2">
                            <input type="text" name="color3" class="form-control mb-2" placeholder="Favorite Color 3">
                            <input type="text" name="color4" class="form-control mb-2" placeholder="Favorite Color 4">
                            <input type="text" name="color5" class="form-control mb-3" placeholder="Favorite Color 5">

                            <div class="text-center">
                                <button name="submit" class="btn btn-dark">Send Colors</button>
                                <a href="index.php" class="btn btn-secondary ms-2">Back</a>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>