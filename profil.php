<?php
include "configuration.php";
 
if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM user WHERE idUser = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();

   $reqImage = $bdd->prepare("SELECT imageDirectory FROM imageprofil WHERE idImage=?");
   $reqImage -> execute(array($_SESSION['photo']));
   $imageProfil = $reqImage->fetch();
?>
<html>
   <head>
      <title>TUTO PHP</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="css/style.css" />
   </head>
   <body>
      <?php require "templates/header.php"; ?>
      <div align="center">
         <h2>Profil de <?php echo $userinfo['firstName'], " ", $userinfo['lastName']; ?></h2>
         <img src="<?php echo $imageProfil['imageDirectory'] ?>" id="photoProfil"/>
         <p>Mail = <?php echo $userinfo['email']; ?></p>
         
         <p>Date de naissance = <?php echo $userinfo['birthDate']; ?></p>
         
         <p>Age = TODO</p>
         
         <p>Genre = <?php echo $userinfo['gender']; ?></p>
        
         <p>Membre depuis = ..</p>
         
         <?php
         if(isset($_SESSION['id']) AND $userinfo['idUser'] == $_SESSION['id']) {
         ?>
         <br />
         <a href="editionprofil.php" class="linkProfil">Editer mon profil</a>
         <a href="deconnexion.php" class="linkProfil">Se déconnecter</a>
         <a href="listResults.php?id=<?php echo($_SESSION['id']) ?>" class="linkProfil">Résultats</a>
         <?php
         }
         ?>
      </div>
      <?php require "templates/footer.php"; ?>
   </body>
</html>
<?php   
}
?>