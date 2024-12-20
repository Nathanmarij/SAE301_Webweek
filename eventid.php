<?php
include_once("config/ConfigBDD.php");
include_once("class/ActionsBDD.php");

/*if (!isset($_SESSION['email'])) {
    header("Location: ./connexion_compte.php");
    exit();
}*/

if (isset($_GET['id'])) {
    $eventId = valider_input($_GET['id']);

    $requete = "SELECT e.id_events, e.nom, e.date_events, e.description, e.prix, e.alt_img, e.url_img, 
       e.nb_places_prevues, e.nb_places_reservees, e.date_creation, l.adresse, c.nom_type
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
    $prevu = $event['nb_places_prevues'];
    $reserv = $event['nb_places_reservees'];
    $rest = $prevu - $reserv;
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
    <link href="style/style.css" rel="stylesheet">
    <link href="style/styleFooter.css" rel="stylesheet">
    <!-- Lien vers la feuille de style Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Lien vers le fichier CSS personnalisé -->
    <link href="style/styleeventid.css" rel="stylesheet">

</head>


<body>
    <?php
    include("header.php");
    ?>
    <div>
        <div class="container my-5 section_event">
            <div class="row align-items-center">
                <div class="img_event col-md-5 ">
                    <img src="img/affiche-1.jpeg" class="img-fluid"
                        alt="<?php echo htmlspecialchars($event['nom']); ?>">
                </div>
                <div class="section_info_event col-md-7 ">
                    <h1 class="fw-bold text-uppercase"><?php echo htmlspecialchars($event['nom']); ?></h1>
                    <h2><?php echo htmlspecialchars($event['date_events']); ?></h2>
                    <h2><?php echo htmlspecialchars($event['adresse']); ?></h2>
                    <p class="mt-4"><?php echo nl2br(htmlspecialchars($event['description'])); ?></p>
                    <div class="btn_info mt-4 text-center"><br>
                        <h3>Prix d'entrée: <?php echo htmlspecialchars($event['prix']); ?> €</h3>

                        <form id="reservationForm" method="POST" action="traitements/t_form_reservation.php"
                            class="d-flex justify-content-center align-items-center">
                            <input type="submit" id="submit" name="Réserver" value="RÉSERVER" class="btn fw-bold px-4">
                            <input type="number" name="nb_places" id="nb_places" value="1" min="1" max="<?php echo $rest?>"
                                class="form-control text-center" style="width: 60px;">
                            <input type="hidden" name="id_event" value="<?php echo "$eventId"; ?>">
                        </form>
                        <p class="mt-2 text-center"><?php echo $rest?> places restantes</p>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="container my-5 ">
            <h2 class="fw-bold text-uppercase mb-4">Adresse</h2>
            <div class="section_carte text-center">
                <div class="map-responsive">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2818.9379115111497!2d3.8777036000000007!3d45.046481799999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f5fbaa7f00dad7%3A0xaac997d8c5188e3e!2sAteliers%20des%20Arts%20-%20Conservatoire%20%C3%A0%20Rayonnement%20D%C3%A9partemental!5e0!3m2!1sfr!2sfr!4v1734358802645!5m2!1sfr!2sfr"
                        width="1200" height="500" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <a
                    href="https://www.google.com/maps/dir//Ateliers+des+Arts+-+Conservatoire+à+Rayonnement+Départemental+32+Rue+86E+Régiment+d'Infanterie+43000+Le+Puy-en-Velay/@45.0464818,3.8777036,16z/data=!4m8!4m7!1m0!1m5!1m1!1s0x47f5fbaa7f00dad7:0xaac997d8c5188e3e!2m2!1d3.8777101!2d45.0464891?entry=ttu&g_ep=EgoyMDI0MTIxMS4wIKXMDSoASAFQAw%3D%3D">
                    <button class="btn px-4">Itinéraire</button>
                </a>
            </div>
            <div class="section_avis ">
                <h2 class="fw-bold text-uppercase mb-4">Avis</h2>
                <div class="border border-danger rounded p-4 mb-5 text-center">
                    <h3 class="text-center mb-3 fw-bold">Laisser mon avis</h3>
                    <form id="avisForm" method="POST" action="traitements/t_form_commentaire.php">
                        <textarea name="avis" id="avis" class="form-control mb-2"
                            placeholder="Laissez un avis..."></textarea>
                        <div id="avisError" class="error"></div>
                        <input type="hidden" name="id_event" value="<?php echo htmlspecialchars($_GET['id']); ?>">
                        <button type="submit" class="btn px-4">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Affichage des avis -->
        <div id="avisList">
                    <?php
                    $reqAvis = "SELECT u.nom, u.prenom, a.description,a.id_events FROM avis as a JOIN 
                    users AS u ON a.id_users = u.id_users WHERE id_events = ?";
                    $avis = ActionsBDD::getInstance()->getDonnees($reqAvis, [$eventId]);
                    ?>
                    <div class="container">
                        <?php
                    foreach ($avis as $dAvis) {
                        echo "<div><strong>{$dAvis['nom']} {$dAvis['prenom']}</strong><p>{$dAvis['description']}</p></div>";
                    }
                    ?>
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