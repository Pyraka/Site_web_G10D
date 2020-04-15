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
$idQuestion=isset($_GET['idQuestion']);
$textQuestion=isset($_POST['textQuestion'])?$_POST['textQuestion']: NULL;
$idQuestion=isset($_POST['idQuestion'])?$_POST['idQuestion']: NULL;
$textAnswer=isset($_POST['textAnswer'])?$_POST['textAnswer']: NULL;

if (isset($_POST['modifier_faq'])){
    $response=$bdd->prepare('UPDATE faq SET textQuestion= , textAnswer= ? WHERE idQuestion= ?');
    $response->execute(array($textQuestion,$textAnswer));

}

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">


</head>
<body>
<div class="faq_edit">
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

    $reponse = $bdd->query('SELECT * FROM faq ');
    $textQuestion=isset($_POST['textQuestion'])?$_POST['textQuestion']: NULL;
    $idQuestion=isset($_POST['idQuestion'])?$_POST['idQuestion']: NULL;
    $textAnswer=isset($_POST['textAnswer'])?$_POST['textAnswer']: NULL;
    while ($donnees = $reponse->fetch())
    {

        echo '<div class="faq"><form action="modifier.php?faq=',$idQuestion,'" method="post">
    <div class="question>"<span>Question:<br><input type="text" name="question" size="65" value="', htmlspecialchars($donnees['textQuestion']),'" /></span></div> <br /><br>
    <div class="reponse">Reponse:<br> <input type="text" name="reponse" size="65" value="', htmlspecialchars($donnees['textAnswer']),'" /></div><br>
    <input type="submit" name="supprimer_faq" value="Supprimer faq"/>  <input type="submit" name="modifier_faq" value="valider les changements"/>
    </form></div> <br><br>
    ';

    }
    ?>

</div>

</body>

</html>