<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="getPost.css">
    <title>Activity 1</title>
</head>

<body>
    <div class="container py-5   vh-100">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h3>GET METHOD</h3>
                        <form action="" method="get" class="mb-3">
                            <div class="mb-3"><label for="firstname" class="form-label">First Name:
                                </label>
                                <input type="text" name="firstname" id="firstname" class="form-control">
                            </div>

                            <div class="mb-3"><label for="middlename" class="form-label">Middle Name:
                                </label>
                                <input type="text" name="middlename" id="middlename" class="form-control">
                            </div>

                            <div class="mb-3"><label for="lastname" class="form-label">Last Name:
                                </label>
                                <input type="text" name="lastname" id="lastname" class="form-control">
                            </div>

                            <div class="mb-3"><label for="dateofbirth" class="form-label">Date of Birth:
                                </label>
                                <input type="date" name="dateofbirth" id="dateofbirth" class="form-control">
                            </div>

                            <div class="mb-3"><label for="address" class="form-label">Address:
                                </label>
                                <input type="text" name="address" id="address" class="form-control">
                            </div>
                            <div class="text-center">
                                <button name="submit" class="btn btn-primary" type="submit">Submit</button>
                                <button type="button" class="btn btn-secondary ms-2" onclick="history.back()">Back</button>
                            </div>
                        </form>

                        <?php

                        if (
                            isset($_GET['submit']) &&
                            (!empty($_GET['firstname']) ||
                                !empty($_GET['middlename']) ||
                                !empty($_GET['lastname']) ||
                                !empty($_GET['dateofbirth']) ||
                                !empty($_GET['address']))
                        ) {
                            require('check_userGet.php');
                        }
                        ?>

                    </div>

                </div>
            </div>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>



</body>

</html>