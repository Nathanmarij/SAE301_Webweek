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
function chargerUtilisateurs(page = 1) {
   const xhttp = new XMLHttpRequest();
   
   xhttp.open("GET", `../API/listerUsers.php?limit=${limit}&offset=${(page - 1) * limit}`, true);
   xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

   xhttp.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
         try {
               const response = JSON.parse(this.responseText);

               if (response.status === "OK") {
                  viderTableUtilisateurs();
                  const template = document.getElementById("template-users").innerHTML;
                  const rendered = Mustache.render(template, { users: response.users });
                  document.getElementById('users-container').innerHTML = rendered;

                  // mettre à jour la pagination
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
   chargerUtilisateurs(1); 

   // écouter les événements sur le champ de recherche et le filtre
   document.getElementById("search-input").addEventListener("input", function() {
      chargerUtilisateurs(1); // Rechercher à partir de la première page
   });

   document.getElementById("status-filter").addEventListener("change", function() {
      chargerUtilisateurs(1); // Filtrer à partir de la première page
   });
}

window.addEventListener("load", init);
