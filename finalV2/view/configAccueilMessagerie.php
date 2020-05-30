
<?php
$idUser = $_SESSION['id'];

$requser = $bdd->prepare("SELECT DISTINCT idWritter, idReceiver FROM messaging WHERE idWritter = ? OR idReceiver = ? ORDER BY date DESC"); 
$requser->execute(array($idUser, $idUser));

$info = $requser->fetchAll();

$stack = array();
$stackReceiver = array();
$stackWritter = array();
foreach ($info as $key) {
	if (estDejaDansLaListe($stack, $key['idWritter'])){
		array_push($stack, $key['idWritter']);
		array_push($stackWritter, $key['idWritter']);
	}
	if (estDejaDansLaListe($stack, $key['idReceiver'])){
		array_push($stack, $key['idReceiver']);
		array_push($stackReceiver, $key['idReceiver']);
	}
}



function estDejaDansLaListe($liste, $param){
	global $idUser;
	if($param == $idUser){
		return false;
	}
	foreach ($liste as $key) {
		if($key == $param){
			return false;
		}
		
	}
	return true;
}

function attribuePrenomNomEmail($id){
	global $bdd;
	$requser = $bdd->prepare("SELECT firstName, lastName, email FROM user WHERE idUser = ?"); 
	$requser->execute(array($id));

	$info = $requser->fetch();
	echo $info['firstName'], ' ', $info['lastName'], ' : ', $info['email'];

}

function attribuePrenomNom($id){
	global $bdd;
	$requser = $bdd->prepare("SELECT firstName, lastName, email FROM user WHERE idUser = ?"); 
	$requser->execute(array($id));

	$info = $requser->fetch();
	echo $info['firstName'], '&nbsp;', $info['lastName'];
}

function attribueDernierMessage($id){
	global $bdd;
	global $idUser;
	

	if (attribueReceiverOuWritter($id) == "Writter"){
		$requser = $bdd->prepare("SELECT date, textMessage FROM messaging WHERE idWritter = ? AND idReceiver = ?");
		$requser->execute(array($id, $idUser));
	}

	if (attribueReceiverOuWritter($id) == "Receiver"){
		$requser = $bdd->prepare("SELECT date, textMessage FROM messaging WHERE idReceiver = ? AND idWritter = ?");
		$requser->execute(array($id, $idUser));
	}


	$info = $requser->fetchAll();

	$latestDate = '1980-01-01T15:03:01.012345Z';
	$latestMessage = "";
	
	
	foreach ($info as $date) {

		if (strtotime($date['date']) > strtotime($latestDate)){
			$latestDate = $date['date'];
			$latestMessage = $date['textMessage'];
		}
		
	}

	if ($latestDate != '1980-01-01T15:03:01.012345Z'){
		echo $latestDate, ' : ', $latestMessage;
	}
	

	


}

function attribueReceiverOuWritter($id){
	global $stackWritter;
	global $stackReceiver;
	foreach ($stackReceiver as $key) {
		if ($key == $id){
			return "Receiver";
		}
	}
	foreach ($stackWritter as $key) {
		if ($key == $id){
			return "Writter";
		}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	

	
	<div class="barreRechercheMessagerie">
		<input type="text" placeholder="Rechercher un contact..." class="champRechercheMessagerie" id="champRechercheMessagerie" value="">
	</div>
	<div>
		<div id="result-search"></div>
	</div>

	<section class="linksMessenger">
		<h2 style="text-align: center; border-bottom-style: solid;">
			Conversations : <br>
		</h2>

		<div class="listeContacts" id="listeContacts" style="background-color: rgba(255, 0, 0, 0.5);">
			<a href="messagerie.php?id=10100">
				<label id="PrenomNomCorresp">admin</label>
				<br>
			</a>
		</div>
				
			
		
		<br>
		<?php
		foreach ($stack as $idCorresp) {

			?>
			<br> 
			
				
			<div class="listeContacts" id="listeContacts">
				<a href=<?php echo "messagerie.php?id=", $idCorresp;?>>
					<label id="PrenomNomCorresp"> <?php attribuePrenomNomEmail($idCorresp) ?></label>
					<br>
					<label id="dernierMessage"> 
						dernier message :
						<br>
						<?php
						if (attribueReceiverOuWritter($idCorresp) == "Receiver"){
							echo 'Vous : ';
						}
						if (attribueReceiverOuWritter($idCorresp) == "Writter"){
							attribuePrenomNom($idCorresp);
							echo ' : ';
						}

						attribueDernierMessage($idCorresp); ?>
					</label>
				</a>
			</div>
					
				
			
			<br>



		<?php } ?>

	</section>


	
</body>
</html>