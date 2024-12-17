<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style/style.css" rel="stylesheet">
    <link href="style/styleFooter.css" rel="stylesheet">

</head>
<body>
    <?php
        include ("header.php");
    ?>
    <div class="main">
        <div>
            <h2>Spectacles à venir</h2>
            <?php
                for ($i=0; $i<3; $i++){
                ?>
                <div>
                    <p>Date</p>
                    <h3>Titre</h3>
                    <div>
                        <p>00H00</p>
                        <h4>Adresse</h4>
                    </div>
                </div>
                <?php
                    }
                ?>
        </div>
        <div>
            <h2>Spectacles passé</h2>
            <?php
                for ($i=0; $i<3; $i++){
                ?>
                <div>
                    <p>Date</p>
                    <h3>Titre</h3>
                    <div>
                        <p>00H00</p>
                        <h4>Adresse</h4>
                    </div>
                </div>
                <?php
                    }
                ?>
        </div>
    </div>
    <?php
        include ("footer.html");
    ?>
</body>
</html>