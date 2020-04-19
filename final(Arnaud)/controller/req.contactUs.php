<?php
require "../model/configuration.php";

if(isset($_POST['mailform']))
{
	if(!empty($_POST['nom']) AND !empty($_POST['mail']) AND !empty($_POST['message']))
	{
		$head="MIME-Version: 1.0\r\n";
		$head.='From:"guilhamat.arnaud@gmail.com'."\n";//adresse mail du site
		$head.='Content-Type:text/html; charset="uft-8"'."\n";
		$head.='Content-Transfer-Encoding: 8bit';

		$message='
		<html>
			<body>
				<div align="center">
					
					<br />
					<p>Nom de l\'expéditeur :</p>'.$_POST['nom'].'<br />
					<p>Mail de l\'expéditeur :</p>'.$_POST['mail'].'<br />
					<br />
					'.($_POST['message']).'
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