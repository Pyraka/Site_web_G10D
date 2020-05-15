<?php
require ("../model/configuration.php"); 
require ("../controller/functions.php");

   if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
      $supprime = (int) $_GET['supprime'];
      $req = $bdd->prepare('DELETE FROM keyproduct WHERE idKey = ?');
      $req->execute(array($supprime)); 
   }
   if(isset($_POST['submit'])){
      if(isKey($_POST['keyProd'])==true){
         echo "Cette clé existe déjà";
      }
      else{
       $req =$bdd->prepare('INSERT INTO keyproduct(keyProd) VALUES(?) ');
       $req -> execute(array($_POST['keyProd']));
      }
   }

$produits = $bdd->query('SELECT * FROM keyproduct');

?>


<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title> Administration clé produit </title>
  <link rel="stylesheet" href="css/style.css" />
</head>
  <?php require "templates/header.php";  ?>
      <h2 class="titleKeys"> Gestion des clés </h2>
      <div class="underline"></div>
      <div class=" firstkey ">
      
         <ul>
         <h3> Clés </h3>
            <?php while($p = $produits->fetch()) { ?>
             <li id="idcleprod"> Clé : <?= $p['keyProd'] ?> - <a href="manageKey.php?supprime=<?= $p['idKey'] ?>">Supprimer</a></li>
            <?php } ?>
         </ul> 
      </div>
      <br><br><br>
      
      <div class="secondKey"> </div>
         <form method="post"> 
            <input type="int" name="keyProd" placeholder="XXXXXXXX"> Clé produit   
            <input type="submit" name="submit" value="Ajouter">
         </form>
         <br>
         <a class="box-register" href="index.php"> Retour à la page d'accueil</a>
           

<?php require "templates/footer.php"; ?>


