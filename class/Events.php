<?php
require_once("ActionsBDD.php");

class Events {
   // propriétés
   private $id = null;

   public $nom = '';
   public $date_events = '';
   public $description = '';
   public $prix = '';
   public $alt_img = '';
   public $url_img = '';
   public $nb_places_prevues = 0;
   public $nb_places_reservees = 0;
   public $id_lieux = 0;
   public $id_cat_events = 0;

   // constructeur
   public function __construct($id, $nom, $date_events, $description, $prix, $alt_img, 
   $url_img, $nb_places_prevues, $nb_places_reservees, $id_lieux, $id_cat_events) {
      $this->id = $id;
      $this->nom = $nom;
      $this->date_events = $date_events;
      $this->description = $description;
      $this->prix = $prix;
      $this->alt_img = $alt_img;
      $this->url_img = $url_img;
      $this->nb_places_prevues = $nb_places_prevues;
      $this->nb_places_reservees = $nb_places_reservees;
      $this->id_lieux = $id_lieux;
      $this->id_cat_events = $id_cat_events;
   }

   // créer un événement
   public function creer() {
      $actionsBDD = ActionsBDD::getInstance();
      
      $sql = "INSERT INTO events (nom, date_events, description, prix, alt_img, url_img, nb_places_prevues, nb_places_reservees, id_lieux, id_cat_events)
         VALUES (:nom, :date_events, :description, :prix, :alt_img, :url_img, :nb_places_prevues, :nb_places_reservees, :id_lieux, :id_cat_events)";
      
      $params = [
         ':nom' => $this->nom,
         ':date_events' => $this->date_events,
         ':description' => $this->description,
         ':prix' => $this->prix,
         ':alt_img' => $this->alt_img,
         ':url_img' => $this->url_img,
         ':nb_places_prevues' => $this->nb_places_prevues,
         ':nb_places_reservees' => $this->nb_places_reservees,
         ':id_lieux' => $this->id_lieux,
         ':id_cat_events' => $this->id_cat_events
      ];
   
      $result = $actionsBDD->insertDonnees($sql, $params);
      
      return $result > 0;
   }
   

    // afficher les informations d'un événement
    public function afficherEvent() {
      return "Nom: " . $this->nom . " | Date: " . $this->date_events . " | Description: " . $this->description . " | Prix: " . $this->prix;
   }
}
?>
