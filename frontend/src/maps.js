var geocoder = new google.maps.Geocoder();
var carte;

//------------------------------------------------------------------
// récupérer ma position courante, afficher la carte et afficher un point correspondant sur ma carte
// ------------------------------------------------------------------

// callbacks de la fonction getCurrentPosition() 
function creerCarte(objet) {
	var latitude = objet.coords.latitude;
	var longitude = objet.coords.longitude;
	affichercarte(latitude,longitude); // j'affiche la carte avec un marqueur sur ma position
	setTimeout(function(){
		calculer_position(updateCarte); // Permet de recentrer la carte
	}, 3000);
}

// demander au navigateur ma position 
function calculer_position(nomCallback) {
	if(navigator.geolocation){				
		navigator.geolocation.getCurrentPosition(
			nomCallback,
			function(){alert(objet.message + " / " + objet.code);}, 
			{ enableHighAccuracy:true, maximumAge:5000, timeout:5000}
		);					
		// Ici j'affiche la carte et le point					
	} else {
		alert('Erreur : pas de support de la géolocalisation dans votre navigateur');
	}
}

//------------------------------------------------------------------
// demander le décodage d'une adresse en point coordonnées et 
// placement d'un marqueur sur la carte
function decoder_adresse() {
	var adresse = document.getElementById("txtAdresse").value;
	geocoder.geocode( {'address': adresse}, callback_decoder);
}

function callback_decoder(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
     	// j'ajoute le marqueur de l'adresse saisie
		ajouterMarqueur(results[0].geometry.location.lat(), results[0].geometry.location.lng());
      } else {
			alert("Erreur Geocode: " + status);
      }
}

// -----------------------------------
// fonctions qui gerent l'affichage d'une carte (fait une fois au début)
// et l'ajout des marqueurs
function ajouterMarqueur(latitude,longitude) {
	// je créé le marqueur
	var point = new google.maps.LatLng(latitude,longitude)
	var marker = new google.maps.Marker({ 
		position: point, 
		title:''
	});			
	// je place le marqueur sur la carte
	marker.setMap(carte);			
	// je centre la carte sur ce nouveau marqueur
	carte.panTo(point);
}

function affichercarte(latitude, longitude) {
	//objet contenant des propriétés avec des identificateurs prédéfinis dans Google Maps permettant
	//de définir des options d'affichage de notre carte
	var options = {
		center: new google.maps.LatLng(latitude,longitude),
		zoom: 13,
		mapTypeId: 'roadmap'
	};	 
	//constructeur de la carte qui prend en paramêtre le conteneur HTML
	//dans lequel la carte doit s'afficher et les options
	carte = new google.maps.Map(document.getElementById("divcarte"), options);	
	ajouterMarqueur(latitude,longitude); // j'ajoute le marqueur de ma position courante.
}

function updateCarte(objet){
	var latitude = objet.coords.latitude;
	var longitude = objet.coords.longitude;
    var myLatLng = new google.maps.LatLng( latitude, longitude ),
        myOptions = {
            zoom: 18,
            center: myLatLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        },
		carte = new google.maps.Map(document.getElementById('divcarte'), myOptions),
			marker = new google.maps.Marker( {position: myLatLng, map: carte} );
    marker.setMap(carte);
		carte.panTo(marker.getPosition());
    setTimeout(function(){
		;
	}, 3000);
}