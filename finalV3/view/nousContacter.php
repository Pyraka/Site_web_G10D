<?php require("../controller/req.contactUs.php") ?>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title> Nous contacter </title>

  <link rel="stylesheet" href="css/style.css" />
</head>
	<?php require "templates/header.php"; ?>
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
	
<?php require "templates/footer.php"; ?>
