<?php
   function deconnecter() {
      session_start();
      session_unset();  
      session_destroy();  
      header("Location: ../connexion_compte.php");
   }

   if(isset($_GET['etat']) == 1){
      deconnecter();
   }
?>