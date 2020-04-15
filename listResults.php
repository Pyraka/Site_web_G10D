<?php
require "configuration.php"; //bdd
?>

<?php require "templates/header.php"; //header?> 

<?php
$reqUser = $bdd->prepare('SELECT * FROM user WHERE idUser = ?');
$reqUser->execute(array($_GET['id']));
while ($user = $reqUser->fetch())
{
?>
	<h1 class="title">Listes des tests</h1>
	<?php echo "utilisateur : " . $user['firstName'] . " " . $user['lastName'];?>
	<br/><br/>
	<?php
	$reqTest = $bdd->prepare('SELECT dateTest, idTest FROM test WHERE idUser = ?');
	$reqTest->execute(array($_GET['id']));
	while ($test = $reqTest->fetch()) { ?>
		<a href="results.php?id=<?php echo $test['idTest']?>">
			<img src="images/logoResults.png" class="logoMenu" />
			Test effectué le <?php echo $test['dateTest']?>
		</a>
		<br/>

	<?php 
	}
	$reqTest->closeCursor();
	?>

	<br/><br/>
	<?php
	$istest = $bdd->prepare('SELECT idTest FROM test WHERE idUser = ?');
	$istest->execute(array($_GET['id']));
	$tests = $istest->fetch();
	if (!($tests['idTest']==NULL)) { //s'il a effectué des tests?> 
		<table>
			<caption>résultas de <?php echo $user['firstName'] . " " . $user['lastName']?> </caption>
	        <thead>
	            <tr>
	                <th>Numéro du test</th>
	                <th>Date du test</th>
	                <th>Rythme cardiaque</th>  
	                <th>Température</th>
	                <th>Temps de réaction</th>
	                <th>Reproduction sonore</th>
	            </tr>
	        </thead>
	        <tboby>
	        <?php 
	        $compteur = 0;
	        $reqTest = $bdd->prepare('SELECT BPMAverage,temperatureAverage,reactionTime,soundReproductionQuality,
	        	DAY(dateTest) AS day, MONTH(dateTest) AS month, YEAR(dateTest) AS year  FROM test WHERE idUser = ?');
			$reqTest->execute(array($_GET['id']));
			while ($test = $reqTest->fetch()) { 
				$compteur += 1;

				if ($test['day'] < 10) {      //affichage correct des jours
					$day = "0" . $test['day'];
				} else { $day = $test['day'];}

				if ($test['month'] < 10) {		//affichage correct des mois
					$month = "0" . $test['month'];
				} else { $month = $test['month'];}
				?>
	        		<tr>
	        			<td><?php echo $compteur; ?></td>
	        			<td><?php echo $day . "/" . $month . "/" . $test['year']; ?></td>
	        			<td><?php echo $test['BPMAverage']; ?></td>
	        			<td><?php echo $test['temperatureAverage']?></td>
	        			<td><?php echo $test['reactionTime']?></td>
	        			<td><?php echo $test['soundReproductionQuality']?></td>
	        		</tr>
			<?php }
			$reqTest->closeCursor();
			?>
			</tbody>
	    </table>
	<?php
	} else {
		echo "Aucun test n'a été effectué par cette personne.";
	}
	?>


<?php
}
$istest->closeCursor();
$reqUser->closeCursor();
?>

<br/><br/>
<a href="read.php">Revenir à la page de recherche</a>

<?php require "templates/footer.php"; //footer?> 	