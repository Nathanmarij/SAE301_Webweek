<?php
session_start();

/*if (!isset($_SESSION['email'])) {
   header("Location: ./connexion_compte.php"); 
   exit(); 
}
*/
include_once("config/ConfigBDD.php");
include_once("class/ActionsBDD.php");



/* Récupération des SAE 
$requete='SELECT * from cat_events;
';
$params = [];

$resultats = ActionsBDD::getInstance()->getDonnees($requete, $params);
$tableauSAES = $resultats;



$nbSAES=count($tableauSAES);
*/

?>

<!DOCTYPE html>
<html lang="fr">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <title>2vènements - Conservatoire de l'Agglomération du Puy-en-Velay</title>
   <meta name="description" content="" />
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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
<!-- FILTRE -->
   <div class="divfiltre container my-5">
      <h1 class="text-center mb-4 fw-bold">Les évènements</h1>
      <!--<div class="d-flex justify-content-center mb-4">
         <form method="get">
            <select name="id_cat_events" id="selectCat">
               for ($i = 0; $i < $nbSAES; $i++) {
                  print_r ($tableauSAES);
                  echo '<option value="' . $tableauSAES[$i]['id_cat_events'] . '">' . $tableauSAES[$i]['nom'] . '</option>';
               }
               ?>
            </select>
         </form>
         <a href="#" class="btn btn-link active text-uppercase text-danger fw-bold me-3">Musique</a>
         <a href="#" class="btn btn-link text-uppercase text-dark me-3">Théatre</a>
         <a href="#" class="btn btn-link text-uppercase text-warning">Danse</a>
      </div>-->
      <div class="row g-4 m-auto align-items-center" id="events-container"></div>
   </div>
   <div id="divevents"></div>
   <!-- Template Mustache -->
   <script id="template-events" type="text/html">
   {{#events}}
      <div class="col-12 col-lg-3 col-md-6 col-sm-12">
         <a href="eventid.php?id={{id_events}}&nom={{#nom}}{{.}}{{/nom}}">
            <div class="card-new">
               <div class="card-entete">
                  <div class="event" style="background-image: url('assets/images/events/{{url_img}}');" width="100%">
                     <span class="entertainment">{{nom_cat}}</span>
                  </div>
               </div>
               <div class="card-n-body">
                  <div class="title">{{nom_event}}</div>
                  <div class="details">
                     <span>
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/46557/Time.svg" />
                        <div class="date">{{date_events}}</div>
                     </span>
                     <span>
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/46557/Pin.svg" />
                        <div class="location">{{adresse}}</div>
                     </span>
                  </div>
               </div>
            </div>
         </a>
      </div>
   {{/events}}
   </script>

   <script src="assets/JS/mustache.min.js"></script>
   <script src="assets/JS/script.js"></script>
  <!-- <script src="/assets/JS/script_filter.js"></script>-->
   <?php
   include("footer.html");
   ?>

</body>

</html>
