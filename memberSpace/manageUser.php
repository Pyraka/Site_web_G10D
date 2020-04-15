<?php include "configuration.php";
include "templates/header.php";

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




$members = $bdd->query('SELECT * FROM user WHERE allow = 0');
$managers = $bdd->query('SELECT * FROM user WHERE allow = 1');
?>


<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8" />
   <title>Administration</title>
</head>
<body>
<br></br>
Utilisateurs 
<ul>
      <?php while($m = $members->fetch()) { ?>
      <li>
      <?= $m['email'] ?> - <a href="modifUser.php">Modifier</a>
      - <a href="manageUser.php?ban=<?= $m['idUser'] ?>">Bannir </a>
      - <a href="manageUser.php?deban=<?= $m['idUser'] ?>">Débannir </a> </li>
      <?php } ?>
   </ul>
Gestionnaires
   <ul>
      <?php while($m = $managers->fetch()) { ?>
      <li>
      <?= $m['email'] ?> - <a href="modifUser.php">Modifier</a>
      - <a href="manageUser.php?ban=<?= $m['idUser'] ?>">Bannir </a>
      - <a href="manageUser.php?deban=<?= $m['idUser'] ?>">Débannir </a> </li>
      <?php } ?>
   </ul>

   <form method="POST">
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
    <label for="productKey">Clé produit</label>
    <input type="int" name="productKey" id="productKey" placeholder="XXXXXXXX"> 
    <input type="submit" name="submit" value="Ajouter manuellement">
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

function emailUse($email){
    $bdd = new PDO('mysql:host=localhost;dbname=infinite_;charset=utf8', 'root', '');
    $requser = $bdd->prepare("SELECT * FROM user WHERE email = ?");
    $requser->execute(array($email));
    $userexist = $requser->rowCount();
    //on vérifie que l'adresse mail n'est pas déjà utilisée
    if($userexist != 0){
        echo "Cette adresse mail est déjà utilisée";
    }
    else{
        // on ajoute s'il n'y a pas deja cette adresse mail dans la bdd
        $requser1 = $bdd->prepare("INSERT INTO user(firstName, lastName, email, birthDate, gender, userPassword, subDate, age, allow) VALUES(?, ?, ?, ?, ?, ?, NOW(), ?,0)");
        $requser1->execute(array($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['birthDate'], $_POST['gender'], md5($_POST['userPassword']), age($_POST['birthDate'])));
        // On refait une requete maintenant que l'utilisateur a été ajouté
        $requser->execute(array($_POST['email']));
        $utilisateur = $requser->fetch();
        }
}

function emailUseManager($email){
    $bdd = new PDO('mysql:host=localhost;dbname=infinite_;charset=utf8', 'root', '');
    $requser = $bdd->prepare("SELECT * FROM user WHERE email = ?");
    $requser->execute(array($email));
    $userexist = $requser->rowCount();
    //on vérifie que l'adresse mail n'est pas déjà utilisée
    if($userexist != 0){
        echo "Cette adresse mail est déjà utilisée";
    }
    else{
        // on ajoute s'il n'y a pas deja cette adresse mail dans la bdd
        $requser1 = $bdd->prepare("INSERT INTO user(firstName, lastName, email, birthDate, gender, userPassword, subDate, age, allow) VALUES(?, ?, ?, ?, ?, ?, NOW(), ?,1)");
        $requser1->execute(array($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['birthDate'], $_POST['gender'], md5($_POST['userPassword']), age($_POST['birthDate'])));
        // On refait une requete maintenant que l'utilisateur a été ajouté
        $requser->execute(array($_POST['email']));
        $utilisateur = $requser->fetch();
        }
}

?>


<?php include "templates/footer.php"; ?>
  </body>
</html>