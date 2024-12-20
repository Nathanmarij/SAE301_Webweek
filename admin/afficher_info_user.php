<?php
session_start();
require_once('../config/ConfigBDD.php');
require_once('../class/Users.php');
require_once('fonctions/verifierConnexionEtDroitsAdmin.php');
require_once('fonctions/getCAleatoire.php');

// vérifier si la personne a le droit à cette page
verifierConnexionEtDroits();

$id_user = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (!$id_user) {
   die("ID utilisateur invalide");
}


$couleurAleatoire = getCAleatoire(); 

$_SESSION['id_user_m'] = $id_user;  
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <title>Afficher les infos - Espace Administrateur</title>
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
               <h1 class="mt-4"><img src="../assets/images/half-wheel-yellow.svg" class="img-fluid" width="32" height="auto" alt=""> Tableau de bord</h1>
               <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Utilisateurs </a></li>
                  <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Gestions utilisateurs</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Informations personnelles</li>
               </ol>
               <div class="row">
                  <div class="col-12 col-lg-12 colg-md-1 col-sm-12 mb-4">
                     <button type="button" class="btn btn-primary bg-danger btn-sm" onclick="window.location.href = 'liste_users.php';">
                        <i class="fas fa-arrow-left"></i> Retour
                     </button>
                  </div>
                  <div class="col-lg-4">
                     <div class="card mb-4 bg-primary">
                        <div class="card-body text-center d-flex flex-column align-items-center justify-content-center">
                           <div class="avatar rounded-circle text-white <?php echo $couleurAleatoire; ?> d-flex align-items-center justify-content-center">
                              <span id="initiaux"></span>
                           </div>
                           <h5 class="my-3 text-white nomComplet"></h5>
                           <p class="opacity-75 mb-1 text-white" >Statut compte</p>
                           <button type="button" class="mt-4 btn btn-primary bg-primary position-relative">
                              <span id="statutCompte"></span>
                              <span id="statutBg" class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                 <span class="visually-hidden"></span>
                              </span>
                           </button>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-8">
                     <div class="card mb-4">
                        <div class="card-body">
                        <div class="row">
                           <div class="col-sm-3">
                              <p class="mb-0">Nom & Prénom</p>
                           </div>
                           <div class="col-sm-9">
                              <p class="text-muted mb-0 nomComplet"></p>
                           </div>
                        </div>
                        <hr>
                        <div class="row">
                           <div class="col-sm-3">
                              <p class="mb-0">Email</p>
                           </div>
                           <div class="col-sm-9">
                              <p class="text-muted mb-0" id="email"></p>
                           </div>
                        </div>
                        <hr>
                        <div class="row">
                           <div class="col-sm-3">
                              <p class="mb-0">Numéro</p>
                           </div>
                           <div class="col-sm-9">
                              <p class="text-muted mb-0" id="telephone">></p>
                           </div>
                        </div>
                        <hr>
                        <div class="row">
                           <div class="col-sm-3">
                              <p class="mb-0">Date de naissance</p>
                           </div>
                           <div class="col-sm-9">
                              <p class="text-muted mb-0" id="date_naissance">></p>
                           </div>
                        </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </main>
         <?php include('includes/footer.php'); ?>
      </div>
   </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="../assets/JS/script_AffichUser.js"></script>

<script src="../assets/JS/script_admin.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>
