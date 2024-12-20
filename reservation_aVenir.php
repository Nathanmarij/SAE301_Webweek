<?php
session_start();
include_once("config/ConfigBDD.php");
include_once("class/ActionsBDD.php");

$BDD = ActionsBDD::getInstance();

$id_user = $_SESSION['id_users']; 
$date_actuelle = date('Y-m-d');


// Requête pour les événements à venir
/*$sql_future = "
    SELECT 
    e.id_events, e.nom, e.date_events, 
    l.id_lieux, l.adresse, 
    r.id_reservations, r.nb_places
FROM 
    reservations r
JOIN 
    events e ON e.id_events = r.id_events
JOIN 
    lieux l ON l.id_lieux = e.id_lieux
WHERE 
        r.id_users = :id_users 
        AND e.date_events >= :current_date
    ORDER BY 
        e.date_events ASC
";
*/
$sql_future = "SELECT e.id_events, e.url_img, e.nom, e.date_events, l.id_lieux, l.adresse, r.id_reservations, r.nb_places FROM reservations r JOIN events e ON e.id_events = r.id_events JOIN lieux l ON l.id_lieux = e.id_lieux WHERE r.id_users = :id_users /* Remplace 1 par un ID utilisateur réel */ AND e.date_events >= :current_date /* Remplace par une date actuelle */ ORDER BY e.date_events ASC";
$params_future = [
    ':id_users' => $id_user,
    ':current_date' => $date_actuelle,

];


$resultat = $BDD->getDonnees($sql_future, $params_future);

if (!$resultat) {
    echo "Aucune donnée trouvée.";
} else {

}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style/style.css" rel="stylesheet">
    <link href="style/styleFooter.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">

</head>

<body>
    <?php
    include("header.php");
    ?>
    <main>
        <div class="container">
        <div class="row">
                <div class="col select">
                    <a href="reservation_aVenir.php" class="pasclick"><button type="button">Spectacles à venir</button></a>
                    <a href="reservation_passe.php"><button type="button">Spectacles passé</button></a>
                </div>            
            </div>           
            </div>
            <!-- Spectacles à venir -->
            <h2>Spectacles à venir</h2>
            <div class="row">
                <?php foreach ($resultat as $event) : ?>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card">
                        <a href="eventid.php?id=<?php echo $event['id_events']; ?>&nom=<?php echo urlencode($event['nom']); ?>">
                                <img class="card-img-top" src="assets/images/events/<?= $event['url_img'] ?>" alt="<?= htmlspecialchars($event['nom']) ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($event['nom']) ?></h5>
                                    <p class="card-text">Date : <?= htmlspecialchars($event['date_events']) ?></p>
                                    <p class="card-text">Adresse : <?= htmlspecialchars($event['adresse']) ?></p>
                                    <p class="card-text">Places réservées : <?= htmlspecialchars($event['nb_places']) ?></p>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </main>



    <?php
    include("footer.html");
    ?>
</body>

</html>