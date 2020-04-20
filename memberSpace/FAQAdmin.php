<?php
include ('configuration.php');
$admin = $bdd-> query('SELECT * FROM user WHERE allow = 2');
//IF ID ADMIN = ID SESSION DONC IL PEUT ACCEDER A LA FAQ

$reponse = $bdd->query('SELECT * FROM faq WHERE isDeleted = 0 ORDER BY idQuestion DESC');
$reponse1 = $bdd->query('SELECT * FROM faq WHERE isDeleted = 1 ORDER BY idQuestion DESC');

while ($donnees = $reponse1->fetch()){
    if (isset($_POST['backOnline' . $donnees['idQuestion']])){
        $requser = $bdd->prepare("UPDATE faq SET isDeleted = 0 WHERE idQuestion = ?"); 
        $requser->execute(array($donnees['idQuestion']));
        header('Location: accueilAdmin.php');
    }
}
while ($donnees = $reponse->fetch()){
    if (isset($_POST['supprimer' . $donnees['idQuestion']])){
        $requser = $bdd->prepare("UPDATE faq SET isDeleted = 1 WHERE idQuestion = ?"); 
        $requser->execute(array($donnees['idQuestion']));
        header('Location: accueilAdmin.php');
    }
}
$reponse = $bdd->query('SELECT * FROM faq WHERE isDeleted = 0 ORDER BY idQuestion DESC');
$reponse1 = $bdd->query('SELECT * FROM faq WHERE isDeleted = 1 ORDER BY idQuestion DESC');
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>FAQ-InfiniteMeasures</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="titre" style="text-align: center;size: 30px">
    <p><strong>F.A.Q</strong></p>
</div>

<nav>
    <ul>
        <li><a href="ajouter.php">Ajouter une question</a> </li>
    </ul>
</nav>
<div class="faq_items">





<p style="text-align: center;">Questions en ligne</p>
<?php
while ($donnees = $reponse->fetch())
{
    ?>
    <div>
        <p><strong><?php echo $donnees['textQuestion'];?></strong></p>
        <p><?php echo $donnees['textAnswer'];?></p>
        
        <a href="modifier.php?id=<?= $donnees['idQuestion'] ?>"><button>modifier</button></a>
        <form method="post">
            <input type="submit" name="supprimer<?=$donnees['idQuestion']?>" value="Supprimer">
        </form>
        <br><br>

    </div>


    <?php
}
?>
<p style="text-align: center;">Questions supprimées</p>
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
<a href="index.php">Retour à l'accueil</a>
    
</div>
</body>

</html>




