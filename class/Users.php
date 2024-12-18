<?php
include_once("ActionsBDD.php");
class Users {
   // propriétés
   private $id_users;
   private $dbh;

   public  $nom;
   public  $prenom;
   public  $email;
   public  $mdp;
   public  $date_naissance;
   public  $statut_compte;
   public  $telephone;
   public  $id_roles;

   // constructeur
   public function __construct($nom, $prenom, $email, $mdp, $date_naissance, $telephone, $id_roles = 1) {
      $this->nom = $nom;
      $this->prenom = $prenom;
      $this->email = $email;
      $this->mdp = $mdp;
      $this->date_naissance = $date_naissance;
      $this->telephone = $telephone;
      $this->statut_compte = 'inactif';  
      $this->id_roles = $id_roles; 
      $this->dbh = Database::getInstance()->getConnexion();
   }

   // méthode pour hacher le mot de passe
   private function hasherMdp() {
      return password_hash($this->mdp, PASSWORD_DEFAULT);
   }

   // méthode pour enregistrer un utilisateur dans la base de données
   public function creer() {
      // création de l'instance de ActionsBDD
      $actionsBDD = ActionsBDD::getInstance();

      // hachage du mot de passe
      $mdpHasher = $this->hasherMdp();
      $code_verification = mt_rand(10000, 99999); // générer un code 

      // requete insertion des données dans la base de données
      $sql = "INSERT INTO users (nom, prenom, mail, mdp, date_naissance, statut_compte, code_verification, telephone, id_roles)
         VALUES (:nom, :prenom, :email, :mdp, :date_naissance, :statut_compte, :code_verification, :telephone, :id_roles)";
      
      $params = [
         ':nom' => $this->nom,
         ':prenom' => $this->prenom,
         ':email' => $this->email,
         ':mdp' => $mdpHasher,
         ':date_naissance' => $this->date_naissance,
         ':statut_compte' => $this->statut_compte,
         ':code_verification' => $code_verification,
         ':telephone' => $this->telephone,
         ':id_roles' => $this->id_roles,
      ];

      // exécuter la requête d'insertion
      $result = $actionsBDD->insertDonnees($sql, $params);
      
      return $result > 0; 
   }

   // mettre à jour le statut du compte et le code de vérification
   public function activerCompte() {
      $actionsBDD = ActionsBDD::getInstance();

      $sql_statut = "UPDATE users SET statut_compte = 'actif' WHERE mail = :email";
      $actionsBDD->updateDonnees($sql_statut, ['email' => $this->email]);

      $sql_code = "UPDATE users SET code_verification = 'sans code' WHERE mail = :email";
      $actionsBDD->updateDonnees($sql_code, ['email' => $this->email]);

      return true;  
   }

   // méthode pour connecter un utilisateur
   public function connecter($email, $mdp) {
      $actionsBDD = ActionsBDD::getInstance();
      $sql = "SELECT * FROM users WHERE mail = :email";
      $user = $actionsBDD->getDonnees($sql, ['email' => $email]);

      if (!empty($user)) {
         $user = $user[0];

         // vérifier si le mot de passe est correct
         if (password_verify($mdp, $user['mdp'])) {
            
            if($user['statut_compte'] == "actif") {
               $_SESSION['email'] = $user['mail'];
               $_SESSION['id_users'] = $user['id_users'];
               $_SESSION['nom'] = $user['nom'];
               $_SESSION['prenom'] = $user['prenom'];
               $_SESSION['role'] = $user['id_roles'];

               $response = [
                  "status" => "success",
                  "message" => "Connexion réussie",
               ];
               
               if ($user['id_roles'] == 1) {
                  $response["redirect"] = './event.php';
               } else {
                  $response["redirect"] = './admin/';
               }

               return $response;
            } else {
               
               $_SESSION['email_a'] = $user['mail'];

               return ["status" => "error", "message" => "Veuillez <a href='verification_compte.php'>activer votre compte</a>", "redirect" => null];
            }
            
         } else {
            return ["status" => "error", "message" => "Mot de passe incorrect.", "redirect" => null];
         }
      }  else {
         return ["status" => "error", "message" => "Ce email n'est associé à aucun compte.", "redirect" => null];
      }
   }

   // méthode pour savoir si l'utilisateur est connecté
   function estConnecte() {
      return isset($_SESSION['id_users']) && isset($_SESSION['email']) && isset($_SESSION['role']);
   }
  
}
?>