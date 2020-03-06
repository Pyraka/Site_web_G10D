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
        FROM utilisateurs
        WHERE email = :email";
        
        $sql = "SELECT *
        FROM utilisateurs
        WHERE mdp = :mdp";

        $genre=$_POST['email'];
        $genre=$_POST['mdp'];

        $statement = $connection->prepare($sql);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':mdp', $mdp, PDO::PARAM_STR);
        $statement->execute();

        