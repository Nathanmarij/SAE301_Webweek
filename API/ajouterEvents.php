<?php
header('Content-Type: application/json; charset=UTF-8');
include_once("../config/ConfigBDD.php");
include_once("../class/ActionsBDD.php");
include_once("../class/Events.php");

// initialisation
$actionsBDD = ActionsBDD::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // récupération des données
   $nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
   $dateEvents = isset($_POST['date_events']) ? trim($_POST['date_events']) : '';
   $description = isset($_POST['description']) ? trim($_POST['description']) : '';
   $prix = isset($_POST['prix']) ? trim($_POST['prix']) : '';
   $altImg = isset($_POST['alt_img']) ? trim($_POST['alt_img']) : '';
   $idLieux = isset($_POST['id_lieux']) ? intval($_POST['id_lieux']) : 0;
   $idCatEvents = isset($_POST['id_cat_events']) ? intval($_POST['id_cat_events']) : 0;
   $nbPlacesPrevues = isset($_POST['nb_places_prevues']) ? intval($_POST['nb_places_prevues']) : 0;
   $nbPlacesReservees = 0; 

   // validation des champs requis
   if (empty($nom) || empty($dateEvents) || empty($idLieux) || empty($idCatEvents) || $nbPlacesPrevues <= 0) {
      echo json_encode(["status" => "error", "message" => "Les champs obligatoires sont manquants ou invalides."]);
      exit;
   }

   // gestion de l'upload d'image
   $urlImg = '';
   if (isset($_FILES['url_img']) && $_FILES['url_img']['error'] === UPLOAD_ERR_OK) {
      $fileTmpPath = $_FILES['url_img']['tmp_name'];
      $fileName = $_FILES['url_img']['name'];
      $fileSize = $_FILES['url_img']['size'];
      $fileType = $_FILES['url_img']['type'];
      $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

      // vérification des extensions autorisées
      $extensionsAutorisees = ['jpg', 'jpeg', 'png', 'gif'];
      if (!in_array($fileExtension, $extensionsAutorisees) || $fileSize > 5 * 1024 * 1024) {
         echo json_encode(["status" => "error", "message" => "Fichier non valide."]);
         exit;
      }

      // déplacement du fichier dans le répertoire des uploads
      $uploadsDir = '../assets/images/events/';
      if (!is_dir($uploadsDir)) mkdir($uploadsDir, 0777, true);
      $nouveauNomFichier = uniqid() . '.' . $fileExtension;
      if (!move_uploaded_file($fileTmpPath, $uploadsDir . $nouveauNomFichier)) {
         echo json_encode(["status" => "error", "message" => "Erreur lors du téléchargement de l'image."]);
         exit;
      }
      $urlImg = $nouveauNomFichier;
   }
   $event = new Events(null, $nom, $dateEvents, $description, $prix, $altImg, $urlImg, $nbPlacesPrevues, 0, $idLieux, $idCatEvents);

   if ($event->creer()) {
      echo json_encode(["status" => "success", "message" => "Événement ajouté avec succès."]);
    } else {
      echo json_encode(["status" => "error", "message" => "Erreur lors de l'ajout de l'événement."]);
    }
} else {
   echo json_encode(["status" => "error", "message" => "Méthode non autorisée."]);
}
