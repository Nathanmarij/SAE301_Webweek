<?php
class SuperAdmin extends Admin {
   // constructeur 
   public function __construct($nom, $prenom, $email, $mdp, $date_naissance, $telephone, $id_roles = 3) {
      parent::__construct($nom, $prenom, $email, $mdp, $date_naissance, $telephone, $id_roles);
   }

   // méthode pour supprimer un compte utilisateur
   public function supprimerCompte($userId) {
      $actionsBDD = ActionsBDD::getInstance();

      $sql = "DELETE FROM users WHERE id_users = :id_users";
      return $actionsBDD->deleteDonnees($sql, [':id_users' => $userId]);
   }

   // méthode pour attribuer une permission à un utilisateur
   public function attribuerPermission($idUser, $idPermission) {
      $actionsBDD = ActionsBDD::getInstance();

      $sql = "INSERT INTO permission_roles (id_permissions, id_roles) VALUES (:id_permissions, :id_roles)";
      return $actionsBDD->insertDonnees($sql, [
         ':id_permissions' => $idPermission,
         ':id_roles' => $idUser
      ]);
   }
}
?>