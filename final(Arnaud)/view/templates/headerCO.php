<?php

$bdd = new PDO('mysql:host=localhost;dbname=infinite_;charset=utf8', 'root', '');

if (isset($_SESSION['id']) AND $_SESSION['id'] > 0)
{
	$connecte = 1;
}
else
{
	$connecte = 0;
}

?>