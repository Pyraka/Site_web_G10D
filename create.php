<?php

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
            "firstname" => $_POST['firstname'],
            "name"  => $_POST['name'],
            "mail" => $_POST['mail'],
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

<?php if (isset($_POST['submit']) && $statement) { ?>
    > <?php echo $_POST['firstname']; ?> ajouté avec succès.
<?php } ?>

<h2>S'inscrire</h2>

<form method="post">
    <label for="firstname">Prénom</label>
    <input type="text" name="firstname" id="firstname" placeholder="Prénom" required>
    <label for="name">Nom</label>
    <input type="text" name="name" id="name" placeholder="name" required>
    <label for="mail">Addresse mail</label>
    <input type="text" name="mail" id="mail" placeholder="Adresse mail" required>
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