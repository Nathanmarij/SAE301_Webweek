<!DOCTYPE html>
<html lang="fr">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style/style.css" rel="stylesheet">
    <title>Page d'accueil</title>
</head>

<body>
    <header>
        <?php include("header.php") ?>
    </header>
    <main class="accueil">
        <div class="container-fluid">
            <div class="row presentation">
                <div class="col-12 col-md-6 concervatoir">
                    <img src="img/concervatoir.jpg" alt="concervatoir">
                </div>
                <div class="col decouvrir">
                    <h2>DÉCOUVREZ NOS SPECTACLES</h2>
                    <p>Explorez notre programmation et trouvez l'événement qui vous transporte.</p>
                    <a href="event.php"><button type="button">RÉSERVEZ MAINTENANT</button></a>
                </div>
            </div>
        </div>
        <div class="confiance">
            <div class="container-fluid">
                <div class="row g-0">
                    <div class="col d-flex justify-content-center align-items-center confiance-content" 
                    style="background-image: url('img/reservation.avif');">
                        <p>Facilité de réservation</p>
                    </div>
                    <div class="col bg-image d-flex justify-content-center align-items-center confiance-content" 
                    style="background-image: url('img/acces.avif');">
                        <p>Un accès direct aux événements</p>
                    </div>
                    <div class="col bg-image d-flex justify-content-center align-items-center confiance-content" 
                    style="background-image: url('img/paiement.jpg');">
                        <p>Paiement sécurisé</p>
                    </div>
                </div>
            </div>
        </div>
        <div class= "recommandation">
            <!--Affichage de 3 événements-->
            <div class="container">
            <h3>Evénements recommandé</h3>
    <div class="row g-0 justify-content-center"> <!-- Centrer les colonnes horizontalement -->
        <div class="col-12 col-md-4 event d-flex flex-column align-items-center"> <!-- Centrer le contenu de chaque colonne -->
            <a href="eventid.php">
                <div class="visu" style="background-image: url('img/affiche-1.jpeg');">
                    <p>jeudi</p>
                    <p class="jour">12</p>
                    <p>DEC</p>
                    <img src="img/ligne-hor.svg" alt="hor">
                    <p>CONFÉRENCE SUR LES MÉCANISMES DE JEU ET MASTER-CLASSE / CUIVRES</p>
                </div>
                <div class="bandCard">
                    <div class="heure">
                        <img src="img/horloge-icon.svg" alt="icone-horloge">
                        <p>19h00</p>
                    </div>
                    <img src="img/ligne-vertical.svg" alt="vert" id="vert">
                    <div class="adresse">
                        <img src="img/localisation.svg" alt="loc">
                        <p>Auditorium - ATELIERS DES ARTS</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-4 event d-flex flex-column align-items-center">
            <a href="eventid.php">
                <div class="visu" style="background-image: url('img/affiche\ 2.jpg  ');">
                    <p>samedi</p>
                    <p class="jour">14</p>
                    <p>DEC</p>
                    <img src="img/ligne-hor.svg" alt="hor">
                    <p>BAL DE NOËL / MUSIQUES ET DANSES TRADITIONNELLES</p>
                </div>
                <div class="bandCard">
                    <div class="heure">
                        <img src="img/horloge-icon.svg" alt="icone-horloge">
                        <p>17h30</p>
                    </div>
                    <img src="img/ligne-vertical.svg" alt="vert" id="vert">
                    <div class="adresse">
                        <img src="img/localisation.svg" alt="loc">
                        <p>Auditorium - ATELIERS DES ARTS</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-4 event d-flex flex-column align-items-center">
            <a href="eventid.php">
                <div class="visu" style="background-image: url('img/affiche-1.jpeg');">
                    <p>jeudi</p>
                    <p class="jour">12</p>
                    <p>DEC</p>
                    <img src="img/ligne-hor.svg" alt="hor">
                    <p>CONFÉRENCE SUR LES MÉCANISMES DE JEU ET MASTER-CLASSE / CUIVRES</p>
                </div>
                <div class="bandCard">
                    <div class="heure">
                        <img src="img/horloge-icon.svg" alt="icone-horloge">
                        <p>19h00</p>
                    </div>
                    <img src="img/ligne-vertical.svg" alt="vert" id="vert">
                    <div class="adresse">
                        <img src="img/localisation.svg" alt="loc">
                        <p>Auditorium - ATELIERS DES ARTS</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="container">
            <div class="row g-0 justify-content-center"> <!-- Centrer les colonnes horizontalement -->
                <div class="col-12 col-md-8 event d-flex flex-column align-items-center"></div>
                <div class="col-12 col-md-4 event d-flex flex-column align-items-end voir-plus">
                    <a href="event.php">Voir tout les événement ></a>
                </div>
            </div>
        </div>
    </div>
</div>

        </div>
        <div class="categories">
            <h3>Catégories</h3>
            <div class="container">
                <div id="bloc">
                    <p>Musique</p>
                </div>
                <div id="bloc">
                    <p>Danse</p>
                </div>
                <div id="bloc">
                    <p>Théâtre</p>
                </div>
            </div>
        </div>

    </main>

