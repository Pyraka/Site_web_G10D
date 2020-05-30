<?php
//require('../model/configuration.php');
$bdd = new PDO('mysql:host=localhost;dbname=infinite_;charset=utf8', 'root', '');

if (!empty($_POST)){
  $valid = true;


  if (isset($_POST['createQuestion'])){
    $question = htmlspecialchars(trim($_POST['textQuestion']));
    $answer = htmlspecialchars(trim($_POST['textAnswer']));

    if(empty($question)){
      $valid = false;
      $er_question = "Veuillez mettre une question";
    }

    if(empty($answer)){
      $valid = false;
      $er_answer = 'Veuillez mettre une réponse';
    }
  }

  if($valid){

    $requser = $bdd->prepare("INSERT INTO faq(textQuestion, textAnswer, isDeleted) VALUES(?, ?, 0)");
    $requser->execute(array($question, $answer));
    header('Location: faqAdmin.php');

  }

}
?>