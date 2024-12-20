let offset = 0; // initialiser l'offset
const limit = 10; // nombre d'utilisateurs par page

// fonction pour vider la table d'utilisateurs
function viderTableUtilisateurs() {
   document.getElementById('users-container').innerHTML = "";
}

// fonction pour vider la pagination
function viderPagination() {
   document.getElementById('paginationLiens').innerHTML = "";
}

// fonction pour charger les utilisateurs depuis l'API
function chargerUtilisateurs(page = 1, recherche = '') {
   const xhttp = new XMLHttpRequest();
   const limit = 10; // Nombre d'utilisateurs par page
   const offset = (page - 1) * limit; // Calculer le décalage

   // construire l'URL avec les paramètres de recherche et de pagination
   const url = `../API/avisGestion.php?limit=${limit}&offset=${offset}&q=${encodeURIComponent(recherche)}`;

   xhttp.open("GET", url, true);
   xhttp.onreadystatechange = function () {
       if (this.readyState === 4 && this.status === 200) {
           try {
               const response = JSON.parse(this.responseText);

               if (response.status === "OK" && response.users && response.users.length > 0) {
                  // Vider les utilisateurs et mettre à jour la table
                  viderTableUtilisateurs();
                  const template = document.getElementById("template-users").innerHTML;
                  const rendered = Mustache.render(template, { users: response.users });
                  document.getElementById("users-container").innerHTML = rendered;

                  // Mettre à jour la pagination
                  afficherPagination(response.totalPages, page);
               } else {
                   // Si aucun utilisateur n'est trouvé
                  viderTableUtilisateurs();
                  viderPagination();
                  document.getElementById("users-container").innerHTML = "<tr><td colspan='7' class='text-center'>Aucun utilisateur trouvé</td></tr>";
               }
           } catch (e) {
               console.error("Erreur lors du traitement des données JSON :", e);
           }
       }
   };
   xhttp.send();
}


// fonction pour afficher les liens de pagination
function afficherPagination(totalPages, pageActuelle) {
   const paginationLiens = document.getElementById('paginationLiens');
   paginationLiens.innerHTML = '';

   // créer les liens de pagination
   for (let i = 1; i <= totalPages; i++) {
      const li = document.createElement('li');
      li.classList.add('page-item');

      const a = document.createElement('a');
      a.classList.add('page-link');
      a.href = '#';
      a.textContent = i;

      if (i === pageActuelle) {
         li.classList.add('actives');
      }

      // ajouter l'événement pour charger la page correspondante
      a.addEventListener('click', function (event) {
         event.preventDefault();
         chargerUtilisateurs(i); // charger les utilisateurs pour la page i
      });

      li.appendChild(a);
      paginationLiens.appendChild(li);
   }
}


function init() {
   const rechercheInput = document.getElementById('recherche-input');

   // Charger les utilisateurs dès le départ
   chargerUtilisateurs(1);

   // ajouter un événement pour la recherche
   if (rechercheInput) {
      rechercheInput.addEventListener('input', function () {
         chargerUtilisateurs(1, this.value); 
      });
   }
}

window.addEventListener("load", init);
