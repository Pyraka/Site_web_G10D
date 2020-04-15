<?php require('configuration.php');

use function PHPSTORM_META\type;

setlocale (LC_TIME, 'fr_FR');

/**
 * Function to query information based on
 * a parameter: in this case, gender.
 *
 */

if (isset($_POST['submit']) && isset ($_POST['gender'])) {
    try {
        

        

        $sql = "SELECT * FROM user WHERE gender = :gender AND age =:age";

        $gender = $_POST['gender'];
        $age = $_POST['age']; //type String ????

        //echo(gettype($age)); // test

        $statement = $bdd->prepare($sql);
        $statement->bindParam(':age', $age, PDO::PARAM_STR);
        $statement->bindParam(':gender', $gender, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

require "templates/header.php";


if (isset($_POST['submit']) && isset ($_POST['gender'])) {
    if ($result && $statement->rowCount() > 0) { ?>
        <h2>Résultats pour "<?php echo ($_POST['gender']); ?>"</h2>

        <table>
            <thead>
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Addresse Email</th>  
                    <th>Age</th>
                    <th>Genre</th>
                    <th>Date d'inscription </th>
                </tr>
            </thead>
            <?php "SELECT DATE('birthDate', '%d/%m/%Y') AS frDate FROM user" ?>
            <tbody>
                <?php foreach ($result as $row) { ?>
                    <tr>
                        <td><?php echo ($row["lastName"]); ?></td>
                        <td><?php echo ($row["firstName"]); ?></td>
                        <td><?php echo ($row["email"]); ?></td>
                        <td><?php echo ($row['age']); ?></td>
                        <td><?php echo ($row["gender"]); ?></td>
                        <td><?php echo($row['subDate']); ?></td>
                        <td><a href="listResults.php?id=<?php echo($row['idUser']) ?>">resultats</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        > Pas de résultat pour "<?php echo ($_POST['gender']); ?>" et "<?php echo ($_POST['age']); ?> ans".
<?php }
} ?>

<h2>Trouver un utilisateur en fonction de son genre</h2>

<form method="post">
<label for="gender">Genre</label>
    <input type="radio" name="gender" value="Homme"> Homme
    <input type="radio" name="gender" value="Femme"> Femme
    <input type="radio" name="gender" value="Autre"> Autre

    <h2> Trouver un utilisateur en fonction de son âge </h2>

    <label for="age"> Age </label>
    <input type="int" name="age" id="age">
    <input type="submit" name="submit" value="Voir les résultats">

</form>




<a href="index.php">Retour à l'accueil</a>

<?php require "templates/footer.php"; ?>