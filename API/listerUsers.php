<?php
include_once("../config/ConfigBDD.php");
include_once("../class/ActionsBDD.php");

// créer instance de la classe ActionsBDD
$recuperer = ActionsBDD::getInstance();

// initialiser le tableau de réponses
$donnees = array();
$donnees["status"] = "OK";

// récupérer le paramètre de rôle (par défaut 1 pour utilisateur)
$categorie = isset($_GET['categorie']) ? filter_var($_GET['categorie'], FILTER_SANITIZE_STRING) : 'all';

// récupérer les paramètres de pagination (offset et limit)
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0; // Décalage
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 5; // Limite par défaut

// requête SQL pour récupérer les utilisateurs
$sql = "
   SELECT 
      u.id_users,
      u.nom,
      u.prenom,
      u.mail,
      u.telephone,
      u.statut_compte,
      u.date_naissance,
      u.code_verification
   FROM 
      users AS u "; 

// condition si une catégorie spécifique est sélectionnée
if ($categorie !== 'all') {
   $sql .= " AND u.statut_compte = :statut_compte"; // Par exemple, on pourrait filtrer les utilisateurs actifs
}

// ajouter la clause ORDER BY pour trier les résultats par id_users
$sql .= " ORDER BY u.id_users DESC";

// ajouter la pagination (LIMIT et OFFSET)
$sql .= " LIMIT $limit OFFSET $offset";

// préparer les paramètres pour la requête
$params = [];
if ($categorie !== 'all') {
   $params[':statut_compte'] = $categorie; // Par exemple, "actif" ou "inactif"
}

// exécuter la requête pour récupérer les utilisateurs
$resultats = $recuperer->getDonnees($sql, $params);

// Si des utilisateurs sont récupérés, les ajouter au tableau de données
if (!empty($resultats)) {
   $donnees["users"] = $resultats;
} else {
   $donnees["status"] = "Aucun utilisateur récupéré";
}

// récupérer le nombre total d'utilisateurs pour calculer le nombre de pages
$sqlTotal = "SELECT COUNT(id_users) AS total FROM users WHERE id_roles = 1";
$resultTotal = $recuperer->getDonnees($sqlTotal);
$totalUsers = $resultTotal[0]['total'];
$donnees["totalPages"] = ceil($totalUsers / $limit);

// Encodage au format JSON 
$donneesJson = json_encode($donnees, JSON_HEX_APOS); 

// Remplacement des \\n qui peuvent causer des erreurs en JavaScript 
$donneesJson = str_replace("\\n", " ", $donneesJson); 

// On écrit les données 
echo $donneesJson;
?>
