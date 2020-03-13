<!DOCTYPE html>

<html>

<body>

	<?php
	

	if (isset($_POST['password']) AND $_POST['password'] == 'chibre' )
	{
		echo 'mdp correct';
	}
	else
	{
		?>
		<p>Mot de passe incorrect!</p>
		<a href="index.php">back</a>
		<?php
	}


	?>

</body>
</html>

