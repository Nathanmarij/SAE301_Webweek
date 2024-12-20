<?php
include_once("../config/ConfigBDD.php");
include_once("../class/ActionsBDD.php");

// créer instance de la classe ActionsBDD
$recuperer = ActionsBDD::getInstance();

// initialiser le tableau de réponses
$donnees = array();
$donnees["status"] = "OK";

// requete pour récupérer les événements
$sql = "
	SELECT 
		c.id_cat_events,
	c.nom AS nom_cat,
		e.id_events,
		e.nom AS nom_event,
		e.date_events,
		e.alt_img,
		e.url_img,
		l.id_lieux,
		l.adresse
   FROM 
		events AS e
   JOIN 
		cat_events AS c ON c.id_cat_events = e.id_cat_events
	JOIN 
		lieux AS l ON l.id_lieux = e.id_lieux
";


$resultats = $recuperer->getDonnees($sql);


if (!empty($resultats)) {
	$donnees["events"] = $resultats;
} else {
	$donnees["status"] = "Aucun événement récupéré";
}

// Encodage au format JSON 
$donneesJson = json_encode($donnees, JSON_HEX_APOS); 

// Remplacement des \\n qui peuvent causer des erreurs en JavaScript 
$donneesJson = str_replace("\\n", " ", $donneesJson); 

// On écrit les données 
echo $donneesJson;
?>
