<?php
header('Content-Type: application/json; charset=UTF-8');
include_once("../config/ConfigBDD.php");
include_once("../class/ActionsBDD.php");

// initialisation
$actionsBDD = ActionsBDD::getInstance();

// vérification de l'action
$action = isset($_POST['action']) ? $_POST['action'] : null;

// action : 1
if ($action === "ajouterLieu") {
   $nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
   $adresse = isset($_POST['adresse']) ? trim($_POST['adresse']) : '';
   $description = isset($_POST['description']) ? trim($_POST['description']) : '';
   $nb_places_max = isset($_POST['nb_places_max']) ? intval($_POST['nb_places_max']) : 0;
   $longitude = isset($_POST['longitude']) ? trim($_POST['longitude']) : '';
   $latitude = isset($_POST['latitude']) ? trim($_POST['latitude']) : '';

   // validation des champs requis
   if (empty($nom) || empty($adresse) || $nb_places_max <= 0) {
      echo json_encode(["status" => "error", "message" => "Les champs obligatoires (nom, adresse, nombre de places) doivent être remplis."]);
      exit;
   }

   // requête SQL pour insérer un lieu
   $sql = "
      INSERT INTO lieux (nom, adresse, description, nb_places_max, longitude, latitude)
      VALUES (:nom, :adresse, :description, :nb_places_max, :longitude, :latitude)
   ";

   $params = [
      ":nom" => $nom,
      ":adresse" => $adresse,
      ":description" => $description,
      ":nb_places_max" => $nb_places_max,
      ":longitude" => $longitude,
      ":latitude" => $latitude
   ];

   // exécution de la requête et retour
   if ($actionsBDD->insertDonnees($sql, $params)) {
      echo json_encode(["status" => "OK", "message" => "Lieu ajouté avec succès."]);
   } else {
      echo json_encode(["status" => "error", "message" => "Erreur lors de l'ajout du lieu."]);
   }
   exit;
}

if ($action === "ajouterCategorie") {
   $nomCategorie = isset($_POST['nom_categorie']) ? trim($_POST['nom_categorie']) : '';

   if (empty($nomCategorie)) {
      echo json_encode(["status" => "error", "message" => "Le champ 'Nom de la catégorie' est obligatoire."]);
      exit;
   }

   $sql = "INSERT INTO cat_events (nom) VALUES (:nom)";
   $params = [
      ":nom" => $nomCategorie
   ];

   if ($actionsBDD->insertDonnees($sql, $params)) {
      echo json_encode(["status" => "OK", "message" => "Catégorie ajoutée avec succès."]);
   } else {
      echo json_encode(["status" => "error", "message" => "Erreur lors de l'ajout de la catégorie."]);
   }
   exit;
}

if ($action === "ajouterMotInterdit") {
   $mot = isset($_POST['mot_interdit']) ? trim($_POST['mot_interdit']) : '';

   if (empty($mot)) {
      echo json_encode(["status" => "error", "message" => "Le mot interdit est obligatoire."]);
      exit;
   }

   $sql = "INSERT INTO mots_interdits (mots) VALUES (:mot)";
   $params = [":mot" => $mot];

   if ($actionsBDD->insertDonnees($sql, $params)) {
      echo json_encode(["status" => "OK", "message" => "Mot interdit ajouté avec succès."]);
   } else {
      echo json_encode(["status" => "error", "message" => "Erreur lors de l'ajout du mot interdit."]);
   }
   exit;
}

// action non reconnue
echo json_encode(["status" => "error", "message" => "Action non reconnue."]);
