<?php

include "dogdb.php";

if(isset($_POST['save'])){

    $name = $_POST['name'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $color = $_POST['color'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];

    $sql = "INSERT INTO dogs
    (name,breed,age,address,color,height,weight)

    VALUES

    ('$name','$breed','$age','$address','$color','$height','$weight')";

    if(mysqli_query($conn,$sql)){
        header("Location: DogRegister.php?success=1");
        exit();
    }else{
        echo "Error: ".mysqli_error($conn);
    }

}
