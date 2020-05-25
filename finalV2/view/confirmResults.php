<?php 
	include("../model/configuration.php");
	if (isset($_GET['mail']) AND !empty($_GET['mail'])) {
    	require("../controller/reqManager/req.confirmResults.php");
    } else {
		header("Location: enterResults.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Entrer des résultats</title>
	<meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
	<?php require("templates/header.php"); ?>
		
	<div id="divConfirm">
		<p>Les résultats de <?php echo $user['firstName']?> <?php echo $user['lastName'] ?> :</p>
		<ul>
			<li>Résultats du test de rythme cardiaque : <?php echo $BPM?>bpm</li>
			<li>Résultats du test de température corporel : <?php echo $temp?>°C</li>
			<li>Résultats du test de réflexes visuels : <?php echo $reactTime?>ms</li>
			<li>Résultats du test de reproduction sonore : <?php echo $SRQ?></li>
		</ul>
		<form method="POST">
			<input type="submit" name="validation" value="Comfirmer"/>
			<input type="submit" name="cancel" value="Annuler"/>
		</form>

		<?php
		if (isset($msg)) {
			echo $msg; ?>
            <script>
            	setTimeout(function() {
            		window.location.replace("enterResults.php");
            	},3000);
            </script>
		<?php } ?>
	</div>


	<?php require("templates/footer.php"); ?>
</body>
</html>