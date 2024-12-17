<?php

class ActionsBDD{
   // propriétés
   private static $instance = NULL;
   private $dbh;

   // constructeur
   private function __construct(){
      $this->dbh = Database::getInstance()->getConnexion();
   }

   // obtenir l'instance unique
   public static function getInstance(){
      if (is_null(self::$instance)) {
         self::$instance = new ActionsBDD();
      }
      return self::$instance;
   }

   // méthode pour insérer des données
   public function insertDonnees($requete, $params = []) {
      try {
         $stmt = $this->dbh->prepare($requete);
         $stmt->execute($params);
         return $this->dbh->lastInsertId(); // retourne l'ID de la dernière insertion
      } catch (PDOException $e) {
         echo "Échec lors de l'enregistrement des données : " . $e->getMessage();
         return false;
      }
   }

   // méthode pour récupérer des données
   public function getDonnees($requete, $params = []){
      try {
         $stmt = $this->dbh->prepare($requete);
         $stmt->execute($params);
         return $stmt->fetchAll(PDO::FETCH_ASSOC); // retourne les résultats sous forme de tableau
      } catch (PDOException $e) {
         echo "Échec lors de la récupération des données : " . $e->getMessage();
         return [];
      }
   }

   // méthode pour supprimer des données
   public function deleteDonnees($requete, $params = []) {
      try {
         $stmt = $this->dbh->prepare($requete);
         $stmt->execute($params);
         return $stmt->rowCount(); // retourne le nombre de lignes affectées (lignes supprimées)
      } catch (PDOException $e) {
         echo "Échec lors de la suppression des données : " . $e->getMessage();
         return false;
      }
   }

   // méthode pour mettre à jour des données
   public function updateDonnees($requete, $params = []) {
      try {
         $stmt = $this->dbh->prepare($requete);
         $stmt->execute($params);
         return $stmt->rowCount() > 0; // retourne le nombre de lignes affectées (lignes mises à jour)
      } catch (PDOException $e) {
         echo "Échec lors de la mise à jour des données : " . $e->getMessage();
         return false;
      }
   }
   
}
?>