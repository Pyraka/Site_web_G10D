<?php
$bdd = new PDO('mysql:host=localhost;dbname=infinite_;charset=utf8', 'root', '');
   if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
      $supprime = (int) $_GET['supprime'];
      $req = $bdd->prepare('DELETE FROM keyproduct WHERE idKey = ?');
      $req->execute(array($supprime));
   }
   if(isset($_GET['submit'])){
       $req =$bdd->prepare('INSERT INTO keyproduct(idKey, keyProd) VALUES(?,?) ');
       $req -> execute(array($_GET['idKey'],$_GET['keyProd']));
   }

$produits = $bdd->query('SELECT * FROM keyproduct');
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8" />
   <title>Administration</title>
</head>
<body>
<ul>
      <?php while($p = $produits->fetch()) { ?>
      <li><?= $p['idKey'] ?> : <?= $p['keyProd'] ?> - <a href="manageKey.php?supprime=<?= $p['idKey'] ?>">Supprimer</a></li>
      <?php } ?>

   </ul>
   <br /><br />

   <form method="get">
   <input type="int" name="idKey" placeholder="XXXXXXXX"> Id de clé unique 
      <input type="int" name="keyProd" placeholder="XXXXXXXX"> Clé produit   
    <input type="submit" name="submit" value="Ajouter">
      </form>
      <br /><br />
      IL FAUT FAIRE L'UNICITE DE LA CLE PRODUIT
      <br /><br />

      <a href="adminHome.php"> Retour à la page d'administration</a>


</body>
</html>