<?php
$bdd = new PDO('mysql:host=localhost;dbname=infinite_;charset=utf8', 'root', '');
   
   if(isset($_GET['ban'])){
      $band = (int) $_GET['ban'];
      $req = $bdd->prepare('INSERT INTO ban(idUser,dateBan) VALUES (?,NOW())');
      $req -> execute(array($_GET['ban']));
      echo($_GET['ban']);  
   }

   else if(isset($_GET['supprime'])) {
      $supprime = (int) $_GET['supprime'];
      $req = $bdd->prepare('DELETE FROM user WHERE idUser = ?');
      $req->execute(array($supprime));
   }


   else if(isset($_GET['modifie'])){
      
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
      <li><?= $m['idUser'] ?> : <?= $m['email'] ?> - <a href="manageUser.php?modifie=<?= $m['idUser'] ?>">Modifier</a>- <a href="manageUser.php?supprime=<?= $m['idUser'] ?>">Supprimer</a> -
       <a href="manageUser.php?ban=<?= $m['idUser'] ?>">Bannir </a> </li>
      <?php } ?>
   </ul>
   <br /><br />
   <a href="adminHome.php"> Retour à la page d'administration</a>
</body>
</html>