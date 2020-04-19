<?php

$bdd = new PDO('mysql:host=localhost;dbname=infinite_;charset=utf8', 'root', '');

if (isset($_SESSION['id']) AND $_SESSION['id'] > 0)
{
	$connecte = 1;
}
else
{
	$connecte = 0;
}

if(!isset($_SESSION['id']) OR  $_SESSION['id']!= 10100){

?>

<body>
	<header>
		<div role="banner">
			<a href="index.php" id="LogoSite" title="Medi-sys - Systèmes médicaux"><img src="images/Infinite_measures.png" id="LogoHome" /></a>
				<nav role="navigation" class="menu">
						<br/>
					<ul class="inline" id="menuPrincipal">
						<li>
							<a href="index.php">
							<img src="images/logoHome.png" class="logoMenu" />
							<span class="centerLogo">Accueil</span></a>
						</li>
						<li>
							<a href="QuiSommesNous.php">
							<img src="images/logoWhoAreWe.png" class="logoMenu" />
							<span class="centerLogo">Qui sommes-nous?</span></a>
						</li>
						<li>
							<a href="information_system.php">
							<img src="images/logoSystem.png" class="logoMenu" />
							<span class="centerLogo">Information système</span></a>
						</li>
						<li>
							<a href="faq.php">
							<img src="images/logoFaq.png" class="logoMenu" />
							<span class="centerLogo">Faq</span></a>
						</li>
						<li>
							<a href="forum.php">
							<img src="images/logoForum.png" class="logoMenu" />
							<span class="centerLogo">Forum</span></a>
						</li>	
					</ul>

					<?php 
						if (isset($connecte) AND $connecte == 1)
						{
						$reqImage = $bdd->prepare("SELECT imageDirectory FROM imageprofil WHERE idImage=?");
						$reqImage -> execute(array($_SESSION['photo']));
						$imageProfil = $reqImage->fetch();
					?>

					<ul class="inline" id="menuAuthentification">
						<a href="accueilMessagerie.php" id="LogoSite"><img src="images/logoMessagerie.png" id="LogoProfile" /></a>
					</ul>
					<ul class="inline" id="menuAuthentification">
						<a href="<?php echo 'profil.php?id='.$_SESSION['id']; ?>" id="LogoSite"><img src=<?= $imageProfil['imageDirectory'];?> id="LogoProfile" /></a>
					</ul>

					<?php } 
						else {
					?>

					<ul class="inline" id="menuAuthentification">
						<a href="connect.php">
							<li id="connect">Se connecter</li></a>
						<a href="createCustomer.php">
							<li id="inscription">S'inscrire</li></a>
					</ul>

					<?php } ?>
				</nav>
			</div>
	</header>
	<link rel="stylesheet" href="css/style.css" />

<?php }
else{
	require 'headerAdmin.php';} 
?>