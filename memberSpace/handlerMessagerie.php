<?php
include "configuration.php";

$task = "list";


// on determine si l'utilisateur veut ecrire un message ou non grace à une variable GET
if (array_key_exists("task", $_GET)) {
	$task = $_GET['task'];
}

// on appelle la fonction correspondante
if($task == "write"){
	postMessage();
}else{
	getMessages();
}

function getMessages(){
	global $bdd;

	$idUser = $_SESSION['id'];
	$idDestinataire = $_SESSION['idCorresp'];



	// On cherche les derniers messages dans la bdd
	//$resultats = $bdd->prepare("SELECT DISTINCT * FROM messaging WHERE (idWritter = ? AND idReceiver = ?) OR (idReceiver = ? AND idWritter = ?) ORDER BY date DESC LIMIT 20"); 

	$resultats = $bdd->query("SELECT DISTINCT * FROM messaging WHERE (idWritter = $idUser AND idReceiver = $idDestinataire) OR (idReceiver = $idUser AND idWritter = $idDestinataire) ORDER BY date DESC LIMIT 20");

	//$resultats = $bdd->query("SELECT * FROM messaging ORDER BY date DESC LIMIT 20");
	//$resultats->query(array($idUser, $idDestinataire, $idUser, $idDestinataire));

	$messages = $resultats->fetchAll();

	// on affiche les données sous forme de JSON pour rendre les données exploitables dans le js
	echo json_encode($messages);


}


function postMessage(){
	global $bdd;

	if (!isset($_POST['destinataire']) OR !isset($_POST['content']) OR empty($_POST['destinataire']) OR empty($_POST['content'])){
		echo json_encode(["status" =>"erreur", "message" => "Un ou plusieurs champs n'ont pas ete remplis"]);
		return;
	}

	// on analyse les paramètre passés en POST (destinataire, message)
	$author = $_SESSION['id'];
	$destinataire = $_POST['destinataire'];
	$content = $_POST['content'];


	$requser = $bdd->prepare("INSERT INTO messaging(textMessage, date, idWritter, idReceiver) VALUES(?, NOW(), ?, ?)"); 
	$requser->execute(array($content, $author, $destinataire));


	echo json_encode(["statut" => "success"]);

	
}

?>


