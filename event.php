<?php
include_once("config/ConfigBDD.php");
$bdd = Database::getInstance()->getConnexion();


//affiche les catégories des événements
$requete = 'SELECT * FROM cat_events';
$resultats = $bdd->query($requete);
$tabCategories = $resultats->fetchAll(PDO::FETCH_ASSOC);
$resultats->closeCursor();

//affiche les événements
$requete = 'SELECT * FROM events';
$resultats = $bdd->query($requete);
$tabEvent = $resultats->fetchAll(PDO::FETCH_ASSOC);
$resultats->closeCursor();

?>


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
        <?php
        // Boucle pour afficher les catégories des événements
        foreach ($tabCategories as $categorie) {
        ?>
        <form action="event.php" method="get">
            <input type="hidden" name="id_cat_events" value="<?= $categorie['id_cat_events'] ?>">
        <h2><?= $categorie['nom'] ?></h2>

        </form>
           
        <?php
        }
        ?>
        
    </div>
    <div>
        
        <?php
        // Boucle pour afficher 6 événements
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