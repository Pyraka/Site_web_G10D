
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>Ajouter une question</title>
</head>

    <body>
    <form action="ajouter.php" method="post">

        <p> <strong>AJOUTER UNE QUESTION</strong><br/><br>
            <label for="textQuestion"></label><br> <textarea placeholder="Insérez une réponse.."name="textQuestion" id="textQuestion" rows="5" cols="70"></textarea><br><br />
            <label for="textAnswer"></label><br> <textarea  placeholder="Insérez une question.." name="textAnswer" id="textAnswer" rows="5" cols="70"></textarea><br><br />
            <input type="submit"  value="Ajouter" />
        </p>
    </form>



<?php

// Conxion à la bdd
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=infinite;charset=utf8', 'root', '');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

// On ajoute la question et la reponse à la bdd
$textQuestion=isset($_POST['textQuestion'])?$_POST['textQuestion']: NULL;
$textAnswer=isset($_POST['textAnswer'])?$_POST['textAnswer']: NULL;
$req = $bdd->prepare('INSERT INTO faq (textQuestion, textAnswer) VALUES(?, ?)');
$req->execute(array($textQuestion,$textAnswer));

// on revient sur les faq


?>
    <p><a href="Index.php">Retour aux faq</a> </p>
    </body>
</html>
