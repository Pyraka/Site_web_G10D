<?php

/**
 * Function to query information based on
 * a parameter: in this case, gender.
 *
 */

if (isset($_POST['submit'])) {
    try {
        require "config.php";
        require "common.php";

        $connection = new PDO($dsn, $username, $password, $options);

        $sql = "SELECT *
    FROM user
    WHERE gender = :gender";

        $gender = $_POST['gender'];

        $statement = $connection->prepare($sql);
        $statement->bindParam(':gender', $gender, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>
<?php require "templates/header.php"; ?>

<?php
if (isset($_POST['submit'])) {
    if ($result && $statement->rowCount() > 0) { ?>
        <h2>Résultats</h2>

        <table>
            <thead>
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Addresse Email</th>
                    <th>Mot de passe</th>   
                    <th>Date de naissance</th>
                    <th>Genre</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row) { ?>
                    <tr>
                        <td><?php echo ($row["lastName"]); ?></td>
                        <td><?php echo ($row["firstName"]); ?></td>
                        <td><?php echo ($row["email"]); ?></td>
                        <td><?php echo ($row["userPassword"]); ?></td>
                        <td><?php echo ($row['birthDate']); ?></td>
                        <td><?php echo ($row["gender"]); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        > Pas de résultat pour <?php echo ($_POST['gender']); ?>.
<?php }
} ?>

<h2>Trouver un utilisateur en fonction de son genre</h2>

<form method="post">
<label for="gender">Genre</label>
    <input type="radio" name="gender" value="Homme"> Homme
    <input type="radio" name="gender" value="Femme"> Femme
    <input type="radio" name="gender" value="Autre"> Autre
    <input type="submit" name="submit" value="Voir les résultats">
</form>

<a href="index.php">Retour à l'accueil</a>

<?php require "templates/footer.php"; ?>