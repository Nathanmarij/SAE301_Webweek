<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evenemnts</title>
    <link href="style/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php 
    include("header.php"); 
?>
    <div>
        <h2>Musique</h2>
        <h2>Théatre</h2>
        <h2>Danse</h2>
    </div>
    <div>
        <?php
        for ($i=0; $i<6; $i++){
        ?>
            <div>
                <p>Date</p>
                <h3>Titre</h3>
                <div>
                    <p>00H00</p>
                    <h4>Adresse</h4>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <?php 
    include("footer.html");
    ?>
</body>
</html>