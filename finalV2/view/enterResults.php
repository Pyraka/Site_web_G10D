<?php 
include("../model/configuration.php");
require("../controller/reqManager/req.enterResults.php");
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
	<?php require("templates/footer.php"); ?>
	<?php $finTest = false;?>

	
	<div id="selectUser">
		<p>Entrez l'adresse mail de la personne qui doit passer le test. Validez pour que les tests commencent.</p>
			<form method="POST">
				<label for="mail">Mail du client :</label>
				<input type="text" name="mail" placeholder="abc@xyz.com" />
			    <input type="submit" name="submit" value="Valider">
		    </form>
		    <br/>

		    <?php
			if (isset($_POST['submit']) AND isset($msg)) {
			 	echo $msg;
	        } ?>
    </div>

    <?php
       if($userexist != 0) { ?>
        	<script src="../js/chronometre"></script>
       <?php } ?>

	<?php 
		if (isset($userMail)) { ?>
			<p>Une fois le test terminé, cliquez <a href="<?php echo "confirmResults.php?mail=" .$userMail; ?>" >ici</a> pour confirmer les résultats</p>
	<?php } ?>

</body>
</html>