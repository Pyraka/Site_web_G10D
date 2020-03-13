<?php

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
	die('Erreur : '. $e->getMessage());
}


$req = $bdd->prepare('INSERT INTO minichat(pseudo, message) VALUES(:pseudo, :message)');
$req->execute(array(
	'pseudo' => $_POST['pseudo'],
	'message' => $_POST['message'],
	));



header('Location: minichat.php');
?>