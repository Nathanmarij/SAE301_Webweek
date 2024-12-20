<?php
session_start();
include_once("config/ConfigBDD.php");
include_once("class/ActionsBDD.php");

$BDD = ActionsBDD::getInstance();


$date_actuelle = date('Y-m-d H:i:s');

// Requête pour les événements à venir 
$sql = "
SELECT e.*, l.id_lieux, l.adresse
FROM 
        events AS e
    JOIN 
        lieux AS l ON l.id_lieux = e.id_lieux
WHERE date_events >= :current_date ORDER BY date_events ASC LIMIT 3";

$params = [
    ':current_date' => $date_actuelle,
];

$resultat = $BDD->getDonnees($sql, $params);

// Tableau pour la traduction en français des jours et mois
$jours_fr = ['Monday' => 'Lundi', 'Tuesday' => 'Mardi', 'Wednesday' => 'Mercredi', 'Thursday' => 'Jeudi', 'Friday' => 'Vendredi', 'Saturday' => 'Samedi', 'Sunday' => 'Dimanche'];
$mois_fr = ['Jan' => 'Jan', 'Feb' => 'Fév', 'Mar' => 'Mars', 'Apr' => 'Avr', 'May' => 'Mai', 'Jun' => 'Juin', 'Jul' => 'Juil', 'Aug' => 'Août', 'Sep' => 'Sept', 'Oct' => 'Oct', 'Nov' => 'Nov', 'Dec' => 'Déc'];

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style/style.css" rel="stylesheet">
    <link href="style/styleFooter.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Page d'accueil</title>
</head>

<body>
    <header>
        <?php include("header.php") ?>
    </header>
    <main class="accueil">
        <div class="container-fluid">
            <div class="row presentation">
                <div class="col-12 col-md-6 concervatoir">
                    <img src="img/concervatoir.jpg" alt="concervatoir">
                </div>
                <div class="col decouvrir">
                    <h2>DÉCOUVREZ NOS SPECTACLES</h2>
                    <p>Explorez notre programmation et trouvez l'événement qui vous transporte.</p>
                    <a href="event.php"><button type="button">RÉSERVEZ MAINTENANT</button></a>
                </div>
            </div>
        </div>
        <div class="confiance">
            <div class="container-fluid">
                <div class="row g-0">
                    <div class="col d-flex justify-content-center align-items-center confiance-content"
                        style="background-image: url('img/reservation.avif');">
                        <p>Facilité de réservation</p>
                    </div>
                    <div class="col bg-image d-flex justify-content-center align-items-center confiance-content"
                        style="background-image: url('img/acces.avif');">
                        <p>Un accès direct aux événements</p>
                    </div>
                    <div class="col bg-image d-flex justify-content-center align-items-center confiance-content"
                        style="background-image: url('img/paiement.jpg');">
                        <p>Paiement sécurisé</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="recommandation">
            <!--Affichage de 3 événements en recommandation dynamique-->
            <div class="container">
                <h3>Événements recommandés</h3>
                <div class="row g-0 justify-content-center"> <!-- Centrer les colonnes horizontalement -->
                    <?php foreach ($resultat as $event) :
                        $date = strtotime($event['date_events']);
                        $jour = $jours_fr[date('l', $date)];
                        $jour_numero = date('d', $date);
                        $mois = $mois_fr[date('M', $date)];
                        $heure = date('H:i', $date);
                    ?>
                        <div class="col-12 col-md-4 event d-flex flex-column align-items-center">
                            <a href="eventid.php?id=<?= htmlspecialchars($event['id_events']) ?>">
                                <div class="visu" style="background-image: url('assets/images/events/<?= htmlspecialchars($event['url_img']) ?>');">
                                    <p><?= htmlspecialchars($jour) ?></p>
                                    <p class="jour"><?= htmlspecialchars($jour_numero) ?></p>
                                    <p><?= htmlspecialchars($mois) ?></p>
                                    <img src="img/ligne-hor.svg" alt="hor">
                                    <p><?= htmlspecialchars($event['nom']) ?></p>
                                </div>
                                <div class="bandCard">
                                    <div class="heure">
                                        <img src="img/horloge-icon.svg" alt="icone-horloge">
                                        <p><?= htmlspecialchars($heure) ?></p>
                                    </div>
                                    <img src="img/ligne-vertical.svg" alt="vert" id="vert">
                                    <div class="adresse">
                                        <img src="img/localisation.svg" alt="loc">
                                        <p><?= htmlspecialchars($event['adresse']) ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row g-0 justify-content-center"> <!-- Centrer les colonnes horizontalement -->
                <div class="col-12 col-md-8 event d-flex flex-column align-items-center"></div>
                <div class="col-12 col-md-4 event d-flex flex-column align-items-end voir-plus">
                    <a href="event.php">Voir tout les événements ></a>
                </div>
            </div>
        </div>
        </div>
        </div>

        </div>
        <div class="container">
            <h3>Catégories</h3>
            <div class="row categories justify-content-center">
                <div class="col cat d-flex flex-column align-items-center" style="background-image: url('img/musique.jpg');">
                    <a href="event.php">
                        <p>Musique</p>
                    </a>
                </div>
                <div class="col cat d-flex flex-column align-items-center" style="background-image: url('img/danse.jpg');">
                    <a href="event.php">
                        <p>Danse</p>
                    </a>
                </div>
                <div class="col cat d-flex flex-column align-items-center" style="background-image: url('img/theatre.jpg');">
                    <a href="event.php">
                        <p>Théâtre</p>
                    </a>
                </div>
            </div>
        </div>

    </main>

    <?php
    include("footer.html");
    ?>
</body>

</html>
