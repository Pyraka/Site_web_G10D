<?php session_start();

/**
 * Use an HTML form to create a new entry in the
 * utilisateurs table.
 *
 */


if (isset($_POST['submit'])) {
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
            "gender"  => $_POST['gender']
        );

        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "user",
            implode(", ", array_keys($new_user)),
            ":" . implode(", :", array_keys($new_user))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement)
{
    header("Location: connect.php");
}
?>
<h2>S'inscrire</h2>

<form method="post">
    <label for="firstName">Prénom</label>
    <input type="text" name="firstName" id="firstName" placeholder="Prénom" required>
    <label for="lastName">Nom</label>
    <input type="text" name="lastName" id="lastName" placeholder="Nom" required>
    <label for="email">Addresse email</label>
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

<?php "SELECT DATE_FORMAT(date, '%d/%m/%Y') AS date FROM user" ?>

<?php require "templates/footer.php"; ?>