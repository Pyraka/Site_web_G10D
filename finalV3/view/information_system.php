<?php require "../model/configuration.php";?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
         <link rel="stylesheet" href="style.css" />
        <title>Information systèmes </title>
    </head>
	<?php require "templates/header.php"; ?>
	<h2 id="titre" class ="titre">
		Informations systèmes
	</h2>
	<div class="underline"></div>
	<div class='informationsystèmes' id="informationsystèmes">
	<article>
		<article>
			<h3>Test cardiaque</h3>
			<p>
			Nous évaluerons le niveau de stress à l’aide du capteur de fréquence cardiaque et du capteur de température superficiel de la peau.
			<br/>

			Pour cela nous utilisons un laser.<br/>
			 Le laser que nous exploitons agit comme un rayon qui traverse le doigt, en le traversant, ce laser va permettre de déterminer la fluctuation du sang et ainsi connaitre le rythme cardiaque.
			<br/>
			
			Dans le but de mesurer la température corporelle nous utilisons un capteur de température électronique.
			</p>

		</article>
	</section>

	<section>
		<article>
			<h3>Test sonore</h3>
			<p>
			Nous employons un casque afin de tester l'ouïe. Pour permettre ce test, nous utilisons un capteur sonore afin de tester la tonalité de la voix.
			</p>

		</article>
	</section>
	<section>
		<article>
			<h3>Test de reflexe visuel
			</h3>
			<p>
				Nous utilisons un test qui fait appel aux réflexs visuels, nous allumons des lampes, le candidat doit réagir à chaque fois qu'une ampoule s'alllume.
			</p>
		</article>
	</section>
	</div>
<?php require "templates/footer.php"; ?>
  