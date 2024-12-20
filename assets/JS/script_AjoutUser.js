// fonction principale pour gérer l'envoi du formulaire
function validerFormulaire() {
   const form = document.getElementById("registerForm");

   form.addEventListener("submit", function (event) {
      event.preventDefault();

      reinitialiserErreurs();

      let valide = true;

      // validation des champs
      if (!validerChamp("nom", "nomError", "Le nom est requis.")) valide = false;
      if (!validerChamp("prenom", "prenomError", "Le prénom est requis.")) valide = false;
      if (!validerChamp("mail", "mailError", "L'email est requis.") || !validerEmail("mail", "mailError")) valide = false;
      if (!validerMotDePasse("mdp", "mdpError")) valide = false;
      if (!validerChamp("mdpConfirmation", "mdpConfirmationError", "Confirmation requise.") || !verifierMotsDePasse("mdp", "mdpConfirmation", "mdpConfirmationError")) valide = false;
      if (!validerChamp("date_naissance", "date_naissanceError", "La date de naissance est requise.")) valide = false;
      if (!validerTelephone("telephone", "telephoneError")) valide = false;
      if (!validerSelect("role", "roleError", "Veuillez choisir un rôle.")) valide = false;

      if (valide) {
         envoyerDonnees();
      }
   });
}

// fonction pour envoyer les données avec AJAX
function envoyerDonnees() {
   const form = document.getElementById("registerForm");
   const formData = new FormData(form);

   const xhr = new XMLHttpRequest();
   xhr.open("POST", "../API/ajouterUser.php", true);

   xhr.onreadystatechange = function () {
      if (xhr.readyState === 4) {
         const reponse = JSON.parse(xhr.responseText);
         const message = document.getElementById("message");
         
         message.classList.remove("alert-success", "alert-danger", "alert");
         message.innerHTML = "";

         if (reponse.status === "OK") {
            message.classList.add("alert", "alert-success");
            message.innerHTML = `
               ${reponse.message}
            `;
         } else {
            message.classList.add("alert", "alert-danger");
            message.innerHTML = `
               ${reponse.message}
            `;
         }
      }
   };

   xhr.send(formData);
}

// fonction pour réinitialiser les erreurs
function reinitialiserErreurs() {
   document.querySelectorAll(".error").forEach(e => e.textContent = "");
   document.querySelectorAll(".form-control").forEach(e => e.classList.remove("is-invalid"));
}

// fonction pour valider un champ
function validerChamp(id, erreurId, messageErreur) {
   const champ = document.getElementById(id);
   if (champ.value.trim() === "") {
      document.getElementById(erreurId).textContent = messageErreur;
      champ.classList.add("is-invalid");
      return false;
   }
   return true;
}

// fonction pour valider un email
function validerEmail(id, erreurId) {
   const email = document.getElementById(id).value;
   const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
   if (!regex.test(email)) {
      document.getElementById(erreurId).textContent = "L'email n'est pas valide.";
      document.getElementById(id).classList.add("is-invalid");
      return false;
}
   return true;
}

// fonction pour valider un mot de passe
function validerMotDePasse(id, erreurId) {
   const mdp = document.getElementById(id).value;
   const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{8,}$/;
   if (mdp.trim() === "") {
      document.getElementById(erreurId).textContent = "Mot de passe requis.";
      document.getElementById(id).classList.add("is-invalid");
      return false;
   }
   if (!regex.test(mdp)) {
      document.getElementById(erreurId).textContent = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, un chiffre et un caractère spécial.";
      document.getElementById(id).classList.add("is-invalid");
      return false;
   }
   return true;
}

// vérifier si les mots de passe correspondent
function verifierMotsDePasse(idMdp, idConfirm, erreurId) {
   const mdp = document.getElementById(idMdp).value;
   const confirm = document.getElementById(idConfirm).value;
   if (mdp !== confirm) {
      document.getElementById(erreurId).textContent = "Les mots de passe ne correspondent pas.";
      document.getElementById(idConfirm).classList.add("is-invalid");
      return false;
}
   return true;
}

// validation d'un numéro de téléphone
function validerTelephone(id, erreurId) {
   const tel = document.getElementById(id).value;
   const regex = /^(\+?\d{1,3}[-.\s]?)?(\(?\d{1,4}\)?[-.\s]?)?(\d{1,4}[-.\s]?)?(\d{1,4})$/;
   if (tel.trim() === "") {
      document.getElementById(erreurId).textContent = "Le téléphone est requis.";
      document.getElementById(id).classList.add("is-invalid");
      return false;
   }
   if (!regex.test(tel)) {
      document.getElementById(erreurId).textContent = "Numéro invalide.";
      document.getElementById(id).classList.add("is-invalid");
      return false;
}
   return true;
}

// validation d'un champ 
function validerSelect(id, erreurId, messageErreur) {
   const select = document.getElementById(id);
   if (!select.value) {
      document.getElementById(erreurId).textContent = messageErreur;
      select.classList.add("is-invalid");
      return false;
}
   return true;
}

function init() {
   validerFormulaire();
}

window.addEventListener("load", init);
