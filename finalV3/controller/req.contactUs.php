<?php
require "../model/configuration.php";




if(isset($_POST['mailform']))
{
	if (isset($_SESSION['id'])){
		$requser = $bdd->prepare('SELECT * FROM user WHERE idUser = ?');
		$requser->execute(array($_SESSION['id']));
		$userinfo = $requser->fetch();

	}

	if (isset($_SESSION['id']) AND !empty($_POST['message'])){
		$name = $userinfo['firstName'] . ' ' . $userinfo['lastName'];
		$mail = $userinfo['email'];
		$text = htmlspecialchars($_POST['message']);

		$head="MIME-Version: 1.0\r\n";
		$head.='From:"guilhamat.arnaud@gmail.com'."\n";//adresse mail du site
		$head.='Content-Type:text/html; charset="uft-8"'."\n";
		$head.='Content-Transfer-Encoding: 8bit';

		$message='
		<html>
			<body>
				<div align="center">
					
					<br />
					<p>Nom de l\'expéditeur :</p>'.$name.'<br />
					<p>Mail de l\'expéditeur :</p>'.$mail.'<br />
					<br />
					'.($text).'
					<br />
				
				</div>
			</body>
		</html>
		';

		mail("guilhamat.arnaud@gmail.com", "CONTACT - medy-sys.com", $message, $head);//adresse mail des admins
		$msg="Votre message a bien été envoyé !";

	}
	elseif(!empty($_POST['nom']) AND !empty($_POST['mail']) AND !empty($_POST['message']))
	{

		$name = htmlspecialchars($_POST['nom']);
		$mail = htmlspecialchars($_POST['mail']);
		$text = htmlspecialchars($_POST['message']);

		$head="MIME-Version: 1.0\r\n";
		$head.='From:"guilhamat.arnaud@gmail.com'."\n";//adresse mail du site
		$head.='Content-Type:text/html; charset="uft-8"'."\n";
		$head.='Content-Transfer-Encoding: 8bit';

		$message='
		<html>
			<body>
				<div align="center">
					
					<br />
					<p>Nom de l\'expéditeur :</p>'.$name.'<br />
					<p>Mail de l\'expéditeur :</p>'.$mail.'<br />
					<br />
					'.($text).'
					<br />
				
				</div>
			</body>
		</html>
		';

		mail("guilhamat.arnaud@gmail.com", "CONTACT - medy-sys.com", $message, $head);//adresse mail des admins
		$msg="Votre message a bien été envoyé !";
	}
	else
	{
		$msg="Tous les champs doivent être complétés !";
	}
}
?>