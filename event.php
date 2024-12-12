<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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