<?php include "configuration.php";

if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $_SESSION['idCorresp'] = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM user WHERE idUser = ?');
   $requser->execute(array($_SESSION['idCorresp']));
   $userinfo = $requser->fetch();


	$userPrenomNom = $userinfo['firstName']. ' '. $userinfo['lastName'];
	
	?>


	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/style.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	    ﻿<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	    ﻿<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	    ﻿<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	    ﻿<script src="js/bootstrap.min.js"></script>
	</head>
	<body>
		<?php include "templates/header.php"; ?>

		<section class="section_prenom_nom_corresp" style="text-align: center;">
			<h2 id="prenomNomCorresp">
				<?php
				echo $userPrenomNom;
				?>
			</h2>
			
		</section>

		<div class="messagerie">
			
			
			<div class="divChat">
				<section class="chat">
					<div class="messages">
						<div class="message">
							<span class="date">14:11</span>
							<span class="author">aaa</span> :
							<span class="content">Ceci est le message quand ca bug</span>

							
						</div>

					</div>

					
				</section>
				<form action="handlerMessagerie.php?task=write" id="formMessagerie" method="POST">
					<input type="text" id="content" name="content" placeholder="Ecrivez un message...">
					<input type="hidden" name="destinataire" id="destinataire" value=<?php echo $userinfo['idUser']; ?>>
					<button type="submit">Envoyer</button>
				</form>
			</div>
			<div class="conversations">
				<?php include('configAccueilMessagerie.php'); ?>
			</div>
		</div>
		<input type="hidden" id="idUser" value="<?php echo $_SESSION['id'] ?>">


		<script src="js/app.js"></script>
		<script src="js/barreRecherche.js"></script>
	</body>
	</html>

	<?php
} else{
	header("Location: accueilMessagerie.php");
}
?>