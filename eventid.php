<?php
include_once("config/ConfigBDD.php");
$bdd = Database::getInstance()->getConnexion();

// Récupération des informations de l'événement
$requete = 'SELECT * FROM events WHERE id_events = 1';
$stmt = $bdd->prepare($requete);
$projet = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt->closeCursor();



?>

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
        <div>
            <img>
        </div>
        <div>
            <h1>Titre</h1>
            <h2>Date et heure</h2>
            <h2>Adresse</h2>
            <p>Description spectacle</p>
        </div>
        <div>
            <h3>Prix d'entrée</h3>
            <form method="POST" action="placesTraitement.php">
                <input type="submit" id="submit" name="Réserver" class="champ">
                <input type="number" name="nb_places" id="nb_places" value="0" min="0" max="100"/>
            </form>
            
        </div>
        <div>
            <h3>Adresse</h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2819.177678260139!2d3.8824898751446915!3d45.04161616153661!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f5fa5472eba401%3A0x30eb4863ad1d5cee!2sTh%C3%A9%C3%A2tre%20du%20Puy-En-Velay!5e0!3m2!1sfr!2sfr!4v1733996907912!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
            <div>
                <h3>Commentaires</h3>
                <form method="POST" action="traitements/t_form_commentaire.php">
                    <input type="text" id="commentaire"name="commentaire">
                    <input type="submit" id="submit" name="Envoyer">
                </form>
                <?php
                for ($i=0; $i<3; $i++){
                ?>
                <div>
                    <h4>Prenom</h4>
                    <p>Commentaire</p>
                <?php
                    }
                ?>
                </div>
            </div>
        </div>
    </div>
    <?php
        include ("footer.html");
    ?>