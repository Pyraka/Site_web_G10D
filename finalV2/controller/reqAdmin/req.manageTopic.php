<?php require('../model/configuration.php'); require('../controller/functions.php');

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
			header('Location: manageTopic.php?id='.$_GET["id"]);
		}
	}

	if (isset($_POST['modifyTitle'])){

		$title = htmlspecialchars(trim($_POST['title']));

		if(empty($title)){
			$valid = false;
			$er_title = "Veuillez entrer un titre";
		}


		if($valid){
			$requser = $bdd->prepare("UPDATE forum_topic SET title = ? WHERE idTopic = ?;");
    		$requser->execute(array($title, $_GET['id']));
			header('Location: manageTopic.php?id='.$_GET["id"]);
		}
	}

	if (isset($_POST['modifyContent'])){

		$content = htmlspecialchars(trim($_POST['content']));

		if(empty($content)){
			$valid = false;
			$er_content = "Veuillez entrer un contenu";
		}


		if($valid){
			$requser = $bdd->prepare("UPDATE forum_topic SET content = ? WHERE idTopic = ?;");
    		$requser->execute(array($content, $_GET['id']));
			header('Location: manageTopic.php?id='.$_GET["id"]);
		}
	}
}
?>