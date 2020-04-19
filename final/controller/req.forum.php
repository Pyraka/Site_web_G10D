<?php require('../model/configuration.php');

$requser = $bdd->query('SELECT *, DATE_FORMAT(date, "Le %d/%m/%Y à %H\h%i") as date_c FROM forum_topic ORDER BY date DESC'); // on pourrait rajouter une LIMIT 10 
$reponse = $requser->fetchAll();



function assignFirstLastName($id){
  global $bdd;
  $requser = $bdd->prepare('SELECT * FROM user WHERE idUser = ?');
  $requser->execute(array($id));
  $answer = $requser->fetch();
  echo $answer['firstName'], " ", $answer['lastName'];
}

?>