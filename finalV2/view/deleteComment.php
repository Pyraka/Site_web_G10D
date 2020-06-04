<?php require('../model/configuration.php');

$requser = $bdd->prepare('SELECT idTopic FROM forum_comments WHERE idComment = ?');
$requser->execute(array($_GET['id']));
$reponse = $requser->fetch();

$requser = $bdd->prepare('DELETE FROM forum_comments WHERE idComment = ?');
$requser->execute(array($_GET['id']));

header('Location:manageTopic.php?id=' . $reponse["idTopic"]);


?>