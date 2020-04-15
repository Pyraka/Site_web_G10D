<?php include('configuration.php');


require "templates/header.php"; 



if (isset($_SESSION['id'])){
    header("Location: profil.php?id=".$_SESSION['id']);
}
if (isset($_POST['submit']) && isset($_POST['firstName']) AND isset($_POST['lastName']) AND isset($_POST['email']) AND isset($_POST['userPassword']) AND isset($_POST['birthDate']) AND isset($_POST['gender']) AND ($_POST['mdp_verif'])==($_POST['userPassword'])) {
    
    try {

        // on vérifie que l'email n'est pas déjà utilisée
        $requser = $bdd->prepare("SELECT * FROM user WHERE email = ?");
        $requser->execute(array($_POST['email']));

        $userexist = $requser->rowCount();
        if($userexist != 0) {
            echo "Cette adresse email est deja utilisé...";
        }

        else{

            // on ajoute s'il n'y a pas deja cette adresse mail dans la bdd
            $requser1 = $bdd->prepare("INSERT INTO user(firstName, lastName, email, birthDate, gender, userPassword, subDate, age, idImage) VALUES(?, ?, ?, ?, ?, ?, NOW(), ?, 1)");
            $requser1->execute(array($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['birthDate'], $_POST['gender'], md5($_POST['userPassword']), age($_POST['birthDate'])));

            // On refait une requete maintenant que l'utilisateur a été ajouté
            $requser->execute(array($_POST['email']));
            $utilisateur = $requser->fetch();

            // on connecte directement l'utilisateur grace aux variables de session
            $_SESSION['id'] = $utilisateur['idUser'];
            $_SESSION['email'] = $utilisateur['email'];
            header("Location: profil.php?id=".$_SESSION['id']);

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
?>

<h2>S'inscrire</h2>

<form method="post">
    <label for="firstName">Prénom</label>
    <input type="text" name="firstName" id="firstName" placeholder="Prénom" required>
    <label for="lastName">Nom</label>
    <input type="text" name="lastName" id="lastName" placeholder="Nom" required>
    <label for="email">Adresse email</label>
    <input type="email" name="email" id="email" placeholder="Adresse email" required>
    <label for="userPassword">Mot de passe</label>
    <input type="password" name="userPassword" id="userPassword" placeholder="Mot de passe" required>
    <label for="mdp_verif">Vérification du mot de passe</label>
    <input type="password" name="mdp_verif" id="mdp_verif" placeholder="Mot de passe" required>
    <label for="birthDate">Date de naissance</label>
    <input type="date" name="birthDate" id="birthDate" placeholder="dd/mm/aa" required>
    <label for="gender">Genre</label>
    <input type="radio" name="gender" value="Homme"> Homme
    <input type="radio" name="gender" value="Femme"> Femme
    <input type="radio" name="gender" value="Autre"> Autre   
    <input type="submit" name="submit" value="S'inscrire">
</form>
</br>
<p class="box-register">Vous avez déjà un compte ? <a href="connect.php">Se connecter</a></p>
</br>
<a href="index.php">Retour à l'accueil</a>


<?php require "templates/footer.php"; ?>


<?php

// Fonction permettant de calculer l'age de l'utilisateur en fonction de sa date de naissance 

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
?>