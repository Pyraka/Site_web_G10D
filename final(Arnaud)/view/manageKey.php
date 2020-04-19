<?php
require "../controller/reqAdmin/req.manageUser.php";
$produits = $bdd->query('SELECT * FROM keyproduct');
?>


<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title>Administration clé produit</title>
      <link rel="stylesheet" href="css/style.css" />

   </head>
  <?php require "templates/header.php";  ?>
      <h2 class="titleKeys"> Gestion des clés </h2>
      <div class="underline"></div>
      <div class=" firstkey ">
         <ul class="listKey">
            <?php while($p = $produits->fetch()) { ?>
            <li id="idcleprod"> <?= $p['keyProd'] ?> - <a href="manageKey.php?supprime=<?= $p['idKey'] ?>">Supprimer</a></li>
            <?php } ?>
         </ul> 
         <br /><br />
      </div>
      
      <div class="secondKey">
         <form method="get" id="form"> 
            <input type="int" name="keyProd" placeholder="XXXXXXXX"> Clé produit   
            <input type="submit" name="submit" value="Ajouter">
         </form>
            <br /><br />
         <a href="index.php"> Retour à la page d'accueil</a>
      </div>

<?php require "templates/footer.php"; ?>
