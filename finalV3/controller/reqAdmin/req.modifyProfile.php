<?php

   $requser = $bdd->prepare('SELECT * FROM user WHERE idUser = ?');
   $requser->execute(array($_SESSION['id']));
   $requser = $requser->fetch();
   // on verifie qu'il s'agit bien d'un admin
   if (!isset($_SESSION['id']) OR $requser['allow']!= 2){
      header('Location: index.php');
   }

 
   if (!isset($_GET['id']) OR $_GET['id'] < 1){
      header('Location: manageUser.php');
   }

   $idUser = htmlspecialchars($_GET['id']);


   $requser = $bdd->prepare('SELECT idImage FROM user WHERE idUser = ?');
   $requser->execute(array($idUser));
   $idImageActuelle = $requser->fetch();

   $imageProfil=$bdd->prepare("SELECT imageDirectory FROM imageprofil WHERE idImage = ?");
   $imageProfil->execute(array($idImageActuelle['idImage']));
   $imageprofile = $imageProfil->fetch();

   
   $requser = $bdd->prepare("SELECT * FROM user WHERE idUser = ?");
   $requser->execute(array($idUser));
   $user = $requser->fetch();
   if(isset($_POST['newfirstname']) AND !empty($_POST['newfirstname']) AND $_POST['newfirstname'] != $user['firstName']) {
      $newfirstname = htmlspecialchars($_POST['newfirstname']);
      $insertfirstname = $bdd->prepare("UPDATE user SET firstName = ? WHERE idUser = ?");
      $insertfirstname->execute(array($newfirstname, $idUser));
      header('Location: profil.php?id='.$idUser);
   } 
   if(isset($_POST['newlastname']) AND !empty($_POST['newlastname']) AND $_POST['newlastname'] != $user['lastName']) {
      $newlastname = htmlspecialchars($_POST['newlastname']);
      $insertlastname = $bdd->prepare("UPDATE user SET lastname = ? WHERE idUser = ?");
      $insertlastname->execute(array($newlastname, $idUser));
      header('Location: profil.php?id='.$idUser);
   }
   if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['email']) {
      $newmail = htmlspecialchars($_POST['newmail']);

      

      $requser = $bdd->prepare("SELECT * FROM user WHERE email = ?");
      $requser->execute(array($newmail));

      $userexist = $requser->rowCount();
      if($userexist != 0) {
          $msg = "Cette adresse email est deja utilisé...";
      }
      else{
         $insertmail = $bdd->prepare("UPDATE user SET email = ? WHERE idUser = ?");
         $insertmail->execute(array($newmail, $idUser));
         header('Location: profil.php?id='.$idUser);
      }

      
   }
   if(isset($_POST['newbirthdate']) AND !empty($_POST['newbirthdate']) AND $_POST['newbirthdate'] != $user['birthDate']) {
      $newbirthdate = htmlspecialchars($_POST['newbirthdate']);
      $insertbirthdate = $bdd->prepare("UPDATE user SET birthDate = ? WHERE idUser = ?");
      $insertbirthdate->execute(array($newbirthdate, $idUser));
      header('Location: profil.php?id='.$idUser);
   }
   if(isset($_POST['newgender']) AND !empty($_POST['newgender']) AND $_POST['newgender'] != $user['gender']) {
      $newgender = htmlspecialchars($_POST['newgender']);
      $insertgender = $bdd->prepare("UPDATE user SET gender = ? WHERE idUser = ?");
      $insertgender->execute(array($newgender, $idUser));
      header('Location: profil.php?id='.$idUser);
   }
   
         if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
            $mdp1 = md5($_POST['newmdp1']);
            $mdp2 = md5($_POST['newmdp2']);
            if($mdp1 == $mdp2) {
               $insertmdp = $bdd->prepare("UPDATE user SET userPassword = ? WHERE idUser = ?");
               $insertmdp->execute(array($mdp1, $idUser));
               header('Location: profil.php?id='.$idUser);
            } else {
               $msg = "Vos deux mdp ne correspondent pas !";
            }
         } else {
            $msg = "Entrez le nouveau mot de passe et la confirmation de mot de passe !";
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
         $changePhoto->execute(array($selectedPhoto['idImage'], $idUser));
         
         header('Location: profil.php?id='.$idUser);
      }
   }



