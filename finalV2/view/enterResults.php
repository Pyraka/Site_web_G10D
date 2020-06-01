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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    ﻿<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    ﻿<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    ﻿<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="../js/barreRecherche.js"></script>
</head>
<body>
	<?php require("templates/header.php"); ?>
	<?php require("templates/footer.php"); ?>
	<?php $finTest = false;?>

	
	<div id="selectUser">
		<p>Entrez l'adresse mail de la personne qui doit passer le test. Validez pour que les tests commencent.</p>
			<form method="POST">
				<label for="mail">Mail du client :</label>
				<input type="text" name="mail" placeholder="abc@xyz.com" class="champRechercheMessagerie" id="champRechercheMessagerie"/>
			    <input type="submit" name="submit" value="Valider">
		    </form>
		    <br/>
		    <div id="result-search"></div>

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
<script type="text/javascript">
	function clickLinks(email){
		document.getElementById('champRechercheMessagerie').value = email;
		document.getElementById('result-search').remove();

		var newDiv = document.createElement("div");
		newDiv.id="result-search";
		document.body.append(newDiv);



	}
</script>
</html>