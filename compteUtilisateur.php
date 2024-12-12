<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header>
        <?php include("header.php") ?>
    </header>
    <main class="compteUtilisateur">
        <h2>Mon compte</h2>
        <div class="containerInfo">
            <div class="ligneInfo">
                <p>Prénom</p>
                <div id="blocTxt">
                    <!--en php récupération du prénom-->
                </div>
            </div>
            <div class="ligneInfo">
                <p>Nom</p>
                <div id="blocTxt">
                    <!--en php récupération du nom-->
                </div>
            </div>
            <div class="ligneInfo">
                <p>Téléphone</p>
                <div id="blocTxt">
                    <!--en php récupération du téléphone-->
                </div>
            </div>
            <div class="ligneInfo">
                <p>Adresse mail</p>
                <div id="blocTxt">
                    <!--en php récupération du adresse mail-->
                </div>
            </div>
            <div class="ligneInfo">
                <p>Mot de passe</p>
                <div id="blocTxt">
                    <!--en php récupération du mot de passe caché-->
                </div>
            </div>

        </div>
        <a href=""><button type="button" id="button">Modifier mes informations</button></a>


    </main>
    <footer>
        <?php include("footer.html")?>
    </footer>
</body>

</html>