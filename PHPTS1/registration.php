<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Student Registration Form</title>
</head>

<body>

    <div class="container">

        <h1>Student Registration Form</h1>
        
        <a href="index.php" class="nav-home">← Back to Home</a>

        <?php
        $full_name = "Francis Sebastian Pertudo";
        $birthday = "2005-10-26";
        $gender = "Male";
        $current_school = "FEU Tech - Institute of Technology";
        $program = "BS Information Technology Web and Mobile Applications";
        $expected_graduation = "2028";
        $previous_school = "SCPS - Senior High School";
        ?>

        <form action="" method="post">

            <div class="section-title">
                Student Information
            </div>

            <div class="row">
                <div class="form-group">
                    <label>Full Legal Name</label>
                    <input type="text" name="full_name" value="<?= $full_name; ?>">
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label>Birthday</label>
                    <input type="date" name="birthday" value="<?= $birthday; ?>">
                </div>

                <div class="form-group">
                    <label>Gender</label>
                    <select name="gender">
                        <option value="Male" <?= ($gender == "Male") ? "selected" : ""; ?>>Male</option>
                        <option value="Female" <?= ($gender == "Female") ? "selected" : ""; ?>>Female</option>
                    </select>
                </div>
            </div>

            <div class="section-title">
                Educational Attainment
            </div>

            <div class="row">
                <div class="form-group">
                    <label>Current School</label>
                    <input type="text" name="current_school" value="<?= $current_school; ?>">
                </div>

                <div class="form-group">
                    <label>Program / Course</label>
                    <input type="text" name="program" value="<?= $program; ?>">
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label>Expected Graduation Year</label>
                    <input type="text" name="expected_graduation" value="<?= $expected_graduation; ?>">
                </div>

                <div class="form-group">
                    <label>Previous School</label>
                    <input type="text" name="previous_school" value="<?= $previous_school; ?>">
                </div>
            </div>

            <button type="submit" name="register" class="btn">
                Register Student
            </button>

        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])): ?>
            <div class="section-title">
                Registered Student Summary
            </div>

            <div class="row">
                <div class="form-group">
                    <label>Formatted Full Name</label>
                    <input type="text" readonly value="<?php echo ucwords(strtolower(trim($full_name))); ?>">
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label>Birthday</label>
                    <input type="text" readonly value="<?php echo $birthday; ?>">
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <input type="text" readonly value="<?php echo $gender; ?>">
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label>Current Institution</label>
                    <input type="text" readonly value="<?php echo ucwords(strtolower(trim($current_school))); ?>">
                </div>
                <div class="form-group">
                    <label>Degree / Program</label>
                    <input type="text" readonly value="<?php echo strtoupper(trim($program)); ?>">
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label>Expected Graduation</label>
                    <input type="text" readonly value="<?php echo intval($expected_graduation); ?>">
                </div>
                <div class="form-group">
                    <label>Previous Institution</label>
                    <input type="text" readonly value="<?php echo ucwords(strtolower(trim($previous_school))); ?>">
                </div>
            </div>
        <?php endif; ?>

    </div>

</body>

</html>