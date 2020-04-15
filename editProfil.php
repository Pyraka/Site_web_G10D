<?php include "configuration.php"; ?>

<!DOCTYPE html>
<html>
<head>
	<title>edition de profil</title>
	<meta charset="utf-8">
</head>
<body>
	<?php require "templates/header.php"; ?>
	<?php
	if(isset($_SESSION['id'])) {
	   $requser = $bdd->prepare("SELECT * FROM user WHERE idUser = ?");
	   $requser->execute(array($_SESSION['id']));
	   $user = $requser->fetch();
	   if(isset($_GET['modif']) AND $_GET['modif']=='firstName'){?>
	   		<div align="left">
            <form method="POST" action="" enctype="multipart/form-data">
               <label>Pseudo :</label>
               <input type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['firstName']; ?>" />
               <input type="submit" value="Mettre à jour mon profil !" />
            </form>
        	</div>
	   <?php 
		    if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['firstName']) {
		      $newpseudo = htmlspecialchars($_POST['newpseudo']);
		      $insertpseudo = $bdd->prepare("UPDATE user SET firstName = ? WHERE idUser = ?");
		      $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
		      header('Location: profil.php?id='.$_SESSION['id']);
		    }
	    }?> 
	<?php } ?>
</body>
</html>
