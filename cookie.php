<?php

if (isset($_POST['submit'])) {


    $first = 'Francis';
    $middle = 'Advincula';
    $last = 'Pertudo';


    setcookie("firstname", $first, time() + 10, "/");
    setcookie("middlename", $middle, time() + 20, "/");
    setcookie("lastname", $last, time() + 30, "/");


    header("Location: activity2_cookie.php");
    exit();
}
?>
