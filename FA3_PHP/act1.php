<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="act1.css">
    <title>Activity 1 - Profile Array</title>

</head>
<body>

    <div class="header-container">
        <h2>Activity 1: Sorted Profiles Table</h2>
        <a href="index.php" class="home-btn">← Home</a>
    </div>

    <?php
    $profiles = [
        ["name" => "Alice Smith", "image" => "https://picsum.photos/id/1025/50/50", "age" => 21, "birthday" => "2005-04-12", "contact" => "09123456781"],
        ["name" => "John Doe", "image" => "https://picsum.photos/id/64/50/50", "age" => 23, "birthday" => "2003-11-22", "contact" => "09123456782"],
        ["name" => "Zack Wright", "image" => "https://picsum.photos/id/91/50/50", "age" => 22, "birthday" => "2004-01-15", "contact" => "09123456783"],
        ["name" => "Elena Gilbert", "image" => "https://picsum.photos/id/338/50/50", "age" => 20, "birthday" => "2006-07-09", "contact" => "09123456784"],
        ["name" => "Bob Jones", "image" => "https://picsum.photos/id/447/50/50", "age" => 25, "birthday" => "2001-09-30", "contact" => "09123456785"],
        ["name" => "Charlie Brown", "image" => "https://picsum.photos/id/577/50/50", "age" => 19, "birthday" => "2007-03-18", "contact" => "09123456786"],
        ["name" => "Fiona Gallagher", "image" => "https://picsum.photos/id/669/50/50", "age" => 24, "birthday" => "2002-05-25", "contact" => "09123456787"],
        ["name" => "Diana Prince", "image" => "https://picsum.photos/id/823/50/50", "age" => 26, "birthday" => "2000-12-05", "contact" => "09123456788"],
        ["name" => "Bruce Wayne", "image" => "https://picsum.photos/id/1062/50/50", "age" => 28, "birthday" => "1998-02-19", "contact" => "09123456789"],
        ["name" => "Kevin Malone", "image" => "https://picsum.photos/id/1074/50/50", "age" => 27, "birthday" => "1999-06-01", "contact" => "09123456790"]
    ];

    usort($profiles, function($a, $b) {
        return strcmp($a['name'], $b['name']);
    });
    ?>

    <table>
        <thead>
            <tr>
                <th>no.</th>
                <th>name</th>
                <th>Image</th>
                <th>age</th>
                <th>birthday</th>
                <th>contact number</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $count = 1;
            foreach ($profiles as $profile): 
            ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $profile['name']; ?></td>
                <td><img src="<?php echo $profile['image']; ?>" alt="Profile Picture" class="profile-img"></td>
                <td><?php echo $profile['age']; ?></td>
                <td><?php echo $profile['birthday']; ?></td>
                <td><?php echo $profile['contact']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>