<?php

/**
 * Function to query information based on
 * a parameter: in this case, genre.
 *
 */

if (isset($_POST['submit'])) {
    try {
        require "config.php";
        require "common.php";

        $connection = new PDO($dsn, $username, $password, $options);

        $sql = "SELECT *
    FROM utilisateurs
    WHERE genre = :genre";

        $genre = $_POST['genre'];

        $statement = $connection->prepare($sql);
        $statement->bindParam(':genre', $genre, PDO::PARAM_STR);
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
                    <th>#</th>
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
                        <td><?php echo ($row["id"]); ?></td>
                        <td><?php echo ($row["prenom"]); ?></td>
                        <td><?php echo ($row["nom"]); ?></td>
                        <td><?php echo ($row["email"]); ?></td>
                        <td><?php echo ($row["mdp"]); ?></td>
                        <td><?php echo ($row['borndate']); ?></td>
                        <td><?php echo ($row["genre"]); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        > Pas de résultat pour <?php echo ($_POST['genre']); ?>.
<?php }
} ?>

<h2>Trouver un utilisateur en fonction de son genre</h2>

<form method="post">
    <label for="genre">Genre</label>
    <input type="text" id="genre" name="genre">
    <input type="submit" name="submit" value="Voir les résultats">
</form>

<a href="index.php">Retour à l'accueil</a>

<?php require "templates/footer.php"; ?>