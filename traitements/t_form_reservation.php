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
    $user = 47;
    $nbr = $_POST["nb_places"];

    // Création variable pour ajouter les données
    $sql = "INSERT INTO reservations (id_events, id_users, nb_place)
     VALUES (:id_events, :id_users, :nb_place);"; 

    $param = [
        ':id_events' => $id, 
        ':id_users' => $user, 
        ':nb_place' => $nbr,
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
// Préparer le HTML des résarvations à renvoyer
$resaHTML = "";
foreach ($resa as $dResa) {
    $resaHTML .= "<div><strong>{$event[0]['nom']}</strong><p>{$dResa['nb_place']}</p></div>";
}

echo json_encode([
    "status" => "success",
    "message" => "L'avis a bien été ajouté.",
    "resaHTML" => $resaHTML,  // Inclure les resarvations dans la réponse
]);
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