// déclaration des fonctions

// fonction pour récupérer
function recupererReservationEtEvent(idReservations, idEvents, idUsers) {
   $.ajax({
      url: "../API/recupererInfosReservation.php",  
      method: "GET",
      dataType: "json",  
      data: {
         id_reservations: idReservations,
         id_events: idEvents,
         id_users: idUsers
      },
      success: function(response) {
         if (response.status === "OK" && response.reservation) {
            const reservation = response.reservation;

            $('.nomPrenom').val(`${reservation.nom_user} ${reservation.prenom_user}`);
            $('#nomEvent').val(reservation.nom_event);
            $('#nbPlaces').val(reservation.nb_place); 
            $('#statutReservation').val(
               reservation.etat === 1 ? 'Acceptée' : 'Rejetée'
            ); 

            // mettre à jour le texte du bouton en fonction du statut
            const bouton = $('#basculeReservationStatut');
            if (reservation.etat === 1) {
               bouton.text('Désactiver la réservation');
               bouton.removeClass('btn-success').addClass('btn-danger');
            } else {
               bouton.text('Activer la réservation');
               bouton.removeClass('btn-danger').addClass('btn-success');
            }
         } else {
            alert("Données de réservation introuvables.");
            window.location.href = "liste_reservations.php";
         }
      },
      error: function(xhr, status, error) {
         console.error("Erreur AJAX:", error);
         alert("Une erreur est survenue lors de la récupération des données.");
      }
   });
}

// fonction pour basculer les états 
function basculeReservationStatut() { //modSupReservation.php
   const ids = getIdDeUrl();
   const messageDiv = $('#message');

   $.ajax({
      url: "../API/modSupReservation.php",
      method: "POST",
      dataType: "json",
      data: {
         action: "bascule",
         id_reservation: ids.idReservations,
         id_event: ids.idEvents
      },
      success: function (response) {
         if (response.status === "OK") {
            const bouton = $('#basculeReservationStatut');
            if (response.nouvelEtat === 1) {
               bouton.text('Désactiver la réservation').removeClass('btn-success').addClass('btn-danger');
               $('#statutReservation').val('Acceptée');

               messageDiv.html('<div class="alert alert-success">La réservation a été acceptée avec succès.</div>');
            } else {
               bouton.text('Activer la réservation').removeClass('btn-danger').addClass('btn-success');
               $('#statutReservation').val('Rejetée');

               messageDiv.html('<div class="alert alert-warning">La réservation a été rejetée avec succès.</div>');
            }
         } else {
            alert(response.message);
         }
      },
      error: function (xhr, status, error) {
         console.error("Erreur AJAX :", error);
         alert("Impossible de basculer l'état de la réservation.");
      }
   });
}

// modifier les informations
function modifierReservationInfos() {
   const ids = getIdDeUrl();
   const nouveauNomEvent = $('#nouveauNomEvent').val();
   const nouveauNbPlaces = $('#nouveauNbPlaces').val();
   const nouveauStatut = $('#nouveauStatutReservation').val(); 

   if (!nouveauNomEvent || !nouveauNbPlaces) {
      $('#message').html('<div class="alert alert-danger">Tous les champs sont obligatoires.</div>');
      return;
   }

   $.ajax({
      url: "../API/modSupReservation.php",
      method: "POST",
      dataType: "json",
      data: {
         action: "modifier",
         id_reservation: ids.idReservations,
         id_event: nouveauNomEvent,
         nouveauNbPlaces: nouveauNbPlaces
      },
      success: function (response) {
         if (response.status === "OK") {
            $('#message').html('<div class="alert alert-success">' + response.message + '</div>');

            const eventText = $('#nouveauNomEvent option:selected').text(); 
            $('#nomEvent').val(eventText);
            $('#nbPlaces').val(nouveauNbPlaces); 
            $('#statutReservation').val(nouveauStatut === "1" ? "Acceptée" : "Rejetée");
         } else {
            $('#message').html('<div class="alert alert-danger">' + response.message + '</div>');
         }
      },
      error: function (xhr, status, error) {
         console.error("Erreur AJAX :", error);
         alert("Impossible de modifier les informations.");
      }
   });
}

// fonction pour récupérer l'ID depuis l'URL
function getIdDeUrl() {
   const urlParams = new URLSearchParams(window.location.search);
   const idReservations = urlParams.get('id_reservations');
   const idEvents = urlParams.get('id_events');
   const idUsers = urlParams.get('id_users');
   return {
      idReservations,
      idEvents,
      idUsers
   };
}

function init() {
   const ids = getIdDeUrl(); 
   const idReservations = ids.idReservations;
   const idEvents = ids.idEvents;
   const idUsers = ids.idUsers;

   if (idReservations && idEvents && idUsers) {
      recupererReservationEtEvent(idReservations, idEvents, idUsers);  // récupère les informations

      const bouton = document.getElementById('basculeReservationStatut');
      bouton.addEventListener('click', basculeReservationStatut);

      document.getElementById('testForm').addEventListener('submit', function (e) {
         e.preventDefault();
         modifierReservationInfos();
      });
   } else {
      alert("ID manquant dans l'URL.");
      window.location.href = "liste_reservations.php";
   }
}

window.addEventListener("load", init);
