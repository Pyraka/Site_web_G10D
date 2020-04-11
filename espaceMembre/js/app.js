


// Cette fonction récupère le JSON des messages et les affiche en string
function getMessages(){

	// requete pour acceder au fichier handlerMessagerie.php
	const requeteAjax = new XMLHttpRequest();
	requeteAjax.open("GET", "handlerMessagerie.php");

	// ensuite on traite le JSON pour afficher les données en HTML


							
					


	requeteAjax.onload = function(){
		const resultat = JSON.parse(requeteAjax.responseText);
		const html = resultat.reverse().map(function(message){


			

			var div = document.getElementById("prenomNomCorresp");
			var prenomNomCorresp = div.textContent;

			div = document.getElementById("idUser");
			var sessionId = div.value;



			var auteur;
			if (message.idWritter == sessionId){
				auteur = 'Vous';
			} else {
				auteur = prenomNomCorresp;
			}
		
	


			return `
				<div class="message">
					<span class="date">${message.date.substring(11, 16)}</span>
					<span class="author">${auteur}</span> :
					<span class="content">${message.textMessage}</span>

					
				</div>
			`

		}).join('');

		const messages = document.querySelector('.messages');


		
		messages.innerHTML = html;
		messages.scrollTop = messages.scrollHeight;
	}


	//finalement on envoie la requete ajax
	requeteAjax.send();


}




function postMessage(event){

	// On empeche le fonctionnement normal du formulaire
	event.preventDefault();

	// On recup les données du formulaire

	const destinataire = document.querySelector('#destinataire');
	const content = document.querySelector('#content');

	// On conditionne les donnees pour pouvoir les transmettre en POST
	const data = new FormData();
	data.append('destinataire', destinataire.value);
	data.append('content', content.value);

	// On configure la requete ajax en POST

	const requeteAjax = new XMLHttpRequest();
	requeteAjax.open('POST', 'handlerMessagerie.php?task=write');


	// on reaffiche les messages une fois l'operation terminee
	requeteAjax.onload = function(){
		content.value = '';
		content.focus();
		getMessages();

	}

	// on envoie la requete
	requeteAjax.send(data);


}


// on ajoute le listener à notre form
document.querySelector('#formMessagerie').addEventListener('submit', postMessage);


// on raffraichi les messages toutes les 500ms
const interval = window.setInterval(getMessages, 500);
getMessages();
