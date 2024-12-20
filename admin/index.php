<?php
session_start();
require_once('../config/ConfigBDD.php');
require_once('../class/Users.php');
require_once('fonctions/statistiques.php');
require_once('fonctions/verifierConnexionEtDroitsAdmin.php');

// pour avoir les stats
$stats = getDonneesStats();

// vérifier si la personne a le droit à cette page
verifierConnexionEtDroits();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <title>Espace Administrateur - Conservatoire de l'Agglomération du Puy-en-Velay</title>
   <meta name="description" content=""/>
   <link rel="icon" type="image/x-icon" href="../assets/images/favicon.ico">
   <!-- Lien vers la feuille de style Bootstrap 5 -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">

   <!-- Lien vers le fichier CSS personnalisé -->
   <link href="../assets/css/styles_admin.css" rel="stylesheet" />
</head>
<body class="sb-nav-fixed">
   <?php include('includes/nav.php'); ?>
   <div id="mySidebar">
      <?php include('includes/menu.php'); ?>
      
      <div id="myContenu">
         <main>
            <div class="container-fluid px-4">
               <h1 class="mt-4"><img src="../assets/images/half-wheel-yellow.svg" class="img-fluid" width="32" height="auto" alt=""> Tableau de bord</h1>
               <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item active">Accueil</li>
               </ol>
               <div class="row">
                  <div class="col-xl-3 col-md-6">
                     <div class="card bg-primary text-white mb-4">
                        <div class="card-body">
                           Utilisateurs
                           <h4>Stats <span class="float-end badge text-bg-secondary"><?= $stats['users']; ?></span></h4>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                           <a class="small text-white stretched-link" href="liste_users.php">Liste utilisateurs</a>
                           <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-3 col-md-6">
                     <div class="card bg-warning text-white mb-4">
                        <div class="card-body">
                           Évènements
                           <h4>Stats <span class="float-end badge text-bg-secondary"><?= $stats['events']; ?></span></h4>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                              <a class="small text-white stretched-link" href="#">Liste  évènements</a>
                              <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-3 col-md-6">
                     <div class="card bg-success text-white mb-4">
                        <div class="card-body">
                           Avis
                           <h4>Stats <span class="float-end badge text-bg-secondary"><?= $stats['avis']; ?></span></h4>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                              <a class="small text-white stretched-link" href="gestions_avis.php">Liste avis</a>
                              <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-3 col-md-6">
                     <div class="card bg-danger text-white mb-4">
                        <div class="card-body">
                           Réservations
                           <h4>Stats <span class="float-end badge text-bg-secondary"><?= $stats['reservation']; ?></span></h4>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                           <a class="small text-white stretched-link" href="liste_reservations.php">Liste réservations</a>
                           <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-3 col-md-6">
                     <div class="card bg-primary text-white mb-4">
                        <div class="card-body">
                           Administrateurs
                           <h4>Stats <span class="float-end badge text-bg-secondary"><?= $stats['admin']; ?></span></h4>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                           <a class="small text-white stretched-link" href="liste_admins.php">Liste administrateurs</a>
                           <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                     </div>
                  </div>
               </div>
               
            </div>
         </main>
         <?php include('includes/footer.php'); ?>
      </div>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
   <script src="../assets/JS/script_admin.js"></script>
  
</body>
</html>
