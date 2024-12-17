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
    $user = $_SESSION["id_users"];

    // Création variable pour ajouter les données
    $sql = "INSERT INTO avis (description, date_creation, id_events, id_users)
     VALUES (:description, NOW(), :id_events, :id_users);"; // NOW() permet de retourner la date et l'heure du système

    $param = [
        ':description' => $_POST["avis"],
        ':id_events' => $id, //$_GET["id_event"],
        ':id_users' => $user, //$_SESSION["id_user"],
    ];

    // exécuter la requête d'insertion
    $result = $actionsBDD->insertDonnees($sql, $param);
    if ($result) {

        // Récupérer les avis mis à jour
        $reqAvis = "SELECT * FROM avis WHERE id_events = ?";
        $avis = ActionsBDD::getInstance()->getDonnees($reqAvis, [$id]);
// Préparer le HTML des avis à renvoyer
$avisHTML = "";
foreach ($avis as $dAvis) {
    $avisHTML .= "<div><strong>{$_SESSION['nom']}</strong><p>{$dAvis['description']}</p></div>";
}

echo json_encode([
    "status" => "success",
    "message" => "L'avis a bien été ajouté.",
    "avisHTML" => $avisHTML,  // Inclure les avis dans la réponse
]);
//echo json_encode(["status" => "success", "message" => "L'avis a bien été ajouté.", "redirect" => 'eventid.php?id=1#a']);
} else {
echo json_encode(["status" => "error", "avisError" => "L'avis n'a pas pu étre ajouté.", "redirect" => null]);
}
//header("Location: ../eventid.php?id=$id");
//var_dump( $_POST["commentaire"]);
//$_GET["commentaire"] = $_POST["commentaire"];
}
//test 2
?>