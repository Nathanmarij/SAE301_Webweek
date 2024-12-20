function chargerRolesEtPermissions() {
   const xhr = new XMLHttpRequest();
   xhr.open('GET', '../API/rolesPermissions.php', true);
   xhr.onload = function () {
      if (xhr.status === 200) {
         const data = JSON.parse(xhr.responseText);
         if (data.status === 'success') {
            // Charger les utilisateurs dans la liste déroulante
            const usersSelect = document.getElementById('liste-users');
            usersSelect.innerHTML = '';
            data.users.forEach((user) => {
                  const option = document.createElement('option');
                  option.value = user.id_users;
                  option.textContent = `${user.nom} ${user.prenom}`;
                  usersSelect.appendChild(option);
            });

            // Charger les rôles dans la liste déroulante
            const rolesSelect = document.getElementById('liste-roles');
            rolesSelect.innerHTML = '';
            data.roles.forEach((role) => {
                  const option = document.createElement('option');
                  option.value = role.id_roles;
                  option.textContent = role.nom_role;
                  rolesSelect.appendChild(option);
            });

            // Charger les permissions par rôle dans le tableau
            const template = document.getElementById('template-permissions').innerHTML;
            const rendered = Mustache.render(template, { roles: data.roles });
            document.getElementById('permissions-container').innerHTML = rendered;
         } else {
            afficherMessage(`Erreur : ${data.message}`, 'danger');
         }
      } else {
         afficherMessage('Erreur lors du chargement des données.', 'danger');
      }
   };
   xhr.onerror = function () {
      afficherMessage('Erreur lors de la connexion au serveur.', 'danger');
   };
   xhr.send();
}

function attribuerRole(event) {
   event.preventDefault();

   const idUser = document.getElementById('liste-users').value;
   const idRole = document.getElementById('liste-roles').value;

   if (!idUser || !idRole) {
      afficherMessage('Veuillez sélectionner un utilisateur et un rôle.', 'danger');
      return;
   }

   const xhr = new XMLHttpRequest();
   xhr.open('POST', '../API/rolesPermissions.php', true);
   xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

   xhr.onload = function () {
      if (xhr.status === 200) {
         const data = JSON.parse(xhr.responseText);
         if (data.status === 'success') {
            afficherMessage(data.message, 'success');
            chargerRolesEtPermissions(); // Recharger les données
         } else {
            afficherMessage(`Erreur : ${data.message}`, 'danger');
         }
      } else {
         afficherMessage('Erreur lors de l\'attribution du rôle.', 'danger');
      }
   };
   xhr.onerror = function () {
      afficherMessage('Erreur lors de la connexion au serveur.', 'danger');
   };

   const params = `action=attribuer&id_users=${encodeURIComponent(idUser)}&id_roles=${encodeURIComponent(idRole)}`;
   xhr.send(params);
}

function afficherMessage(message, type) {
   const messageContainer = document.getElementById('message-role');
   messageContainer.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
   setTimeout(() => {
      messageContainer.innerHTML = '';
   }, 3000);
}

function init() {
   chargerRolesEtPermissions();

   // ajouter un écouteur sur le bouton d'attribution
   const attribuerButton = document.getElementById('attribuer-role');
   if (attribuerButton) {
      attribuerButton.addEventListener('click', attribuerRole);
   }
}

window.addEventListener('load', init);
