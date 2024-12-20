<?php
// fonction récupérer les statistiques 
function getDonneesStats() {
   $actionsBDD = ActionsBDD::getInstance();

   // récupérer le nombre d'utilisateurs
   $sqlUsers = "SELECT COUNT(*) AS total_users FROM users WHERE id_roles=1 ";
   $resultUsers = $actionsBDD->getDonnees($sqlUsers);
   $totalUsers = $resultUsers[0]['total_users'];

   // récupérer le nombre d'événements
   $sqlEvents = "SELECT COUNT(id_events) AS total_events FROM events";
   $resultEvents = $actionsBDD->getDonnees($sqlEvents);
   $totalEvents = $resultEvents[0]['total_events'];

   // récupérer le nombre d'avis
   $sqlAvis = "SELECT COUNT(*) AS total_avis FROM avis";
   $resultAvis = $actionsBDD->getDonnees($sqlAvis);
   $totalAvis = $resultAvis[0]['total_avis'];

   // récupérer le nombre de réservations
   $sqlReservation = "SELECT COUNT(*) AS total_reservation FROM reservations WHERE etat=1";
   $resultReservation = $actionsBDD->getDonnees($sqlReservation);
   $totalReservation = $resultReservation[0]['total_reservation'];

   // récupérer le nombre de admin
   $sqlEvents = "SELECT COUNT(*) AS total_evenements FROM users WHERE id_roles IN (2, 3)";
   $resultEvents = $actionsBDD->getDonnees($sqlEvents);
   $totalAdmins = $resultEvents[0]['total_evenements'];

   return [
      'users' => $totalUsers,
      'events' => $totalEvents,
      'avis' => $totalAvis,
      'reservation' => $totalReservation,
      'admin' => $totalAdmins
   ];
}

?>
