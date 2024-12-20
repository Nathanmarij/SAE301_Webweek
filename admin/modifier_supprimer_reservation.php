<?php
session_start();
require_once('../config/ConfigBDD.php');
require_once('../class/Users.php');
require_once('fonctions/verifierConnexionEtDroitsAdmin.php');

// vérifier si la personne a le droit à cette page
verifierConnexionEtDroits();


$actionsBDD = ActionsBDD::getInstance();
$sql = "SELECT * FROM events"; 
$events = $actionsBDD->getDonnees($sql);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <title>Modifier les infos - Espace Administrateur</title>
   <meta name="description" content=""/>
   <link rel="icon" type="image/x-icon" href="../assets/images/favicon.ico">
   <!-- Lien vers la feuille de style Bootstrap 5 -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">

   <!-- Lien vers le fichier CSS personnalisé -->
   <link href="../assets/css/styles_admin.css" rel="stylesheet" />
</head>
<body>
   <?php include('includes/nav.php'); ?>
   <div id="mySidebar">
      <?php include('includes/menu.php'); ?>
      
      <div id="myContenu">
         <main>
            <div class="container-fluid px-4">
               <h1 class="mt-4"><img src="../assets/images/half-wheel-yellow.svg" class="img-fluid" width="32" height="auto" alt=""> Réservation</h1>
               <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Utilisateurs </a></li>
                  <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Gestions réservations</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Modification / Annulation</li>
               </ol>
               <div class="row">
                  <div class="col-12 col-lg-1 col-md-1 col-sm-12">
                     <button type="button" class="btn btn-primary bg-danger btn-sm" onclick="window.location.href = 'liste_reservations.php';">
                        <i class="fas fa-arrow-left"></i> Retour
                     </button>
                  </div>
                  <div class="col-12 col-lg-11 col-md-11 col-sm-12">
                     <div id="message" class="mt-1 col-lg-11"></div>
                     <form id="testForm">
                        <div class="row">
                           <div class="col-md-6 bg-primary rounded me-4 justify-content-center">
                              <h5 class="text-white mt-4">Informations actuelles</h5>
                              <div class="mb-3">
                                 <label for="nomPrenom" class="form-label text-white">Nom complet</label>
                                 <input type="text" class="form-control nomPrenom" id="nomPrenom" disabled>
                              </div>
                              <div class="mb-3">
                                 <label for="nomEvent" class="form-label text-white">Nom de l'événement</label>
                                 <input type="text" class="form-control" id="nomEvent" disabled>
                              </div>
                              <div class="mb-3">
                                 <label for="nbPlaces" class="form-label text-white">Nombre de places réservées</label>
                                 <input type="text" class="form-control" id="nbPlaces" disabled>
                              </div>
                              <div class="mb-3">
                                 <label for="statutReservation" class="form-label text-white">Statut de la réservation</label>
                                 <input type="text" class="form-control" id="statutReservation" disabled>
                              </div>
                           </div>

                           <div class="col-md-5 card justify-content-center">
                              <h5 class="color-primary">Modifier les informations</h5>
                              <div class="mb-3 card-bodys">
                                 <label for="nomPrenom" class="form-label">Nom complet</label>
                                 <input type="text" class="form-control nomPrenom"  disabled>
                              </div>
                              <div class="mb-3">
                                 <label for="nouveauNomEvent" class="form-label">Nouveau événement <span class="text-danger">*</span></label>
                                 <select class="form-select" id="nouveauNomEvent">
                                    <option value="" disabled selected>Choisissez l'évènement</option>
                                    <?php foreach ($events as $event) : ?>
                                       <option value="<?= htmlspecialchars($event['id_events']) ?>">
                                          <?= $event['nom']?>
                                       </option>
                                    <?php endforeach; ?>
                                 </select>
                              </div>
                              <div class="mb-3">
                                 <label for="nouveauNbPlaces" class="form-label">Nouveau nombre de places <span class="text-danger">*</span></label>
                                 <input type="number" class="form-control" id="nouveauNbPlaces" placeholder="Modifier le nombre de places">
                              </div>
                              <div class="mb-3">
                                 <label for="nouveauStatutReservation" class="form-label">Nouveau statut de la réservation <span class="text-danger">*</span></label>
                                 <select class="form-select" id="nouveauStatutReservation">
                                    <option value="1">Acceptée</option>
                                    <option value="0">Rejetée</option>
                                 </select>
                              </div>
                           </div>
                        </div>

                       
                        <div class="d-flex justify-content-center gap-2 mt-4">
                           <button type="button" class="btn " id="basculeReservationStatut">
                              Réactiver la réservation
                           </button>
                           <button type="submit" class="btn btn-primary bg-primary">Modifier la réservation</button>
                        </div>
                     </form>
                  </div>
               </div>

               

            </div>
         </main>
         <?php include('includes/footer.php'); ?>
      </div>
   </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="../assets/JS/script_ModSupReservation.js"></script>

<script src="../assets/JS/script_admin.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>
