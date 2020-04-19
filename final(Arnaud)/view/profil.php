<?php 
if(isset($_GET['id']) AND $_GET['id'] > 0) { require('../controller/req.profil.php') ;?>
<!DOCTYPE html>
<html lang="fr">

      <head>
      <meta charset="utf-8" />
      <meta http-equiv="x-ua-compatible" content="ie=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />

      <title> Profil </title>

      <link rel="stylesheet" href="css/style.css" />
      </head>

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
         <a href="../model/deconnexion.php" class="linkProfil">Se déconnecter</a>
         <a href="listResults.php?id=<?= $_SESSION['id'] ?>" class="linkProfil">Voir résultats</a>
         <?php
         }
         ?>
      </div>
      <?php  
}
?>
      <?php require "templates/footer.php"; ?>
