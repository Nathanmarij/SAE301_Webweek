<?php
session_start();

include_once("../config/ConfigBDD.php");
include_once("../class/Users.php");

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // récupérer et valider les données envoyées
      $nom = isset($_POST['nom']) ? valider_input($_POST['nom']) : '';
      $prenom = isset($_POST['prenom']) ? valider_input($_POST['prenom']) : '';
      $email = isset($_POST['email']) ? valider_input($_POST['email']) : '';
      $mdp = isset($_POST['mdp']) ? valider_input($_POST['mdp']) : '';
      $date_naissance = isset($_POST['date_naissance']) ? valider_input($_POST['date_naissance']) : '';
      $telephone = isset($_POST['telephone']) ? valider_input($_POST['telephone']) : '';

      // créer une nouvelle instance de l'utilisateur
      $user = new Users($nom, $prenom, $email, $mdp, $date_naissance, $telephone);

      // vérifier si l'email existe déjà

      $actionsBDD = ActionsBDD::getInstance();
      $sql = "SELECT COUNT(*) as total FROM users WHERE mail = :email";
      $result = $actionsBDD->getDonnees($sql, [':email' => $email]);

      if ($result[0]['total'] > 0) {
         echo json_encode(["status" => "error", "message" => "Cet email est déjà utilisé."]);
         exit;
      } else {
         // enregistrer l'utilisateur
         if ($user->creer()) {
            
            $_SESSION['email_a'] = $email;

            // récupérer le code de vérification généré depuis la base de données
            $sql = "SELECT code_verification FROM users WHERE mail = :email LIMIT 1";
            $result = $actionsBDD->getDonnees($sql, [':email' => $email]);
            $code_verification = $result[0]['code_verification'];

            // envoyer l'email avec le code de vérification
            //envoiVerificationEmail($email, $code_verification);

            // masquer une partie de l'email
            $emailMasque = substr($email, 0, 3) . '***' . substr($email, -3);
            
            $_SESSION['code'] = $code_verification;
            $_SESSION['successMessage'] = "Compte créé avec succès. Veuillez saisir le code envoyé à votre mail ($emailMasque) pour l'activer.";
           
            echo json_encode(["status" => "success", "message" => "Inscription réussie."]);
         } else {
            echo json_encode(["status" => "error", "message" => "Erreur lors de l'inscription."]);
         }
      }
   }

   // fonction pour valider les données entrées
   function valider_input($donnees) {
      $donnees = trim($donnees);
      $donnees = stripslashes($donnees);
      $donnees = htmlspecialchars($donnees);
      return $donnees;
   }

   // function pour envoyer un mail avec le code de vérification
   function envoiVerificationEmail($email, $code_verification) {
      $subject = 'Activation de votre compte';
      
      $message = '<html><head></head><body>';
      $message .= '<p>Bonjour,</p>';
      $message .= '<p>Voici votre code de vérification pour activer votre compte :</p>';
      $message .= '<p><strong>' . $code_verification . '</strong></p>';
      $message .= '<p>Veuillez entrer ce code dans le formulaire pour valider votre inscription.</p>';
      $message .= '<p>Votre adresse e-mail est : <strong>' . $email . '</strong></p>';
      $message .= '<p>Cordialement,</p>';
      $message .= '<p>L\'équipe d\'activation</p>';
      $message .= '</body></html>';

      $headers = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $headers .= 'From: contact@notre-site.com' . "\r\n";  


      // envoi de l'email
      if (mail($email, $subject, $message, $headers)) {
         return ['status' => 'success', 'message' => 'Code de vérification envoyé avec succès.'];
      } else {
         return ['status' => 'error', 'message' => 'Erreur lors de l\'envoi du mail.'];
      }
   }

?>