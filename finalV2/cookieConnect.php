<?php

if (!isset($_SESSION['id']) AND isset($_COOKIE['email'], $_COOKIE['password']) AND !empty($_COOKIE['email']) AND !empty($_COOKIE['password'])) 
{
	$requser = $bdd->prepare("SELECT * FROM user WHERE email = ? AND userPassword = ?");
	$requser->execute(array($mailconnect, $mdpconnect));
	$userexist = $requser->rowCount();
	if($userexist == 1) 
	{
	 $userinfo = $requser->fetch();
	 $_SESSION['id'] = $userinfo['idUser'];
	 $_SESSION['pseudo'] = $userinfo['firstName'];
	 $_SESSION['mail'] = $userinfo['email'];
	}
}

?>	

