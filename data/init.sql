CREATE DATABASE test;

  use test;

  CREATE TABLE utilisateurs (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    prenom VARCHAR(30) NOT NULL,
    nom VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    mdp VARCHAR(255),
    age INT(3),
    genre VARCHAR(10),
  );