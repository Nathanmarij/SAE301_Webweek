<?php
session_start();
require_once('../config/ConfigBDD.php');
require_once('../class/Users.php');
require_once('fonctions/verifierConnexionEtDroitsAdmin.php');

// vérifier si la personne a le droit à cette page
verifierConnexionEtDroits();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <title>Liste des utilisateurs - Espace Administrateur</title>
   <meta name="description" content=""/>
   <link rel="icon" type="image/x-icon" href="../assets/images/favicon.ico">
   <!-- Lien vers la feuille de style Bootstrap 5 -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

   <!-- Lien vers le fichier CSS personnalisé -->
   <link href="../assets/css/styles_admin.css" rel="stylesheet" />
</head>
<body class="sb-nav-fixed">
   <?php include('includes/nav.php'); ?>
   <div id="layoutSidenav">
      <?php include('includes/menu.php'); ?>
      
      <div id="layoutSidenav_content">
         <main>
            <div class="container-fluid px-4">
               <h1 class="mt-4"><img src="../assets/images/half-wheel-yellow.svg" class="img-fluid" width="32" height="auto" alt=""> Tableau de bord</h1>
               <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Utilisateurs </a></li>
                  <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Gestions utilisateurs</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Liste</li>
               </ol>
               <div class="row">

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
