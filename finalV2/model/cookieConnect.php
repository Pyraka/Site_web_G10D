<?php

if (!isset($_SESSION['id']) AND isset($_COOKIE['email'], $_COOKIE['password']) AND !empty($_COOKIE['email']) AND !empty($_COOKIE['password'])) 
{


	$requser = $bdd->prepare("SELECT * FROM user WHERE email = ? AND userPassword = ?");
	$requser->execute(array($mailconnect, $mdpconnect));
	$userexist = $requser->rowCount();
	if($userexist == 1) 
	{
		 $userinfo = $requser->fetch();

		 $req10 = $bdd->prepare("SELECT * FROM ban WHERE idUser = ?");
		 $req10->execute(array($userinfo['idUser']));
		 $userexist1 = $req10->rowCount();
		 if ($userexist1 == 0){
		 	$_SESSION['id'] = $userinfo['idUser'];
		 	$_SESSION['pseudo'] = $userinfo['firstName'];
		 	$_SESSION['mail'] = $userinfo['email'];
		 	$_SESSION['photo'] = $userinfo['idImage'];
		 }

		 
	}
}

?>	

