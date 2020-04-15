<?php
try
{
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=infinite_;charset=utf8',
        'root','');
}
catch(Exception $e)
{
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}


if(isset($_POST['delete'])){

    foreach ($_POST['delete'] as $key) {
        $requser = $bdd->prepare("UPDATE faq SET isDeleted = 1 WHERE idQuestion = ?"); 
        $requser->execute(array($key));

        // TODO faire la requete pour update la table deletefaq
    }

    
}
