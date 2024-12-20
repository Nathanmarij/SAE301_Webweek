<?php
include_once("../config/ConfigBDD.php");
include_once("../class/ActionsBDD.php");

// créer instance de la classe ActionsBDD
$recuperer = ActionsBDD::getInstance();

// initialiser le tableau de réponses
$donnees = array();
$donnees["status"] = "OK";

// Récupérer le paramètre de recherche par nom
$nom = isset($_GET['q']) ? filter_var($_GET['q'], FILTER_SANITIZE_STRING) : '';

// récupérer les paramètres de pagination (offset et limit)
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0; // Décalage
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10; // Limite par défaut

// requête SQL pour récupérer les utilisateurs
$sql = "
   SELECT 
      u.id_users,
      u.id_roles,
      u.nom,
      u.prenom,
      u.mail,
      u.telephone,
      u.statut_compte,
      u.date_naissance,
      u.code_verification
   FROM 
      users AS u 
   WHERE
      (u.nom LIKE :nom OR u.prenom LIKE :nom OR u.mail LIKE :nom OR u.statut_compte LIKE :nom)
      AND u.id_roles IN (2, 3)"; 

// ajouter la clause ORDER BY pour trier les résultats par id_users
$sql .= " ORDER BY u.id_users DESC";

// ajouter la pagination (LIMIT et OFFSET)
$sql .= " LIMIT $limit OFFSET $offset";

// préparer les paramètres pour la requête
$params = [];

$params = [':nom' => "%$nom%"];

// exécuter la requête pour récupérer 
$resultats = $recuperer->getDonnees($sql, $params);

// si des utilisateurs sont récupérés, les ajouter au tableau de données
if (!empty($resultats)) {
   // modifier les utilisateurs pour ajouter le champ isActive
   foreach ($resultats as &$user) {
      $user['estActif'] = ($user['statut_compte'] == 'actif') ? true : false;
   }
   $donnees["users"] = $resultats;
} else {
   $donnees["status"] = "Aucun utilisateur récupéré";
}

// récupérer le nombre total d'utilisateurs pour calculer le nombre de pages
$sqlTotal = "SELECT COUNT(id_users) AS total FROM users WHERE (nom LIKE :nom OR prenom LIKE :nom) AND id_roles IN (2, 3)";
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
