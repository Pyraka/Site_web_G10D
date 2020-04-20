<?php
require "../model/configuration.php"; //bdd
?>

<?php require "templates/header.php"; //header?> 

<?php
$reqUser = $bdd->prepare('SELECT * FROM user WHERE idUser = ?');
$reqUser->execute(array($_GET['id']));
while ($user = $reqUser->fetch())
{
?>
	<h1 class="title">Listes des tests</h1>
	<p class="underTitle">utilisateur : <?php echo $user['firstName'] . " " . $user['lastName'];?></p>
	<br/>
	<?php
	$reqTest = $bdd->prepare('SELECT dateTest, idTest FROM test WHERE idUser = ?');
	$reqTest->execute(array($_GET['id']));
	while ($test = $reqTest->fetch()) { ?>
		<a href="results.php?id=<?php echo $test['idTest']?>" id="listTests">
			<img src="images/logoResults.png" class="logoMenu" />
			Test effectué le <?php echo $test['dateTest']?>
		</a>
		<br/>

	<?php 
	}
	$reqTest->closeCursor();
	?>

	<br/>
	<?php
	$istest = $bdd->prepare('SELECT idTest FROM test WHERE idUser = ?');
	$istest->execute(array($_GET['id']));
	$tests = $istest->fetch();
	if (!($tests['idTest']==NULL)) { //s'il a effectué des tests?> 
		<table class="tableau">
			<caption>résultas de <?php echo $user['firstName'] . " " . $user['lastName']?> </caption>
	        <thead>
	            <tr class="bordureTableau">
	                <th>Numéro du test</th>
	                <th>Date du test</th>
	                <th>Rythme cardiaque <br/>(en bpm)</th>  
	                <th>Température<br/>(en °C)</th>
	                <th>Temps de réaction<br/>(en ms)</th>
	                <th>Reproduction sonore<br/>(en %)</th>
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
	        		<tr class="bordureTableau">
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
	} else { ?>
		<p id="noResult">Aucun test n'a été effectué par cette personne.</p>
	<?php } ?>


<?php
}
$istest->closeCursor();
$reqUser->closeCursor();
?>

<br/><br/>
<a href="index.php" class="linkBack">Revenir à la page d'accueil</a>

<?php require "templates/footer.php"; //footer?> 	