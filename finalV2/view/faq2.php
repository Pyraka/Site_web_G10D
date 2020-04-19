<?php
require ('../model/configuration.php');

if(!isset($_SESSION['id']) OR  $_SESSION['id']!= 10100){

$reponse = $bdd->query('SELECT * FROM faq WHERE isDeleted = 0 ORDER BY idQuestion DESC');


?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>FAQ-InfiniteMeasures</title>
        <link rel="stylesheet" href="foot/style.css">
    </head>
    <?php require "templates/header.php"; ?>
        <h2 class="titleFaq">F.A.Q</h2>

        <div class="underline"></div>


    <ul>
        <?php
        while ($donnees = $reponse->fetch())
        {
            ?>
            
                <li id="faqQues"><strong><?php echo $donnees['textQuestion'];?></strong></li>
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


