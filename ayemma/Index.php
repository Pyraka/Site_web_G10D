<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>FAQ-InfiniteMeasures</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="titre" >
    <p><strong>F.A.Q</strong></p>
</div>

<nav>
    <ul>
        <li><a href="ajouter.php">Ajouter</a> </li>
        <li><a href="modifier.php">Modifier</a> </li>
    </ul>
</nav>
<div class="faq_items">
<?php
// Connexion à la base de données
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
// Affichafe des questions
$reponse = $bdd->query('SELECT textQuestion,textAnswer FROM faq ORDER BY idQuestion');


while ($donnees = $reponse->fetch())
{
    echo '<p>'.'<strong> ' . htmlspecialchars($donnees['textQuestion']) . '</strong>  </p>';
    echo '<p>' . htmlspecialchars($donnees['textAnswer']).'</p>';


}

$reponse->closeCursor();

?>
</div>
</body>

</html>


