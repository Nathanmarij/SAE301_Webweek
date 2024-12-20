function afficherRecherche(str, page = 1) {
    if (str.length === 0) {
        document.getElementById("user-container").innerHTML = "";
        return;
    }

    const xmlhttp = new XMLHttpRequest();
    const limit = 5; // limite de résultats par page
    const offset = (page - 1) * limit; // calculer le décalage

    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {

            const response = JSON.parse(this.responseText);
            const template = document.getElementById("template-user").innerHTML;

            // si des utilisateurs sont trouvés
            if (response.users && response.users.length > 0) {
                const rendered = Mustache.render(template, { 
                    users: response.users.map(user => {
                        user.initiaux = getInitiaux(user.nom + ' ' + user.prenom);
                        user.statutClass = user.statut_compte === 'actif' ? 'bg-success' : 'bg-danger';
                        return user;
                    })
                });
                document.getElementById("user-container").innerHTML = rendered;

                // afficher la pagination
                afficherPagination(response.totalPages, page);
                document.getElementById("paginationLiens").classList.remove('d-none');
            } else {
                document.getElementById("user-container").innerHTML = "<p>Aucun utilisateur trouvé</p>";
                document.getElementById("paginationLiens").classList.add('d-none');
            }
            
        }
    };
    const url = `../API/listerUsers.php?q=${encodeURIComponent(str)}&limit=5&offset=${offset}`;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
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


function afficherPagination(totalPages, pageActuelle) {
    const paginationLiens = document.getElementById('paginationLiens');
    paginationLiens.innerHTML = ''; // vider les anciens liens de pagination
 
    // nombre maximal de liens à afficher
    const maxPagesAffichees = 10; // nombre de pages à afficher
 
    // calculer les plages de pages à afficher
    let pageDepart = Math.max(1, pageActuelle - Math.floor(maxPagesAffichees / 2));
    let pageFin = Math.min(totalPages, pageDepart + maxPagesAffichees - 1);
 
    // ajuster le début si le nombre total de pages est plus petit
    if (pageFin - pageDepart < maxPagesAffichees - 1) {
       pageDepart = Math.max(1, pageFin - maxPagesAffichees + 1);
    }
 
    // ajouter le lien "Précédent"
    if (pageActuelle > 1) {
       const li = document.createElement('li');
       li.classList.add('page-item');
       const a = document.createElement('a');
       a.classList.add('page-link');
       a.href = '#';
       a.textContent = 'Précédent';
       a.addEventListener('click', function (event) {
          event.preventDefault();
          afficherRecherche(document.getElementById('inputR').value, pageActuelle - 1);
       });
       li.appendChild(a);
       paginationLiens.appendChild(li);
    }
 
    // afficher les pages autour de la page actuelle avec des "..."
    if (pageDepart > 1) {
       const li = document.createElement('li');
       li.classList.add('page-item', 'disabled');
       const span = document.createElement('span');
       span.classList.add('page-link');
       span.textContent = '...';
       li.appendChild(span);
       paginationLiens.appendChild(li);
    }
 
    // afficher les liens de pages
    for (let i = pageDepart; i <= pageFin; i++) {
       const li = document.createElement('li');
       li.classList.add('page-item');
       if (i === pageActuelle) {
          li.classList.add('actives'); // ajouter la classe "active" pour la page actuelle
       }
 
       const a = document.createElement('a');
       a.classList.add('page-link');
       a.href = '#';
       a.textContent = i;
 
       a.addEventListener('click', function (event) {
          event.preventDefault();
          afficherRecherche(document.getElementById('inputR').value, i); // rechercher et charger les utilisateurs pour la page i
       });
 
       li.appendChild(a);
       paginationLiens.appendChild(li);
    }
 
    // afficher les "..." à la fin si nécessaire
    if (pageFin < totalPages) {
       const li = document.createElement('li');
       li.classList.add('page-item', 'disabled');
       const span = document.createElement('span');
       span.classList.add('page-link');
       span.textContent = '...';
       li.appendChild(span);
       paginationLiens.appendChild(li);
    }
 
    // ajouter le lien "Suivant"
    if (pageActuelle < totalPages) {
       const li = document.createElement('li');
       li.classList.add('page-item');
       const a = document.createElement('a');
       a.classList.add('page-link');
       a.href = '#';
       a.textContent = 'Suivant';
       a.addEventListener('click', function (event) {
          event.preventDefault();
          afficherRecherche(document.getElementById('inputR').value, pageActuelle + 1);
       });
       li.appendChild(a);
       paginationLiens.appendChild(li);
    }
}

function changerStatutUser(idUser, action) {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const response = JSON.parse(this.responseText);

            // si la réponse est OK, met à jour l'interface
            if (response.status === 'OK') {
                // mettre à jour l'interface utilisateur 
                const userCard = document.querySelector(`[data-id="${idUser}"]`);
                if (userCard) {
                    const pagination = document.getElementById('paginationLiens');
                    const activePage = pagination.querySelector('li.actives');
                    
                    // vérifie si une page active est présente
                    if (activePage) {
                        const pageIndex = activePage.querySelector('a').textContent; // obtient le numéro de la page active
                        afficherRecherche(document.getElementById('inputR').value, pageIndex); // recharger les utilisateurs de la page active
                    }
                }
                
            } else {
                alert('Erreur : ' + response.message);
            }
        }
    };

    const url = '../API/activerCompteUser.php'; 
    const formData = new FormData();
    formData.append('id_users', idUser);
    formData.append('action', action);

    xmlhttp.open('POST', url, true);
    xmlhttp.send(formData);
}


function init() {
    const inputR = document.getElementById('inputR');
    if (inputR) {
        inputR.addEventListener('input', function () {
            afficherRecherche(this.value, 1);  
        });
    }
}

window.addEventListener("load", init);
