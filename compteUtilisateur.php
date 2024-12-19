<?php

session_start();
include_once("config/ConfigBDD.php");
include_once("class/ActionsBDD.php");

if (!isset($_SESSION['email'])) {
    header("Location: ./connexion_compte.php");
    exit();
}
$email = $_SESSION['email'];

$requete = "SELECT prenom, nom, telephone, mail, date_naissance FROM users WHERE mail = :email";
$params = [':email' => $email];

$userDetails = ActionsBDD::getInstance()->getDonnees($requete, $params);

if (!$userDetails) {
    header("Location: ./connexion_compte.php");
    exit();
}

$users = $userDetails[0];
function deconnexion() {
    session_start();
    session_unset();
    session_destroy();
    header("Location: connexion_compte.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deco'])) {
    deconnexion();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/styleuser.css">
</head>

<body>
    <header>
        <?php include("header.php"); ?>
    </header>
    <main class="compteUtilisateur">
        <h2 class="text-center text-uppercase fw-bold mb-4">Mon compte</h2>
        <div class="containerInfo">
            <div class="ligneInfo">
                <p>Prénom</p>
                <div id="blocInfo">
                    <input type="text" value="<?php echo htmlspecialchars($users['prenom']); ?>" readonly>
                </div>
            </div>
            <div class="ligneInfo">
                <p>Nom</p>
                <div id="blocInfo">
                    <input type="text" value="<?php echo htmlspecialchars($users['nom']); ?>" readonly>
                </div>
            </div>
            <div class="ligneInfo">
                <p>Date de naissance</p>
                <div id="blocInfo">
                    <input type="text" value="<?php echo htmlspecialchars($users['date_naissance']); ?>" readonly>
                </div>
            </div>
            <div class="ligneInfo">
                <p>Téléphone</p>
                <div id="blocInfo">
                    <input type="text" value="<?php echo htmlspecialchars($users['telephone']); ?>" readonly>
                </div>
            </div>
            <div class="ligneInfo">
                <p>Adresse Email</p>
                <div id="blocInfo">
                    <input type="email" value="<?php echo htmlspecialchars($users['mail']); ?>" readonly>
                </div>
            </div>
            <form method="POST" action="">
                <div class="col">
                    <button type="submit" name="deco" id="button" class="btn btn-danger">Déconnexion</button>
                </div>
            </form>
        </div>
    </main>
    <footer>
        <?php include("footer.html"); ?>
    </footer>
</body>

</html>