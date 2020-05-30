<?php
require "../model/configuration.php"; //bdd
?>

<?php require "templates/header.php"; //header?> 

<head>
	<link rel="stylesheet" href="css/style.css" />
	<script src="../dist/chart.js"></script>
</head>

<?php
$reqUser = $bdd->prepare('SELECT * FROM user WHERE idUser = ?');
$reqUser->execute(array($_GET['id']));
while ($user = $reqUser->fetch())
{
?>
	<h1 class="title">Listes des tests</h1>
	<p class="underTitle">Utilisateur : <?php echo $user['firstName'] . " " . $user['lastName'];?></p>
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
			<caption>Résultats de <?php echo $user['firstName'] . " " . $user['lastName']?> </caption>
	        <thead>
	            <tr class="bordureTableau">
	                <th>Numéro du test</th>
	                <th>Date du test</th>
	                <th id="BPMAverage"><a href="#" class="dispGraph">Rythme cardiaque<br/>(en bpm)</a></th>  
	                <th id="temperatureAverage"><a href="#" class="dispGraph">Température<br/>(en °C)</a></th>
	                <th id="reactionTime"><a href="#" class="dispGraph">Temps de réaction<br/>(en ms)</a></th>
	                <th id="soundReproductionQuality"><a href="#" class="dispGraph">Reproduction sonore<br/>(en %)</a></th>
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

	<?php //permet de savoir combien de test à passé l'utilisateur
		$reqTestCount = $bdd->prepare('SELECT COUNT(*) AS count FROM test WHERE idUser = ?');
		$reqTestCount->execute(array($_GET['id']));
		$testCount = $reqTestCount->fetch();
		$reqTestCount->closeCursor();
	?>

<script> // affichage des graphiques de l'évolution des résultats
	var BPMAverage = document.getElementById("BPMAverage");
	var temperatureAverage = document.getElementById("temperatureAverage");
	var reactionTime = document.getElementById("reactionTime");
	var soundReproductionQuality = document.getElementById("soundReproductionQuality");

	var divGraph = document.createElement('div');
	divGraph.className = 'divGraph';
	divGraph.style.height = '15em';
	divGraph.style.width = '40em';
	divGraph.style.position = "absolute";
	divGraph.style.bottom = "9em"
	divGraph.style.left= "35em";
	var canvas = document.createElement('canvas');
	canvas.id = 'chart';


	BPMAverage.addEventListener('click', function(){
		var ctx = canvas.getContext('2d');
				var chart = new Chart(ctx, {
		    // The type of chart we want to create
		    	type: 'line',

		    // The data for our dataset
			   		data: {
			        labels: [
			        	<?php for ($i=0; $i < $testCount['count'] ; $i++) { 
			        			if($i<$testCount['count']-1){
			        				echo $i+1 . ',';
			        			}else{
			        				echo $i+1 ;
			        			}
			        		  } ?>
			        ],
			        	datasets: [{
			            	label: 'Rythme cardique',
			            	backgroundColor: '#2B3087',
			            	borderColor: '#2B3087',
			            	fill : false,
			            	data: [
			            		<?php $compteur = 0;
			            			$reqTest = $bdd->prepare('SELECT BPMAverage FROM test WHERE idUser = ?');
			            			$reqTest->execute(array($_GET['id']));
			            			while ($test = $reqTest->fetch()) {
			            				$compteur += 1;
			            				if ($compteur<$testCount) {
			            					echo $test['BPMAverage'] . ',';
			            				}else{
			            					echo $test['BPMAverage'];
			            				}
			            			}
			            			$reqTest->closeCursor();
			        		    ?>
			            	]
			       	 	}]
			    	},

		    // Configuration options go here
		    		options: {}
				});

		divGraph.appendChild(canvas);
		document.body.appendChild(divGraph);
	});

	temperatureAverage.addEventListener('click', function(){

		var ctx = canvas.getContext('2d');
				var chart = new Chart(ctx, {
		    // The type of chart we want to create
		    	type: 'line',

		    // The data for our dataset
			   		data: {
			        labels: [
			        	<?php for ($i=0; $i < $testCount['count'] ; $i++) { 
			        			if($i<$testCount['count']-1){
			        				echo $i+1 . ',';
			        			}else{
			        				echo $i+1 ;
			        			}
			        		  } ?>
			        ],
			        	datasets: [{
			            	label: 'Température',
			            	backgroundColor: '#240027',
			            	borderColor: '#2B3087',
			            	fill : false,
			            	data: [
			            		<?php $compteur = 0;
			            			$reqTest = $bdd->prepare('SELECT temperatureAverage FROM test WHERE idUser = ?');
			            			$reqTest->execute(array($_GET['id']));
			            			while ($test = $reqTest->fetch()) {
			            				$compteur += 1;
			            				if ($compteur<$testCount) {
			            					echo $test['temperatureAverage'] . ',';
			            				}else{
			            					echo $test['temperatureAverage'];
			            				}
			            			}
			            			$reqTest->closeCursor();
			        		    ?>
			            	]
			       	 	}]
			    	},

		    // Configuration options go here
		    		options: {}
				});

		divGraph.appendChild(canvas);
		document.body.appendChild(divGraph);
	});

	reactionTime.addEventListener('click', function(){

		var ctx = canvas.getContext('2d');
				var chart = new Chart(ctx, {
		    // The type of chart we want to create
		    	type: 'line',

		    // The data for our dataset
			   		data: {
			        labels: [
			        	<?php for ($i=0; $i < $testCount['count'] ; $i++) { 
			        			if($i<$testCount['count']-1){
			        				echo $i+1 . ',';
			        			}else{
			        				echo $i+1 ;
			        			}
			        		  } ?>
			        ],
			        	datasets: [{
			            	label: 'Temps de réaction',
			            	backgroundColor: '#240027',
			            	borderColor: '#2B3087',
			            	fill : false,
			            	data: [
			            		<?php $compteur = 0;
			            			$reqTest = $bdd->prepare('SELECT reactionTime FROM test WHERE idUser = ?');
			            			$reqTest->execute(array($_GET['id']));
			            			while ($test = $reqTest->fetch()) {
			            				$compteur += 1;
			            				if ($compteur<$testCount) {
			            					echo $test['reactionTime'] . ',';
			            				}else{
			            					echo $test['reactionTime'];
			            				}
			            			}
			            			$reqTest->closeCursor();
			        		    ?>
			            	]
			       	 	}]
			    	},

		    // Configuration options go here
		    		options: {}
				});

		divGraph.appendChild(canvas);
		document.body.appendChild(divGraph);
	});

	soundReproductionQuality.addEventListener('click', function(){

		var ctx = canvas.getContext('2d');
				var chart = new Chart(ctx, {
		    // The type of chart we want to create
		    	type: 'line',

		    // The data for our dataset
			   		data: {
			        labels: [
			        	<?php for ($i=0; $i < $testCount['count'] ; $i++) { 
			        			if($i<$testCount['count']-1){
			        				echo $i+1 . ',';
			        			}else{
			        				echo $i+1 ;
			        			}
			        		  } ?>
			        ],
			        	datasets: [{
			            	label: 'Qualité de reproduction sonore',
			            	backgroundColor: '#146585',
			            	borderColor: '#2B3087',
			            	fill : false,
			            	data: [
			            		<?php $compteur = 0;
			            			$reqTest = $bdd->prepare('SELECT soundReproductionQuality FROM test WHERE idUser = ?');
			            			$reqTest->execute(array($_GET['id']));
			            			while ($test = $reqTest->fetch()) {
			            				$compteur += 1;
			            				if ($compteur<$testCount) {
			            					echo $test['soundReproductionQuality'] . ',';
			            				}else{
			            					echo $test['soundReproductionQuality'];
			            				}
			            			}
			            			$reqTest->closeCursor();
			        		    ?>
			            	]
			       	 	}]
			    	},

		    // Configuration options go here
		    		options: {}
				});

		divGraph.appendChild(canvas);
		document.body.appendChild(divGraph);
	});
</script>


<?php
}
$istest->closeCursor();
$reqUser->closeCursor();
?>

<br/><br/>
<a href="index.php" class="linkBack">Revenir à la page d'accueil</a>

<?php require "templates/footer.php"; //footer?> 	