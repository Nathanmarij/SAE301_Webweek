<?php
header('Content-Type: application/json; charset=UTF-8');

include_once("../config/ConfigBDD.php");
include_once("../class/ActionsBDD.php");

$actionsBDD = ActionsBDD::getInstance();

// initialiser le tableau de réponses
$donnees = array();
$donnees["status"] = "OK";

// vérifier si l'ID de l'utilisateur est passé en paramètre
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
   $id_users = intval($_GET['id']);
} else {
   $donnees["status"] = "ID utilisateur manquant ou invalide";
   echo json_encode($donnees);
   exit;
}

// requête SQL pour récupérer les données de l'utilisateur
$sql = "
   SELECT id_users, nom, prenom, mail, telephone, date_naissance, statut_compte, code_verification
   FROM users 
   WHERE id_users = :id_users
";

$params = [':id_users' => $id_users];
$resultats = $actionsBDD->getDonnees($sql, $params);

// si des données sont récupérées, les ajouter au tableau de données
if (!empty($resultats)) {
   $donnees["user"] = $resultats[0];  
} else {
   $donnees["status"] = "Utilisateur introuvable";
}

// Encodage au format JSON 
$donneesJson = json_encode($donnees, JSON_HEX_APOS); 

// Remplacement des \\n qui peuvent causer des erreurs en JavaScript 
$donneesJson = str_replace("\\n", " ", $donneesJson); 

// On écrit les données 
echo $donneesJson;
?>
