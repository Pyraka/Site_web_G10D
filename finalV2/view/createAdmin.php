<?php 
require ("../model/configuration.php");

if (isset($_POST['submit']) && isset($_POST['firstName']) AND isset($_POST['lastName']) AND isset($_POST['email']) AND isset($_POST['userPassword']) AND isset($_POST['birthDate']) AND isset($_POST['gender']) AND ($_POST['mdp_verif'])==($_POST['userPassword'])) {
   try {
       if(($_POST['productKey'])!=""){
         // on vérifie que l'email n'est pas déjà utilisée
        $requser = $bdd->prepare("SELECT * FROM user WHERE email = ?");
        $requser->execute(array($_POST['email']));

        $userexist = $requser->rowCount();

        // on vérifie que la clé existe dans la table des  keyproduct
        $reqkey = $bdd->prepare("SELECT * FROM keyproduct WHERE keyProd = ?");
        $reqkey ->execute(array($_POST['productKey']));

        $keyexist = $reqkey ->rowCount();

        if($keyexist != 1){
            echo "Cette clé produit n'existe pas...";
        }

        else if($userexist != 0) {
            echo "Cette adresse email est deja utilisé...";
        }
        

        else{

            // on ajoute s'il n'y a pas deja cette adresse mail dans la bdd
            $requser1 = $bdd->prepare("INSERT INTO user(firstName, lastName, email, birthDate, gender, userPassword, subDate, age, idImage, allow) VALUES(?, ?, ?, ?, ?, ?, NOW(), ? , 1,1)");
            $requser1->execute(array($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['birthDate'], $_POST['gender'], md5($_POST['userPassword']), age($_POST['birthDate'])));

            // On refait une requete maintenant que l'utilisateur a été ajouté
            $requser->execute(array($_POST['email']));
            $utilisateur = $requser->fetch();

            //on ajoute ce même utilisateur dans la table manager car c'est un gestionnaire
            
            $req = $bdd -> query('SELECT * FROM user ORDER BY idUser DESC LIMIT 1'); //permet de selectionner l'id du dernier utilisateur qui s'est inscrit
            while($m = $req->fetch()) {
                $req2 = $bdd -> prepare("INSERT INTO manager(idUser, productKey) VALUES(?, ?)");
                $req2->execute(array($m['idUser'],$_POST['productKey']));
                }
    
         }

        }else{
            $requser = $bdd->prepare("SELECT * FROM user WHERE email = ?");
            $requser->execute(array($_POST['email']));
            $userexist = $requser->rowCount();
            if($userexist != 0) {
                echo "Cette adresse email est deja utilisé...";
            }
            
            else{
                 // on ajoute s'il n'y a pas deja cette adresse mail dans la bdd
            $requser1 = $bdd->prepare("INSERT INTO user(firstName, lastName, email, birthDate, gender, userPassword, subDate, age, idImage, allow) VALUES(?, ?, ?, ?, ?, ?, NOW(), ?, 1, 0)");
            $requser1->execute(array($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['birthDate'], $_POST['gender'], md5($_POST['userPassword']), age($_POST['birthDate'])));

            // On refait une requete maintenant que l'utilisateur a été ajouté
            $requser->execute(array($_POST['email']));
            $utilisateur = $requser->fetch();
            }
        }
    }catch (PDOException $error) {
         echo $error->getMessage();
    }
} ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title> Inscription client</title>

  <link rel="stylesheet" href="css/style.css" />
</head>
<?php require("templates/header.php") ?>
<form method="POST">
            <div class="secondAdmin">

                <strong> Ajouter un utilisateur manuellement </strong>
                <label for="firstName">Prénom</label>
                <input type="text" name="firstName" id="firstName" placeholder="Prénom" required>
                <label for="lastName">Nom</label>
                <input type="text" name="lastName" id="lastName" placeholder="Nom" required>
                <label for="email">Adresse email</label>
                <input type="email" name="email" id="email" placeholder="Adresse email" required>
                <label for="birthDate">Date de naissance</label>
                <input type="date" name="birthDate" id="birthDate" placeholder="dd/mm/aa" required>
                <label for="gender">Genre</label>
                <input type="radio" name="gender" value="Homme"> Homme
                <input type="radio" name="gender" value="Femme"> Femme
                <input type="radio" name="gender" value="Autre"> Autre 
                </div>

                <div class="thirdAdmin">
                <label for="userPassword">Mot de passe</label>
                <input type="password" name="userPassword" id="userPassword" placeholder="Mot de passe" required >
                <label for="mdp_verif">Vérification du mot de passe</label>
                <input type="password" name="mdp_verif" id="mdp_verif" placeholder="Mot de passe" required >
                <span id='message'></span> <!-- permet d'insérer le message de vérification de mot de passe en js -->
                <label for="productKey">Clé produit</label>
                <input type="int" name="productKey" id="productKey" placeholder="XXXXXXXX"> 
                <br></br>
                <input type="submit" name="submit" value="Ajouter manuellement">
               
        </form>
        <br></br>
            <a href="index.php"><strong> Retour à l'accueil</strong></a>
            <br></br>
            <a href="manageUser.php"><strong> Retour à la page précédente</a>
            <a href="index.php"><strong> Retour à l'accueil</strong></a>
            </div>

<script type="text/javascript" src="../js/checkPassword.js"></script>

<?php require("templates/footer.php") ?>

<?php

function age($date){

return intval(date('Y', time() - strtotime($date))) - 1970;

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