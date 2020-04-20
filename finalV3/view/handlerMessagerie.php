<?php
require('../model/configuration.php');
require('../controller/functions.php');

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


?>


