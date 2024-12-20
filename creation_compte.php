<?php 
// pour se connecter à la base de données
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="Conservatoire, Agglomération du Puy-en-Velay, compte, informations personnelles, services personnalisés, réservations">
  <title>Je crée mon compte - Conservatoire de l'Agglomération du Puy-en-Velay</title>
  <meta name="description" content=""/>
  <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
  <!-- Lien vers la feuille de style Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- lien vers le fichier CSS personnalisé -->
  <link rel="stylesheet" href="assets/css/style_base.css">

</head>
<body class="bg-light">

  <div class="container py-5">

    <div class="logo-container text-center mb-3">
      <img src="assets/images/wheel-pink.svg" alt="Logo" class="img-fluid" style="max-width: 100px;">
    </div>

    <h1 class="text-center mb-4">Je crée mon compte</h1>
    
    <form id="registerForm" action="" method="POST" class="shadow-lg p-4 rounded bg-white">
      <div id="message" class="mb-3 text-center"></div>
      <div class="row">
        <div class="col-12 col-lg-6 col-md-12 col-sm-12">
          <div class="mb-3">
            <label for="nom" class="form-label">Nom<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nom" name="nom" >
            <div id="nomError" class="error"></div>
          </div>
        </div>
        <div class="col-12 col-lg-6 col-md-12 col-sm-12">
          <div class="mb-3">
            <label for="prenom" class="form-label">Prénom<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="prenom" name="prenom" >
            <div id="prenomError" class="error"></div>
          </div>
        </div>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="email" name="email" >
        <div id="emailError" class="error"></div>
      </div>
      
      <div class="row">
        <div class="col-12 col-lg-6 col-md-12 col-sm-12">
          <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe<span class="text-danger">*</span></label>
            <input type="password" class="form-control" id="mdp" name="mdp" >
            <div id="mdpError" class="error"></div>
            
          </div>
        </div>
        <div class="col-12 col-lg-6 col-md-12 col-sm-12">
          <div class="mb-3">
            <label for="mdp" class="form-label">Confirmation<span class="text-danger">*</span> </label>
            <input type="password" class="form-control" id="mdpConfirmation" name="mdpConfirmation" >
            <div id="mdpConfirmationError" class="error"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-lg-6 col-md-12 col-sm-12">
          <div class="mb-3">
            <label for="date_naissance" class="form-label">Date de naissance<span class="text-danger">*</span></label>
            <input type="date" class="form-control" id="date_naissance" name="date_naissance" >
            <div id="date_naissanceError" class="error"></div>
          </div>
        </div>
        <div class="col-12 col-lg-6 col-md-12 col-sm-12">
          <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone<span class="text-danger">*</span></label>
            <input type="tel" class="form-control" id="telephone" name="telephone" >
            <div id="telephoneError" class="error"></div>
          </div>
        </div>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="acceptConditions">
        <label class="form-check-label" for="acceptConditions">
          J'accepte les <a href="#" class="text-decoration-none">conditions d'utilisation.</a>
        </label>
        <div id="acceptCError" class="error"></div>
      </div>
      <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
      <p class="text-center mt-3">
        Avez-vous déjà un compte ? 
        <a href="connexion_compte.php" class="color-red">Je me connecte</a>
      </p>
      
    </form>
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- script pour envoyer le formulaire via AJAX -->
  <script>
    
    $(document).ready(function(){
      $("#registerForm").submit(function(event){
        event.preventDefault(); // empêche l'envoi normal du formulaire

         // réinitialiser les messages d'erreur
        $(".error").text("");  
        $(".form-control").removeClass("is-invalid");  

        var valid = true; // variable de contrôle de la validité du formulaire

        // validation des champs
        if ($("#nom").val() === "") {
          $("#nomError").text("Le nom est requis.");
          $("#nom").addClass("is-invalid");
          valid = false;
        }

        if ($("#prenom").val() === "") {
          $("#prenomError").text("Le prénom est requis.");
          $("#prenom").addClass("is-invalid");
          valid = false;
        }

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
        } else {
          var mdp = $("#mdp").val();

          if (!validerMdp(mdp)) {
            $("#mdpError").text("Le mot de passe doit contenir au moins 8 caractères, une majuscule, un chiffre et un caractère spécial.");
            $("#mdp").addClass("is-invalid");
            valid = false;
          }
        }

        if ($("#mdpConfirmation").val() === "") {
          $("#mdpConfirmationError").text("La confirmation du mot de passe est requise.");
          $("#mdpConfirmation").addClass("is-invalid");
          valid = false;
        }

        if ($("#mdp").val() !== $("#mdpConfirmation").val()) {
          $("#mdpConfirmationError").text("Les mots de passe ne correspondent pas.");
          $("#mdpConfirmation").addClass("is-invalid");
          valid = false;
        }

        if ($("#date_naissance").val() === "") {
          $("#date_naissanceError").text("La date de naissance est requise.");
          $("#date_naissance").addClass("is-invalid");
          valid = false;
        }

        if ($("#telephone").val() === "") {
          $("#telephoneError").text("Le téléphone est requis.");
          $("#telephone").addClass("is-invalid");
          valid = false;
        } else {
          var telephone = $("#telephone").val();

          if (!validerTelephone(telephone)) {
            $("#telephoneError").text("Veuillez entrer un numéro de téléphone valide.");
            $("#telephone").addClass("is-invalid");
            valid = false;
          }
        }

        if (!$("#acceptConditions").prop("checked")) {
          $("#acceptCError").html('<div class="error">Vous devez accepter les conditions d\'utilisation.</div>');
          valid = false;
        }

        // si tout est valide, envoi du formulaire via AJAX
        if (valid) {
          var formData = $(this).serialize();
          $.ajax({
            type: "POST",
            url: "traitements/t_creation_compte.php",  
            data: formData,
            dataType: "json", 
            success: function(response) {
              if (response.status === "success") {
                // si la vérification a réussi, afficher le chargement et rediriger
                $("#message").html(`

                  <div class="d-flex align-items-center text-center">
                    <div class="spinner-border text-success me-3" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                  </div>
                `);
                
                setTimeout(function() {  // redirection vers la page de connexion après 3 s
                  window.location.href = "verification_compte.php";
                }, 3000); 
              } else if (response.status === "error") {
                // si une erreur est survenue, afficher le message d'erreur
                $("#message").html('<div class="alert alert-danger">' + response.message + '</div>');
              }
            },
            error: function() {
              $("#message").html('<div class="alert alert-danger">Une erreur s\'est produite. Veuillez réessayer.</div>');
            }

          });
        }
        
        // pour valider le format du mail
        function validerEmail(email) {
          var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
          return regex.test(email);
        }

        // pour valider le format du mdp
        function validerMdp(mdp) {
          var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{8,}$/;
          return regex.test(mdp);
        }

        // pour valider le format du num tel
        function validerTelephone(telephone) {
          var regex = /^(\+?\d{1,3}[-.\s]?)?(\(?\d{1,4}\)?[-.\s]?)?(\d{1,4}[-.\s]?)?(\d{1,4})$/;
          return regex.test(telephone);
        }

      });
    });
  </script>

  <!-- Lien vers le fichier JS Bootstrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
