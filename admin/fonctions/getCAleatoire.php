<?php
   // fonction pour générer une couleur hexadécimale aléatoire
   function getCAleatoire() {
      $classCouleurs = ['bg-black', 'bg-warning', 'bg-success', 'bg-danger']; 
      return $classCouleurs[array_rand($classCouleurs)]; 
   }
?>