<?php
session_start();
include_once("../config/ConfigBDD.php");
include_once("../class/Users.php");
include_once("../class/ActionsBDD.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $actionsBDD = ActionsBDD::getInstance();

    //Vérification id (gestion des erreurs)
    // Récupération de l'id de l'événement et de l'utilisateur en session

    $id = $_POST["id_event"];
    $user = $_SESSION["id_users"];;
    $nbr = $_POST["nb_places"];

    // Création variable pour ajouter les données
    $sql = "INSERT INTO reservations (id_events, id_users, nb_places)
     VALUES (:id_events, :id_users, :nb_places);"; 

    $param = [
        ':id_events' => $id, 
        ':id_users' => $user, 
        ':nb_places' => $nbr,
    ];

    // exécuter la requête d'insertion
    $result = $actionsBDD->insertDonnees($sql, $param);
    if ($result) {

        // Récupérer les réservations mis à jour
        $reqResa = "SELECT * FROM reservations WHERE id_events = ?";
        $resa = ActionsBDD::getInstance()->getDonnees($reqResa, [$id]);
        // Récupérer les informations de l'événement réservé
        $reqEvent = "SELECT * FROM events WHERE id_events = ?";
        $event = ActionsBDD::getInstance()->getDonnees($reqEvent, [$id]);
        $prevu = $event[0]['nb_places_prevues'];
        $reserv = $event[0]['nb_places_reservees'];
        $add = $reserv + $nbr;
        $actionsBDD = ActionsBDD::getInstance();
        $NouvResa = "UPDATE events SET nb_places_reservees = :nbplaces WHERE id_events = :id_event";
        $params = [
            ':nbplaces' => $add,
            ':id_event' => $id,
        ];
        $resultat = $actionsBDD->updateDonnees($NouvResa, $params);

$response = [];
if ($resultat) {
    $response['status'] = "success";
    $response['message'] = "Nombre de places mis à jour avec succès.";
} else {
    $response['status'] = "error";
    $response['message'] = "Erreur lors de la mise à jour des places.";
}

print_r($response);

         
// Préparer le HTML des résarvations à renvoyer
$resaHTML = "";
foreach ($resa as $dResa) {
    $resaHTML .= "<div><strong>{$event[0]['nom']}</strong><p>{$dResa['nb_places']}</p></div>";
}

echo json_encode([
    "status" => "success",
    "message" => "L'avis a bien été ajouté.",
    "resaHTML" => $resaHTML,  // Inclure les resarvations dans la réponse
]);
header("Location: ../reservation_aVenir.php");



//echo json_encode(["status" => "success", "message" => "L'avis a bien été ajouté.", "redirect" => 'eventid.php?id=1#a']);
} /*else {
echo json_encode(["status" => "error", "resaHTML" => "L'avis n'a pas pu étre ajouté.", "redirect" => null]);
}
//header("Location: ../eventid.php?id=$id");
//var_dump( $_POST["commentaire"]);*/
//$_GET["commentaire"] = $_POST["commentaire"];
}
//test 2
?>