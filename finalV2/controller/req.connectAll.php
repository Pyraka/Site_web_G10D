<?php 
require "../model/configuration.php";

if(isset($_POST['formconnexion'])) {

   
      $mailconnect = htmlspecialchars($_POST['mailconnect']);
      $mdpconnect = md5($_POST['mdpconnect']);
      if(!empty($mailconnect) AND !empty($mdpconnect)) {

         $requser = $bdd->prepare("SELECT * FROM user WHERE email = ? AND userPassword = ?");
         $requser->execute(array($mailconnect, $mdpconnect));
         $userexist = $requser->rowCount();
         if($userexist == 1) {

            $userinfo = $requser->fetch();


            $req10 = $bdd->prepare("SELECT * FROM ban WHERE idUser = ?");
            $req10->execute(array($userinfo['idUser']));
            $userexist1 = $req10->rowCount();
            if ($userexist1 == 0){

               if (isset($_POST['rememberme']))
               {
                  setcookie('email', $mailconnect, time() + 365 * 24 * 3600, null, null, false, true);
                  setcookie('password', $mdpconnect, time() + 365 * 24 * 3600, null, null, false, true);
               }
               
               $_SESSION['id'] = $userinfo['idUser'];
               $_SESSION['email'] = $userinfo['email'];
               $_SESSION['photo'] = $userinfo['idImage'];
               header("Location: profil.php?id=".$_SESSION['id']);
               
            }
            else{
               $erreur = "Ce compte a été suspendu, veuillez contacter un administrateur";
            }

            
         } else {
            $erreur = "Mauvais mail ou mot de passe !";
         }
      } else {
         $erreur = "Tous les champs doivent être complétés !";
      }
   
}
?>