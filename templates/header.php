<?php

session_start();

$id_session = session_id() ;

//echo($id_session );

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Base de données simple</title>

  <link rel="stylesheet" href="css/style.css" />
</head>
	
<body>
<header>
				<div role="banner">
						<a href="header.php" id="LogoSite" title="Medi-sys - Systèmes médicaux"><img src="images/Logo.png" id="LogoHome" /></a>
					<nav role="navigation" class="menu">
						<br/>
						<ul class="inline" id="menuPrincipal">
							<li>
								<a href="index.php">
								<img src="images/logoHome.png" class="logoMenu" />
								<span class="centerLogo">Accueil</span></a>
							</li>
							<li>
								<a href="QuiSommesNous.html">
								<img src="images/logoWhoAreWe.png" class="logoMenu" />
								<span class="centerLogo">Qui sommes-nous?</span></a>
							</li>
							<li>
								<a href="">
								<img src="images/logoSystem.png" class="logoMenu" />
								<span class="centerLogo">Information système</span></a>
							</li>
							<li>
								<a href="">
								<img src="images/logoFaq.png" class="logoMenu" />
								<span class="centerLogo">Faq</span></a>
							</li>
							<li>
								<a href="">
								<img src="images/logoForum.png" class="logoMenu" />
								<span class="centerLogo">Forum</span></a>
							</li>
						</ul>
						<ul class="inline" id="menuAuthentification">
							<a href="connect.php"><li id="connect">Se connecter</li></a>
							<a href="create.php"><li id="inscription">S'inscrire</li></a>
						</ul>
					</nav>
				</div>
		</header>
</body>

</html>