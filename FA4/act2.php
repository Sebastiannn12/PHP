<?php require 'header.php'; ?>

<h2>Laboratory Activity 2 - Creation of String Function Matrix</h2>
<p>Below is the matrix of 20 names processed dynamically through native string functions[cite: 1]:</p>

<table>
    <thead>
        <tr>
            <th>List of names</th>
            <th>Number of characters</th>
            <th>Uppercase first character</th>
            <th>Replace vowels with @</th>
            <th>Check position of character "a"</th>
            <th>Reverse name</th>
        </tr>
    </thead>
    <tbody>
        <?php

        $namesArray = [
            "chrisa", "benjamin", "alonzo", "mariane", "nathaniel", 
            "alexandra", "jonathan", "elizabeth", "gabriel", "katarina", 
            "timothy", "samuel", "valerie", "dominic", "roderick", 
            "adriana", "frederick", "sebastian", "juliana", "anthony"
        ];

        foreach ($namesArray as $name) {

            $charCount = strlen($name);
            
           
            $ucFirst = ucfirst($name);
            
         
            $vowels = ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'];
            $vowelReplace = str_replace($vowels, '@', $name);
            
      
            $posA = strpos($name, 'a');
            if ($posA === false) {
                $posDisplay = "Not Found";
            } else {
                $posDisplay = $posA;
            }
        
            $reversed = strrev($name);
            
        
            echo "<tr>";
            echo "<td>" . $name . "</td>";
            echo "<td>" . $charCount . "</td>";
            echo "<td>" . $ucFirst . "</td>";
            echo "<td>" . $vowelReplace . "</td>";
            echo "<td>" . $posDisplay . "</td>";
            echo "<td>" . $reversed . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>