
<?php if(session_status() !== PHP_SESSION_ACTIVE) session_start(); ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Qui sommes-nous ?</title>
		<link rel="stylesheet" href="css/style.css">
	</head>

	<?php require "templates/header.php"; //header?>
	<body>

	<div style="padding-left: 5px;">
		
	
		<h2 class="titre">INFINITE MEASURES</h2>

		<p class="PresentationMedisys">
			Inifinite measures est un installateur de solutions « clé en main » pour les centres d’évaluation psychotechniques. <br>
			Ces systèmes pourront à la fois s’adresser à :<br>
			<ul class="PresentationMedisys">
				<li>Des auto-écoles, à destination finale des conducteurs ayant eu leurs permis annulés, invalidés pour solde de points nul ou suspendus pour un délai supérieur à 30 jours</li>
				<li>Des centres de formation de conducteurs de trains ou d’engins de chantier et de grutiers</li>
				<li>Des centres médicaux pour les vérifications périodiques des capacités psychotechniques des pilotes d’engins volants (hélicoptères, petits avions privés)</li>
				<li>Des centres de recherche scientifique pour des analyses comportementales statistiques</li>
			</ul>
		</p>

		<div class="underline"></div>
		<h2 class="titre">Notre équipe chez Médi-sys! </h2>
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

					<p class="PresentationMedisys">Médi-sys est une jeune startup fondée en 2018 par un groupe
						de 6 ingénieurs présentés ci-dessus. Ils ont déjà travaillé en collaboration avec différents
						hôpitaux de Paris sur la réalisation de capteurs mesurant la fréquence cardiaque. Cette nouvelle 
						entreprise a eu la chance de se développer et de travailler avec un nouveau client, Infinite Mesures, 
						sur la réalisation d'un système de tests psychomoteurs. Vous trouverez plus d'informations sur ce système 
						<a class="box-nous" href="information_system.php">ici</a>.</p>
				</section>
			</div>
		<?php require "templates/footer.php"; //footer?>
	</body>
</html>