<!DOCTYPE html>
<html>

<head>
    <title>Dog Information</title>
    <link rel="stylesheet" href="dogRegister.css">
</head>

<body>

<div class="container">

<?php if(isset($_GET['success']) && $_GET['success'] == 1){ ?>

    <div class="notification success" style="border:1px solid #4CAF50;padding:12px;margin-bottom:16px;background:#e8f5e9;">
        <span>Dog registered successfully.</span>
    </div>

<?php } ?>

<div class="button-row top-row">
    <button type="button" class="secondary-btn" onclick="history.back();">Back</button>
</div>

<h2>Dog Information</h2>

<form action="managingDog_form.php" method="POST">

<label>Name</label>
<input type="text" name="name" required>

<label>Breed</label>
<input type="text" name="breed" required>

<label>Age</label>
<input type="text" name="age" required>

<label>Address</label>
<input type="text" name="address" required>

<label>Color</label>
<input type="text" name="color" required>

<label>Height</label>
<input type="text" name="height" required>

<label>Weight</label>
<input type="text" name="weight" required>

<button type="submit" name="save">Save</button>

</form>

</div>

</body>
</html>