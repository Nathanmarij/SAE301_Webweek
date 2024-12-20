<?php
include_once("../config/ConfigBDD.php");
include_once("../class/ActionsBDD.php");

// initialiser la réponse
$response = ["status" => "error", "message" => "Action non valide."];

// vérifier les paramètres
$action = isset($_POST['action']) ? trim($_POST['action']) : null;
$idAvis = isset($_POST['id_avis']) ? intval($_POST['id_avis']) : null;

if (!$action || !$idAvis) {
   $response["message"] = "Paramètres manquants.";
   echo json_encode($response);
   exit;
}

// instancier la classe ActionsBDD
$actionsBDD = ActionsBDD::getInstance();

// actions possibles
if ($action === "valider") {
   // mettre à jour statut et estVerifie à 1
   $sql = "UPDATE avis SET statut = 1, estVerifie = 1 WHERE id_avis = :id_avis";
   $params = [":id_avis" => $idAvis];

   if ($actionsBDD->updateDonnees($sql, $params)) {
      $response["status"] = "success";
      $response["message"] = "Avis validé avec succès.";
   } else {
      $response["message"] = "Erreur lors de la validation de l'avis.";
   }
} elseif ($action === "rejeter") {
   // mettre à jour statut et estVerifie à 0
   $sql = "UPDATE avis SET statut = 0, estVerifie = 1 WHERE id_avis = :id_avis";
   $params = [":id_avis" => $idAvis];

   if ($actionsBDD->updateDonnees($sql, $params)) {
      $response["status"] = "success";
      $response["message"] = "Avis rejeté avec succès.";
   } else {
      $response["message"] = "Erreur lors du rejet de l'avis.";
   }
}

// Retourner la réponse en JSON
echo json_encode($response, JSON_HEX_APOS);
