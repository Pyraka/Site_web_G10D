<?php

/**
 * Configuration pour se connecter à la BDD
 *
 */

$host       = "localhost";
$username   = "root";
$password   = "";
$dbname     = "medi-sys";
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
