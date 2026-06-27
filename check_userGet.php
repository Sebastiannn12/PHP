<?php
$firstname   = $_GET['firstname'];
$middlename  = $_GET['middlename'];
$lastname    = $_GET['lastname'];
$dateofbirth = $_GET['dateofbirth'];
$address     = $_GET['address'];
?>

<div class="output-box mt-4">
    <h5 class="mb-3">Submitted Data</h5>

    <div class="data-row">
        <span class="label">First Name</span>
        <span class="value"><?php echo $firstname; ?></span>
    </div>

    <div class="data-row">
        <span class="label">Middle Name</span>
        <span class="value"><?php echo $middlename; ?></span>
    </div>

    <div class="data-row">
        <span class="label">Last Name</span>
        <span class="value"><?php echo $lastname; ?></span>
    </div>

    <div class="data-row">
        <span class="label">Date of Birth</span>
        <span class="value"><?php echo $dateofbirth; ?></span>
    </div>

    <div class="data-row">
        <span class="label">Address</span>
        <span class="value"><?php echo $address; ?></span>
    </div>
</div>
``
