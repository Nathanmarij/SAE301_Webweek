//fonction pour defiler vers le haut avec les coordonnées donné tout en douceur
function retourHaut() {
    window.scrollTo({
      top: 0,
      left: 0,
      behavior: "smooth",
    });
  }
  //affiche le bouton Haut lorsque la barre de défilement est à + de 500px
  function scrollFonction() {
    let button = document.getElementById("haut");
    //obtenir le nombre de pixels qui ont été défilé
    let intElemenScrollTop = document.documentElement.scrollTop; // en fct de la taille du document
    //définir le nombre de pixels à faire défiler
    //Element.scrollTop = 500 + "px";
    if (intElemenScrollTop > 50) {
      button.style.display = "flex"; //j'attribue pr mon css
    } else {
      button.style.display = "none";
    }
  }
  
  // abonnement via le click
  function setupListeners() {
    let button = document.getElementById("haut");
    button.addEventListener("click", retourHaut);
    window.addEventListener("scroll", scrollFonction);
  }
  
  // lancement de setupListeners au chargement de la page
  window.addEventListener("load", setupListeners);
  