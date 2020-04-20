<?php
include ('../model/configuration.php');

$isAdmin = false;

if (isset($_SESSION['id'])){
    $req = $bdd->prepare('SELECT allow from user WHERE idUser = ?');
    $req->execute(array($_SESSION['id']));
    $user = $req->fetch();

    if ($user['allow'] == 2){
        $isAdmin = true;
    }
}



if(!isset($_SESSION['id']) OR  $isAdmin == false){

$reponse = $bdd->query('SELECT * FROM faq WHERE isDeleted = 0 ORDER BY idQuestion DESC');


?>



<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title> F.A.Q </title>

  <link rel="stylesheet" href="css/style.css" />
</head> 
    <?php require "templates/header.php"; ?>
        <h2 class="titleFaq">F.A.Q</h2>

        <div class="underline"></div>

<div class="textFaq">
    <ul>
        <?php
        while ($donnees = $reponse->fetch())
        {
            ?>
                <li id="faqQues"><strong><?php echo $donnees['textQuestion'];?></strong></li>
                <br>
                <li id="faqAns"><?php echo $donnees['textAnswer'];?></li>
                <br>
    </ul>
            <?php
        }
        ?>
</div>

    <?php require('templates/footer.php'); ?>
   <?php }
   else 
   require("faqAdmin.php")?>
