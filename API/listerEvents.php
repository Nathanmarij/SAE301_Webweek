<?php
include_once("../config/ConfigBDD.php");
include_once("../class/ActionsBDD.php");

// créer instance de la classe ActionsBDD
$recuperer = ActionsBDD::getInstance();

// initialiser le tableau de réponses
$donnees = array();
$donnees["status"] = "OK";

// requete pour récupérer les événements
$sql = "SELECT * FROM events";

$resultats = $recuperer->getDonnees($sql);

if(!empty($resultats)){
	$donnees["events"] = $resultats;
}else {
	$donnees["status"] = "Aucun événement récupéré";
}

// Encodage au format JSON 
$donneesJson = json_encode($donnees, JSON_HEX_APOS); 

// Remplacement des \\n qui peuvent causer des erreurs en JavaScript 
$donneesJson = str_replace("\\n", " ", $donneesJson); 

// On écrit les données 
echo $donneesJson;
?>
