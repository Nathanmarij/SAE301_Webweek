<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Je me connecte - Conservatoire de l'Agglomération du Puy-en-Velay</title>
  <meta name="description" content="Conservatoire, Agglomération du Puy-en-Velay, compte, email, mot de passe, réservations, sécurité">
  <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
  <!-- Lien vers la feuille de style Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- Lien vers le fichier CSS personnalisé -->
  <link rel="stylesheet" href="assets/css/style_base.css">


</head>
<body class="bg-light">

  <div class="container py-5">

    <div class="logo-container text-center mb-3">
      <img src="assets/images/wheel-pink.svg" alt="Logo" class="img-fluid" style="max-width: 100px;">
    </div>

    <h1 class="text-center mb-4">Je me connecte</h1>    
    
    <form id="loginForm" action="traitements/t_connexion.php" method="POST" class="shadow-lg p-4 rounded bg-white">

      <?php
        if (isset($_SESSION['successMessage'])) {
          echo '<div class="alert alert-success text-center">' . $_SESSION['successMessage'] . '</div>';
          unset($_SESSION['successMessage']); 
          unset($_SESSION['email']); 
        }
      ?>
      <div id="message" class="mb-3 text-center"></div>

      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" id="email" name="email" >
        <div id="emailError" class="error"></div>
      </div>
      
      <div class="mb-3">
        <label for="mdp" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="mdp" name="mdp" >
        <div id="mdpError" class="error"></div>
        
      </div>
      <button type="submit" class="btn btn-primary w-100">Se connecter</button>
      <p class="text-center mt-3 text-end">
        N'avez-vous pas un compte ? 
        <a href="creation_compte.php" class="color-red">Je crée mon compte</a>
      </p>
      <p class="text-center">
        <a href="#" class="color-yellow">Mot de passe oublié ?</a>
      </p>
      
      
    </form>
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Script pour envoyer le formulaire via AJAX -->
  <script>
     $(document).ready(function(){
    $("#loginForm").submit(function(event){
        event.preventDefault(); // Empêche l'envoi normal du formulaire

        // Réinitialiser les messages d'erreur
        $(".error").text("");
        $(".form-control").removeClass("is-invalid");  // Effacer les erreurs sur les champs

        var valid = true; // Variable de contrôle de la validité du formulaire

        if ($("#email").val() === "") {
            $("#emailError").text("L'email est requis.");
            $("#email").addClass("is-invalid");
            valid = false;
        } else if (!validerEmail($("#email").val())) {
            $("#emailError").text("L'email n'est pas valide.");
            $("#email").addClass("is-invalid");
            valid = false;
        }

        if ($("#mdp").val() === "") {
            $("#mdpError").text("Le mot de passe est requis.");
            $("#mdp").addClass("is-invalid");
            valid = false;
        }

        if (valid) {
            // Récupérer les données du formulaire
            var formData = $(this).serialize();

            // Envoi des données via AJAX
            $.ajax({
                type: "POST",
                url: "traitements/t_connexion.php",  // Le fichier PHP pour gérer la connexion
                data: formData,
                dataType: "json",  // Attente d'une réponse JSON
                success: function(response){
                    console.log("Réponse du serveur : ", response);  // Log de la réponse

                    // Si la connexion est réussie
                    if(response.status === "success"){
                        window.location.href = response.redirect;
                    } else {
                        $("#message").html('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                },
                error: function(xhr, status, error){
                    console.error("Erreur AJAX : ", xhr.responseText);
                    $("#message").html('<div class="alert alert-danger">Une erreur s\'est produite. Veuillez réessayer.</div>');
                }
            });
        }
    });

    // Fonction pour valider l'email
    function validerEmail(email) {
        var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return regex.test(email);
    }
});

  </script>



  <!-- Lien vers le fichier JS Bootstrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
