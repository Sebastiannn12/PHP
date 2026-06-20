<?php require('header.php'); ?>

<div class="container">
    <div class="header-container">
        <h2>Volume of Shapes</h2>
        <a href="index.php" class="home-btn">← Back to Dashboard</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Shape Target</th>
                <th>Values Provided</th>
                <th>Formula</th>
                <th style="color: var(--accent-neon);">Computed Answer</th>
            </tr>
        </thead>
        <tbody>
            <?php

            function getCubeVolume($s)
            {
                return pow($s, 3);
            }
            echo "<tr><td><strong>Cube</strong></td><td>Side (s) = 5</td><td>v = s³</td><td><strong>" . getCubeVolume(5) . "</strong></td></tr>";

            function getRectPrismVolume($l, $w, $h)
            {
                return $l * $w * $h;
            }
            echo "<tr><td><strong>Right Rectangular Prism</strong></td><td>l = 4, w = 3, h = 6</td><td>v = l × w × h</td><td><strong>" . getRectPrismVolume(4, 3, 6) . "</strong></td></tr>";

            function getCylinderVolume($r, $h)
            {
                return round(pi() * pow($r, 2) * $h, 2);
            }
            echo "<tr><td><strong>Cylinder</strong></td><td>Radius (r) = 3, h = 7</td><td>v = π × r² × h</td><td><strong>" . getCylinderVolume(3, 7) . "</strong></td></tr>";

            function getConeVolume($r, $h)
            {
                return round((1 / 3) * pi() * pow($r, 2) * $h, 2);
            }
            echo "<tr><td><strong>Cone / Pyramid</strong></td><td>Radius (r) = 3, h = 9</td><td>v = (1/3) × π × r² × h</td><td><strong>" . getConeVolume(3, 9) . "</strong></td></tr>";

            function getSphereVolume($r)
            {
                return round((4 / 3) * pi() * pow($r, 3), 2);
            }
            echo "<tr><td><strong>Sphere</strong></td><td>Radius (r) = 4</td><td>v = (4/3) × π × r³</td><td><strong>" . getSphereVolume(4) . "</strong></td></tr>";
            ?>
        </tbody>
    </table>
</div>

<?php require('footer.php'); ?>