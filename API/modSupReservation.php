<?php
header('Content-Type: application/json; charset=UTF-8');

include_once("../config/ConfigBDD.php");
include_once("../class/ActionsBDD.php");

$actionsBDD = ActionsBDD::getInstance();

// vérifier l'ID de la réservation
if (!isset($_POST['id_reservation']) || !is_numeric($_POST['id_reservation'])) {
   echo json_encode(["status" => "error", "message" => "ID de réservation invalide."]);
   exit;
}

$idReservation = intval($_POST['id_reservation']);
$action = $_POST['action'] ?? null;

// action : basculer l'état de la réservation
if ($action === "bascule") {
   $sql = "SELECT etat, nb_place FROM reservations WHERE id_reservations = :id_reservation";
   $result = $actionsBDD->getDonnees($sql, [":id_reservation" => $idReservation]);

   if (empty($result)) {
      echo json_encode(["status" => "error", "message" => "Réservation introuvable."]);
      exit;
   }

   $etatActuel = $result[0]['etat'];
   $nbPlacesActuelles = $result[0]['nb_place'];

   $nouvelEtat = $etatActuel == 1 ? 0 : 1;

   $sqlUpdate = "UPDATE reservations SET etat = :nouvel_etat WHERE id_reservations = :id_reservation";
   $params = [
      ":nouvel_etat" => $nouvelEtat,
      ":id_reservation" => $idReservation,
   ];

   if ($actionsBDD->updateDonnees($sqlUpdate, $params)) {
      // mettre à jour les nb_places_reservees de l'événement
      $idEvent = intval($_POST['id_event']);

      $idEvent = intval($_POST['id_event']);
      $sqlEvent = "SELECT nb_places_prevues, nb_places_reservees FROM events WHERE id_events = :id_event";
      $eventData = $actionsBDD->getDonnees($sqlEvent, [":id_event" => $idEvent]);

      if (empty($eventData)) {
         echo json_encode(["status" => "error", "message" => "Événement introuvable."]);
         exit;
      }

      $nbPlacesPrevues = $eventData[0]['nb_places_prevues'];
      $nbPlacesReservees = $eventData[0]['nb_places_reservees'];



      if ($nouvelEtat == 1) {
         // vérifier si le total dépasse le nombre de places prévues
         if ($nbPlacesReservees + $nbPlacesActuelles > $nbPlacesPrevues) {
            echo json_encode(["status" => "error", "message" => "Nombre total de places réservées dépasse le nombre prévu."]);
            exit;
         } else {
            // si le nouvel état est "1" (réservation activée), on ajoute les places réservées à l'événement
            $sqlUpdateEvent = "UPDATE events 
                                 SET nb_places_reservees = nb_places_reservees + :nb_places 
                                 WHERE id_events = :id_event";
         }
         
      } else {
         // si le nouvel état est "0" (réservation désactivée), on soustrait les places réservées de l'événement
         $sqlUpdateEvent = "UPDATE events 
                              SET nb_places_reservees = nb_places_reservees - :nb_places 
                              WHERE id_events = :id_event";
      }

      $actionsBDD->updateDonnees($sqlUpdateEvent, [
         ":nb_places" => $nbPlacesActuelles,
         ":id_event" => $idEvent
      ]);

      echo json_encode(["status" => "OK", "nouvelEtat" => $nouvelEtat]);
   } else {
      echo json_encode(["status" => "error", "message" => "Erreur lors de la mise à jour."]);
   }
   exit;
}

// action : modifier les informations de la réservation
if ($action === "modifier") {
   $nouveauNomEvent = $_POST['id_event'] ?? null;
   $nouveauNbPlaces = $_POST['nouveauNbPlaces'] ?? null;
   $idEvent = intval($_POST['id_event']);

   if (!$nouveauNomEvent || !$nouveauNbPlaces) {
      echo json_encode(["status" => "error", "message" => "Champs requis manquants."]);
      exit;
   }

   // récupérer les anciennes informations
   $sql = "SELECT nb_place FROM reservations WHERE id_reservations = :id_reservation";
   $result = $actionsBDD->getDonnees($sql, [":id_reservation" => $idReservation]);
   if (empty($result)) {
      echo json_encode(["status" => "error", "message" => "Réservation introuvable."]);
      exit;
   }
   $ancienNbPlaces = $result[0]['nb_place'];


   // récupérer les informations de l'événement
   $sqlEvent = "SELECT nb_places_prevues, nb_places_reservees FROM events WHERE id_events = :id_event";
   $eventData = $actionsBDD->getDonnees($sqlEvent, [":id_event" => $idEvent]);

   if (empty($eventData)) {
      echo json_encode(["status" => "error", "message" => "Événement introuvable."]);
      exit;
   }

   $nbPlacesPrevues = $eventData[0]['nb_places_prevues'];
   $nbPlacesReservees = $eventData[0]['nb_places_reservees'];

   // calculer le nouvel état des places réservées après modification
   $nouveauTotalReservees = $nbPlacesReservees - $ancienNbPlaces + $nouveauNbPlaces;

   if ($nouveauTotalReservees > $nbPlacesPrevues) {
      echo json_encode(["status" => "error", "message" => "Le nombre total de places réservées dépasse le nombre prévu."]);
      exit;
   }




   // mettre à jour la réservation
   $sqlUpdate = "UPDATE reservations SET nb_place = :nb_places, id_events = :id_event WHERE id_reservations = :id_reservation";
   $params = [
      ":nb_places" => $nouveauNbPlaces,
      ":id_event" => $idEvent,
      ":id_reservation" => $idReservation,
   ];

   if ($actionsBDD->updateDonnees($sqlUpdate, $params)) {
      // mettre à jour les nb_places_reservees dans l'événement
      $sqlUpdateEvent = "
         UPDATE events 
         SET nb_places_reservees = nb_places_reservees - :ancien_nb_places + :nouveau_nb_places
         WHERE id_events = :id_event
      ";
      $actionsBDD->updateDonnees($sqlUpdateEvent, [
         ":ancien_nb_places" => $ancienNbPlaces,
         ":nouveau_nb_places" => $nouveauNbPlaces,
         ":id_event" => $idEvent
      ]);

      echo json_encode(["status" => "OK", "message" => "Informations modifiées avec succès."]);
   } else {
      echo json_encode(["status" => "error", "message" => "Erreur lors de la mise à jour."]);
   }
   exit;
}

echo json_encode(["status" => "error", "message" => "Action non reconnue."]);
?>
