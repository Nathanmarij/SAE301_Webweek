// nos fonctions

// fonction qui efface le contenu de la div ressources
function afficherTsEvent(){
	document.getElementById('divfiltre').innerHTML = "";	
}

// fonction qui permet de récupérer, en Ajax, la liste de toutes les ressources de la SAE d'id idsae
// et de générer le HTML mis dans la div ressources
function listerEvents(id_cat_events){
    console.log("Appel de l'API pour la catégorie : ", id_cat_events);
	// requete AJAX
	var xhttp = new XMLHttpRequest();
	xhttp.open("GET", "API/listerEvents.php?id_cat_events="+id_cat_events, true);
	xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhttp.onreadystatechange = function() {
	   if (this.readyState == 4 && this.status == 200) {
		  // Response
		  var response = JSON.parse(this.responseText); 
		  // si le status vaut OK, tout c'est bien passé donc on peut récupérer les éléments de la SAE (intitule et ressources associées)
		  if(response["status"]=="OK"){
			  
			  // on récupère le modèle de bloc HTML à remplir pour les ressources
			  var template = document.getElementById('template-events').innerHTML;
			  
			  // on utilise Mustache pour faire le rendu
			  var rendered = Mustache.render(template, response["events"]);
			  
			  // on met le contenu dans la div
			  document.getElementById('divevents').innerHTML = title+rendered;			  
		 }  

	   }
	};
	xhttp.send();
}

// au chargement de la page, on vide la div ressources
afficherTsEvent();

// on recupere l'element selectSAE
var selectCat=document.getElementById('selectCat');
// on ajoute un écouteur à cet élément
selectCat.addEventListener('change', function(){
	// quand la SAE sélectionnée change, on récupère l'id
	id_cat_events=this.value;
    console.log("ID de catégorie sélectionnée : ", id_cat_events);
	// on vide les ressources 
    afficherTsEvent();
		// on récupère la liste des ressources
        listerEvents(id_cat_events);
});

