<?php
session_start();
require_once('../config/ConfigBDD.php');
require_once('../class/Users.php');
require_once('fonctions/verifierConnexionEtDroitsAdmin.php');

// vérifier si la personne a le droit à cette page
verifierConnexionEtDroits();


$actionsBDD = ActionsBDD::getInstance();
$sqlCat = "SELECT * FROM cat_events"; 
$cats = $actionsBDD->getDonnees($sqlCat);

$sqlLieux = "SELECT * FROM lieux"; 
$lieux = $actionsBDD->getDonnees($sqlLieux);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <title>Ajouter un évènement - Espace Administrateur</title>
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
               <h1 class="mt-4"><img src="../assets/images/half-wheel-yellow.svg" class="img-fluid" width="32" height="auto" alt=""> Évènements</h1>
               <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Évènements </a></li>
                  <li class="breadcrumb-item"><a class="text-decoration-none" href="#">Gestion Évènements</a></li>
                  <li class="breadcrumb-item active" aria-current="page">ajouter un évènement</li>
               </ol>
               <div id="message" class="mb-3"></div>
               <div class="row">
                     <div class="card p-4">
                        <h5 class="text-primary text-danger">Ajouter un Événement</h5>
                        <form id="formEvenement" enctype="multipart/form-data">
                           <div class="row">
                                 <div class="mb-3 col-6 col-lg-6 col-md-6 col-sm-12">
                                    <label for="nomEvent" class="form-label">Nom de l'événement <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nomEvent" name="nom" placeholder="Entrez le nom de l'événement" >
                                 </div>
                                 <div class="mb-3 col-6 col-lg-6 col-md-6 col-sm-12">
                                    <label for="dateEvent" class="form-label">Date de l'événement <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="dateEvent" name="date_events" >
                                 </div>
                           </div>
                           <div class="row">
                                 <div class="mb-3 col-6 col-lg-6 col-md-6 col-sm-12">
                                    <label for="descriptionEvent" class="form-label">Description</label>
                                    <textarea class="form-control" id="descriptionEvent" name="description" placeholder="Entrez une description de l'événement"></textarea>
                                 </div>
                                 <div class="mb-3 col-6 col-lg-6 col-md-6 col-sm-12">
                                    <label for="prixEvent" class="form-label">Prix (en €) <span class="text-danger">*</span></label>
                                    <input type="text" min="0" class="form-control" id="prixEvent" value="gratuit" name="prix" placeholder="Entrez le prix de l'événement" >
                                 </div>
                           </div>
                           <div class="row">
                                 <div class="mb-3 col-6 col-lg-6 col-md-6 col-sm-12">
                                    <label for="nbPlacesPrevues" class="form-label">Nombre de places prévues <span class="text-danger">*</span></label>
                                    <input type="number" min="1" class="form-control" id="nbPlacesPrevues" name="nb_places_prevues" placeholder="Entrez le nombre de places prévues" >
                                 </div>
                                 <div class="mb-3 col-6 col-lg-6 col-md-6 col-sm-12">
                                    <label for="altImgEvent" class="form-label">Texte alternatif de l'image</label>
                                    <input type="text" class="form-control" id="altImgEvent" name="alt_img" placeholder="Texte alternatif pour l'image">
                                 </div>
                           </div>
                           <div class="row">
                              <div class="mb-3 col-6 col-lg-4 col-md-6 col-sm-12">
                                 <label for="urlImgEvent" class="form-label">Image de l'événement</label>
                                 <input type="file" class="form-control" id="urlImgEvent" name="url_img" accept=".jpg,.jpeg,.png,.gif">
                              </div>
                              <div class="mb-3 col-6 col-lg-4 col-md-6 col-sm-12">
                                 <label for="lieuEvent" class="form-label">Lieu de l'événement <span class="text-danger">*</span></label>
                                 <select class="form-select" id="lieuEvent" name="id_lieux">
                                    <option value="" disabled selected>Choisissez un lieu</option>
                                    <?php foreach ($lieux as $lieu) : ?>
                                       <option value="<?= htmlspecialchars($lieu['id_lieux']) ?>">
                                          <?= $lieu['nom']?>
                                       </option>
                                    <?php endforeach; ?>
                                 </select>
                              </div>
                              <div class="mb-3 col-6 col-lg-4 col-md-6 col-sm-12">
                                 <label for="categorieEvent" class="form-label">Catégorie de l'événement <span class="text-danger">*</span></label>
                           
                                    <select class="form-select" id="categorieEvent" name="id_cat_events">
                                    <option value="" disabled selected>Choisissez un lieu</option>
                                    <?php foreach ($cats as $cat) : ?>
                                       <option value="<?= htmlspecialchars($cat['id_cat_events']) ?>">
                                          <?= $cat['nom']?>
                                       </option>
                                    <?php endforeach; ?>
                                 </select>
                              </div>
                           </div>
                           
                           <button type="submit" class="btn btn-primary bg-primary">Ajouter</button>
                        </form>
                     </div>                  
               </div>
   
            </div>
         </main>
         <?php include('includes/footer.php'); ?>
      </div>
   </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>



function ajouterEvenement() {
    // Récupérer les valeurs des champs
    const formData = new FormData();
    formData.append('nom', document.getElementById('nomEvent').value.trim());
    formData.append('date_events', document.getElementById('dateEvent').value.trim());
    formData.append('description', document.getElementById('descriptionEvent').value.trim());
    formData.append('prix', parseFloat(document.getElementById('prixEvent').value.trim()) || 0);
    formData.append('alt_img', document.getElementById('altImgEvent').value.trim());
    formData.append('id_lieux', document.getElementById('lieuEvent').value.trim());
    formData.append('id_cat_events', document.getElementById('categorieEvent').value.trim());
    formData.append('nb_places_prevues', parseInt(document.getElementById('nbPlacesPrevues').value.trim()) || 0);

    const fileInput = document.getElementById('urlImgEvent');
    if (fileInput.files.length > 0) {
        formData.append('url_img', fileInput.files[0]); // Ajouter le fichier image
    }

    // Validation des champs
    if (!formData.get('nom') || !formData.get('date_events') || !formData.get('id_lieux') || !formData.get('id_cat_events') || !formData.get('nb_places_prevues')) {
        afficherMessage("Tous les champs obligatoires doivent être remplis.", "danger");
        return;
    }

    // Requête AJAX pour envoyer les données à l'API
    fetch('../API/ajouterEvents.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            afficherMessage(data.message, 'success');
            document.getElementById('formEvenement').reset(); // Réinitialiser le formulaire
        } else {
            afficherMessage(data.message, 'danger');
        }
    })
    .catch(error => {
        console.error("Erreur lors de l'ajout de l'événement :", error);
        afficherMessage("Une erreur est survenue lors de l'ajout de l'événement.", "danger");
    });
}

// Fonction pour afficher un message dans la div #message
function afficherMessage(message, type) {
    const messageDiv = document.getElementById('message');
    messageDiv.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
    setTimeout(() => {
        messageDiv.innerHTML = ''; // Supprimer le message après quelques secondes
    }, 5000);
}

// Fonction d'initialisation
function init() {
    const form = document.getElementById('formEvenement');
    form.addEventListener('submit', function (e) {
        e.preventDefault(); // Empêcher le rechargement de la page
        ajouterEvenement(); // Appeler la fonction pour ajouter l'événement
    });
}

// Attacher l'événement lors du chargement de la page
window.addEventListener('load', init);
</script>

<script src="../assets/JS/script_admin.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>
