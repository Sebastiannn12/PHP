<?php require 'multiheader.php'; ?>
        <?php
        for ($row = 0; $row <= 10; $row++) {
            echo "<tr>";

            for ($col = 0; $col <= 10; $col++) {

                $value = $row * $col;

                if (($row + $col) % 2 == 0) {
                    $color = "#66ffe8";
                } else {
                    $color = "#bee667";
                }

                echo "<td style='background-color:$color;'>$value</td>";
            }

            echo "</tr>";
        }
        ?>

<?php require 'multifooter.php'; ?>