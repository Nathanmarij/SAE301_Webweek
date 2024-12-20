<?php
session_start();
include_once("config/ConfigBDD.php");
include_once("class/ActionsBDD.php");

$BDD = ActionsBDD::getInstance();

$id_user = 47; // $_SESSION['id_users'] 
$date_actuelle = date('Y-m-d H:i:s');

// Requête pour les événements passés
$sql_past = "
    SELECT 
        e.*, l.id_lieux, l.adresse, r.*
    FROM 
        reservations AS r
    JOIN 
        events AS e ON e.id_events = r.id_events
    JOIN 
        lieux AS l ON l.id_lieux = e.id_lieux
    WHERE 
        r.id_users = :id_users AND e.date_events < :current_date
    ORDER BY 
        e.date_events DESC
";

$params_past = [
    ':id_users' => $id_user,
    ':current_date' => $date_actuelle,
];


$events_past = $BDD->getDonnees($sql_past, $params_past);



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
    <div class="main">
        <div class="container">
        <div class="row">
                <div class="col select">
                    <a href="reservation_aVenir.php"><button type="button">Spectacles à venir</button></a>
                    <a href="reservation_passe.php" class="pasclick"><button type="button">Spectacles passé</button></a>
                </div>            
            </div>
            <!-- Spectacles passés -->
            <h2>Spectacles passés</h2>
            <div class="row">
                <?php foreach ($events_past as $event) : ?>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card">
                            <img class="card-img-top" src="assets/images/events/<?= htmlspecialchars($event['url_img']) ?>" alt="<?= htmlspecialchars($event['nom']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($event['nom']) ?></h5>
                                <p class="card-text">Date : <?= htmlspecialchars($event['date_events']) ?></p>
                                <p class="card-text">Adresse : <?= htmlspecialchars($event['adresse']) ?></p>
                                <p class="card-text">Places réservées : <?= htmlspecialchars($event['nb_place']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>




    <?php
    include("footer.html");
    ?>
</body>

</html>