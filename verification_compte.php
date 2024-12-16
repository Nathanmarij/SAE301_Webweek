<?php 
session_start();

if(!isset($_SESSION['email_a'])) {
   header("Location: connexion_compte.php");
   exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Je vérifie mon compte - Conservatoire de l'Agglomération du Puy-en-Velay</title>
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

   <h1 class="text-center mb-4">Je valide mon compte</h1>    
   
   <form id="verifyForm" action="traitements/t_verification_compte.php" method="POST" class="shadow-lg p-4 rounded bg-white">
      <?php
         if (isset($_SESSION['successMessage'])) {
            echo '<div class="alert alert-success text-center">' . $_SESSION['successMessage'] . '</div>';
            unset($_SESSION['successMessage']); 
         }
      ?>
      <div id="message" class="mb-3 text-center"></div>
      <div class="mb-3">
         <label for="code" class="form-label">Code d'activation<span class="text-danger">*</span> </label>
         <input type="text" class="form-control" id="code" name="code_verification" >
         <div id="codeError" class="error"></div>
      </div>
      <button type="submit" class="btn btn-primary w-100">Envoyer</button>

     </form>
   </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- script pour envoyer le formulaire via AJAX -->
  <script>
   $(document).ready(function(){
      $("#verifyForm").submit(function(event){
         event.preventDefault(); // empêche l'envoi normal du formulaire

         // réinitialiser les messages d'erreur
         $(".error").text("");  
         $(".form-control").removeClass("is-invalid");

         var valid = true; // initialiser la variable de validation

         // Validation des champs
         if ($("#code").val() === "") {
            $("#codeError").text("Le code est requis.");
            $("#code").addClass("is-invalid");
            valid = false;
         }
         
         if (valid) {
            // récupérer les données du formulaire
            var formData = $(this).serialize();

            // envoi des données via AJAX
            $.ajax({
               type: "POST",
               url: "traitements/t_verification_compte.php", 
               data: formData,
               dataType: "json",  
               success: function(response){
                  if (response.status === "success") {
                     // si la vérification a réussi, afficher le chargement et rediriger
                     $("#message").html(`
                        <div class="d-flex align-items-center text-center">
                           <div class="spinner-border text-success me-3" role="status">
                              <span class="visually-hidden">Chargement...</span>
                           </div>
                        </div>
                     `);
                     
                     setTimeout(function() {  // redirection vers la page de connexion après 3 s
                        window.location.href = "connexion_compte.php";
                     }, 3000);
                  } else if (response.status === "error") {
                     // si une erreur est survenue, afficher le message d'erreur
                     $("#message").html('<div class="alert alert-danger">' + response.message + '</div>');
                  }
               },
               error: function(){
                  $("#message").html("Une erreur s'est produite. Veuillez réessayer.").removeClass('text-success').addClass('text-danger');
               }
            });
         }
      });
   });

  </script>

  <!-- Lien vers le fichier JS Bootstrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
