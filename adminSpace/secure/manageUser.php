<?php
$bdd = new PDO('mysql:host=localhost;dbname=infinite_;charset=utf8', 'root', '');
   

   //ajout d'un utilisateur

   /*else if($_GET['submit']){
      $req =$bdd->prepare('INSERT INTO user(email, userPassword) VALUES(?,?) ');
      $req -> execute(array($_GET['email'],$_GET['password']));
   }*/

   if(isset($_GET['ban'])){
      //vérif si utilisateur déjà banni
      $ban = (int) $_GET['ban'];
      $allBan = $bdd ->prepare('SELECT * FROM ban WHERE idUser = ?');
      $allBan -> execute(array($ban));
      $banExist = $allBan->rowCount();

      if($banExist != 0){
         echo "Cette personne est déjà banni" ; 
      }
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

   <form method="get">
      <strong> Ajouter un utilisateur</strong> <br></br>
      <label for="email">Adresse email</label>
      <input type="email" name="email" id="email" placeholder="adresse@email" required>  <br /><br />
      <label for="password">Mot de passe </label>
      <input type="password" name="password" placeholder="password"> 
      <input type="submit" name="submit" value="Ajouter">
   </form>

   <br /><br />
   <a href="adminHome.php"> Retour à la page d'administration</a>
</body>
</html>