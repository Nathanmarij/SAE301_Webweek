<?php
include_once("../config/ConfigBDD.php");
include_once("../class/ActionsBDD.php");

header('Content-Type: application/json; charset=UTF-8');
// Initialisation du tableau de réponse
$response = array();
$response['status'] = 'OK';

// Vérification de la méthode POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "methode non autorisée."]);
    exit;
}

// Récupération des paramètres
$id_utilisateur_cible = isset($_POST['id_users']) ? $_POST['id_users'] : null;
$action = isset($_POST['action']) ? $_POST['action'] : null;

// Validation des champs
if (empty($id_utilisateur_cible) || empty($action) || !in_array($action, ['activer', 'desactiver'])) {
    echo json_encode(["status" => "error", "message" => "parametres manquants ou invalides."]);
    exit;
}

// Récupérer le statut actuel de l'utilisateur
$actionsBDD = ActionsBDD::getInstance();
$sql = "SELECT statut_compte FROM users WHERE id_users = :id_users";
$params = [':id_users' => $id_utilisateur_cible];
$resultat = $actionsBDD->getDonnees($sql, $params);

// Vérifier si l'utilisateur existe
if (empty($resultat)) {
    echo json_encode(["status" => "error", "message" => "utilisateur non trouvé."]);
    exit;
}

$statut_actuel = $resultat[0]['statut_compte'];

// Effectuer l'action d'activation/désactivation
if ($action === 'activer' && $statut_actuel !== 'actif') {
    // Mise à jour du statut à "actif"
    $sqlUpdate = "UPDATE users SET statut_compte = 'actif' WHERE id_users = :id_users";
    $paramsUpdate = [':id_users' => $id_utilisateur_cible];
    $actionsBDD->updateDonnees($sqlUpdate, $paramsUpdate);
    $response['message'] = "L'utilisateur a été activé.";
} elseif ($action === 'desactiver' && $statut_actuel !== 'desactiver') {
    // Mise à jour du statut à "désactiver"
    $sqlUpdate = "UPDATE users SET statut_compte = 'inactif' WHERE id_users = :id_users";
    $paramsUpdate = [':id_users' => $id_utilisateur_cible];
    $actionsBDD->updateDonnees($sqlUpdate, $paramsUpdate);
    $response['message'] = "L'utilisateur a été désactivé.";
} else {
    // Aucun changement nécessaire si l'état est déjà le bon
    $response['message'] = "Aucun changement effectué. L'utilisateur est déjà dans le bon état.";
}

echo json_encode($response);
?>
