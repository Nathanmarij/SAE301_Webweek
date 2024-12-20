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
   <title>Mes configurations - Espace Administrateur</title>
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
               <h1 class="mt-4"><img src="../assets/images/half-wheel-yellow.svg" class="img-fluid" width="32" height="auto" alt=""> Mes configurations</h1>
               <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Configurations </a></li>
                  <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Gestion configurations</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Faire configuration</li>
               </ol>
               <div id="message" class="mb-3"></div>
               <div class="row">
                  <div class="col-6 col-lg-6 col-md-6 col-sm-12">
                     <div class="card p-4">
                        <h5 class="text-primary text-danger">Ajouter un Lieu</h5>
                        <form id="formLieux">
                           <div class="row">
                              <div class="mb-3 col-6 col-lg-6 col-md-6 col-sm-12">
                                 <label for="nomLieu" class="form-label">Nom du lieu <span class="text-danger">*</span></label>
                                 <input type="text" class="form-control" id="nomLieu" placeholder="Entrez le nom du lieu">
                              </div>
                              <div class="mb-3 col-6 col-lg-6 col-md-6 col-sm-12">
                                 <label for="adresseLieu" class="form-label">Adresse <span class="text-danger">*</span></label>
                                 <input type="text" class="form-control" id="adresseLieu" placeholder="Entrez l'adresse du lieu">
                              </div>
                           </div>
                           <div class="row">
                              <div class="mb-3 col-6 col-lg-6 col-md-6 col-sm-12">
                                 <label for="descriptionLieu" class="form-label">Description</label>
                                 <textarea class="form-control" id="descriptionLieu" placeholder="Entrez une description du lieu"></textarea>
                              </div>
                              <div class="mb-3 col-6 col-lg-6 col-md-6 col-sm-12">
                                 <label for="nbPlacesMax" class="form-label">Nombre de places maximum <span class="text-danger">*</span></label>
                                 <input type="number" min="1" class="form-control" id="nbPlacesMax" placeholder="Entrez le nombre de places maximum">
                              </div>
                           </div>
                           <div class="row">
                              <div class="mb-3 col-6 col-lg-6 col-md-6 col-sm-12">
                                 <label for="longitudeLieu" class="form-label">Longitude</label>
                                 <input type="text" class="form-control" id="longitudeLieu" placeholder="Entrez la longitude">
                              </div>
                              <div class="mb-3 col-6 col-lg-6 col-md-6 col-sm-12">
                                 <label for="latitudeLieu" class="form-label">Latitude</label>
                                 <input type="text" class="form-control" id="latitudeLieu" placeholder="Entrez la latitude">
                              </div>
                           </div>
                           <button type="submit" class="btn btn-primary bg-primary">Ajouter</button>
                        </form>
                     </div>
                  </div>
                  <div class="col-3 col-lg-3 col-md-6 col-sm-12">
                     <div class="card p-4">
                        <h5 class="text-primary text-danger">Ajouter une Catégorie</h5>
                        <form id="formCategories">
                           <div class="mb-3">
                                 <label for="nomCategorie" class="form-label">Nom de la catégorie <span class="text-danger">*</span></label>
                                 <input type="text" class="form-control" id="nomCategorie" placeholder="Entrez le nom de la catégorie" >
                           </div>
                           <button type="submit" class="btn btn-primary bg-primary">Ajouter</button>
                        </form>
                     </div>
                  </div>
                  <div class="col-3 col-lg-3 col-md-6 col-sm-12">
                     <div class="card p-4">
                        <h5 class="text-primary text-danger">Ajouter un Mot Interdit</h5>
                        <form id="formMots">
                           <div class="mb-3">
                                 <label for="motInterdit" class="form-label">Mot Interdit <span class="text-danger">*</span></label>
                                 <input type="text" class="form-control" id="motInterdit" placeholder="Entrez le mot interdit" >
                           </div>
                           <button type="submit" class="btn btn-primary bg-primary">Ajouter</button>
                        </form>
                     </div>
                  </div>
               </div>
   
            </div>
         </main>
         <?php include('includes/footer.php'); ?>
      </div>
   </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
// fonction pour gérer les lieux
function ajouterLieu() {
   const nom = document.getElementById('nomLieu').value;
   const adresse = document.getElementById('adresseLieu').value;
   const description = document.getElementById('descriptionLieu').value;
   const nbPlacesMax = document.getElementById('nbPlacesMax').value;
   const longitude = document.getElementById('longitudeLieu').value;
   const latitude = document.getElementById('latitudeLieu').value;

   if (!nom || !adresse || nbPlacesMax <= 0) {
      afficherMessage('Les champs obligatoires doivent être remplis.', 'danger');
      return;
   }

   $.ajax({
      url: "../API/ajouterInfosConfigs.php",
      method: "POST",
      dataType: "json",
      data: {
         action: "ajouterLieu", 
         nom: nom,
         adresse: adresse,
         description: description,
         nb_places_max: nbPlacesMax,
         longitude: longitude,
         latitude: latitude
      },
      success: function (response) {
      if (response.status === 'OK') {
            afficherMessage(response.message, 'success');
            document.getElementById('formLieux').reset(); 
      } else {
            afficherMessage(response.message, 'danger');
      }
      },
      error: function () {
      afficherMessage('Erreur lors de la requête.', 'danger');
      }
   });
}

// fonction pour afficher un message dans la div #message
function afficherMessage(message, type) {
   const messageDiv = document.getElementById('message');
   messageDiv.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
   setTimeout(() => {
       messageDiv.innerHTML = ''; 
   }, 5000);
}

// pour gerer les categories
function ajouterCategorie() {

   
   const nomCategorie = document.getElementById('nomCategorie').value;

   if (!nomCategorie) {
   afficherMessage('Le champ "Nom de la catégorie" est obligatoire.', 'danger');
   return;
   }

   $.ajax({
   url: "../API/ajouterInfosConfigs.php",
   method: "POST",
   dataType: "json",
   data: {
      action: "ajouterCategorie",
      nom_categorie: nomCategorie
   },
   success: function (response) {
      if (response.status === 'OK') {
         afficherMessage(response.message, 'success');
         document.getElementById('formCategories').reset(); 
      } else {
         afficherMessage(response.message, 'danger');
      }
   },
   error: function () {
      afficherMessage('Erreur lors de la requête.', 'danger');
   }
   });
}

// pour les mots interdits
function ajouterMotInterdit() {

   const motInterdit = document.getElementById('motInterdit').value;

   if (!motInterdit) {
      afficherMessage('Le champ "Mot Interdit" est obligatoire.', 'danger');
      return;
   }

   $.ajax({
      url: "../API/ajouterInfosConfigs.php",
      method: "POST",
      dataType: "json",
      data: {
         action: "ajouterMotInterdit",
         mot_interdit: motInterdit
      },
      success: function (response) {
         if (response.status === 'OK') {
            afficherMessage(response.message, 'success');
            document.getElementById('formMots').reset(); 
         } else {
            afficherMessage(response.message, 'danger');
         }
      },
      error: function () {
         afficherMessage('Erreur lors de la requête.', 'danger');
      }
   });
}


function init() {
   const forms = document.querySelectorAll('form');

   forms.forEach((form) => {
      form.addEventListener('submit', function (e) {
         e.preventDefault(); 
         if (form.id === 'formLieux') {
            ajouterLieu();
         } else if (form.id === 'formCategories') {
            ajouterCategorie();
         }  else if (form.id === 'formMots') {
            ajouterMotInterdit();
         }
      });
   });
}

window.addEventListener('load', init);
</script>

<script src="../assets/JS/script_admin.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>
