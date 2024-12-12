<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page gestion pour un admin</title>
</head>

<body>
    <header>
        <?php include("header.php") ?>
    </header>
    <main class="gestion">
        <!--Filtre 1 gestion event-->
        <div class="gestionEvent">
            <h2>Gestion des événements</h2>
            <div class="containerGestionEvent">
                <!--utilisation d'un foreach pour afficher tous les événements-->
                <div id="ligneGestion">
                    <div id="droit">
                        <p>Titre du spectacle</p>
                        <p>Date & Heure</p>
                    </div>
                    <div id="centre">
                        <a href=""><button type="button">Modifier</button></a>
                    </div>
                    <div id="gauche">
                        <a href=""><button type="button">Supprimer</button></a>
                    </div>

                </div>
            </div>
        </div>

        <!--Filtre 2 gestion des avis-->
        <div class="gestionAvis">
            <h2>Gestion des avis</h2>
            <div class="containerGestionAvis">
                <!--utilisation d'un foreach pour afficher tous les événements-->
                <div id="ligneGestion">
                    <div id="droit">
                        <p>Prénom</p>
                    </div>
                    <div id="centre">
                        <p>Avis</p>
                    </div>
                    <div id="gauche">
                        <a href=""><button type="button">Supprimer</button></a>
                    </div>

                </div>
            </div>
        </div>
        <a href=""><button type="button">En voir plus</button></a>

    </main>
</body>

</html>