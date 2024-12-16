<?php
session_start();
include_once("../config/ConfigBDD.php"); 
include_once("../class/Users.php"); 

header('Content-Type: application/json'); 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // récupérer et valider les données envoyées
    $email = isset($_POST['email']) ? valider_input($_POST['email']) : '';
    $mdp = isset($_POST['mdp']) ? valider_input($_POST['mdp']) : '';

    if (empty($email) || empty($mdp)) {
        echo json_encode(["status" => "error", "message" => "Tous les champs sont requis.", "redirect" => null]);
        exit;
    }
    
    $user = new Users('', '', $email, '', '', ''); 

    // appel de la méthode connecter et des réponses
    $response = $user->connecter($email, $mdp);

    echo json_encode($response);
}

// fonction pour valider les données entrées
function valider_input($donnees) {
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}
?>
