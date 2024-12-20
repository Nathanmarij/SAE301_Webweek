<?php
include_once("../config/ConfigBDD.php");
include_once("../class/ActionsBDD.php");

// créer instance de la classe ActionsBDD
$recuperer = ActionsBDD::getInstance();

// initialiser le tableau de réponses
$donnees = array();
$donnees["status"] = "OK";

// récupérer le paramètre de recherche 
$recherche = isset($_GET['q']) ? filter_var($_GET['q'], FILTER_SANITIZE_STRING) : '';

// récupérer les paramètres de pagination 
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0; 
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10; 

// requête SQL 
$sql = "
   SELECT 
      r.*,
      e.id_events AS id_events,
      e.nom AS nom_event,
      u.nom AS nom_user,
      u.prenom AS prenom_user,
      u.id_users AS id_user_r
   FROM 
      reservations AS r
   INNER JOIN 
      events AS e ON r.id_events = e.id_events
   INNER JOIN 
      users AS u ON r.id_users = u.id_users
   WHERE 
      u.nom LIKE :recherche OR u.prenom LIKE :recherche OR e.nom LIKE :recherche
   ORDER BY u.id_users DESC
   LIMIT $limit OFFSET $offset"; 

// préparer les paramètres pour la requête
$params = [];

$params = [':recherche' => "%$recherche%"];

// exécuter la requête 
$resultats = $recuperer->getDonnees($sql, $params);

// si des reservations sont récupérées, les ajouter au tableau de données
if (!empty($resultats)) {
   $donnees["users"] = $resultats;
   foreach ($resultats as &$reservation) {
      $reservation['statut_reservation'] = ($reservation['etat'] == 1) ? 'acceptée' : 'rejetée';
      $reservation['classe_badge'] = ($reservation['etat'] == 1) ? 'text-bg-primary' : 'text-bg-danger';
   }
   $donnees["users"] = $resultats;
} else {
   $donnees["status"] = "Aucun utilisateur récupéré";
}

$sqlTotal = " SELECT COUNT(*) AS total 
   FROM 
      reservations AS r
   INNER JOIN 
      events AS e ON r.id_events = e.id_events
   INNER JOIN 
      users AS u ON r.id_users = u.id_users
   WHERE 
      u.nom LIKE :recherche OR u.prenom LIKE :recherche OR e.nom LIKE :recherche
";
$resultTotal = $recuperer->getDonnees($sqlTotal,$params);
$totalUsers = $resultTotal[0]['total'];
$donnees["totalPages"] = ceil($totalUsers / $limit);

// Encodage au format JSON 
$donneesJson = json_encode($donnees, JSON_HEX_APOS); 

// Remplacement des \\n qui peuvent causer des erreurs en JavaScript 
$donneesJson = str_replace("\\n", " ", $donneesJson); 

// On écrit les données 
echo $donneesJson;
?>
