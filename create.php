<?php require "templates/header.php"; ?>
<?php
if (isset($_POST['submit']) && ($_POST['mdp_verif'])==($_POST['userPassword'])) {
    require "config.php";
    require "common.php";
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_user = array(
            "firstName" => $_POST['firstName'],
            "lastName"  => $_POST['lastName'],
            "email" => $_POST['email'],
            "userPassword"  => md5($_POST['userPassword']),
            "birthDate"   => $_POST['birthDate'],
            "gender"  => $_POST['gender'],
            "age" => age($_POST['birthDate']),
            "subDate" => date('Y-m-d'));

        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "user",
            implode(", ", array_keys($new_user)),
            ":" . implode(", :", array_keys($new_user))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_user);


        echo("Bienvenu chez Infinite Measures !");
        
    }catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
else{ 
    echo("Les mots de passe ne sont pas identiques");
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