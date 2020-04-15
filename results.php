<?php
require "configuration.php";
//require "common.php";
/*try
{
	$connection = new PDO($dsn, $username, $password, $options); // accès à la base de données utilisateur
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}*/?>

<head>
	<script src="dist/chart.js"></script>
</head>

<?php require "templates/header.php"; //header?> 

<?php
$reqBpmMean = $bdd->query("SELECT AVG(BPMAverage) AS bpm_mean FROM test");
$bpmMean = $reqBpmMean->fetch();
$reqBpmMean->closeCursor();

$reqTempMean = $bdd->query("SELECT AVG(temperatureAverage) AS temp_mean FROM test");
$tempMean = $reqTempMean->fetch();
$reqTempMean->closeCursor();

$reqReactMean = $bdd->query("SELECT AVG(reactionTime) AS react_mean FROM test");
$reactMean = $reqReactMean->fetch();
$reqReactMean->closeCursor();

$reqSrqMean = $bdd->query("SELECT AVG(soundReproductionQuality) AS srq_mean FROM test");
$srqMean = $reqSrqMean->fetch();
$reqSrqMean->closeCursor();

$reqTest = $bdd->prepare('SELECT * FROM test WHERE idTest = ?'); 
$reqTest->execute(array($_GET['id']));
while ($test = $reqTest->fetch()) {?>
	<h1 class="title">Liste des résultats</h1>
	<p id="descriptionTest"> effectué le <?php echo $test['dateTest'] ?></p>
	<br/><br/>
	<ul id="listResults">
		<li>Résultats du test de rythme cardiaque : <?php echo $test['BPMAverage']?>bpm</li>
		<li>Résultats du test de température corporel : <?php echo $test['temperatureAverage']?>°C</li>
		<li>Résultats du test de réflexes visuels : <?php echo $test['reactionTime']?>ms</li>
		<li>Résultats du test de reproduction sonore : <?php echo $test['soundReproductionQuality']?></li>
	</ul>

	<div style="position: relative; bottom: 8em; left: 40em; height: 20vh; width: 50vw">
		<canvas id="myChart"></canvas>
		<script>
			var ctx = document.getElementById('myChart').getContext('2d');
			var chart = new Chart(ctx, {
	    // The type of chart we want to create
	    	type: 'bar',

	    // The data for our dataset
		   		data: {
		        labels: ['BPMAverage', 'temperatureAverage', 'reactionTime', 'soundReproductionQuality'],
		        	datasets: [{
		            	label: 'resultats',
		            	backgroundColor: '#2B3087',
		            	borderColor: '#2B3087',
		            	data: [<?php echo $test['BPMAverage']?>, <?php echo $test['temperatureAverage']?>, <?php echo $test['reactionTime']?>, <?php echo $test['soundReproductionQuality']?>]
		       	 	},{
		       	 		label: 'moyenne',
		            	backgroundColor: '#8BACED',
		            	borderColor: '#8BACED',
		            	data: [<?php echo $bpmMean['bpm_mean']?>, <?php echo $tempMean['temp_mean']?>, <?php echo $reactMean['react_mean']?>, <?php echo $srqMean['srq_mean']?>]
		       	 	}]
		    	},

	    // Configuration options go here
	    		options: {}
			});
		</script>
	</div>

<a href="listResults.php?id=<?php echo $test['idUser']?>">Revenir à la liste des résultats</a>

<?php }
$reqTest->closeCursor();
?>

<?php require "templates/footer.php"; //footer?> 