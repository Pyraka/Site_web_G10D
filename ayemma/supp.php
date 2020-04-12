<?php
try
{
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=infinite;charset=utf8',
        'root','');
}
catch(Exception $e)
{
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}


if(isset($_POST['delete'])){
    $suppr="";
    foreach ($_POST['delete'] as $idQuestion){
        mysqli_query($bdd,'DELETE FROM faq WHERE idQuestion =$idQuestion');
        $suppr=$idQuestion

    }
}