<?php

if(session_status() === PHP_SESSION_NONE) session_start();
 
$bdd = new PDO('mysql:host=localhost;dbname=infinite_;charset=utf8', 'root', '');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
include('cookieConnect.php');



?>