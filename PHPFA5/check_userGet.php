<?php

$firstname   = $_GET['firstname'];
$middlename  = $_GET['middlename'];
$lastname    = $_GET['lastname'];
$dateofbirth = $_GET['dateofbirth'];
$address     = $_GET['address'];

echo '<div class="output-box mt-4">';
echo '<h5 class="mb-3">Submitted Data</h5>';

echo '<div class="data-row">
        <span class="label">First Name</span>
        <span class="value">' . $firstname . '</span>
      </div>';

echo '<div class="data-row">
        <span class="label">Middle Name</span>
        <span class="value">' . $middlename . '</span>
      </div>';

echo '<div class="data-row">
        <span class="label">Last Name</span>
        <span class="value">' . $lastname . '</span>
      </div>';

echo '<div class="data-row">
        <span class="label">Date of Birth</span>
        <span class="value">' . $dateofbirth . '</span>
      </div>';

echo '<div class="data-row">
        <span class="label">Address</span>
        <span class="value">' . $address . '</span>
      </div>';

echo '</div>';
?>
