<?php
session_start();
?>

<?php
if (isset($_POST['submit'])) {
    try {
        require "config.php";
        require "common.php";

        $connection = new PDO($dsn, $username, $password, $options);
        $sql = "SELECT *
        FROM user
        WHERE mail = :mail";
        
        $sql = "SELECT *
        FROM user
        WHERE userPassword = :userPassword";

        $genre=$_POST['mail'];
        $genre=$_POST['userPassword'];

        $statement = $connection->prepare($sql);
        $statement->bindParam(':mail', $mail, PDO::PARAM_STR);
        $statement->bindParam(':userPassword', $mdp, PDO::PARAM_STR);
        $statement->execute();
    }
    catch (Exception $e) {
        echo 'erreur';
    }
}
?>