<?php
include_once("Users.php");
include_once("Events.php");

class Admin extends Users {
   // constructeur 
   public function __construct($nom, $prenom, $email, $mdp, $date_naissance, $telephone, $id_roles = 2) {
      parent::__construct($nom, $prenom, $email, $mdp, $date_naissance, $telephone, $id_roles);
   }

   // méthode pour modifier les informations d'un utilisateur
   public function modifierInfos($id_users, $updatedDonnes) {
      $actionsBDD = ActionsBDD::getInstance();

      $setClauses = [];
      $params = [];
      foreach ($updatedDonnes as $key => $value) {
         $setClauses[] = "$key = :$key";
         $params[":$key"] = $value;
      }
      $params[':id_users'] = $id_users;

      $sql = "UPDATE users SET " . implode(", ", $setClauses) . " WHERE id_users = :id_users";

      return $actionsBDD->updateDonnees($sql, $params);
   }

   // méthode pour ajouter un événement
   public function ajouterEvents($eventDonnees) {
      $event = new Events(
         null, 
         $eventDonnees['nom'],
         $eventDonnees['date_events'],
         $eventDonnees['description'],
         $eventDonnees['prix'],
         $eventDonnees['alt_img'],
         $eventDonnees['url_img'],
         $eventDonnees['nb_places_prevues'],
         $eventDonnees['nb_places_reservees'],
         $eventDonnees['id_lieux'],
         $eventDonnees['id_cat_events']
      );

      return $event->creer(); 
   }

   // méthode pour supprimer un avis
   public function supprimerAvis($id_users) {
      $actionsBDD = ActionsBDD::getInstance();

      $sql = "DELETE FROM avis WHERE id_avis = :id_avis";
      return $actionsBDD->deleteDonnees($sql, [':id_avis' => $id_users]);
   }
}

?>