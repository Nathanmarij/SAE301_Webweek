let offset = 0; // Initialiser l'offset
const limit = 10; // Nombre d'utilisateurs par page

// Fonction pour vider les utilisateurs affichés
function viderUtilisateurs() {
   document.getElementById('users-container').innerHTML = "";
}

// Fonction pour vider la pagination
function viderPagination() {
   document.getElementById('paginationLiens').innerHTML = "";
}

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

// Fonction pour charger les utilisateurs depuis l'API
function chargerUtilisateurs(page = 1) {
   const xhttp = new XMLHttpRequest();
   
   xhttp.open("GET", `../API/listerUsers.php?limit=${limit}&offset=${(page - 1) * limit}`, true);
   xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

   xhttp.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
         try {
            const response = JSON.parse(this.responseText);

            if (response.status === "OK") {
               viderUtilisateurs();
               const template = document.getElementById("template-users").innerHTML;
               const rendered = Mustache.render(template, { 
                  users: response.users.map(user => ({
                     initiaux: getInitiaux(user.nom + ' ' + user.prenom)
                  }))
               });
               document.getElementById('users-container').innerHTML = rendered;

               // Mettre à jour la pagination
               afficherPagination(response.totalPages, page);
            } else {
               console.error('Aucun utilisateur récupéré.');
            }
         } catch (e) {
            console.error("Erreur de parsing JSON :", e);
         }
      }
   };

   xhttp.send();
}

// Fonction pour afficher les liens de pagination
function afficherPagination(totalPages, pageActuelle) {
   const paginationLiens = document.getElementById('paginationLiens');
   paginationLiens.innerHTML = '';

   for (let i = 1; i <= totalPages; i++) {
      const li = document.createElement('li');
      li.classList.add('page-item');

      const a = document.createElement('a');
      a.classList.add('page-link');
      a.href = '#';
      a.textContent = i;

      if (i === pageActuelle) {
         li.classList.add('active');
      }

      a.addEventListener('click', function (event) {
         event.preventDefault();
         chargerUtilisateurs(i); // Charger les utilisateurs pour la page i
      });

      li.appendChild(a);
      paginationLiens.appendChild(li);
   }
}

// Initialisation au chargement de la page
function init() {
   chargerUtilisateurs(1);

   document.getElementById("search-input").addEventListener("input", function() {
      chargerUtilisateurs(1); // Rechercher depuis la première page
   });

   document.getElementById("status-filter").addEventListener("change", function() {
      chargerUtilisateurs(1); // Filtrer depuis la première page
   });
}

window.addEventListener("load", init);
