<?php
require ("../model/configuration.php"); require("../controller/functions.php");

   if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
      $supprime = (int) $_GET['supprime'];
      $req = $bdd->prepare('DELETE FROM keyproduct WHERE idKey = ?');
      $req->execute(array($supprime));
   }
   if(isset($_GET['submit'])){
      if(isKey($_GET['keyProd'])==true){
         echo "Cette clé existe déjà";
      }
      else{
       $req =$bdd->prepare('INSERT INTO keyproduct(keyProd) VALUES(?) ');
       $req -> execute(array($_GET['keyProd']));
      }

   }
   $produits = $bdd->query('SELECT * FROM keyproduct');

?>