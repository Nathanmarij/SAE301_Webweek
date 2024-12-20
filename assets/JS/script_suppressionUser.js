// déclaration de la fonction showToast()
function showToast() {
   const toast = new bootstrap.Toast(document.getElementById('toast'));
   toast.show();
}

// fonction pour gérer la suppression 
function SupprimerUser() {
   $(document).on('click', '.supprimer-user', function() {
      const id_users = $(this).data('id');  
      
      // demander confirmation 
      if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.")) {
         $.ajax({
            url: "../API/supprimerUser.php",  
            method: "POST",
            dataType: "json",
            data: { id_users: id_users },
            success: function(response) {
               if (response.status === "OK") {
                  showToast();  
                  $('button[data-id="' + id_users + '"]').closest('tr').remove();
               } else {
                  alert(response.message);  
               }
            },
            error: function(xhr, status, error) {
               alert("Une erreur est survenue lors de la suppression de cet utilisateur.");
            }
         });
      }
   });
}

function init() {
   SupprimerUser();  
}

window.addEventListener("load", init);
