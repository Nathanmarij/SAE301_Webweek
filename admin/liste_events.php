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
   <title>Liste des évènements - Espace Administrateur</title>
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
               <h1 class="mt-4"><img src="../assets/images/half-wheel-yellow.svg" class="img-fluid" width="32" height="auto" alt=""> Liste des évènements</h1>
               <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Évènements </a></li>
                  <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Gestion évènements</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Liste </li>
               </ol>
               
               <div class="row mb-3">
                  <div class="col-8">
                     <input type="text" id="recherche-input" class="form-control" placeholder="Rechercher un utilisateur">
                  </div>
                 
               </div>
               <div class="row table-responsive">
                  <div id=message></div>
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th>Catégorie</th>
                           <th>Événement</th>
                           <th>Date</th>
                           <th>Adresse</th>
                           <th>Image</th>
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
         <td>{{nom_cat}}</td> 
         <td>{{nom_event}}</td> 
         <td>{{date_events}}</td> 
         <td>{{adresse}}</td> 
         <td>
            {{#url_img}}
            <img src="../assets/images/events/{{url_img}}" alt="{{alt_img}}" class="img-thumbnail" width="50">
            {{/url_img}}
         </td>
         <td class="text-center">
            

             <a data-action="modifier" href="#" class="btn text-white bg-warning btn-sm">  <i class="fas fa-eye"></i>+ <i class="fas fa-edit"></i> </a>
            <button class="btn text-white bg-danger btn-sm supprimer-user" data-id="{{id_event}}" data-action="supprimer">
               <i class="fas fa-trash"></i> 
            </button>
         </td>
      </tr>
      {{/users}}
   </script>

   <!-- jQuery -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
   
   <script src="../assets/JS/mustache.min.js"></script>


   <script src="../assets/JS/script_admin.js"></script>
   <script src="../assets/JS/script_AffEvents.js"></script>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>
