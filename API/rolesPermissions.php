<?php
session_start();
require_once('../config/ConfigBDD.php');
require_once('../class/ActionsBDD.php');

header('Content-Type: application/json; charset=UTF-8');

$response = ["status" => "error", "message" => "Action ou méthode invalide."];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
   $bdd = ActionsBDD::getInstance();

   // récupérer les utilisateurs
   $users = $bdd->getDonnees("SELECT id_users, nom, prenom FROM users WHERE id_roles IN (1, 2, 3)");

   // récupérer les rôles et leurs permissions
   $roles = $bdd->getDonnees("
      SELECT r.id_roles, r.nom AS nom_role, p.description AS nom_permission 
      FROM roles AS r
      LEFT JOIN permission_roles AS pr ON r.id_roles = pr.id_roles
      LEFT JOIN permissions AS p ON pr.id_permissions = p.id_permissions
      ORDER BY r.id_roles
   ");

   // structurer les permissions par rôle
   $groupedRoles = [];
   foreach ($roles as $role) {
      $roleId = $role['id_roles'];
      if (!isset($groupedRoles[$roleId])) {
         $groupedRoles[$roleId] = [
            "id_roles" => $roleId,
            "nom_role" => $role['nom_role'],
            "permissions" => []
         ];
      }
      if (!empty($role['nom_permission'])) {
         $groupedRoles[$roleId]['permissions'][] = ["nom_permission" => $role['nom_permission']];
      }
   }

   $response = [
      "status" => "success",
      "users" => $users,
      "roles" => array_values($groupedRoles)
   ];
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // attribuer un rôle à un utilisateur
   $action = $_POST['action'] ?? '';
   $idUsers = intval($_POST['id_users'] ?? 0);
   $idRoles = intval($_POST['id_roles'] ?? 0);

   if ($action === "attribuer" && $idUsers > 0 && $idRoles > 0) {
      $bdd = ActionsBDD::getInstance();
      $result = $bdd->updateDonnees("UPDATE users SET id_roles = :id_roles WHERE id_users = :id_users", [
         ":id_roles" => $idRoles,
         ":id_users" => $idUsers
      ]);

      if ($result) {
         $response = ["status" => "success", "message" => "Rôle attribué avec succès."];
      } else {
         $response = ["status" => "error", "message" => "Impossible d'attribuer le rôle."];
      }
   } else {
      $response["message"] = "Paramètres manquants ou invalides.";
   }
}

echo json_encode($response);
