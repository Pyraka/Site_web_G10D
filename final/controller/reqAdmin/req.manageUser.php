<?php
require ("../model/configuration.php"); require("../controller/functions.php");

   //ajout d'un utilisateur

if (isset($_POST['submit']) && isset($_POST['firstName']) AND isset($_POST['lastName']) AND isset($_POST['email']) AND isset($_POST['userPassword']) AND isset($_POST['birthDate']) AND isset($_POST['gender']) AND ($_POST['mdp_verif'])==($_POST['userPassword'])) {
 
   try {

     if(($_POST['productKey'])!==""){
         //on vérifie que la clé produit n'est pas déjà utilisée
         $reqkey = $bdd->prepare("SELECT * FROM keyproduct WHERE keyProd = ?");
         $reqkey ->execute(array($_POST['productKey']));
         $keyexist = $reqkey ->rowCount();

         if($keyexist != 1){
             ?> Cette clé produit n'existe pas... <?php
         }
         else{
             //on ajoute l'utilisateur à la table manager via son idUser et sa clé produit 
             emailUseManager($_POST['email']);
             $req = $bdd -> query('SELECT * FROM user ORDER BY idUser DESC LIMIT 1'); //permet de selectionner l'id du dernier utilisateur qui s'est inscrit
             while($m = $req->fetch()) {
                 $req2 = $bdd -> prepare("INSERT INTO manager(idUser, productKey) VALUES(?, ?)");
                 $req2->execute(array($m['idUser'],$_POST['productKey']));
             }
         }

     }
     
     else{

         emailUse($_POST['email']);
             
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


if(isset($_GET['ban'])){
// fonction isBan en bas de la page


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
 if (isBan($_GET['deban'])!== true){echo "Cette utilisateur est déjà non bannis.";}
 else{
   $deban = (int) $_GET['deban'];
   $req = $bdd->prepare('DELETE FROM ban WHERE idUser = ?');
   $req->execute(array($deban));
}
}




$members = $bdd->query('SELECT * FROM user WHERE allow = 0'); //allow = 0 c'est un utilisateur
$managers = $bdd->query('SELECT * FROM user WHERE allow = 1'); //allow = 1 c'est un gestionnaire (hors cas admin alow = 2)
?>
