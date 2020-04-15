<!-- adresse mail unique dans la base de données-->

<?php
include "configuration.php";

if(isset($_POST['formconnexion'])) {
   $mailconnect = htmlspecialchars($_POST['mailconnect']);
   
//la vérification de ban ne fonctionne pas et mets 3 erreurs liées aux sessions
   /*require "isBan.php";

   if(isEmailBan($mailconnect)==true){
      echo "Cette adresse mail est bannie";
   }*/


   //else{
      $mdpconnect = md5($_POST['mdpconnect']);
      if(!empty($mailconnect) AND !empty($mdpconnect)) {
         $requser = $bdd->prepare("SELECT * FROM user WHERE email = ? AND userPassword = ?");
         $requser->execute(array($mailconnect, $mdpconnect));
         $userexist = $requser->rowCount();
         if($userexist == 1) {

            if (isset($_POST['rememberme']))
            {
               setcookie('email', $mailconnect, time() + 365 * 24 * 3600, null, null, false, true);
               setcookie('password', $mdpconnect, time() + 365 * 24 * 3600, null, null, false, true);
            }
            $userinfo = $requser->fetch();
            $_SESSION['id'] = $userinfo['idUser'];
            $_SESSION['email'] = $userinfo['email'];
            header("Location: profil.php?id=".$_SESSION['id']);
         } else {
            $erreur = "Mauvais mail ou mot de passe !";
         }
      } else {
         $erreur = "Tous les champs doivent être complétés !";
      }
   }
//}
?>
<html>
   <head>
      <title>TUTO PHP</title>
      <meta charset="utf-8">
   </head>
   <body>
      <?php require "templates/header.php"; ?>
      <div align="center">
         <h2>Connexion</h2>
         <br /><br />
         <form method="POST" action="">
            <input type="email" name="mailconnect" placeholder="Mail" />
            <input type="password" name="mdpconnect" placeholder="Mot de passe" />
            <br /><br />
            <!-- TODO le style -->
            <input type="checkbox" name="rememberme" id="remembercheckbox"/><label for="remembercheckbox">Se souvenir de moi</label>
            <input type="submit" name="formconnexion" value="Se connecter !" />
         </form>
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
      </div>
      <?php require "templates/footer.php"; ?>
   </body>
</html>