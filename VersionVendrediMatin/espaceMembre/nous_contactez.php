<?php
include "configuration.php";
include "templates/header.php";
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
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css" />
	</head>
	<body>
		<div align="center">
		<h2>Nous contacter</h2>
		<form method="POST" action="">
			<input type="text" name="nom" placeholder="Votre nom" value="<?php if(isset($_POST['nom'])) { echo $_POST['nom']; } ?>" /><br /><br />
			<input type="email" name="mail" placeholder="Votre email" value="<?php if(isset($_POST['mail'])) { echo $_POST['mail']; } ?>" /><br /><br />
			<textarea  name="message" placeholder="Votre message"><?php if(isset($_POST['message'])) { echo $_POST['message']; } ?></textarea>
			<br /><br />
			<input type="submit" value="Envoyer !" name="mailform"/>
		</form>
	</div>

		<?php
		if(isset($msg))
		{
			echo $msg;
		}
		?>
	</body>
</html>
<?php include "templates/footer.php"; ?>
