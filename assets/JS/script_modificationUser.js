// déclaration des fonctions

// fonction pour récupérer les données de l'utilisateur
function recupererUtilisateur(id) {
   $.ajax({
      url: "../API/recupererInfoUser.php",  
      method: "GET",
      dataType: "json",  
      data: { id: id },  
      success: function(response) {
         if (response.status === "OK" && response.user) {
            $('#nom').val(response.user.nom);
            $('#prenom').val(response.user.prenom);
            $('#email').val(response.user.mail);
            $('#telephone').val(response.user.telephone);
            $('#date_naissance').val(response.user.date_naissance);

            // sauvegarder les valeurs actuelles
            currentNom = response.user.nom;
            currentPrenom = response.user.prenom;
            currentEmail = response.user.mail;
            currentTelephone = response.user.telephone;
            currentDateNaissance = response.user.date_naissance;
         } else {
            window.location.href = "liste_users.php";
         }
      },
      error: function(xhr, status, error) {
         console.error("Erreur AJAX:", error);
         alert("Une erreur est survenue lors de la récupération des données.");
      }
   });
}

// fonction pour modifier les informations de l'utilisateur
function modifierUtilisateur(id) {
   const messageDiv = document.getElementById('message');
   let nom = $('#nom').val();
   let prenom = $('#prenom').val();
   let email = $('#email').val();
   let telephone = $('#telephone').val();
   let date_naissance = $('#date_naissance').val();

   if (!nom || !prenom || !email || !telephone || !date_naissance) {
      messageDiv.innerHTML = '<div class="alert alert-danger">Tous les champs sont obligatoires.</div>';
      return;
   }

   // ne faire la mise à jour que si les données ont changé
   if (nom === currentNom && prenom === currentPrenom && email === currentEmail && telephone === currentTelephone && date_naissance === currentDateNaissance) {
      messageDiv.innerHTML = '<div class="alert alert-warning">Aucune modification effectuée.</div>';
      return;
   }

   $.ajax({
      url: "../API/modifierInfosUsers.php?id=" + id,
      method: "POST",
      dataType: "json",
      data: { id_users: id, nom: nom, prenom: prenom, mail: email, telephone: telephone, date_naissance: date_naissance },
      success: function(response) {
         let messageDiv = $('#message');
         if (response.status === "OK") {
               messageDiv.html('<div class="alert alert-success">' + response.message + '</div>');
               console.log(id);
               currentNom = nom;
               currentPrenom = prenom;
               currentEmail = email;
               currentTelephone = telephone;
               currentDateNaissance = date_naissance;
         } else {
               messageDiv.html('<div class="alert alert-warning">' + response.message + '</div>');
         }
      },
      error: function(xhr, status, error) {
      alert("Une erreur est survenue lors de la modification des données.");
      }
   });
}

// fonction pour récupérer l'ID depuis l'URL
function getIdDeUrl() {
   const urlParams = new URLSearchParams(window.location.search);
   return urlParams.get('id'); // récupérer l'ID à partir de l'URL
}

function init() {
   const id_user = getIdDeUrl(); 
   if (id_user) {
      recupererUtilisateur(id_user); // récupère les informations de l'utilisateur

      // soumettre le formulaire
      $('#testForm').submit(function(event) {
      event.preventDefault();
      modifierUtilisateur(id_user); 
      });
   } else {
      alert("ID utilisateur manquant dans l'URL.");
   }
}

window.addEventListener("load", init);
