<?php require("header.php") ?>

<!-- div.container>div.header-container>h2+a[href="index.php"].home-btn
 table>thead>tr>th*4^^tbody>tr>td*4
-->
<div class="container">
    <div class="header-container">
        <h2>Mga Prutas</h2>
        <a href="index.php" class="home-btn">Back To Dashboard</a>
    </div>

    <?php

    $fruits = [

        ["name" => "Banana", "image" => " ", "desc" => "Color Yellow", "facts" => "Likes by monkey"],
        ["name" => "Apple", "image" => " ", "desc" => "Color Greem / Red", "facts" => "makes the doctors away"],
        ["name" => "Orange", "image" => " ", "desc" => "Color Orange / Green", "facts" => "Good for vitamin c"],
        ["name" => "Grapes", "image" => " ", "desc" => "Color Greem / Violet / Red", "facts" => "Grapes are packed with powerful plant compounds known as antioxidants."],
        ["name" => "Watermelon", "image" => " ", "desc" => "Color Greem", "facts" => "Watermelon is about 92% water, making it extremely hydrating to consume."],

    ];
    usort($fruits, function ($a, $b) {
        return strcmp($a['name'], $b['name']);
    });
    ?>

    <table>
        <thead>
            <tr>
                <th style="width: 15%; text-align: center;">Display</th>
                <th style="width: 15%">Name</th>
                <th style="width: 20%">Description</th>
                <th style="width: 50%">Facts</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fruits as $fruits): ?>
                <tr>
                    <td><img src=" <?php echo $fruits['image']; ?>" alt="Fruit" class="fruit-image"> </td>
                    <td><strong style="color: var(--accent-glow); font-size: 1.1em;"><?= $fruits['name']; ?>  </strong></td>
                    <td><?= $fruits['desc'] ?></td>
                    <td><?= $fruits['facts'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>





<?php require('footer.php') ?>