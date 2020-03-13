<!DOCTYPE html>
<html>


<?php


if ((!isset($_POST['password'])) OR ($_POST['password'] != 'chibre'))
{
	?>
	<p>
		<?php
		if (isset($_POST['password']) ){
			echo "mot de passe incorrect!";

			?>
			<br>
			<?php
		}
		?>
		veuillez entrer le mot de passe:

		<form action="" method=POST>
			<input type="password" name="password">
			<input type="submit" value="valider">
			
		</form>
	</p>
	<?php
}


else
{
	echo 'le mot de passe est correct';
}

?>



									



</html>