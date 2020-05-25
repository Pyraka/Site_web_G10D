<!-- adresse mail unique dans la base de données-->
<?php require ('../controller/req.connectAll.php') ?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title> Se connecter </title>

  <link rel="stylesheet" href="css/style.css" />
</head>

      <?php require "templates/header.php"; ?>
      <div class="entireCo">
         <h2 class="titleCo">Connexion</h2>
         <div class="underline"></div>
               
         <form method="POST" action="" class="formCo">
            <input type="email" name="mailconnect" placeholder="Mail" />
            <input type="password" name="mdpconnect" placeholder="Mot de passe" />
            <br /><br />
            <!-- TODO le style -->
            <div style="display: inline-flex;">
              <input type="checkbox" name="rememberme" id="remembercheckbox"/><label for="remembercheckbox">Se souvenir de moi</label>
            </div>
            <br><br>
            <input type="submit" name="formconnexion" value="Se connecter !" />
            
         </form>
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
      </div>


      <?php require "templates/footer.php"; ?>