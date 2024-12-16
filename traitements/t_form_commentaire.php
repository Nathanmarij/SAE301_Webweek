<?php
include_once("../config/ConfigBDD.php");
include_once("../class/Users.php");
include_once("../class/ActionsBDD.php");
// Récupération de l'id de l'événement et de l'utilisateur en session
$_GET["id_event"] = 1;
$_SESSION["id_user"] = 37;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $actionsBDD = ActionsBDD::getInstance();
    //Vérification id (gestion des erreurs)
if (!isset($_GET["id_event"]) || !isset($_SESSION["id_user"])) {
   header("Location: ../eventid.php");
}
     
     // Création variable pour ajouter les données
     $sql = "INSERT INTO avis (description, date_creation, id_events, id_users)
     VALUES (:description, NOW(), :id_events, :id_users);"; // NOW() permet de retourner la date et l'heure du système
     
     $param = [
         ':description' => $_POST["commentaire"],
         ':id_events' => 1,//$_GET["id_event"],
         ':id_users' => 37, //$_SESSION["id_user"],
     ];
     
      // exécuter la requête d'insertion
      $result = $actionsBDD->insertDonnees($sql, $param);
    //var_dump( $_POST["commentaire"]);
    //$_GET["commentaire"] = $_POST["commentaire"];
}
//test 


?>