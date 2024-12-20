// déclaration des fonctions 

// fonction pour obtenir les initiales à partir du nom complet
function getInitiaux(nomComplet) {
   const mots = nomComplet.trim().split(' ');  // diviser le nom complet en mots
   let initiaux = '';
   
   const motsLimites = mots.slice(0, 2);  // prendre uniquement les deux premiers mots

   // ajouter la première lettre de chaque mot (nom et prénom)
   motsLimites.forEach(mot => {
      initiaux += mot.charAt(0).toUpperCase();
   });

   return initiaux;
}

// fonction pour récupérer les données de l'utilisateur
function recupererUtilisateur(id) {
   $.ajax({
      url: "../API/recupererInfoUser.php",  
      method: "GET",
      dataType: "json",  
      data: { id: id },  
      success: function(response) {
         if (response.status === "OK" && response.user) {
            // générer les initiaux
            const nomComplet = response.user.nom + ' ' + response.user.prenom;
            const initiaux = getInitiaux(nomComplet);
            $('#initiaux').text(initiaux);

            $('.nomComplet').text(response.user.nom + ' ' + response.user.prenom);
            $('#email').text(response.user.mail);
            $('#telephone').text(response.user.telephone);
            $('#statutCompte').text(response.user.statut_compte);
            $('#date_naissance').text(response.user.date_naissance);

            const statut = response.user.statut_compte; // récupérer le statut du compte
            const statutSpan = $('#statutBg'); 

            if (statut === 'actif') {
                  statutSpan.closest('span') 
                     .removeClass('bg-danger')  
                     .addClass('bg-success');  
            } else {
                  statutSpan.closest('span') 
                     .removeClass('bg-success') 
                     .addClass('bg-danger');  
            }
         } else {
            window.location.href = "liste_users.php";
         }
      },
      error: function(xhr, status, error) {
         alert("Une erreur est survenue lors de la récupération des données.");
      }
   });
}

// fonction pour récupérer l'ID depuis l'URL
function getIdFromUrl() {
   const urlParams = new URLSearchParams(window.location.search);
   return urlParams.get('id'); // récupérer l'ID à partir de l'URL
}

// fonction d'initialisation qui appelle les autres fonctions
function init() {
   const id_user = getIdFromUrl(); // récupérer l'ID de l'URL
   if (id_user) {
      recupererUtilisateur(id_user); // récupère les informations de l'utilisateur
   } else {
      alert("ID utilisateur manquant dans l'URL.");
   }
}

// attacher la fonction init à l'événement "load" du window
window.addEventListener("load", init);
