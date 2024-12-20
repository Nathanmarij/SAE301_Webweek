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
   <title>Liste des réservations - Espace Administrateur</title>
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
               <h1 class="mt-4"><img src="../assets/images/half-wheel-yellow.svg" class="img-fluid" width="32" height="auto" alt=""> Liste des réservations</h1>
               <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Utilisateurs </a></li>
                  <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Gestion réservations</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Liste </li>
               </ol>
               
               <div class="row mb-3">
                  <div class="col-8">
                     <input type="text" id="recherche-input" class="form-control" placeholder="Rechercher un utilisateur">
                  </div>
                 
               </div>
               <div class="row table-responsive">
                  <table class="table table-bordered">
                     <thead>
                           <tr>
                              <th>Réservateur</th>
                              <th>Évènement</th>
                              <th>Nombre de place</th>
                              <th>Statut</th>
                              <th>Date réservation</th>
                              <th class="text-center">Actions</th>
                           </tr>
                     </thead>
                     <tbody id="users-container"></tbody>
                  </table>

                  <nav>
                     <ul class="pagination" id="paginationLiens">

                     </ul>
                  </nav>
               </div>
            </div>
         </main>
         <?php include('includes/footer.php'); ?>
      </div>
   </div>


   <!-- Template Mustache -->
   <script id="template-users" type="text/template">
      {{#users}}
      <tr>
         <td > <a class="link-offset-2 color-primary"  href="afficher_info_user.php?id={{id_user_r}}"> {{nom_user}} {{prenom_user}}</a></td>
         <td>{{nom_event}}</td>
         <td>{{nb_place}}</td>
         <td ><span class="badge {{classe_badge}}">{{statut_reservation}}</span></td>
         <td>{{date_reservation}}</td>
         <td class="text-center">
            <a href="modifier_supprimer_reservation.php?id_reservations={{id_reservations}}&id_events={{id_events}}&id_users={{id_users}}" class="btn text-white bg-danger btn-sm"><i class="fas fa-edit"></i> Modifier/Annuler </a>
         </td>
      </tr>
      {{/users}}
   </script>
   <!-- jQuery -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
   
   <script src="../assets/JS/script_suppressionUser.js"></script>
   <script src="../assets/JS/mustache.min.js"></script>

   <script src="script_ModSupReservation.js"></script>

   <script src="../assets/JS/script_admin.js"></script>
   <script src="../assets/JS/script_AffReservations.js"></script>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>
