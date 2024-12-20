<?php
header('Content-Type: application/json; charset=UTF-8');

include_once("../config/ConfigBDD.php");
include_once("../class/ActionsBDD.php");

$actionsBDD = ActionsBDD::getInstance();

// initialiser le tableau de réponses
$donnees = array();
$donnees["status"] = "OK";

// vérifier si les IDs sont présents et valides
$idReservations = isset($_GET['id_reservations']) ? intval($_GET['id_reservations']) : null;
$idEvents = isset($_GET['id_events']) ? intval($_GET['id_events']) : null;
$idUsers = isset($_GET['id_users']) ? intval($_GET['id_users']) : null;

if (!$idReservations || !$idEvents || !$idUsers) {
   $donnees["status"] = "IDs manquants ou invalides";
   echo json_encode($donnees);
   exit;
}

// requête SQL
$sql = "
   SELECT 
      r.id_reservations, r.nb_place, r.etat, 
      e.id_events, e.nom AS nom_event,
      u.id_users, u.nom AS nom_user, u.prenom AS prenom_user
   FROM reservations AS r
   INNER JOIN events AS e ON r.id_events = e.id_events
   INNER JOIN users AS u ON r.id_users = u.id_users
   WHERE r.id_reservations = :idReservations 
   AND e.id_events = :idEvents 
   AND u.id_users = :idUsers
";

$params = [
   ':idReservations' => $idReservations,
   ':idEvents' => $idEvents,
   ':idUsers' => $idUsers
];
$resultats = $actionsBDD->getDonnees($sql, $params);

// si des données sont récupérées, les ajouter au tableau de données
if (!empty($resultats)) {
   $donnees["reservation"] = $resultats[0];
} else {
   $donnees["status"] = "Données introuvables";
}

// Encodage au format JSON 
$donneesJson = json_encode($donnees, JSON_HEX_APOS); 

// Remplacement des \\n qui peuvent causer des erreurs en JavaScript 
$donneesJson = str_replace("\\n", " ", $donneesJson); 

// On écrit les données 
echo $donneesJson;
?>
