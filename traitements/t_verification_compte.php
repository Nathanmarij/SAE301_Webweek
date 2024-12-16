<?php
session_start();
include_once("../config/ConfigBDD.php");
include_once("../class/Users.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // vérifier que l'email est dans la session
   if (!isset($_SESSION['email'])) {
      echo json_encode(["status" => "error", "message" => "Aucun email trouvé dans la session."]);
      exit;
   }

   $email = $_SESSION['email'];
   $code_saisi = isset($_POST['code_verification']) ? valider_input($_POST['code_verification']) : '';

   // créer une instance de l'utilisateur
   $user = new Users('', '', $email, '', '', '', 1);

   // récupérer l'utilisateur par email
   $actionsBDD = ActionsBDD::getInstance();
   $sql = "SELECT * FROM users WHERE mail = :email";
   $result = $actionsBDD->getDonnees($sql, [':email' => $email]);

   if (empty($result)) {
      echo json_encode(["status" => "error", "message" => "Utilisateur non trouvé."]);
      exit;
   }else{
      $user->code_verification = $result[0]['code_verification'];

      // vérifier si le code saisi correspond à celui dans la base de données
      if ($code_saisi !== $user->code_verification) {
         echo json_encode(["status" => "error", "message" => "Le code de vérification est incorrect."]);
         exit;
      }else {
         // si le code est correct, changer le statut du compte en 'actif' et réinitialiser le code de vérification
         if ($user->activerCompte()) {
            unset($_SESSION['email']);
            
            $_SESSION['successMessage'] = "Compte activé avec succès. Vous pouvez maintenant vous connecter.";
            echo json_encode(["status" => "success", "message" => "Bon !"]);
         } else {
            echo json_encode(["status" => "error", "message" => "Erreur lors de l'activation du compte."]);
         }
      }

      
   }

}

function valider_input($donnees) {
   $donnees = trim($donnees);
   $donnees = stripslashes($donnees);
   $donnees = htmlspecialchars($donnees);
   return $donnees;
}

header('Content-Type: application/json');

?>
