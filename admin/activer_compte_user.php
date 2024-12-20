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
   <title>Activer compte des utilisateurs - Espace Administrateur</title>
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
               <h1 class="mt-4"><img src="../assets/images/half-wheel-yellow.svg" class="img-fluid" width="32" height="auto" alt=""> Activation de compte</h1>
               <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Utilisateurs </a></li>
                  <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Gestions utilisateurs</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Activer compte</li>
               </ol>

               <div class="row mb-3 align-items-center">
                  <p><b>Saisissez ce que vous rechercher</b></p>
                  <div class="col-lg-6 col-md-4 ">
                     <form>
                        <input type="text" id="inputR" onkeyup="afficherRecherche(this.value)" class="form-control" placeholder="Rechercher un utilisateur par nom, prenom, email ou statut">
                     </form>
                  </div>
                  <div class="col-lg-6">
                  <nav class="mt-4">
                     <ul class="pagination justify-content-center" id="paginationLiens"></ul>
                  </nav>
                  </div>
                  <p>Résultats : </p>
                  <div id="user-container" style="margin-top:-40px;" class="row g-4"></div>
               </div>
            </div>
         </main>
         <?php include('includes/footer.php'); ?>
      </div>
   </div>



   <script id="template-user" type="text/template">
      {{#users}}
      <div class="col-12 col-lg-4 col-md-4 col-sm-6">
         <div class="card h-100 bg-primary">
            <div class="card-body text-center  text-white">
               <div class="avatar rounded-circle bg-warning d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 70px; height: 70px;">
                  <span>{{initiaux}}</span>
               </div>
               <h5 class="card-title">{{nom}} {{prenom}}</h5>
               <p class="card-text"><strong>Email :</strong> {{mail}}</p>
               
               <p class="opacity-75 mb-1 text-white" >Statut compte</p>

               <div class="d-flex row justify-content-center gap-2">
                  
                  <div class="col-lg-6">
                     <button type="button" class="btn btn-primary bg-primary position-relative">
                        <span>{{statut_compte}} {{id_users}}</span>
                        <span id="statutBg" class="position-absolute top-0 start-100 translate-middle p-2 {{statutClass}} border border-light rounded-circle">
                           <span class="visually-hidden"></span>
                        </span>
                     </button>
                  </div>
                  <div class="col-lg-12">
                     {{#estActif}}
                        <button class="btn bg-danger text-white btn-sm supprimer-user" data-id="{{id_users}}" data-action="desactiver" onclick="changerStatutUser({{id_users}}, 'desactiver')">
                           cliquez pour désactiver <i class="fas fa-close"></i> 
                        </button>
                     {{/estActif}}

                     {{^estActif}}
                        <button class="btn btn-success btn-sm supprimer-user" data-id="{{id_users}}" data-action="activer" onclick="changerStatutUser({{id_users}}, 'activer')">
                           cliquez pour activer  <i class="fas fa-check"></i> 
                        </button>
                     {{/estActif}}
                  </div>
               </div> 
            </div>
         </div>
      </div>
      {{/users}}
   </script>
   <script src="../assets/JS/mustache.min.js"></script>
   
   <script src="../assets/JS/script_admin.js"></script>
   <script src="../assets/JS/script_recherche.js"></script>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>
