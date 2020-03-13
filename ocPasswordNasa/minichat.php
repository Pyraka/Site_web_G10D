<!DOCTYPE html>
<html>


<form action="minichat_post.php" method=POST>
	<p> <label>Pseudo : </label>
		<input type="text" name="pseudo"></p>
	<p><label>Message : </label>
		<input type="text" name="message"></p>
	<p><input type="submit" value="envoyer"></p>
</form>


<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}

$reponse = $bdd->query('SELECT * FROM minichat ORDER BY ID DESC LIMIT 10');

while ($donnees = $reponse->fetch())
{

	?>
	<p> <strong> <?php echo htmlspecialchars($donnees['pseudo']); ?></strong> : <?php echo htmlspecialchars($donnees['message']); ?> </p>
	<?php
	
}

$reponse->closeCursor();

?>


</html>