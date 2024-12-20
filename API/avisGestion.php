<?php
include_once("../config/ConfigBDD.php");
include_once("../class/ActionsBDD.php");

$recuperer = ActionsBDD::getInstance();

// initialiser le tableau de réponses
$donnees = [];
$donnees["status"] = "OK";

// récupérer les paramètres de pagination
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;

// requête SQL pour récupérer les avis avec mots interdits
$sql = "
   SELECT 
      a.id_avis,
      a.description AS commentaire,
      a.date_creation,
      a.statut,
       a.estVerifie,
      e.nom AS nom_evenement,
      u.nom AS nom_user,
      u.prenom AS prenom_user,
      u.id_users AS id_user
   FROM 
      avis AS a
   JOIN 
      events AS e ON a.id_events = e.id_events
   JOIN 
      users AS u ON a.id_users = u.id_users
   WHERE 
      EXISTS (
         SELECT 1 
         FROM mots_interdits AS m 
         WHERE a.description LIKE CONCAT('%', m.mots, '%')
      ) AND a.statut = 1
       AND a.estVerifie = 0
   ORDER BY a.date_creation DESC
   LIMIT $limit OFFSET $offset
";

// exécuter la requête principale
$resultats = $recuperer->getDonnees($sql);

// si des avis sont récupérés, les ajouter au tableau de données
if (!empty($resultats)) {
   $donnees["users"] = $resultats;
} else {
   $donnees["status"] = "Aucun avis contenant des mots interdits n'a été trouvé.";
}

// requête pour compter le nombre total d'avis avec mots interdits
$sqlTotal = "
   SELECT COUNT(a.id_avis) AS total 
   FROM 
      avis AS a
   WHERE 
      EXISTS (
         SELECT 1 
         FROM mots_interdits AS m 
         WHERE a.description LIKE CONCAT('%', m.mots, '%')
      ) AND a.statut = 1
       AND a.estVerifie = 0
";

$resultTotal = $recuperer->getDonnees($sqlTotal);
$totalUsers = $resultTotal[0]['total'] ?? 0;
$donnees["totalPages"] = ceil($totalUsers / $limit);

// Encodage au format JSON et retour
echo json_encode($donnees, JSON_HEX_APOS);
