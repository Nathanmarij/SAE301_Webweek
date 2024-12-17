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

// vérification si l'ID est dans la session
if (!isset($_SESSION['id_user_m']) || empty($_SESSION['id_user_m'])) {
   echo json_encode(["status" => "error", "message" => "ID utilisateur manquant."]);
   exit;
}

// récupération de l'ID de l'utilisateur depuis la session
$id_users = $_SESSION['id_user_m'];

// récupération des données POST
$nom = isset($_POST['nom']) ? $_POST['nom'] : null;
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : null;
$mail = isset($_POST['mail']) ? $_POST['mail'] : null;
$telephone = isset($_POST['telephone']) ? $_POST['telephone'] : null;
$date_naissance = isset($_POST['date_naissance']) ? $_POST['date_naissance'] : null;

// validation des champs (si nécessaire)
if (empty($nom) || empty($prenom) || empty($mail) || empty($telephone) || empty($date_naissance)) {
   echo json_encode(["status" => "error", "message" => "Tous les champs sont obligatoires PHP."]);
   exit;
}


$actionsBDD = ActionsBDD::getInstance();
$sql = "UPDATE users
        SET nom = :nom,
            prenom = :prenom,
            mail = :mail,
            telephone = :telephone,
            date_naissance = :date_naissance
        WHERE id_users = :id_users";

$params = [
   ':nom' => $nom,
   ':prenom' => $prenom,
   ':mail' => $mail,
   ':telephone' => $telephone,
   ':date_naissance' => $date_naissance,
   ':id_users' => $id_users
];

$resultat = $actionsBDD->updateDonnees($sql, $params);

if ($resultat) {
   $response['message'] = "Nom mis à jour avec succès.";
} else {
   $response['status'] = "error";
   $response['message'] = "Erreur lors de la mise à jour du nom.";
}

echo json_encode($response);
?>
