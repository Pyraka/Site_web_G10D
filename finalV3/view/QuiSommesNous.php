
<?php if(session_status() !== PHP_SESSION_ACTIVE) session_start(); ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Qui sommes-nous ?</title>
		<link rel="stylesheet" href="css/style.css">
	</head>

	<?php require "templates/header.php"; //header?>
	<h2 class="titre"> Notre équipe ! </h2>
	<div class="underline"></div>
			<section>
				<div class="ourPhotos">
					<figure>
						<img src="images/jeremy.jpg"/>
						<figcaption>Jeremy Igliki</figcaption>
					</figure>
					<figure>
						<img src="images/jean.jpg"/>
						<figcaption>Jean Trang</figcaption>
					</figure>
					<figure>
						<img src="images/arnaud.jpg"/>
						<figcaption>Arnaud Guilhamat</figcaption>
					</figure>
					<figure>
						<img src="images/yanis.jpg"/>
						<figcaption>Yanis Moula</figcaption>
					</figure>
					<figure>
						<img src="images/nicolas.jpg"/>
						<figcaption>Nicolas Fourquet</figcaption>
					</figure>
					<figure>
						<img src="images/axel.jpg"/>
						<figcaption>Axel Sagredo</figcaption>
					</figure>
				</div>

				<p id="PresentationMedisys">Médi-sys est une jeune startup fondée en 2018 par un groupe
					de 6 ingénieurs présentés ci-dessus. Ils ont déjà travaillé en collaboration avec différents
					hôpitaux de Paris sur la réalisation de capteurs mesurant la fréquence cardiaque. Cette nouvelle 
					entreprise a eu la chance de se développer et de travailler avec un nouveau client, Infinite Mesures, 
					sur la réalisation d'un système de tests psychomoteurs. Vous trouverez plus d'informations sur ce système 
					<a href="information_system.php">ici</a>.</p>
			</section>

		<?php require "templates/footer.php"; //footer?>
	</body>
</html>