<!DOCTYPE html>
<html lang="fr">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
</head>

<body>
    <header>
        <?php include("header.php") ?>
    </header>
    <main class="accueil">
        <div class="presentation">
            <img src="" alt="">
            <h2>Découvrez nos spectacles</h2>
            <p>Explorez notre programmation et trouvez l'événement qui vous transporte.</p>
            <a href="event.php"><button type="button">Reservez maintenant</button></a>
        </div>
        <div class="confiance">
            <div class="container">
                <div id="bloc">
                    <p>Facilité de réservation</p>
                </div>
                <div id="bloc">
                    <p>Un accès direct aux événement</p>
                </div>
                <div id="bloc">
                    <p>Paiement sécurisé</p>
                </div>
            </div>

        </div>
        <div class="recommandation">
            <h3>Evénements recommandé</h3>
            <!--Affichage de 3 événements-->
            <div class="container">
                <div class="card">
                    <p>Date</p>
                    <p>Titre</p>
                    <div class="bandCard">
                    <img src="" alt="icone horloge"><p>00h00</p>
                    <p>Adresse</p>
                    </div>
                </div>
            </div>
            <p>Voir tout les événement -></p>
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

    <footer>
        <?php include("footer.html") ?>
    </footer>
</body>
</html>