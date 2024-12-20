<?php
session_start();
require_once('../config/ConfigBDD.php');
require_once('../class/Users.php');
require_once('fonctions/verifierConnexionEtDroitsAdmin.php');

// vérifier si la personne a le droit à cette page
verifierConnexionEtDroits();

$actionsBDD = ActionsBDD::getInstance();
$sql = "SELECT id_roles, nom FROM roles"; 
$roles = $actionsBDD->getDonnees($sql);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <title>Ajouter un utilisateur - Espace Administrateur</title>
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
               <h1 class="mt-4"><img src="../assets/images/half-wheel-yellow.svg" class="img-fluid" width="32" height="auto" alt=""> Ajouter un utilisateur</h1>
               <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Utilisateurs </a></li>
                  <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Gestions utilisateurs</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Ajouter un utilisateur</li>
               </ol>
               
               <div class="row ">
                  <div class="col-12 col-lg-1 colg-md-1 col-sm-12">
                     <button type="button" class="btn btn-primary bg-danger btn-sm" onclick="window.location.href = 'liste_users.php';">
                        <i class="fas fa-arrow-left"></i> Retour
                     </button>
                  </div>
                  <div class="col-12 col-lg-11 colg-md-11 col-sm-12">
                     <div id="message" class="mt-1"></div>
                     <form id="registerForm">
                        <div class="row">
                           <div class="col-12 col-lg-6 col-md-12 col-sm-12 mb-3">
                              <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="nom" name="nom" >
                              <div id="nomError" class="error"></div>
                           </div>
                           <div class="col-12 col-lg-6 col-md-12 col-sm-12 mb-3">
                              <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="prenom" name="prenom" >
                              <div id="prenomError" class="error"></div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-12 col-lg-6 col-md-12 col-sm-12 mb-3">
                              <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                              <input type="email" class="form-control" id="mail" name="mail" >
                              <div id="mailError" class="error"></div>
                           </div>
                           <div class="col-12 col-lg-6 col-md-12 col-sm-12 mb-3">
                              <label for="role" class="form-label">Rôle de l'utilisateur <span class="text-danger">*</span></label>
                              <select class="form-control" id="role" name="role">
                                 <option value="" disabled selected>Choisissez le rôle</option>
                                 <?php foreach ($roles as $role) : ?>
                                       <option value="<?= htmlspecialchars($role['id_roles']) ?>">
                                          <?php
                                          if ($role['nom'] === 'user') {
                                             echo 'Utilisateur';
                                          } elseif ($role['nom'] === 'admin') {
                                             echo 'Administrateur';
                                          } elseif ($role['nom'] === 'superAdmin') {
                                             echo 'Super Administrateur';
                                          }
                                          ?>
                                       </option>
                                 <?php endforeach; ?>
                              </select>
                              <div id="roleError" class="error"></div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-12 col-lg-6 col-md-12 col-sm-12 mb-3">
                              <label for="mdp" class="form-label">Mot de passe <span class="text-danger">*</span></label>
                              <input type="password" class="form-control" id="mdp" name="mdp" >
                              <div id="mdpError" class="error"></div>
                           </div>
                           <div class="col-12 col-lg-6 col-md-12 col-sm-12 mb-3">
                              <label for="mdpConfirmation" class="form-label">Confirmation mot de passe <span class="text-danger">*</span></label>
                              <input type="password" class="form-control" id="mdpConfirmation" name="mdpConfirmation" >
                              <div id="mdpConfirmationError" class="error"></div>
                           </div>
                        </div>
                        
                        <div class="row">
                           <div class="col-12 col-lg-6 col-md-12 col-sm-12 mb-3">
                              <label for="telephone" class="form-label">Téléphone <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="telephone" name="telephone" >
                              <div id="telephoneError" class="error"></div>
                           </div>
                           <div class="col-12 col-lg-6 col-md-12 col-sm-12 mb-3">
                              <label for="date_naissance" class="form-label">Date de naissance <span class="text-danger">*</span></label>
                              <input type="date" class="form-control" id="date_naissance" name="date_naissance" >
                              <div id="date_naissanceError" class="error"></div>
                           </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary bg-primary">Envoyer</button>
                     </form>
                  </div>                  
               </div>
            </div>
         </main>
         <?php include('includes/footer.php'); ?>
      </div>
   </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="../assets/JS/script_AjoutUser.js"></script>

<script src="../assets/JS/script_admin.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>
