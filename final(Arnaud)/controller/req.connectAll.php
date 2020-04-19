<?php 
require "../model/configuration.php";

if(isset($_POST['formconnexion'])) {
    //la vérification de ban ne fonctionne pas et mets 3 erreurs liées aux sessions
   /*require "isBan.php";

   if(isEmailBan($mailconnect)==true){
      echo "Cette adresse mail est bannie";
   }*/


   //else{
   $mailconnect = htmlspecialchars($_POST['mailconnect']);
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
         $_SESSION['photo'] = $userinfo['idImage'];
         header("Location: profil.php?id=".$_SESSION['id']);
      } else {
         $erreur = "Mauvais mail ou mot de passe !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>