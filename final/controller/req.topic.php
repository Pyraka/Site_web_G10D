<?php require('../model/configuration.php'); require('functions.php');

/*
if (!isset($_GET['id']) OR $_GET['id'] < 1){
	header("Location: forum.php");
	exit;
}*/

$requser = $bdd->prepare('SELECT *, DATE_FORMAT(date, "Le %d/%m/%Y à %H\h%i") as date_c FROM forum_topic WHERE idTopic = ? ORDER BY date DESC'); // on pourrait rajouter une LIMIT 10 
$requser->execute(array($_GET['id']));
$reponse = $requser->fetch();

$reqcom = $bdd->prepare('SELECT *, DATE_FORMAT(date, "Le %d/%m/%Y à %H\h%i") as date_c FROM forum_comments WHERE idTopic = ? ORDER BY date DESC');
$reqcom->execute(array($_GET['id']));
$reponse2 = $reqcom->fetchAll();

if (!empty($_POST)){
	$valid = true;

	if (isset($_POST['createMessage'])){

		$text = htmlspecialchars(trim($_POST['text']));

		if(empty($text)){
			$valid = false;
			$er_comment = "Veuillez entrer un message";
		}


		if($valid){
			$requser = $bdd->prepare("INSERT INTO forum_comments(idTopic, idUser, date, text) VALUES(?, ?, NOW(), ?)");
    		$requser->execute(array($_GET['id'], $_SESSION['id'], $text));
			header('Location: topic.php?id='.$_GET["id"]);
		}
	}
}
?>