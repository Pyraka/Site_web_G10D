<?php 
include("../model/configuration.php");
if (isset($_POST['mail']) AND isset($_POST['reflex']) AND isset($_POST['reproduction']) AND isset($_POST['bpm']) AND isset($_POST['temperature']) AND 
	!empty($_POST['mail']) AND !empty($_POST['reflex']) AND !empty($_POST['reproduction']) AND !empty($_POST['bpm']) AND !empty($_POST['temperature'])) {
	 try {
        // on vérifie que l'email existe dans la bdd
        $requser = $bdd->prepare("SELECT idUser FROM user WHERE email = ?");
        $requser->execute(array($_POST['mail']));
        $userexist = $requser->rowCount();
        if($userexist != 0) {
            // on ajoute les résultats dans la bdd
            $user = $requser -> fetch();
            $reqtest = $bdd->prepare("INSERT INTO test(`reactionTime`, `soundReproductionQuality`, `BPMAverage`, `temperatureAverage`, `dateTest`, `idUser`) VALUES(?,?,?,?,?,?)");
            $reqtest->execute(array($_POST['reflex'], $_POST['reproduction'], $_POST['bpm'], $_POST['temperature'], date("Y-m-d H:i:s"), $user['idUser'] ));

            $msg = "Les résultats ont bien été ajouté.";
        }
        else{
        	$msg = "L'adresse mail est invalide !";
        }

        
        
    }catch (PDOException $error) {
        echo $error->getMessage();
    }
} else {
	$msg = "Remplissez tous les champs !";
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
	<form method="POST">
		<label for="mail">Mail du client :</label>
		<input type="text" name="mail" placeholder="abc@xyz.com" />
		<label for="bpm">Test de rythme cardiaque :</label>
		<input type="number" name="bpm" min="40" max="150" />
		<label for="temperature">Test de température :</label>
		<input type="number" name="temperature" min="35" max="45" />
		<label for="reflex">Test de réflexes visuels :</label>
		<input type="number" name="reflex" min="0" max="2000" />
		<label for="reproduction">Test de reproduction sonore :</label>
		<input type="number" name="reproduction" min="0" max="100" />
		<input type="submit" name="submit" value="Enregistrer les résultats">
		<?php
		if (isset($_POST['submit'])) {
		 	echo $msg;
		 } ?>
	</form>
	<a href="index.php" class="linkBack">Revenir à l'accueil</a>
	<?php require("templates/footer.php"); ?>
</body>
</html>
