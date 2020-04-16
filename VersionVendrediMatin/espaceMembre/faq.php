<?php
include ('configuration.php');

if(!isset($_SESSION['id']) OR  $_SESSION['id']!= 10100){

$reponse = $bdd->query('SELECT * FROM faq WHERE isDeleted = 0 ORDER BY idQuestion DESC');


?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>FAQ-InfiniteMeasures</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include('templates/header.php'); ?>
        <h2 class="titre">F.A.Q</h2>

    <div class="underline"></div>

    <div class="faq_items">


        <?php
        while ($donnees = $reponse->fetch())
        {
            ?>
            <ul>
                <li id="faqQues"><strong><?php echo $donnees['textQuestion'];?></strong></li>
                <li id="faqAns"><?php echo $donnees['textAnswer'];?></li>
                
                <br>

        </ul>


            <?php
        }
        ?>


    </div>

    <?php include('templates/footer.php'); ?>
</body>

</html>
   <?php }
   else 
   include "faqAdmin.php" ?>


