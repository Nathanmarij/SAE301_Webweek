
<?php
session_start();
include_once("config/ConfigBDD.php");
include_once("class/ActionsBDD.php");

if (!isset($_SESSION['email'])) {
    header("Location: ./connexion_compte.php");
    exit();
}

if (isset($_GET['id'])) {
    $eventId = valider_input($_GET['id']);

    $requete = "SELECT e.id_events, e.nom, e.date_events, e.description, e.prix, e.alt_img, e.url_img, 
       e.nb_places_prevues, e.nb_places_reservees, e.date_creation, l.adresse, c.nom
    FROM events e
    JOIN 
		cat_events AS c ON c.id_cat_events  = e.id_cat_events
	JOIN 
		lieux AS l ON l.id_lieux = e.id_lieux
    WHERE e.id_events = :id_event";

    $params = [':id_event' => $eventId];

    $eventDetails = ActionsBDD::getInstance()->getDonnees($requete, $params);

    if (empty($eventDetails)) {
        header("Location: ./event.php");
    }

    $event = $eventDetails[0];
} else {
    header("Location: ./event.php");
}

function valider_input($donnees)
{
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Évènements - <?php echo htmlspecialchars($event['nom']); ?></title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
    <!-- Lien vers la feuille de style Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Lien vers le fichier CSS personnalisé -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="style/styleFooter.css" rel="stylesheet">
</head>

<body>
    <?php
    include("header.php");
    ?>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <img src="assets/images/events/<?php echo htmlspecialchars($event['url_img']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($event['nom']); ?>">
            </div>
            <div class="col-md-6">
                <h1><?php echo htmlspecialchars($event['nom']); ?></h1>
                <h2><?php echo htmlspecialchars($event['date_events']); ?></h2>
                <h3><?php echo htmlspecialchars($event['adresse']); ?></h3>
                <p><?php echo nl2br(htmlspecialchars($event['description'])); ?></p>

                <h4>Prix d'entrée: <?php echo htmlspecialchars($event['prix']); ?> €</h4>

                <form method="POST" action="placesTraitement.php">
                    <div class="mb-3">
                        <label for="nb_places" class="form-label">Nombre de places</label>
                        <input type="number" name="nb_places" id="nb_places" class="form-control" min="0" max="100" value="0" />
                    </div>
                    <button type="submit" name="Réserver" class="btn btn-primary">Réserver</button>
                </form>

                <h5>Carte de l'événement</h5>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2819.177678260139!2d3.8824898751446915!3d45.04161616153661!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f5fa5472eba401%3A0x30eb4863ad1d5cee!2sTh%C3%A9%C3%A2tre%20du%20Puy-En-Velay!5e0!3m2!1sfr!2sfr!4v1733996907912!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

                <h5>avis</h5>
                <form id="avisForm" method="POST" action="traitements/t_form_commentaire.php">
                    <textarea name="avis" id="avis" class="form-control mb-2" placeholder="Laissez un avis..."></textarea>
                    <div id="avisError" class="error"></div>
                    <input type="hidden" name="id_event" value="<?php echo htmlspecialchars($_GET['id']); ?>">
                    <button type="submit" class="btn btn-secondary">Envoyer</button>
                </form>

                <!-- Affichage des avis -->
                <div id="avisList">
                    <?php
                    $reqAvis = "SELECT * FROM avis WHERE id_events = ?";
                    $avis = ActionsBDD::getInstance()->getDonnees($reqAvis, [$eventId]);
                    foreach ($avis as $dAvis) {
                        echo "<div><strong>{$_SESSION['nom']}</strong><p>{$dAvis['description']}</p></div>";
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Script pour envoyer le formulaire via AJAX -->
    <script>
        $(document).ready(function() {
            $("#avisForm").submit(function(event) {
                event.preventDefault(); // Empêche l'envoi normal du formulaire

                // Réinitialiser les messages d'erreur
                $(".error").text("");
                $(".form-control").removeClass("is-invalid"); // Effacer les erreurs sur les champs

                var valid = true; // Variable de contrôle de la validité du formulaire

                if ($("#avis").val() === "") {
                    $("#avisError").text("Il faut rédigez un commentaire.");
                    $("#avis").addClass("is-invalid");
                    valid = false;

                }

                if (valid) {
                    // Récupérer les données du formulaire
                    var formData = $(this).serialize();

                    // Envoi des données via AJAX
                    $.ajax({
                        type: "POST",
                        url: "traitements/t_form_commentaire.php", // Le fichier PHP pour gérer la connexion
                        data: formData,
                        dataType: "json", // Attente d'une réponse JSON
                        success: function(response) {
                            console.log("Réponse du serveur : ", response); // Log de la réponse

                            // Si la connexion est réussie
                            /*if(response.status === "success"){
                                window.location.href = response.redirect;
                            } else {
                                $("#avisError").html('<div class="alert alert-danger">' + response.message + '</div>');
                            }*/
                            if (response.status === "success") {
                                // Mettre à jour les avis
                                $("#avisList").html(response.avisHTML); // Mettre à jour la section des avis
                                $("#avis").val(""); // Réinitialiser le champ
                            } else {
                                $("#message").html('<div class="alert alert-danger">' + response.message + '</div>');
                            }

                        },
                        error: function(xhr, status, error) {
                            console.error("Erreur AJAX : ", xhr.responseText);
                            $("#message").html('<div class="alert alert-danger">Une erreur s\'est produite. Veuillez réessayer.</div>');
                        }
                    });
                }
            });


        });
    </script>


    <?php
    include("footer.html");
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>