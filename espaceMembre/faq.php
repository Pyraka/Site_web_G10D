<?php
include ('configuration.php');

$reponse = $bdd->query('SELECT * FROM faq WHERE isDeleted = 0 ORDER BY idQuestion DESC');


?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>FAQ-InfiniteMeasures</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include('templates/header.php'); ?>


    <div class="titre" style="text-align: center;size: 30px">
        <p><strong>F.A.Q</strong></p>
    </div>


    <div class="faq_items">


        <?php
        while ($donnees = $reponse->fetch())
        {
            ?>
            <div>
                <p><strong><?php echo $donnees['textQuestion'];?></strong></p>
                <p><?php echo $donnees['textAnswer'];?></p>
                
                <br>

            </div>


            <?php
        }
        ?>


    </div>

    <?php include('templates/footer.php'); ?>
</body>

</html>


