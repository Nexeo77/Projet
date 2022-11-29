<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TypeEngin</title>
</head>
<body>
<?php
    require 'connection.php';
?>
    <?php
        $typeengin= "SELECT idTypeEngin, LblEngincol FROM pompier.typeengin;";
        foreach ($db->query($typeengin) as $row) {
            echo '<option value="'.$row["idTypeEngin"].'">'.ucwords($row["LblEngincol"]).'</option>';

        }
    ?>
    
    <?php
    
     $reponse = query ("SELECT * FROM typeengin");
        echo "<img src='".$donnees['URLimage']."' />";
    ?>

</body>
</html>
