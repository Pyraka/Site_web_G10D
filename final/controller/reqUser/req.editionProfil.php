<?php
 

   $requser = $bdd->prepare('SELECT idImage FROM user WHERE idUser = ?');
   $requser->execute(array($_SESSION['id']));
   $idImageActuelle = $requser->fetch();

   $imageProfil=$bdd->prepare("SELECT imageDirectory FROM imageprofil WHERE idImage = ?");
   $imageProfil->execute(array($idImageActuelle['idImage']));
   $imageprofile = $imageProfil->fetch();

   
   $requser = $bdd->prepare("SELECT * FROM user WHERE idUser = ?");
   $requser->execute(array($_SESSION['id']));
   $user = $requser->fetch();
   if(isset($_POST['newfirstname']) AND !empty($_POST['newfirstname']) AND $_POST['newfirstname'] != $user['firstName']) {
      $newfirstname = htmlspecialchars($_POST['newfirstname']);
      $insertfirstname = $bdd->prepare("UPDATE user SET firstName = ? WHERE idUser = ?");
      $insertfirstname->execute(array($newfirstname, $_SESSION['id']));
      header('Location: profil.php?id='.$_SESSION['id']);
   } 
   if(isset($_POST['newlastname']) AND !empty($_POST['newlastname']) AND $_POST['newlastname'] != $user['lastName']) {
      $newlastname = htmlspecialchars($_POST['newlastname']);
      $insertlastname = $bdd->prepare("UPDATE user SET lastname = ? WHERE idUser = ?");
      $insertlastname->execute(array($newlastname, $_SESSION['id']));
      header('Location: profil.php?id='.$_SESSION['id']);
   }
   if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['email']) {
      $newmail = htmlspecialchars($_POST['newmail']);
      $insertmail = $bdd->prepare("UPDATE user SET email = ? WHERE idUser = ?");
      $insertmail->execute(array($newmail, $_SESSION['id']));
      header('Location: profil.php?id='.$_SESSION['id']);
   }
   if(isset($_POST['newbirthdate']) AND !empty($_POST['newbirthdate']) AND $_POST['newbirthdate'] != $user['birthDate']) {
      $newbirthdate = htmlspecialchars($_POST['newbirthdate']);
      $insertbirthdate = $bdd->prepare("UPDATE user SET birthDate = ? WHERE idUser = ?");
      $insertbirthdate->execute(array($newbirthdate, $_SESSION['id']));
      header('Location: profil.php?id='.$_SESSION['id']);
   }
   if(isset($_POST['newgender']) AND !empty($_POST['newgender']) AND $_POST['newgender'] != $user['gender']) {
      $newgender = htmlspecialchars($_POST['newgender']);
      $insertgender = $bdd->prepare("UPDATE user SET gender = ? WHERE idUser = ?");
      $insertgender->execute(array($newgender, $_SESSION['id']));
      header('Location: profil.php?id='.$_SESSION['id']);
   }
   if (isset($_POST['oldmdp']) AND !empty($_POST['oldmdp'])) {
      if (md5($_POST['oldmdp'])==$user['userPassword']) {
         if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
            $mdp1 = md5($_POST['newmdp1']);
            $mdp2 = md5($_POST['newmdp2']);
            if($mdp1 == $mdp2) {
               $insertmdp = $bdd->prepare("UPDATE user SET userPassword = ? WHERE idUser = ?");
               $insertmdp->execute(array($mdp1, $_SESSION['id']));
               header('Location: profil.php?id='.$_SESSION['id']);
            } else {
               $msg = "Vos deux mdp ne correspondent pas !";
            }
         } else {
            $msg = "Entrez le nouveau mot de passe et la confirmation de mot de passe !";
         }
      } else {
         $msg = "L'ancien mot de passe que vous avez entré ne correspond pas !";
      }
   } else {
      $msg = "Entrez votre ancien mot de passe pour pouvoir changer.";
   }

   if (isset($_FILES['photoProfil']) AND !empty($_FILES['photoProfil'])) {
      $targetDirectory = "images/photoProfil/";
      $targetFile = $targetDirectory . basename($_FILES['photoProfil']['name']);
      if (move_uploaded_file(($_FILES['photoProfil']['tmp_name']), $targetFile)) {
         try {
            $reqImage=$bdd->prepare("SELECT imageDirectory FROM imageprofil WHERE imageDirectory = ?");
            $reqImage->execute(array($targetFile));
            $imageExist = $reqImage->rowcount();

            if($imageExist < 1){
               $insertPhoto=$bdd->prepare("INSERT INTO imageprofil(imageDirectory) VALUES (?)");
               $insertPhoto->execute(array($targetFile));
            }  
         } catch (Exception $error) {
            echo $error->getMessage();
         }
         $selectPhoto=$bdd->prepare("SELECT idImage FROM imageprofil WHERE imageDirectory = ?");
         $selectPhoto->execute(array($targetFile));
         $selectedPhoto = $selectPhoto->fetch();
         $changePhoto=$bdd->prepare("UPDATE user SET idImage = ? WHERE idUser = ?");
         $changePhoto->execute(array($selectedPhoto['idImage'], $_SESSION['id']));
         $_SESSION['photo'] = $selectedPhoto['idImage'];
         header('Location: profil.php?id='.$_SESSION['id']);
      }
   }



?>