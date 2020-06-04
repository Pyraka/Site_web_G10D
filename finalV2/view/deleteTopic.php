<?php require('../model/configuration.php');

$requser = $bdd->prepare('DELETE FROM forum_topic WHERE idTopic = ?');
$requser->execute(array($_GET['id']));

header('Location:manageForum.php');


?>