<?php
session_start();
include_once("../config/ConfigBDD.php");
include_once("../class/Users.php");

header('Content-Type: application/json; charset=UTF-8');

// initialisation du tableau de réponse
$response = array();
$response['status'] = 'OK';

// vérification de la méthode POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
   echo json_encode(["status" => "error", "message" => "Méthode non autorisée."]);
   exit;
}

// récupération des données 
$nom = isset($_POST['nom']) ? trim($_POST['nom']) : null;
$prenom = isset($_POST['prenom']) ? trim($_POST['prenom']) : null;
$email = isset($_POST['mail']) ? trim($_POST['mail']) : null;
$mdp = isset($_POST['mdp']) ? trim($_POST['mdp']) : null;
$date_naissance = isset($_POST['date_naissance']) ? trim($_POST['date_naissance']) : null;
$telephone = isset($_POST['telephone']) ? trim($_POST['telephone']) : null;
$id_roles = isset($_POST['id_roles']) ? intval($_POST['id_roles']) : 1; 

// validation des champs
if (!$nom || !$prenom || !$email || !$mdp || !$date_naissance || !$telephone) {
   echo json_encode(["status" => "error", "message" => "Tous les champs sont obligatoires."]);
   exit;
}

// création de l'utilisateur avec la classe Users
try {
   $user = new Users($nom, $prenom, $email, $mdp, $date_naissance, $telephone, $id_roles);
   $actionsBDD = ActionsBDD::getInstance();
   $sql1 = "SELECT COUNT(*) as total FROM users WHERE mail = :email";
   $result = $actionsBDD->getDonnees($sql1, [':email' => $email]);

   if ($result[0]['total'] > 0) {

      $response['status'] = "error";
      $response['message'] = "Cet email est déjà utilisé.";
      
   } else {
      $resultat = $user->creer();

      if ($resultat) {
         // activer le compte immédiatement après la création
         $user->activerCompte();

         $response['status'] = "OK";
         $response['message'] = "Utilisateur créé avec succès.";
      } else {
         $response['status'] = "error";
         $response['message'] = "Erreur lors de la création de l'utilisateur.";
      }
   }

      
} catch (Exception $e) {
   $response['status'] = "error";
   $response['message'] = "Erreur serveur : " . $e->getMessage();
}

// Retourner la réponse au format JSON
echo json_encode($response);
?>
