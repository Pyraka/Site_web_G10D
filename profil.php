<?php
session_start();
 
$bdd = new PDO('mysql:host=localhost;dbname=infinite_', 'root', '');

include('cookieConnect.php');
 
if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM user WHERE idUser = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
?>
<html>
   <head>
      <title>TUTO PHP</title>
      <meta charset="utf-8">
   </head>
   <body>
      <?php require "templates/header.php"; ?>
      <div align="center">
         <h2>Profil de <?php echo $userinfo['firstName'], " ", $userinfo['lastName']; ?></h2>
         <br /><br />
         Prenom = <?php echo $userinfo['firstName']; ?>
         <br />
         Nom = <?php echo $userinfo['lastName']; ?>
         <br />
         Mail = <?php echo $userinfo['email']; ?>
         <br />
         Date de naissance = <?php echo $userinfo['birthDate']; ?>
         <br />
         Age = TODO
         <br />
         Genre = <?php echo $userinfo['gender']; ?>
         <br />
         Membre depuis = ..
         <br />
         <?php
         if(isset($_SESSION['id']) AND $userinfo['idUser'] == $_SESSION['id']) {
         ?>
         <br />
         <a href="editionprofil.php">Editer mon profil</a>
         <a href="deconnexion.php">Se déconnecter</a>
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