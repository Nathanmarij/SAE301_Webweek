<?php
session_start();
include_once("../config/ConfigBDD.php");
include_once("../class/ActionsBDD.php");

header('Content-Type: application/json; charset=UTF-8');

// initialisation du tableau de réponse
$response = array();
$response['status'] = 'OK';

// vérification de la méthode POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
   echo json_encode(["status" => "error", "message" => "Méthode non autorisée."]);
   exit;
}

$id_users = isset($_POST['id_users']) ? intval($_POST['id_users']) : 0;

// suppression de l'utilisateur dans la base de données
$actionsBDD = ActionsBDD::getInstance();
$sql = "DELETE FROM users WHERE id_users = :id_users";

// suppression de ses commentaires
$sql_sup = "DELETE FROM avis WHERE id_users = :id_users";

$params = [':id_users' => $id_users];

$resultat = $actionsBDD->deleteDonnees($sql, $params);
$actionsBDD->deleteDonnees($sql_sup, $params);

if ($resultat) {
   $response['status'] = "OK";
   $response['message'] = "Ce compte a été supprimé avec succès.";
} else {
   // si erreur dans la suppression
   $response['status'] = "error";
   $response['message'] = "Erreur lors de la suppression du compte.";
}

echo json_encode($response);
?>
