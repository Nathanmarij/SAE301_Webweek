<?php
session_start();
include_once("../config/ConfigBDD.php"); 

header('Content-Type: application/json'); 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // récupérer et valider les données envoyées
    $email = isset($_POST['email']) ? valider_input($_POST['email']) : '';
    $mdp = isset($_POST['mdp']) ? valider_input($_POST['mdp']) : '';

    if (empty($email) || empty($mdp)) {
        echo json_encode(["status" => "error", "message" => "Tous les champs sont requis.", "redirect" => null]);
        exit;
    }

    // vérification de l'email et du mot de passe dans la base de données
    try {
        // connexion à la base de données
        $pdo = Database::getInstance()->getConnexion();

        // préparer la requête pour récupérer l'utilisateur par email
        $stmt = $pdo->prepare("SELECT * FROM users WHERE mail = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // vérifier si l'utilisateur existe et si le mot de passe est correct
        if ($user && password_verify($mdp, $user['mdp'])) {
            // connexion réussie, démarrer la session
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $user['id_roles']; //mettre le rôle de l'utilisateur en session

            // redirection en fonction du rôle
            if ($user['id_roles'] == 1) { // c'est un utilisateur
               $redirect = 'espace_user.php';  
            } else {
               
            }
            echo json_encode(["status" => "success", "message" => "Connexion réussie", "redirect" => $redirect]);
        } else {
            echo json_encode(["status" => "error", "message" => "Email ou mot de passe incorrect.", "redirect" => null]);
        }
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Une erreur s'est produite. Veuillez réessayer.", "redirect" => null]);
    }
}

// fonction pour valider les données entrées
function valider_input($donnees) {
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}
?>
