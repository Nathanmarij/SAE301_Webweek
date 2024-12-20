<?php
require_once("../fonctions/deconnexion.php");
   function verifierConnexionEtDroits() {
      $user = new Users('', '', '', '', '', '', '');
      
      // vérifier si l'utilisateur est connecté ou s'il est admin
      if (!$user->estConnecte() || !(isset($_SESSION['role']) && ($_SESSION['role'] == 2 || $_SESSION['role'] == 3))) {
         deconnecter();
      }
  }
?>