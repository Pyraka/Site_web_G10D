<?php
if (isset($_POST['mail']) AND !empty($_POST['mail'])) {
	 try {
        // on vérifie que l'email existe dans la bdd
        $requser = $bdd->prepare("SELECT idUser FROM user WHERE email = ?");
        $requser->execute(array($_POST['mail']));
        $userexist = $requser->rowCount();
        if($userexist == 0) {
        	$msg = "L'adresse mail est invalide !";
        } else {
        	$userMail = $_POST['mail'];
        	$msg = "adresse sélectionnée : " . $userMail . ". Vous pouvez lancer le test.";
        }
    }catch (PDOException $error) {
        echo $error->getMessage();
    }
} else {
	$msg = "Remplissez le champs !";
	$userexist = 0;
}
?>