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
            "prenom" => $_POST['prenom'],
            "nom"  => $_POST['nom'],
            "email" => $_POST['email'],
            "mdp"  => md5($_POST['mdp']),
            "borndate"   => $_POST['borndate'],
            "genre"  => $_POST['genre']
        );

        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "utilisateurs",
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
    > <?php echo $_POST['prenom']; ?> ajouté avec succès.
<?php } ?>

<h2>S'inscrire</h2>

<form method="post">
    <label for="prenom">Prenom</label>
    <input type="text" name="prenom" id="prenom" placeholder="Prénom" required>
    <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom" placeholder="Nom" required>
    <label for="email">Addresse Email</label>
    <input type="text" name="email" id="email" placeholder="Adresse Email" required>
    <label for="mdp">Mot de passe</label>
    <input type="password" name="mdp" id="mdp" placeholder="Mot de passe" required>
    <label for="mdp_verif">Vérification du mot de passe</label>
    <input type="password" name="mdp_verif" id="mdp_verif" placeholder="Mot de passe" required>
    <label for="borndate">Date de naissance</label>
    <input type="date" name="borndate" id="borndate" placeholder="dd/mm/aa" required>
    <label for="genre">Genre</label>
    <input type="radio" name="genre" value="Homme"> Homme
    <input type="radio" name="genre" value="Femme"> Femme
    <input type="radio" name="genre" value="Autre"> Autre   
    <input type="submit" name="submit" value="S'inscrire">
</form>
</br>
<p class="box-register">Vous avez déjà un compte ? <a href="connect.php">Se connecter</a></p>
</br>
<a href="index.php">Retour à l'accueil</a>

<?php "SELECT DATE_FORMAT(date, '%d/%m/%Y') AS date FROM utilisateurs" ?>

<?php require "templates/footer.php"; ?>