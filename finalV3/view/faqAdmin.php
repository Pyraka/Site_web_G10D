<?php
include ('../model/configuration.php');

$reponse = $bdd->query('SELECT * FROM faq WHERE isDeleted = 0 ORDER BY idQuestion DESC');
$reponse1 = $bdd->query('SELECT * FROM faq WHERE isDeleted = 1 ORDER BY idQuestion DESC');

while ($donnees = $reponse1->fetch()){
    if (isset($_POST['backOnline' . $donnees['idQuestion']])){
        $requser = $bdd->prepare("UPDATE faq SET isDeleted = 0 WHERE idQuestion = ?"); 
        $requser->execute(array($donnees['idQuestion']));
        header('Location: faqAdmin.php');
    }
}
while ($donnees = $reponse->fetch()){
    if (isset($_POST['supprimer' . $donnees['idQuestion']])){
        $requser = $bdd->prepare("UPDATE faq SET isDeleted = 1 WHERE idQuestion = ?"); 
        $requser->execute(array($donnees['idQuestion']));
        header('Location: faqAdmin.php');
    }
}
$reponse = $bdd->query('SELECT * FROM faq WHERE isDeleted = 0 ORDER BY idQuestion DESC');
$reponse1 = $bdd->query('SELECT * FROM faq WHERE isDeleted = 1 ORDER BY idQuestion DESC');
?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>FAQ- Admin - InfiniteMeasures</title>
        <link rel="stylesheet" href="foot/style.css">
    </head>
    <?php require('templates/header.php'); ?>
    <h2 class="titleFaq">F.A.Q</h2>
<div class="underline"></div>
<div class="faqbody">
<nav>
    <ul style="list-style:none">
        <li ><a href="faqAdd.php" style="text-decoration: none;color:rgb(161, 57, 202); "><strong>Ajouter une question</strong> </a> </li>
    </ul>
</nav>
<div class="faq_items">





<p style="text-align: center;font-size : 1.2em"> <strong>Questions en ligne</strong></p>
<?php
while ($donnees = $reponse->fetch())
{
    ?>
    <div>
        <p><strong><?php echo $donnees['textQuestion'];?></strong></p>
        <p><?php echo $donnees['textAnswer'];?></p>
        
        <a href="faqMod.php?id=<?= $donnees['idQuestion'] ?>"><button>Modifier</button></a>
        <form method="post">
            <input type="submit" name="supprimer<?=$donnees['idQuestion']?>" value="Supprimer">
        </form>
        <br><br>

    </div>


    <?php
}
?>
<p style="text-align: center;font-size : 1.2em"><strong>Questions supprimées</strong></p>
<?php
while ($donnees = $reponse1->fetch()){
    ?>
    <div>
        <p><strong><?php echo $donnees['textQuestion'];?></strong></p>
        <p><?php echo $donnees['textAnswer'];?></p>
        <form method="post">
            <input type="submit" name="backOnline<?=$donnees['idQuestion']?>" value="Remettre en ligne">
        </form>
        
        <br><br>

    </div>


    <?php
}

?>
</div>
</div>
</body>

</html>


