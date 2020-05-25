
var divTest = document.createElement('div');
var button = document.createElement('button');
var textButton = document.createTextNode('Démarer les tests');
button.appendChild(textButton);
divTest.appendChild(button);
document.body.appendChild(divTest);

var buttonChrono = document.createElement('button');
var textButtonChrono = document.createTextNode('Lancer le test')
buttonChrono.appendChild(textButtonChrono);
var timer = document.createElement('p');

var instructions = document.createElement('p');
var textInstruction = [
	document.createTextNode('Vous disposez de 15sec pour chacun des quatre textes qui vont suivre. Le premier commencera automatiquement dans 5 secondes.'),
	document.createTextNode('Premier test : Mesure du rythme cardiaque.'),
	document.createTextNode('Deuxième test : Mesure de la température corporelle.'),
	document.createTextNode('Troisième test : Mesure du temps de réaction'),
	document.createTextNode('Quatrième test : Mesure de la Qualité de reproduction sonore')
]
var compteur = 0;

function chrono(temps){
	divTest.removeChild(buttonChrono);
	timer.innerHTML = "Temps restant : " + temps + "sec.";
	var createTimer = setTimeout(function() {
		clearInterval(interval);
		timer.innerHTML = "Temps restant : 0sec.";
	}, temps*1000);

	var interval = setInterval(function() {
		timer.innerHTML = "Temps restant : " + --temps + "sec.";
	}, 1000);
}


button.addEventListener('click', function(){
	var supp = document.getElementById('selectUser');
	document.body.removeChild(supp);
	divTest.removeChild(button);

	divTest.appendChild(instructions);

	instructions.appendChild(textInstruction[compteur]);

	setTimeout(function() {
		compteur += 1;
		instructions.replaceChild(textInstruction[compteur], instructions.firstChild);
		divTest.appendChild(buttonChrono);
	}, 5000);
});

buttonChrono.addEventListener('click', function() {
	divTest.appendChild(timer);
	chrono(15);
	setTimeout(function() {
		divTest.removeChild(timer);
		if (compteur<4) {
			compteur += 1;
		    instructions.replaceChild(textInstruction[compteur], instructions.firstChild);
		    divTest.appendChild(buttonChrono);						
		} else {
			instructions.innerHTML = "Le test est terminé.";
		}					
	}, 15200);
});


