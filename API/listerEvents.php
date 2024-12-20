<?php
include_once("../config/ConfigBDD.php");
include_once("../class/ActionsBDD.php");

// créer instance de la classe ActionsBDD
$recuperer = ActionsBDD::getInstance();

// initialiser le tableau de réponses
$donnees = array();
$donnees["status"] = "OK";

// Vérification de la méthode de la requête
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Récupération des données de la requête POST
	$action = isset($_POST['action']) ? $_POST['action'] : '';
	$id_event = isset($_POST['id_events']) ? intval($_POST['id_events']) : 0;

	if ($action === 'supprimer' && $id_event > 0) {
		 // Supprimer les réservations et avis liés à l'événement
		 $sqlReservations = "DELETE FROM reservations WHERE id_events = :id_event";
		 $sqlAvis = "DELETE FROM avis WHERE id_events = :id_event";
		 $sqlEvent = "DELETE FROM events WHERE id_events = :id_event";

		 $params = [':id_event' => $id_event];

		 $recuperer->deleteDonnees($sqlReservations, $params);
		 $recuperer->deleteDonnees($sqlAvis, $params);
		 $result = $recuperer->deleteDonnees($sqlEvent, $params);

		 if ($result) {
			  $donnees["status"] = "success";
			  $donnees["message"] = "Événement supprimé avec succès.";
		 } else {
			  $donnees["status"] = "error";
			  $donnees["message"] = "Échec de la suppression de l'événement.";
		 }
	} else {
		 $donnees["status"] = "error";
		 $donnees["message"] = "Action ou ID invalide.";
	}

	echo json_encode($donnees);
	exit;
}




$recherche = isset($_GET['q']) ? filter_var($_GET['q'], FILTER_SANITIZE_STRING) : '';

// récupérer les paramètres de pagination 
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0; 
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10; 

// requete pour récupérer les événements
$sql = "
	SELECT 
		c.id_cat_events,
		c.nom AS nom_cat,
		e.id_events AS id_event,
		e.nom AS nom_event,
		e.date_events,
		e.alt_img,
		e.url_img,
		l.id_lieux,
		l.adresse,
		l.nom AS nom_lieu
   FROM 
		events AS e
   JOIN 
		cat_events AS c ON c.id_cat_events = e.id_cat_events
	JOIN 
		lieux AS l ON l.id_lieux = e.id_lieux
	WHERE 
		e.nom LIKE :recherche OR 
		c.nom LIKE :recherche OR 
		l.nom LIKE :recherche OR 
		l.adresse LIKE :recherche
		ORDER BY e.id_events DESC
   LIMIT $limit OFFSET $offset
";

$params = [
	':recherche' => "%$recherche%",
	':limit' => $limit,
	':offset' => $offset
];

$resultats = $recuperer->getDonnees($sql,$params);


if (!empty($resultats)) {
	$donnees["users"] = $resultats;
} else {
	$donnees["status"] = "Aucun événement récupéré";
}


$sqlTotal = " SELECT COUNT(*) AS total 
   FROM 
		events AS e
   JOIN 
		cat_events AS c ON c.id_cat_events = e.id_cat_events
	JOIN 
		lieux AS l ON l.id_lieux = e.id_lieux
		WHERE 
		e.nom LIKE :recherche OR 
		c.nom LIKE :recherche OR 
		l.nom LIKE :recherche OR 
		l.adresse LIKE :recherche
";
$resultTotal = $recuperer->getDonnees($sqlTotal,[':recherche' => "%$recherche%"]);
$totalUsers = $resultTotal[0]['total'];
$donnees["totalPages"] = ceil($totalUsers / $limit);


// Encodage au format JSON 
$donneesJson = json_encode($donnees, JSON_HEX_APOS); 

// Remplacement des \\n qui peuvent causer des erreurs en JavaScript 
$donneesJson = str_replace("\\n", " ", $donneesJson); 

// On écrit les données 
echo $donneesJson;
?>
