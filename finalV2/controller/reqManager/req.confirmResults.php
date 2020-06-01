<?php

	$reactTime = rand(0,1500);
	$SRQ = rand(0,100);
	$BPM = rand(40,150);
	$temp = rand(35,45);
	
	try {
		$reqUser = $bdd->prepare('SELECT idUser, firstName, lastName FROM user WHERE email = ?');
		$reqUser->execute(array($_GET['mail']));
		$user = $reqUser->fetch();
		if (isset($_POST['validation'])) {
			$reqtest = $bdd->prepare("INSERT INTO test(`reactionTime`, `soundReproductionQuality`, `BPMAverage`, `temperatureAverage`, `dateTest`, `idUser`) VALUES(?,?,?,?,?,?)");
            $reqtest->execute(array($reactTime, $SRQ, $BPM, $temp, date("Y-m-d H:i:s"), $user['idUser'] ));
            $msg = "Les résultats ont bien été envoyés. Vous allez être redirigé.";
		} elseif (isset($_POST['cancel'])) {
			header("Location: enterResults.php");
		} 
	} catch (Exception $e) {
		 echo $error->getMessage();
	}
	
?>