// pour vider la div des événements
function viderDivEvenements(){
	document.getElementById('events-container').innerHTML = "";
}

// pour charger les événements depuis l'API
function chargerEvenements(){
	// requête AJAX pour récupérer les événements
	var xhttp = new XMLHttpRequest();
	xhttp.open("GET", "API/listerEvents.php", true);
	xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		// réponse de l'API
		var response = JSON.parse(this.responseText);

		if(response.status == "OK"){

		viderDivEvenements();

		const template = document.getElementById("template-events").innerHTML;

		const rendered = Mustache.render(template, { events: response.events });

		document.getElementById('events-container').innerHTML = rendered;
		} else {
			console.error('Aucun événement récupéré.');
		}
		}
	};
	xhttp.send();
}

function init(){
	chargerEvenements();
}

window.addEventListener("load", init);
