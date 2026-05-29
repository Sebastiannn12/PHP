<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Measurement</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="nav-bar">
         <a href="index.php" class="home-btn">Home</a>
    </div>


    <div class="container">

        <?php
        $value = 1;


        $cm_to_mm = $value * 10;
        $dm_to_cm = $value * 10;
        $m_to_cm = $value * 100;
        $km_to_m = $value * 1000;


        $ft_to_in = $value * 12;
        $yd_to_ft = $value * 3;
        $ch_to_yd = $value * 22;
        $fur_to_yd = $value * 220;
        $mi_to_yd = $value * 1760;


        $mm_to_in = $value * 0.03937;
        $cm_to_in = $value * 0.39370;
        $m_to_in = $value * 39.37008;
        $m_to_ft = $value * 3.28084;
        $m_to_yd = $value * 1.09361;
        $km_to_yd = $value * 1093.6133;
        $km_to_mi = $value * 0.62137;


        $in_to_cm = $value * 2.54;
        $ft_to_cm = $value * 30.48;
        $yd_to_cm = $value * 91.44;
        $yd_to_m = $value * 0.9144;
        $mi_to_m = $value * 1609.344;
        $mi_to_km = $value * 1.609344;
        ?>

        <!-- METRIC CONVERSIONS -->
        <table>
            <tr>
                <th colspan="4">METRIC CONVERSIONS</th>
            </tr>
            <tr>
                <td><?= "$value centimetre"; ?></td>
                <td>= <?= "$cm_to_mm millimetres"; ?></td>
                <td>1 cm</td>
                <td>= 10 mm</td>
            </tr>
            <tr>
                <td><?= "$value decimetre"; ?></td>
                <td>= <?= "$dm_to_cm centimetres"; ?></td>
                <td>1 dm</td>
                <td>= 10 cm</td>
            </tr>
            <tr>
                <td><?= "$value metre"; ?></td>
                <td>= <?= "$m_to_cm centimetres"; ?></td>
                <td>1 m</td>
                <td>= 100 cm</td>
            </tr>
            <tr>
                <td><?= "$value kilometre"; ?></td>
                <td>= <?= "$km_to_m metres"; ?></td>
                <td>1 km</td>
                <td>= 1000 m</td>
            </tr>
        </table>

        <!-- IMPERIAL CONVERSIONS -->
        <table>
            <tr>
                <th colspan="4">IMPERIAL CONVERSIONS</th>
            </tr>
            <tr>
                <td><?= "$value foot"; ?></td>
                <td>= <?= "$ft_to_in inches"; ?></td>
                <td>1 ft</td>
                <td>= 12 in</td>
            </tr>
            <tr>
                <td><?= "$value yard"; ?></td>
                <td>= <?= "$yd_to_ft feet"; ?></td>
                <td>1 yd</td>
                <td>= 3 ft</td>
            </tr>
            <tr>
                <td><?= "$value chain"; ?></td>
                <td>= <?= "$ch_to_yd yards"; ?></td>
                <td>1 ch</td>
                <td>= 22 yd</td>
            </tr>
            <tr>
                <td><?= "$value furlong"; ?></td>
                <td>= <?= "$fur_to_yd yards"; ?></td>
                <td>1 fur</td>
                <td>= 220 yd</td>
            </tr>
            <tr>
                <td><?= "$value mile"; ?></td>
                <td>= <?= "$mi_to_yd yards"; ?></td>
                <td>1 mi</td>
                <td>= 1760 yd</td>
            </tr>
        </table>

        <!-- METRIC TO IMPERIAL -->
        <table>
            <tr>
                <th colspan="4">METRIC → IMPERIAL CONVERSIONS</th>
            </tr>
            <tr>
                <td><?= "$value mm"; ?></td>
                <td>= <?= "$mm_to_in inches"; ?></td>
                <td>1 mm</td>
                <td>= 0.03937 in</td>
            </tr>
            <tr>
                <td><?= "$value cm"; ?></td>
                <td>= <?= "$cm_to_in inches"; ?></td>
                <td>1 cm</td>
                <td>= 0.39370 in</td>
            </tr>
            <tr>
                <td><?= "$value m"; ?></td>
                <td>= <?= "$m_to_in inches"; ?></td>
                <td>1 m</td>
                <td>= 39.37008 in</td>
            </tr>
            <tr>
                <td><?= "$value m"; ?></td>
                <td>= <?= "$m_to_ft feet"; ?></td>
                <td>1 m</td>
                <td>= 3.28084 ft</td>
            </tr>
            <tr>
                <td><?= "$value m"; ?></td>
                <td>= <?= "$m_to_yd yards"; ?></td>
                <td>1 m</td>
                <td>= 1.09361 yd</td>
            </tr>
            <tr>
                <td><?= "$value km"; ?></td>
                <td>= <?= "$km_to_yd yards"; ?></td>
                <td>1 km</td>
                <td>= 1093.6133 yd</td>
            </tr>
            <tr>
                <td><?= "$value km"; ?></td>
                <td>= <?= "$km_to_mi miles"; ?></td>
                <td>1 km</td>
                <td>= 0.62137 mi</td>
            </tr>
        </table>

        <!-- IMPERIAL TO METRIC -->
        <table>
            <tr>
                <th colspan="4">IMPERIAL → METRIC CONVERSIONS</th>
            </tr>
            <tr>
                <td><?= "$value inch"; ?></td>
                <td>= <?= "$in_to_cm cm"; ?></td>
                <td>1 in</td>
                <td>= 2.54 cm</td>
            </tr>
            <tr>
                <td><?= "$value foot"; ?></td>
                <td>= <?= "$ft_to_cm cm"; ?></td>
                <td>1 ft</td>
                <td>= 30.48 cm</td>
            </tr>
            <tr>
                <td><?= "$value yard"; ?></td>
                <td>= <?= "$yd_to_cm cm"; ?></td>
                <td>1 yd</td>
                <td>= 91.44 cm</td>
            </tr>
            <tr>
                <td><?= "$value yard"; ?></td>
                <td>= <?= "$yd_to_m m"; ?></td>
                <td>1 yd</td>
                <td>= 0.9144 m</td>
            </tr>
            <tr>
                <td><?= "$value mile"; ?></td>
                <td>= <?= "$mi_to_m m"; ?></td>
                <td>1 mi</td>
                <td>= 1609.344 m</td>
            </tr>
            <tr>
                <td><?= "$value mile"; ?></td>
                <td>= <?= "$mi_to_km km"; ?></td>
                <td>1 mi</td>
                <td>= 1.609344 km</td>
            </tr>
        </table>

    </div>
</body>

</html>