<?php
require('../model/configuration.php');

if (isset($_GET['userSearch'])){

	$user = (String) trim($_GET['userSearch']);


	$requser = $bdd->prepare("SELECT * FROM user WHERE firstName LIKE ? OR lastName LIKE ? LIMIT 10");
	$requser->execute(array("$user%", "$user%"));


	$resultat = $requser->fetchAll();

	foreach ($resultat as $key) {
		?>

		<div class='linksMessenger' style="margin-top: 20px 0; border-bottom: 2px solid #ccc; text-align: center;">
			<a href=<?php echo "messagerie.php?id=", $key['idUser'];?>>
				<?php echo $key['firstName'], " ", $key['lastName'];?>
				<br>
				<?php echo "email : ", $key['email'];?>
			</a>
		</div>

		<?php
	}

}



?>