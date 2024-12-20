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
   <title>Les avis - Espace Administrateur</title>
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
               <h1 class="mt-4"><img src="../assets/images/half-wheel-yellow.svg" class="img-fluid" width="32" height="auto" alt=""> Gestions des avis</h1>
               <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Avis </a></li>
                  <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Gestions avis</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Avis suspects à analyser</li>
               </ol>
               
               <div id="message" class="mt-1 col-lg-8 mx-auto"></div>
               <nav>
                  <ul class="pagination" id="paginationLiens"> 
                  </ul>
               </nav>
               <div id="users-container" class="row"></div>
               
            </div>
         </main>
         <?php include('includes/footer.php'); ?>
      </div>
   </div>


   <script id="template-users" type="text/template">
      <div class="row">
         {{#users}}
         <div class="col-md-6 col-sm-6 col-lg-6 mb-4">
            <div class="card h-100 shadow-sm bg-primary text-white">
               <div class="card-body">
                  <h5 class="card-title">Utilisateur : <a class="text-white" href="afficher_info_user.php?id={{id_user}}">{{nom_user}} {{prenom_user}}</a></h5>
                  <p class="card-text">
                     <strong>Événement :</strong> {{nom_evenement}}<br>
                     <strong>Commentaire :</strong> {{commentaire}}<br>
                     <strong>Date :</strong> {{date_creation}}
                  </p>
                  <div class="text-center">
                     <button class="btn text-white bg-success btn-sm verifier-avis me-4" data-id="{{id_avis}}" data-action="valider">
                        <i class="fas fa-check"></i> 
                     </button>
                     <button class="btn text-white bg-danger btn-sm verifier-avis" data-id="{{id_avis}}" data-action="rejeter">
                        <i class="fas fa-trash"></i> 
                     </button>
                  </div>
               </div>
            </div>
         </div>
         {{/users}}
      </div>
   </script>

   <!-- jQuery -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
   
   <script src="../assets/JS/script_suppressionUser.js"></script>
   <script src="../assets/JS/mustache.min.js"></script>
   <script>
      function afficherMessageDansDiv(message, type) {
         const messageDiv = document.getElementById("message");
         messageDiv.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
         setTimeout(() => {
            messageDiv.innerHTML = ""; 
         }, 5000);
      }
      // fonction pour appeler l'API
      function verifierAvis(idAvis, action) {
         $.ajax({
            url: "../API/modAvisGestion.php",
            method: "POST",
            dataType: "json",
            data: {
               action: action,
               id_avis: idAvis,
            },
            success: function (response) {
               if (response.status === "success") {
                  afficherMessageDansDiv(response.message, "success"); 
                     chargerUtilisateurs(1); 
               } else {
                  afficherMessageDansDiv("Erreur : " + response.message, "danger");
                     alert("Erreur : " + response.message);
               }
            },
            error: function () {
               alert("Erreur lors de la communication avec le serveur.");
            },
         });
      }


      function init() {
         document.addEventListener("click", function (e) {
            if (e.target.closest(".verifier-avis")) {
               const bouton = e.target.closest(".verifier-avis");
               const idAvis = bouton.getAttribute("data-id");
               const action = bouton.getAttribute("data-action");
      
               // demander une confirmation
               const confirmation = confirm("Voulez-vous vraiment effectuer cette action ?");
               if (!confirmation) return;
      
               // appeler l'API pour mettre à jour le statut
               verifierAvis(idAvis, action);
            }
      });
      }

      window.addEventListener("load", init);
      </script>
   <script src="../assets/JS/script_admin.js"></script>
   <script src="../assets/JS/script_avis.js"></script>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>
