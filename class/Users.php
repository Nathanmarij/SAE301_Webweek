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
   public $statut_compte;
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

   // récupère le code de vérification associé à l'email de l'utilisateur courant
   public function getVerificationCode() {
      $actionsBDD = ActionsBDD::getInstance();

      $sql = "SELECT code_verification FROM users WHERE mail = :email";
      $result = $actionsBDD->getDonnees($sql, ['email' => $this->email]);
      
      return !empty($result) ? $result[0]['code_verification'] : null;
   }

   // récupère le code de vérification pour un email spécifique
   public function getVerificationCodeByEmail($email) {
      $actionsBDD = ActionsBDD::getInstance();

      $sql = "SELECT code_verification FROM users WHERE mail = :email LIMIT 1";
      $result = $actionsBDD->getDonnees($sql, ['email' => $email]);
      
      return !empty($result) ? $result[0]['code_verification'] : null;
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

   // vérifier si un email est déjà enregistré
   public function emailExists() {
      $actionsBDD = ActionsBDD::getInstance();

      $sql = "SELECT COUNT(*) FROM users WHERE mail = :email";
      $params = [':email' => $this->email];

      $result = $actionsBDD->getDonnees($sql, $params);
      return $result[0]['COUNT(*)'] > 0; 
   }

   // méthode pour récupérer un utilisateur par son email
   public function getUserByEmail($email) {
      $actionsBDD = ActionsBDD::getInstance();
      $params = [':email' => $this->email];

      $sql = "SELECT * FROM users WHERE mail = :email";
      $result = $actionsBDD->getDonnees($sql, $params);
      if (count($result) > 0) {
         // si l'utilisateur existe, initialiser les propriétés de l'objet
         $this->nom = $result[0]['nom'];
         $this->prenom = $result[0]['prenom'];
         $this->email = $result[0]['mail'];
         $this->mdp = $result[0]['mdp'];
         $this->date_naissance = $result[0]['date_naissance'];
         $this->telephone = $result[0]['telephone'];
         $this->statut_compte = $result[0]['statut_compte'];
         //$this->code_verification = $result[0]['code_verification'];
         return true; 
      }
      return false; 
   }
   
}
?>