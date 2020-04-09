<?php

/**
  * Open a connection via PDO to create a
  * new database and table with structure.
  *
  */

require "config.php";

try {
  $connection = new PDO("mysql:host=$host", $username, $password, $options);
  $sql = file_get_contents("data/127_0_0_1.sql");
  $connection->exec($sql);

  echo "BDD et table crées avec succès.";
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}