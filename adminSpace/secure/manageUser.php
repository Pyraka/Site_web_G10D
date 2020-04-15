<?php
$bdd = new PDO('mysql:host=localhost;dbname=infinite_;charset=utf8', 'root', '');
 //require "memberSpace/templates/header.php";

   //ajout d'un utilisateur

   if (isset($_POST['submit']) && isset($_POST['firstName']) AND isset($_POST['lastName']) AND isset($_POST['email']) AND isset($_POST['userPassword']) AND isset($_POST['birthDate']) AND isset($_POST['gender']) AND ($_POST['mdp_verif'])==($_POST['userPassword'])) {
    
      try {
  
          // on vérifie que l'email n'est pas déjà utilisée
          $requser = $bdd->prepare("SELECT * FROM user WHERE email = ?");
          $requser->execute(array($_POST['email']));
  
          $userexist = $requser->rowCount();
          if($userexist != 0) {
              echo "Cette adresse email est deja utilisé...";
          }

          else{

            // on ajoute s'il n'y a pas deja cette adresse mail dans la bdd
            $requser1 = $bdd->prepare("INSERT INTO user(firstName, lastName, email, birthDate, gender, userPassword, subDate, age) VALUES(?, ?, ?, ?, ?, ?, NOW(), ?)");
            $requser1->execute(array($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['birthDate'], $_POST['gender'], md5($_POST['userPassword']), age($_POST['birthDate'])));

            // On refait une requete maintenant que l'utilisateur a été ajouté
            $requser->execute(array($_POST['email']));
            $utilisateur = $requser->fetch();
          }
      }catch (PDOException $error) {
            echo $error->getMessage();
         }
   }
    else{
        if (isset($_POST['submit'])) {
            echo("Les mots de passe ne sont pas identiques");
        }
        
    }

   /*else if($_GET['submit']){
      $req =$bdd->prepare('INSERT INTO user(email, userPassword) VALUES(?,?) ');
      $req -> execute(array($_GET['email'],$_GET['password']));
   }*/

   if(isset($_GET['ban'])){
// fonction isBan en bas de la page

   /*   //vérif si utilisateur déjà banni
      $ban = (int) $_GET['ban'];
      $allBan = $bdd ->prepare('SELECT * FROM ban WHERE idUser = ?');
      $allBan -> execute(array($ban));
      $banExist = $allBan->rowCount();

      if($banExist != 0){
         echo "Cette personne est déjà banni" ; 
      }*/
      if (isBan($_GET['ban'])==true){ echo "Cette utilisateur est déjà bannis.";}
      //bannissment d'un utilisateur
      else{
      $ban = (int) $_GET['ban'];
      $req = $bdd->prepare('INSERT INTO ban(idUser, dateBan) VALUES (?,NOW())');
      $req -> execute(array($ban));
      }
   }

   //débannissmenet d'un utilisateur

   else if(isset($_GET['deban'])){
      $deban = (int) $_GET['deban'];
      $req = $bdd->prepare('DELETE FROM ban WHERE idUser = ?');
      $req->execute(array($deban));
   }



$members = $bdd->query('SELECT * FROM user');
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8" />
   <title>Administration</title>
</head>
<body>
<ul>
      <?php while($m = $members->fetch()) { ?>
      <li><?= $m['idUser'] ?> : <?= $m['email'] ?> - <a href="modifUser.php">Modifier</a>
      - <a href="manageUser.php?ban=<?= $m['idUser'] ?>">Bannir </a> </li>
      - <a href="manageUser.php?deban=<?= $m['idUser'] ?>">Débannir </a> </li>
      <?php } ?>
   </ul>

   <form method="post">
      <strong> Ajouter un utilisateur manuellement </strong>
    <label for="firstName">Prénom</label>
    <input type="text" name="firstName" id="firstName" placeholder="Prénom" required>
    <label for="lastName">Nom</label>
    <input type="text" name="lastName" id="lastName" placeholder="Nom" required>
    <label for="email">Adresse email</label>
    <input type="email" name="email" id="email" placeholder="Adresse email" required>
    <label for="userPassword">Mot de passe</label>
    <input type="password" name="userPassword" id="userPassword" placeholder="Mot de passe" required >
    <label for="mdp_verif">Vérification du mot de passe</label>
    <input type="password" name="mdp_verif" id="mdp_verif" placeholder="Mot de passe" required >
    <span id='message'></span> <!-- permet d'insérer le message de vérification de mot de passe en js -->
    <label for="birthDate">Date de naissance</label>
    <input type="date" name="birthDate" id="birthDate" placeholder="dd/mm/aa" required>
    <label for="gender">Genre</label>
    <input type="radio" name="gender" value="Homme"> Homme
    <input type="radio" name="gender" value="Femme"> Femme
    <input type="radio" name="gender" value="Autre"> Autre   
    <input type="submit" name="submit" value="S'inscrire">
</form>

   <br /><br />
   <a href="adminHome.php"> Retour à la page d'administration</a>
</body>
</html>

<?php

function isBan($id){
    //include "configuration.php";
    $bdd = new PDO('mysql:host=localhost;dbname=infinite_;charset=utf8', 'root', '');
   
    $allBan = $bdd ->prepare('SELECT * FROM ban WHERE idUser = ?');
    $allBan -> execute(array($id));
     $banExist = $allBan->rowCount();

      if($banExist != 0){
        return true;
      }
}


function age($date){
    $birthYear = date('Y', strtotime($_POST['birthDate']));
    $birthMonth = date('m', strtotime($_POST['birthDate']));
    $todayYear = date('Y', strtotime(date('Y')));
    $todayMonth = date('m', strtotime(date('m')));
    $age = $todayYear - $birthYear;

    if ( $todayMonth> $birthMonth ){
        return ($age) ;
    }
    else{
        return($age) - 1;
    }
}
?>