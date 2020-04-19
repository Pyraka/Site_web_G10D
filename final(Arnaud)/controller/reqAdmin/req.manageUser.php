<?php
require ("../model/configuration.php"); require("../controller/functions.php");

$requser = $bdd->prepare('SELECT * FROM user WHERE idUser = ?');
$requser->execute(array($_SESSION['id']));
$requser = $requser->fetch();
// on verifie qu'il s'agit bien d'un admin
if (!isset($_SESSION['id']) OR $requser['allow']!= 2){
  header('Location: index.php');
}

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


if(isset($_GET['ban']) AND $_GET['ban'] > 0){
// fonction isBan en bas de la page

  if (userExists($_GET['ban']) == false){
    echo "cet utilisateur n'existe pas!";
  }
  elseif (isBan($_GET['ban'])==true){ echo "Cette utilisateur est déjà bannis.";}

   //bannissment d'un utilisateur

   else{
   $ban = htmlspecialchars((int) $_GET['ban']);
   $req = $bdd->prepare('INSERT INTO ban(idUser, dateBan) VALUES (?,NOW())');
   $req -> execute(array($ban));
   header('Location: manageUser.php');

   }
}

//débannissmenet d'un utilisateur

elseif(isset($_GET['deban']) AND $_GET['deban'] > 0){
  if (userExists($_GET['deban']) == false){
    echo "cet utilisateur n'existe pas!";
  }
 elseif (isBan($_GET['deban'])!== true){echo "Cette utilisateur est déjà non bannis.";}
 else{
   $deban = htmlspecialchars((int) $_GET['deban']);
   $req = $bdd->prepare('DELETE FROM ban WHERE idUser = ?');
   $req->execute(array($deban));
   header('Location: manageUser.php');
}
}



$members = $bdd->query('SELECT * FROM user WHERE allow = 0 ORDER BY idUser DESC'); //allow = 0 c'est un utilisateur

$managers = $bdd->query('SELECT * FROM user WHERE allow = 1 ORDER BY idUser DESC'); //allow = 1 c'est un gestionnaire 

$admins = $bdd->query('SELECT * FROM user WHERE allow = 2 ORDER BY idUser DESC'); // admin = 2
?>
